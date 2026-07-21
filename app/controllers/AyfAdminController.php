<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\AyfCategoria;
use App\Models\AyfMarca;
use App\Models\AyfProducto;
use App\Models\AyfProductoImagen;
use App\Models\AyfBanner;
use App\Models\AyfUsuario;
use App\Models\AyfConfiguracion;

class AyfAdminController extends Controller
{
    protected function startSecureSession()
    {
        parent::startSecureSession();
    }

    protected function regenerateSession()
    {
        parent::regenerateSession();
    }

    public function __construct()
    {
        $this->startSecureSession();
        $this->generateCsrfToken();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION['ayf_admin'])) {
            if (!isset($_POST['user']) || !isset($_POST['pass'])) {
                $this->render('admin/ayf_login');
                exit;
            }
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['ayf_admin'])) {
            $uri = $_SERVER['REQUEST_URI'] ?? '';
            $isJson = strpos($uri, '/data/') !== false || strpos($uri, '/guardar') !== false || strpos($uri, '/eliminar') !== false;
            if (!$isJson) {
                $this->validateCsrfToken();
            }
        }
        if (!isset($_SESSION['ayf_admin'])) {
            $uri = $_SERVER['REQUEST_URI'] ?? '';
            $isAjax = strpos($uri, '/data/') !== false || strpos($uri, '/guardar') !== false || strpos($uri, '/eliminar') !== false;
            if ($isAjax) {
                $this->json(['error' => 'No autorizado'], 401);
                exit;
            }
            $this->render('admin/ayf_login');
            exit;
        }
    }

    public function login()
    {
        $this->checkRateLimit('ayf_login', 5, 60);

        $user = $_POST['user'] ?? '';
        $pass = $_POST['pass'] ?? '';

        $usuario = (new AyfUsuario())->queryFirst(
            "SELECT * FROM ayf_usuarios WHERE estado = 1 AND (email = ? OR nombre = ?) LIMIT 1",
            [$user, $user]
        );

        if ($usuario) {
            if (password_verify($pass, $usuario['password'])) {
                $this->resetRateLimit('ayf_login');
                $this->regenerateSession();
                $_SESSION['ayf_admin'] = true;
                $_SESSION['ayf_admin_user'] = $usuario['nombre'];
                $_SESSION['ayf_admin_rol'] = $usuario['rol'];
                $this->redirect('ayf-admin');
            }
            if (md5($pass) === $usuario['password']) {
                $this->resetRateLimit('ayf_login');
                $this->regenerateSession();
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                (new AyfUsuario())->update($usuario['id'], ['password' => $hash]);
                $_SESSION['ayf_admin'] = true;
                $_SESSION['ayf_admin_user'] = $usuario['nombre'];
                $_SESSION['ayf_admin_rol'] = $usuario['rol'];
                $this->redirect('ayf-admin');
            }
        }

        $this->render('admin/ayf_login', ['error' => 'Credenciales incorrectas']);
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('');
    }

    public function dashboard()
    {
        $this->render('admin/ayf_dashboard', [
            'totalCategorias' => count((new AyfCategoria())->all()),
            'totalMarcas' => count((new AyfMarca())->all()),
            'totalProductos' => count((new AyfProducto())->all()),
            'totalBanners' => count((new AyfBanner())->all()),
            'productosRecientes' => (new AyfProducto())->query(
                "SELECT p.*, c.nombre as categoria_nombre FROM ayf_productos p LEFT JOIN ayf_categorias c ON p.categoria_id = c.id ORDER BY p.id DESC LIMIT 5"
            ),
        ]);
    }

    private function paginate($model, $page = 1, $perPage = 15, $orderBy = 'id DESC')
    {
        $page = max(1, (int)$page);
        $offset = ($page - 1) * $perPage;
        $table = $model->getTable();
        $total = $model->queryFirst("SELECT COUNT(*) as c FROM {$table}")['c'];
        $items = $model->query("SELECT * FROM {$table} ORDER BY {$orderBy} LIMIT ? OFFSET ?", [$perPage, $offset]);
        return [$items, $total, $page, ceil($total / $perPage)];
    }

    // ============ CATEGORIAS ============
    public function categorias()
    {
        $page = $_GET['page'] ?? 1;
        list($items, $total, $currentPage, $totalPages) = $this->paginate(new AyfCategoria(), $page, 15, 'orden ASC');
        $this->render('admin/ayf_categorias', [
            'categorias' => $items,
            'totalCategorias' => $total,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
        ]);
    }

    public function categoriaGuardar()
    {
        $id = $_POST['id'] ?? null;
        $model = new AyfCategoria();
        $data = [
            'nombre' => $_POST['nombre'],
            'slug' => AyfCategoria::slugify($_POST['nombre']),
            'descripcion' => $_POST['descripcion'] ?? '',
            'color' => $_POST['color'] ?? '#e63946',
            'orden' => (int)($_POST['orden'] ?? 0),
            'estado' => (int)($_POST['estado'] ?? 1),
        ];
        if ($id) {
            $f = $model->find($id);
            if (isset($_FILES['imagen']) && $_FILES['imagen']['name']) {
                $uploaded = $this->uploadFile($_FILES['imagen'], 'ayf_categorias');
                if ($uploaded) { $this->deleteFile($f['imagen']); $data['imagen'] = $uploaded; }
            }
            if (isset($_FILES['icono']) && $_FILES['icono']['name']) {
                $uploaded = $this->uploadFile($_FILES['icono'], 'ayf_categorias');
                if ($uploaded) { $this->deleteFile($f['icono']); $data['icono'] = $uploaded; }
            }
            $model->update($id, $data);
        } else {
            if (isset($_FILES['imagen']) && $_FILES['imagen']['name']) {
                $uploaded = $this->uploadFile($_FILES['imagen'], 'ayf_categorias');
                if ($uploaded) $data['imagen'] = $uploaded;
            }
            if (isset($_FILES['icono']) && $_FILES['icono']['name']) {
                $uploaded = $this->uploadFile($_FILES['icono'], 'ayf_categorias');
                if ($uploaded) $data['icono'] = $uploaded;
            }
            $model->create($data);
        }
        $this->json(['ok' => true]);
    }

    public function categoriaData($id)
    {
        $f = (new AyfCategoria())->find($id);
        $this->json($f ?: []);
    }

    public function categoriaDelete($id)
    {
        $f = (new AyfCategoria())->find($id);
        if ($f) { $this->deleteFile($f['imagen']); $this->deleteFile($f['icono']); (new AyfCategoria())->delete($id); }
        $this->json(['ok' => true]);
    }

    // ============ MARCAS ============
    public function marcas()
    {
        $page = $_GET['page'] ?? 1;
        list($items, $total, $currentPage, $totalPages) = $this->paginate(new AyfMarca(), $page, 15);
        $this->render('admin/ayf_marcas', [
            'marcas' => $items,
            'totalMarcas' => $total,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
        ]);
    }

    public function marcaGuardar()
    {
        $id = $_POST['id'] ?? null;
        $model = new AyfMarca();
        $data = [
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'] ?? '',
            'sitio_web' => $_POST['sitio_web'] ?? '',
            'estado' => (int)($_POST['estado'] ?? 1),
        ];
        if ($id) {
            $m = $model->find($id);
            if (isset($_FILES['logo']) && $_FILES['logo']['name']) {
                $uploaded = $this->uploadFile($_FILES['logo'], 'ayf_marcas');
                if ($uploaded) { $this->deleteFile($m['logo']); $data['logo'] = $uploaded; }
            }
            $model->update($id, $data);
        } else {
            if (isset($_FILES['logo']) && $_FILES['logo']['name']) {
                $uploaded = $this->uploadFile($_FILES['logo'], 'ayf_marcas');
                if ($uploaded) $data['logo'] = $uploaded;
            }
            $model->create($data);
        }
        $this->json(['ok' => true]);
    }

    public function marcaData($id)
    {
        $m = (new AyfMarca())->find($id);
        $this->json($m ?: []);
    }

    public function marcaDelete($id)
    {
        $m = (new AyfMarca())->find($id);
        if ($m) { $this->deleteFile($m['logo']); (new AyfMarca())->delete($id); }
        $this->json(['ok' => true]);
    }

    // ============ PRODUCTOS ============
    public function productos()
    {
        $page = $_GET['page'] ?? 1;
        $page = max(1, (int)$page);
        $perPage = 15;
        $offset = ($page - 1) * $perPage;
        $model = new AyfProducto();
        $total = count($model->all());
        $totalPages = ceil($total / $perPage);
        $productos = $model->query(
            "SELECT p.*, c.nombre as categoria_nombre, m.nombre as marca_nombre
             FROM ayf_productos p LEFT JOIN ayf_categorias c ON p.categoria_id = c.id
             LEFT JOIN ayf_marcas m ON p.marca_id = m.id
             ORDER BY p.id DESC LIMIT ? OFFSET ?",
            [$perPage, $offset]
        );
        $this->render('admin/ayf_productos', [
            'productos' => $productos,
            'totalProductos' => $total,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ]);
    }

    public function productoCreate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new AyfProducto();
            $data = $this->productoDataFromPost();
            if (isset($_FILES['imagen_principal']) && $_FILES['imagen_principal']['name']) {
                $uploaded = $this->uploadFile($_FILES['imagen_principal'], 'ayf_productos');
                if ($uploaded) $data['imagen_principal'] = $uploaded;
            }
            $id = $model->create($data);
            $this->uploadGaleria($id, $_FILES['galeria'] ?? null);
            $this->redirect('ayf-admin/productos');
        }
        $this->render('admin/ayf_producto_form', [
            'categorias' => (new AyfCategoria())->all('orden ASC'),
            'marcas' => (new AyfMarca())->all(),
        ]);
    }

    public function productoEdit($id)
    {
        $model = new AyfProducto(); $producto = $model->find($id);
        if (!$producto) { $this->redirect('ayf-admin/productos'); }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->productoDataFromPost();
            if (isset($_FILES['imagen_principal']) && $_FILES['imagen_principal']['name']) {
                $uploaded = $this->uploadFile($_FILES['imagen_principal'], 'ayf_productos');
                if ($uploaded) {
                    $this->deleteFile($producto['imagen_principal']);
                    $data['imagen_principal'] = $uploaded;
                }
            }
            $model->update($id, $data);
            $this->uploadGaleria($id, $_FILES['galeria'] ?? null);
            $this->redirect('ayf-admin/productos');
        }

        $this->render('admin/ayf_producto_form', [
            'producto' => $producto,
            'galeria' => (new AyfProductoImagen())->byProducto($id),
            'categorias' => (new AyfCategoria())->all('orden ASC'),
            'marcas' => (new AyfMarca())->all(),
        ]);
    }

    private function productoDataFromPost()
    {
        return [
            'categoria_id' => $_POST['categoria_id'],
            'marca_id' => ($_POST['marca_id'] ?? '') !== '' ? $_POST['marca_id'] : NULL,
            'codigo' => $_POST['codigo'] ?? '',
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'] ?? '',
            'material' => $_POST['material'] ?? '',
            'genero' => $_POST['genero'] ?? 'unisex',
            'tallas' => $_POST['tallas'] ?? '',
            'colores' => $_POST['colores'] ?? '',
            'precio' => ($_POST['precio'] ?? '') !== '' ? $_POST['precio'] : NULL,
            'precio_anterior' => ($_POST['precio_anterior'] ?? '') !== '' ? $_POST['precio_anterior'] : NULL,
            'video' => $_POST['video'] ?? '',
            'stock' => (int)($_POST['stock'] ?? 0),
            'destacado' => isset($_POST['destacado']) ? 1 : 0,
            'nuevo' => isset($_POST['nuevo']) ? 1 : 0,
            'orden' => $_POST['orden'] ?? 0,
            'estado' => isset($_POST['estado']) ? 1 : 0,
        ];
    }

    private function uploadGaleria($productoId, $files)
    {
        if (!$files || empty($files['name'][0])) return;
        $model = new AyfProductoImagen();
        foreach ($files['name'] as $i => $name) {
            if (!$name) continue;
            $file = [
                'name' => $files['name'][$i],
                'type' => $files['type'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error' => $files['error'][$i],
                'size' => $files['size'][$i],
            ];
            if ($path = $this->uploadFile($file, 'ayf_productos')) {
                $model->create(['producto_id' => $productoId, 'imagen' => $path, 'orden' => $i]);
            }
        }
    }

    public function productoDeleteGaleria($id)
    {
        $img = (new AyfProductoImagen())->find($id);
        if ($img) { $this->deleteFile($img['imagen']); (new AyfProductoImagen())->delete($id); }
        $this->json(['ok' => true]);
    }

    public function productoDelete($id)
    {
        $p = (new AyfProducto())->find($id);
        if ($p) {
            $this->deleteFile($p['imagen_principal']);
            foreach ((new AyfProductoImagen())->byProducto($id) as $img) { $this->deleteFile($img['imagen']); (new AyfProductoImagen())->delete($img['id']); }
            (new AyfProducto())->delete($id);
        }
        $this->json(['ok' => true]);
    }

    // ============ BANNERS ============
    public function banners()
    {
        $page = $_GET['page'] ?? 1;
        list($items, $total, $currentPage, $totalPages) = $this->paginate(new AyfBanner(), $page, 15, 'orden ASC');
        $msgMap = ['ok' => 'Banner guardado correctamente.', 'del_ok' => 'Banner eliminado correctamente.'];
        $this->render('admin/ayf_banners', [
            'banners' => $items,
            'totalBanners' => $total,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'message' => $msgMap[$_GET['msg'] ?? ''] ?? '',
        ]);
    }

    public function bannerCreate()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST)) {
                $this->redirect('ayf-admin/banners/crear');
            }
            $data = [
                'titulo' => $_POST['titulo'] ?? '',
                'subtitulo' => $_POST['subtitulo'] ?? '',
                'link' => $_POST['link'] ?? '',
                'orden' => (int)($_POST['orden'] ?? 0),
                'estado' => (int)($_POST['estado'] ?? 1),
            ];
            if (isset($_FILES['imagen']) && $_FILES['imagen']['name']) {
                $uploaded = $this->uploadFile($_FILES['imagen'], 'ayf_banners');
                if ($uploaded) {
                    $data['imagen'] = $this->normalizeExistingUpload($uploaded);
                } else {
                    $error = $this->getLastUploadError();
                }
            } else {
                $error = 'Debe seleccionar una imagen.';
            }
            if (!$error && $data['imagen']) {
                (new AyfBanner())->create($data);
                $this->redirect('ayf-admin/banners?msg=ok');
            }
        }
        $this->render('admin/ayf_banner_form', ['error' => $error, 'formData' => $data ?? []]);
    }

    public function bannerEdit($id)
    {
        $model = new AyfBanner(); $banner = $model->find($id);
        if (!$banner) { $this->redirect('ayf-admin/banners'); }
        $error = '';
        $debug = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST)) {
                $this->redirect('ayf-admin/banners/editar/' . $id);
            }
            $data = [
                'titulo' => $_POST['titulo'] ?? '',
                'subtitulo' => $_POST['subtitulo'] ?? '',
                'link' => $_POST['link'] ?? '',
                'orden' => (int)($_POST['orden'] ?? 0),
                'estado' => (int)($_POST['estado'] ?? 1),
            ];
            if (isset($_FILES['imagen']) && $_FILES['imagen']['name']) {
                $uploaded = $this->uploadFile($_FILES['imagen'], 'ayf_banners');
                if ($uploaded) {
                    $this->deleteFile($banner['imagen']);
                    $data['imagen'] = $this->normalizeExistingUpload($uploaded);
                } else {
                    $error = $this->getLastUploadError();
                }
            } elseif (!empty($_POST['eliminar_imagen'])) {
                $this->deleteFile($banner['imagen']);
                $data['imagen'] = '';
            }
            if (!$error) {
                $model->update($id, $data);
                $this->redirect('ayf-admin/banners?msg=ok');
            }
        }
        $targetDir = __DIR__ . '/../../public/uploads/ayf_banners/';
        $debug = "TargetDir: <code>{$targetDir}</code><br>Existe: " . (is_dir($targetDir) ? '✅ Si' : '❌ No') . "<br>Escribible: " . (is_dir($targetDir) && is_writable($targetDir) ? '✅ Si' : '❌ No');
        $this->render('admin/ayf_banner_form', ['banner' => $banner, 'error' => $error, 'debug' => $debug]);
    }

    public function bannerDelete($id)
    {
        $b = (new AyfBanner())->find($id);
        if ($b) { $this->deleteFile($b['imagen']); (new AyfBanner())->delete($id); }
        $this->json(['ok' => true]);
    }

    // ============ USUARIOS ============
    public function usuarios()
    {
        $page = $_GET['page'] ?? 1;
        list($items, $total, $currentPage, $totalPages) = $this->paginate(new AyfUsuario(), $page, 15);
        $this->render('admin/ayf_usuarios', [
            'usuarios' => $items,
            'totalUsuarios' => $total,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
        ]);
    }

    public function usuarioCreate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new AyfUsuario())->create(['nombre' => $_POST['nombre'], 'email' => $_POST['email'], 'password' => password_hash($_POST['password'], PASSWORD_DEFAULT), 'rol' => $_POST['rol'] ?? 'editor', 'estado' => $_POST['estado'] ?? 1]);
            $this->redirect('ayf-admin/usuarios');
        }
        $this->render('admin/ayf_usuario_form');
    }

    public function usuarioEdit($id)
    {
        $model = new AyfUsuario(); $usuario = $model->find($id);
        if (!$usuario) { $this->redirect('ayf-admin/usuarios'); }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['nombre' => $_POST['nombre'], 'email' => $_POST['email'], 'rol' => $_POST['rol'] ?? 'editor', 'estado' => $_POST['estado'] ?? 1];
            if ($_POST['password']) $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $model->update($id, $data);
            $this->redirect('ayf-admin/usuarios');
        }
        $this->render('admin/ayf_usuario_form', ['usuario' => $usuario]);
    }

    public function usuarioDelete($id)
    {
        (new AyfUsuario())->delete($id);
        $this->json(['ok' => true]);
    }

    // ============ CONFIGURACION ============
    public function configuracion()
    {
        $model = new AyfConfiguracion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $keys = [
                'site_name', 'site_desc', 'whatsapp', 'whatsapp_msg',
                'email', 'phone', 'address', 'facebook', 'instagram',
                'linkedin', 'tiktok', 'youtube',
                'theme_primary', 'theme_primary_hover', 'theme_secondary', 'theme_accent',
            ];
            foreach ($keys as $key) {
                if (isset($_POST[$key])) {
                    $model->set($key, $_POST[$key]);
                }
            }
            if ($_FILES['logo']['name']) {
                $path = $this->uploadFile($_FILES['logo'], 'ayf_config');
                if ($path) $model->set('logo', $path);
            }
            if ($_FILES['banner_contacto']['name']) {
                $path = $this->uploadFile($_FILES['banner_contacto'], 'ayf_config');
                if ($path) $model->set('banner_contacto', $path);
            }
            $this->redirect('ayf-admin/configuracion');
        }

        $this->render('admin/ayf_configuracion', [
            'config' => $model->allAsArray(),
        ]);
    }
}
