<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Familia;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\ProductoImagen;
use App\Models\Banner;
use App\Models\Usuario;
use App\Models\BuenaPractica;

class AdminController extends Controller
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION['admin'])) {
            if (!isset($_POST['user']) || !isset($_POST['pass'])) {
                $this->render('admin/login');
                exit;
            }
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['admin'])) {
            $uri = $_SERVER['REQUEST_URI'] ?? '';
            $isJson = strpos($uri, '/data/') !== false || strpos($uri, '/guardar') !== false || strpos($uri, '/eliminar') !== false;
            if (!$isJson) {
                $this->validateCsrfToken();
            }
        }
        if (!isset($_SESSION['admin'])) {
            $uri = $_SERVER['REQUEST_URI'] ?? '';
            $isAjax = strpos($uri, '/data/') !== false || strpos($uri, '/guardar') !== false || strpos($uri, '/eliminar') !== false;
            if ($isAjax) {
                $this->json(['error' => 'No autorizado'], 401);
                exit;
            }
            $this->render('admin/login');
            exit;
        }
    }

    public function login()
    {
        $this->checkRateLimit('login', 5, 60);

        $user = $_POST['user'] ?? '';
        $pass = $_POST['pass'] ?? '';

        $usuario = (new Usuario())->queryFirst(
            "SELECT * FROM usuarios WHERE estado = 1 AND (email = ? OR nombre = ?) LIMIT 1",
            [$user, $user]
        );

        if ($usuario) {
            if (password_verify($pass, $usuario['password'])) {
                $this->resetRateLimit('login');
                $this->regenerateSession();
                $_SESSION['admin'] = true;
                $_SESSION['admin_user'] = $usuario['nombre'];
                $_SESSION['admin_rol'] = $usuario['rol'];
                $this->redirect('admin');
            }
            if (md5($pass) === $usuario['password']) {
                $this->resetRateLimit('login');
                $this->regenerateSession();
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                (new Usuario())->update($usuario['id'], ['password' => $hash]);
                $_SESSION['admin'] = true;
                $_SESSION['admin_user'] = $usuario['nombre'];
                $_SESSION['admin_rol'] = $usuario['rol'];
                $this->redirect('admin');
            }
        }

        $this->render('admin/login', ['error' => 'Credenciales incorrectas']);
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('');
    }

    public function dashboard()
    {
        if (!isset($_SESSION['admin'])) { $this->render('admin/login'); return; }
        $this->render('admin/dashboard', [
            'totalFamilias' => count((new Familia())->all()),
            'totalMarcas' => count((new Marca())->all()),
            'totalProductos' => count((new Producto())->all()),
            'totalBanners' => count((new Banner())->all()),
            'productosRecientes' => (new Producto())->query(
                "SELECT p.*, f.nombre as familia_nombre FROM productos p LEFT JOIN familias f ON p.familia_id = f.id ORDER BY p.id DESC LIMIT 5"
            ),
        ]);
    }

    // ============ HELPERS ============
    private function paginate($model, $page = 1, $perPage = 15, $orderBy = 'id DESC')
    {
        $page = max(1, (int)$page);
        $offset = ($page - 1) * $perPage;
        $table = $model->getTable();
        $total = $model->queryFirst("SELECT COUNT(*) as c FROM {$table}")['c'];
        $items = $model->query("SELECT * FROM {$table} ORDER BY {$orderBy} LIMIT ? OFFSET ?", [$perPage, $offset]);
        return [$items, $total, $page, ceil($total / $perPage)];
    }

    // ============ FAMILIAS ============
    public function familias()
    {
        if (!isset($_SESSION['admin'])) { $this->render('admin/login'); return; }
        $page = $_GET['page'] ?? 1;
        list($items, $total, $currentPage, $totalPages) = $this->paginate(new Familia(), $page, 15, 'orden ASC');
        $this->render('admin/familias/index', [
            'familias' => $items,
            'totalFamilias' => $total,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
        ]);
    }

    public function familiaGuardar()
    {
        if (!isset($_SESSION['admin'])) { $this->json(['error' => 'No autorizado'], 401); return; }
        $id = $_POST['id'] ?? null;
        $model = new Familia();
        $data = [
            'nombre' => $_POST['nombre'],
            'slug' => Familia::slugify($_POST['nombre']),
            'descripcion' => $_POST['descripcion'] ?? '',
            'color' => $_POST['color'] ?? '#009933',
            'orden' => (int)($_POST['orden'] ?? 0),
            'estado' => (int)($_POST['estado'] ?? 1),
        ];
        if ($id) {
            $f = $model->find($id);
            if ($_FILES['imagen']['name']) { $this->deleteFile($f['imagen']); $data['imagen'] = $this->uploadFile($_FILES['imagen'], 'familias'); }
            if ($_FILES['icono']['name']) { $this->deleteFile($f['icono']); $data['icono'] = $this->uploadFile($_FILES['icono'], 'familias'); }
            $model->update($id, $data);
        } else {
            if ($_FILES['imagen']['name']) $data['imagen'] = $this->uploadFile($_FILES['imagen'], 'familias');
            if ($_FILES['icono']['name']) $data['icono'] = $this->uploadFile($_FILES['icono'], 'familias');
            $model->create($data);
        }
        $this->json(['ok' => true]);
    }

    public function familiaData($id)
    {
        $f = (new Familia())->find($id);
        $this->json($f ?: []);
    }

    public function familiaDelete($id)
    {
        $f = (new Familia())->find($id);
        if ($f) { $this->deleteFile($f['imagen']); $this->deleteFile($f['icono']); (new Familia())->delete($id); }
        $this->json(['ok' => true]);
    }

    // ============ MARCAS ============
    public function marcas()
    {
        if (!isset($_SESSION['admin'])) { $this->render('admin/login'); return; }
        $page = $_GET['page'] ?? 1;
        list($items, $total, $currentPage, $totalPages) = $this->paginate(new Marca(), $page, 15);
        $this->render('admin/marcas/index', [
            'marcas' => $items,
            'totalMarcas' => $total,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
        ]);
    }

    public function marcaGuardar()
    {
        if (!isset($_SESSION['admin'])) { $this->json(['error' => 'No autorizado'], 401); return; }
        $id = $_POST['id'] ?? null;
        $model = new Marca();
        $data = [
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'] ?? '',
            'sitio_web' => $_POST['sitio_web'] ?? '',
            'estado' => (int)($_POST['estado'] ?? 1),
        ];
        if ($id) {
            $m = $model->find($id);
            if ($_FILES['logo']['name']) { $this->deleteFile($m['logo']); $data['logo'] = $this->uploadFile($_FILES['logo'], 'marcas'); }
            $model->update($id, $data);
        } else {
            if ($_FILES['logo']['name']) $data['logo'] = $this->uploadFile($_FILES['logo'], 'marcas');
            $model->create($data);
        }
        $this->json(['ok' => true]);
    }

    public function marcaData($id)
    {
        $m = (new Marca())->find($id);
        $this->json($m ?: []);
    }

    public function marcaDelete($id)
    {
        $m = (new Marca())->find($id);
        if ($m) { $this->deleteFile($m['logo']); (new Marca())->delete($id); }
        $this->json(['ok' => true]);
    }

    // ============ PRODUCTOS ============
    public function productos()
    {
        if (!isset($_SESSION['admin'])) { $this->render('admin/login'); return; }
        $page = $_GET['page'] ?? 1;
        $page = max(1, (int)$page);
        $perPage = 15;
        $offset = ($page - 1) * $perPage;
        $model = new Producto();
        $total = count($model->all());
        $totalPages = ceil($total / $perPage);
        $productos = $model->query(
            "SELECT p.*, f.nombre as familia_nombre, m.nombre as marca_nombre
             FROM productos p LEFT JOIN familias f ON p.familia_id = f.id
             LEFT JOIN marcas m ON p.marca_id = m.id
             ORDER BY p.id DESC LIMIT ? OFFSET ?",
            [$perPage, $offset]
        );
        $this->render('admin/productos/index', [
            'productos' => $productos,
            'totalProductos' => $total,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ]);
    }

    public function productoCreate()
    {
        if (!isset($_SESSION['admin'])) { $this->render('admin/login'); return; }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new Producto();
            $data = $this->productoDataFromPost();
            if ($_FILES['imagen_principal']['name']) $data['imagen_principal'] = $this->uploadFile($_FILES['imagen_principal']);
            if ($_FILES['ficha_tecnica']['name']) $data['ficha_tecnica'] = $this->uploadFile($_FILES['ficha_tecnica'], 'productos');
            $id = $model->create($data);
            $this->uploadGaleria($id, $_FILES['galeria'] ?? null);
            $this->redirect('admin/productos');
        }
        $this->render('admin/productos/form', [
            'familias' => (new Familia())->all('orden ASC'),
            'marcas' => (new Marca())->all(),
        ]);
    }

    public function productoEdit($id)
    {
        if (!isset($_SESSION['admin'])) { $this->render('admin/login'); return; }
        $model = new Producto(); $producto = $model->find($id);
        if (!$producto) { $this->redirect('admin/productos'); }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->productoDataFromPost();
            if ($_FILES['imagen_principal']['name']) { $this->deleteFile($producto['imagen_principal']); $data['imagen_principal'] = $this->uploadFile($_FILES['imagen_principal']); }
            if ($_FILES['ficha_tecnica']['name']) { $this->deleteFile($producto['ficha_tecnica']); $data['ficha_tecnica'] = $this->uploadFile($_FILES['ficha_tecnica'], 'productos'); }
            $model->update($id, $data);
            $this->uploadGaleria($id, $_FILES['galeria'] ?? null);
            $this->redirect('admin/productos');
        }

        $this->render('admin/productos/form', [
            'producto' => $producto,
            'galeria' => (new ProductoImagen())->byProducto($id),
            'familias' => (new Familia())->all('orden ASC'),
            'marcas' => (new Marca())->all(),
        ]);
    }

    private function productoDataFromPost()
    {
        return [
            'familia_id' => $_POST['familia_id'],
            'marca_id' => ($_POST['marca_id'] ?? '') !== '' ? $_POST['marca_id'] : NULL,
            'codigo' => $_POST['codigo'] ?? '',
            'sku' => $_POST['sku'] ?? '',
            'nombre_comercial' => $_POST['nombre_comercial'],
            'nombre_producto' => $_POST['nombre_producto'],
            'descripcion' => $_POST['descripcion'] ?? '',
            'composicion' => $_POST['composicion'] ?? '',
            'materiales' => $_POST['materiales'] ?? '',
            'presentacion' => $_POST['presentacion'] ?? '',
            'beneficios' => $_POST['beneficios'] ?? '',
            'modo_uso' => $_POST['modo_uso'] ?? '',
            'indicaciones' => $_POST['indicaciones'] ?? '',
            'contraindicaciones' => $_POST['contraindicaciones'] ?? '',
            'registro_sanitario' => $_POST['registro_sanitario'] ?? '',
            'laboratorio' => $_POST['laboratorio'] ?? '',
            'pais_origen' => $_POST['pais_origen'] ?? '',
            'video' => $_POST['video'] ?? '',
            'peso' => ($_POST['peso'] ?? '') !== '' ? $_POST['peso'] : NULL,
            'alto' => ($_POST['alto'] ?? '') !== '' ? $_POST['alto'] : NULL,
            'ancho' => ($_POST['ancho'] ?? '') !== '' ? $_POST['ancho'] : NULL,
            'largo' => ($_POST['largo'] ?? '') !== '' ? $_POST['largo'] : NULL,
            'destacado' => isset($_POST['destacado']) ? 1 : 0,
            'nuevo' => isset($_POST['nuevo']) ? 1 : 0,
            'orden' => $_POST['orden'] ?? 0,
            'estado' => isset($_POST['estado']) ? 1 : 0,
        ];
    }

    private function uploadGaleria($productoId, $files)
    {
        if (!$files || empty($files['name'][0])) return;
        $model = new ProductoImagen();
        foreach ($files['name'] as $i => $name) {
            if (!$name) continue;
            $file = [
                'name' => $files['name'][$i],
                'type' => $files['type'][$i],
                'tmp_name' => $files['tmp_name'][$i],
                'error' => $files['error'][$i],
                'size' => $files['size'][$i],
            ];
            if ($path = $this->uploadFile($file, 'productos')) {
                $model->create(['producto_id' => $productoId, 'imagen' => $path, 'orden' => $i]);
            }
        }
    }

    public function productoDeleteGaleria($id)
    {
        $img = (new ProductoImagen())->find($id);
        if ($img) { $this->deleteFile($img['imagen']); (new ProductoImagen())->delete($id); }
        $this->json(['ok' => true]);
    }

    public function productoDelete($id)
    {
        $p = (new Producto())->find($id);
        if ($p) {
            foreach (['imagen_principal','ficha_tecnica'] as $f) $this->deleteFile($p[$f]);
            foreach ((new ProductoImagen())->byProducto($id) as $img) { $this->deleteFile($img['imagen']); (new ProductoImagen())->delete($img['id']); }
            (new Producto())->delete($id);
        }
        $this->json(['ok' => true]);
    }

    // ============ BANNERS ============
    public function banners()
    {
        if (!isset($_SESSION['admin'])) { $this->render('admin/login'); return; }
        $page = $_GET['page'] ?? 1;
        list($items, $total, $currentPage, $totalPages) = $this->paginate(new Banner(), $page, 15, 'orden ASC');
        $this->render('admin/banners/index', [
            'banners' => $items,
            'totalBanners' => $total,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
        ]);
    }

    public function bannerCreate()
    {
        if (!isset($_SESSION['admin'])) { $this->render('admin/login'); return; }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['titulo' => $_POST['titulo'] ?? '', 'subtitulo' => $_POST['subtitulo'] ?? '', 'link' => $_POST['link'] ?? '', 'orden' => $_POST['orden'] ?? 0, 'estado' => $_POST['estado'] ?? 1];
            if ($_FILES['imagen']['name']) $data['imagen'] = $this->uploadFile($_FILES['imagen'], 'banners');
            (new Banner())->create($data);
            $this->redirect('admin/banners');
        }
        $this->render('admin/banners/form');
    }

    public function bannerEdit($id)
    {
        if (!isset($_SESSION['admin'])) { $this->render('admin/login'); return; }
        $model = new Banner(); $banner = $model->find($id);
        if (!$banner) { $this->redirect('admin/banners'); }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['titulo' => $_POST['titulo'] ?? '', 'subtitulo' => $_POST['subtitulo'] ?? '', 'link' => $_POST['link'] ?? '', 'orden' => $_POST['orden'] ?? 0, 'estado' => $_POST['estado'] ?? 1];
            if ($_FILES['imagen']['name']) { $this->deleteFile($banner['imagen']); $data['imagen'] = $this->uploadFile($_FILES['imagen'], 'banners'); }
            $model->update($id, $data);
            $this->redirect('admin/banners');
        }
        $this->render('admin/banners/form', ['banner' => $banner]);
    }

    public function bannerDelete($id)
    {
        $b = (new Banner())->find($id);
        if ($b) { $this->deleteFile($b['imagen']); (new Banner())->delete($id); }
        $this->json(['ok' => true]);
    }

    // ============ USUARIOS ============
    public function usuarios()
    {
        if (!isset($_SESSION['admin'])) { $this->render('admin/login'); return; }
        $page = $_GET['page'] ?? 1;
        list($items, $total, $currentPage, $totalPages) = $this->paginate(new Usuario(), $page, 15);
        $this->render('admin/usuarios/index', [
            'usuarios' => $items,
            'totalUsuarios' => $total,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
        ]);
    }

    public function usuarioCreate()
    {
        if (!isset($_SESSION['admin'])) { $this->render('admin/login'); return; }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new Usuario())->create(['nombre' => $_POST['nombre'], 'email' => $_POST['email'], 'password' => password_hash($_POST['password'], PASSWORD_DEFAULT), 'rol' => $_POST['rol'] ?? 'editor', 'estado' => $_POST['estado'] ?? 1]);
            $this->redirect('admin/usuarios');
        }
        $this->render('admin/usuarios/form');
    }

    public function usuarioEdit($id)
    {
        if (!isset($_SESSION['admin'])) { $this->render('admin/login'); return; }
        $model = new Usuario(); $usuario = $model->find($id);
        if (!$usuario) { $this->redirect('admin/usuarios'); }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = ['nombre' => $_POST['nombre'], 'email' => $_POST['email'], 'rol' => $_POST['rol'] ?? 'editor', 'estado' => $_POST['estado'] ?? 1];
            if ($_POST['password']) $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $model->update($id, $data);
            $this->redirect('admin/usuarios');
        }
        $this->render('admin/usuarios/form', ['usuario' => $usuario]);
    }

    public function usuarioDelete($id)
    {
        (new Usuario())->delete($id);
        $this->json(['ok' => true]);
    }

    // ============ BUENAS PRÁCTICAS ============
    public function buenasPracticas()
    {
        if (!isset($_SESSION['admin'])) { $this->render('admin/login'); return; }
        $page = $_GET['page'] ?? 1;
        $page = max(1, (int)$page);
        $perPage = 15;
        $offset = ($page - 1) * $perPage;
        $model = new BuenaPractica();
        $total = count($model->all());
        $totalPages = ceil($total / $perPage);
        $items = $model->query("SELECT * FROM buenas_practicas ORDER BY created_at DESC LIMIT ? OFFSET ?", [$perPage, $offset]);
        $this->render('admin/buenas-practicas/index', [
            'items' => $items,
            'total' => $total,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ]);
    }

    public function buenaPracticaGuardar()
    {
        if (!isset($_SESSION['admin'])) { $this->json(['error' => 'No autorizado'], 401); return; }
        $id = $_POST['id'] ?? null;
        $model = new BuenaPractica();
        $data = [
            'titulo' => $_POST['titulo'],
            'descripcion' => $_POST['descripcion'] ?? '',
            'categoria' => $_POST['categoria'] ?? 'general',
            'estado' => (int)($_POST['estado'] ?? 1),
        ];
        if ($_FILES['archivo']['name']) $data['archivo'] = $this->uploadFile($_FILES['archivo'], 'buenas-practicas');
        if ($id) {
            $model->update($id, $data);
        } else {
            $model->create($data);
        }
        $this->json(['ok' => true]);
    }

    public function buenaPracticaData($id)
    {
        $item = (new BuenaPractica())->find($id);
        $this->json($item ?: []);
    }

    public function buenaPracticaDelete($id)
    {
        $item = (new BuenaPractica())->find($id);
        if ($item) { $this->deleteFile($item['archivo']); (new BuenaPractica())->delete($id); }
        $this->json(['ok' => true]);
    }
}
