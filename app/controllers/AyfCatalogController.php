<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\AyfCategoria;
use App\Models\AyfMarca;
use App\Models\AyfProducto;
use App\Models\AyfBanner;
use App\Models\AyfConfiguracion;

class AyfCatalogController extends Controller
{
    protected function loadConfig()
    {
        if (!isset($GLOBALS['_AYF_CONFIG'])) {
            try {
                $model = new AyfConfiguracion();
                $rows = $model->allAsArray();
                $conf = [];
                foreach ($rows as $r) { $conf[$r['clave']] = $r['valor']; }
                $GLOBALS['_AYF_CONFIG'] = $conf;
            } catch (\Exception $e) {
                $GLOBALS['_AYF_CONFIG'] = [];
            }
        }
        return $GLOBALS['_AYF_CONFIG'];
    }

    protected function renderWithConfig($view, $data = [])
    {
        $data['_AYF'] = $this->loadConfig();
        $this->render($view, $data);
    }
    public function index()
    {
        $categoria = new AyfCategoria();
        $producto = new AyfProducto();
        $banner = new AyfBanner();
        $this->renderWithConfig('catalogo/ayf_index', [
            'categorias' => $categoria->activas(),
            'destacados' => $producto->destacados(8),
            'banners' => $banner->activos(),
        ]);
    }

    public function categoria($slug)
    {
        $categoria = new AyfCategoria();
        $producto = new AyfProducto();
        $marca = new AyfMarca();

        $cat = $categoria->findBySlug($slug);
        if (!$cat) {
            $cat = $categoria->find($slug);
            if (!$cat) { http_response_code(404); echo 'Categoría no encontrada'; return; }
        }

        $search = $_GET['s'] ?? '';
        $marcaId = $_GET['marca'] ?? '';
        $productos = $producto->byCategoria($cat['id'], $search, $marcaId);

        $this->renderWithConfig('catalogo/ayf_categoria', [
            'categoria' => $cat,
            'productos' => $productos,
            'categorias' => $categoria->activas(),
            'marcas' => $marca->activas(),
        ]);
    }

    public function detalle($id)
    {
        $producto = new AyfProducto();
        $prod = $producto->withRelations($id);
        if (!$prod) {
            http_response_code(404);
            echo 'Producto no encontrado';
            return;
        }

        $galeria = $producto->imagenes($id);
        $relacionados = $producto->relacionados($prod['categoria_id'], $id);
        $categoria = new AyfCategoria();

        $this->renderWithConfig('catalogo/ayf_detalle', [
            'producto' => $prod,
            'galeria' => $galeria,
            'relacionados' => $relacionados,
            'categorias' => $categoria->activas(),
        ]);
    }

    public function search()
    {
        $producto = new AyfProducto();
        $search = $_GET['q'] ?? '';
        $categoria = new AyfCategoria();
        $marca = new AyfMarca();
        $categoriaId = $_GET['categoria'] ?? '';
        $marcaId = $_GET['marca'] ?? '';
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 12;
        $offset = ($page - 1) * $perPage;
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

        if ($categoriaId || $marcaId || $search) {
            $total = $producto->filterAll($search, $categoriaId, $marcaId, 0, 0, true);
            $productos = $producto->filterAll($search, $categoriaId, $marcaId, $perPage, $offset);
        } else {
            $total = $producto->countAll();
            $productos = $producto->allWithRelations('p.orden ASC', $perPage, $offset);
        }

        $view = $isAjax ? 'catalogo/ayf_search_results' : 'catalogo/ayf_search';
        $this->renderWithConfig($view, [
            'productos' => $productos,
            'categorias' => $categoria->activas(),
            'marcas' => $marca->activas(),
            'search' => $search,
            'selectedCategoria' => $categoriaId,
            'selectedMarca' => $marcaId,
            'currentPage' => $page,
            'totalPages' => max(1, ceil($total / $perPage)),
            'total' => $total,
        ]);
    }

    public function apiSearch()
    {
        $producto = new AyfProducto();
        $search = $_GET['q'] ?? '';
        $results = $producto->search($search);
        $this->json($results);
    }

    public function contacto()
    {
        $categoria = new AyfCategoria();
        $marca = new AyfMarca();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
            $rateFile = __DIR__ . '/../../cache/rate_' . md5($ip) . '.tmp';
            $rateLimit = 3;
            $rateWindow = 3600;
            if (file_exists($rateFile)) {
                $data = json_decode(file_get_contents($rateFile), true);
                if ($data && $data['time'] > time() - $rateWindow && $data['count'] >= $rateLimit) {
                    $this->renderWithConfig('catalogo/ayf_contacto', [
                        'categorias' => $categoria->activas(),
                        'marcas' => $marca->activas(),
                        'error' => 'Has enviado muchos mensajes. Intenta de nuevo más tarde.',
                        'success' => '',
                        'nombre' => htmlspecialchars($_POST['nombre'] ?? '', ENT_QUOTES, 'UTF-8'),
                        'email' => htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8'),
                        'telefono' => htmlspecialchars($_POST['telefono'] ?? '', ENT_QUOTES, 'UTF-8'),
                        'mensaje' => '',
                    ]);
                    return;
                }
                $count = $data ? $data['count'] + 1 : 1;
            } else {
                $count = 1;
            }
            $dir = dirname($rateFile);
            if (!is_dir($dir)) mkdir($dir, 0755, true);
            file_put_contents($rateFile, json_encode(['time' => time(), 'count' => $count]));

            $nombre = substr(trim($_POST['nombre'] ?? ''), 0, 100);
            $email = substr(trim($_POST['email'] ?? ''), 0, 255);
            $telefono = substr(trim($_POST['telefono'] ?? ''), 0, 20);
            $mensaje = substr(trim($_POST['mensaje'] ?? ''), 0, 2000);
            $error = '';
            $success = '';

            if (!$nombre || !$email || !$mensaje) {
                $error = 'Completa todos los campos obligatorios.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Email no válido.';
            } elseif (preg_match('/[\r\n]/', $nombre) || preg_match('/[\r\n]/', $mensaje)) {
                $error = 'Datos inválidos.';
            } else {
                try {
                    require __DIR__ . '/../core/phpmailer/PHPMailer.php';
                    require __DIR__ . '/../core/phpmailer/SMTP.php';
                    require __DIR__ . '/../core/phpmailer/Exception.php';

                    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host = 'ayfnovastyle.moabcode.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'ventas@ayfnovastyle.moabcode.com';
                    $mail->Password = $this->getEmailPassword();
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->CharSet = 'UTF-8';
                    $mail->setFrom('ventas@ayfnovastyle.moabcode.com', 'Contacto Web');
                    $mail->addAddress('ventas@ayfnovastyle.moabcode.com');
                    $mail->Subject = 'Nuevo mensaje desde la web - AYF Novastyle';
                    $mail->Body = "Nombre: $nombre\nEmail: $email\nTeléfono: $telefono\n\nMensaje:\n$mensaje";
                    if ($mail->send()) {
                        $success = 'Mensaje enviado correctamente. Te responderemos pronto.';
                    } else {
                        $error = 'Error: ' . $mail->ErrorInfo;
                    }
                } catch (\Exception $e) {
                    $error = 'Error SMTP: ' . $e->getMessage();
                }
            }

            $this->renderWithConfig('catalogo/ayf_contacto', [
                'categorias' => $categoria->activas(),
                'marcas' => $marca->activas(),
                'error' => $error,
                'success' => $success,
                'nombre' => $nombre,
                'email' => $email,
                'telefono' => $telefono,
                'mensaje' => $mensaje,
            ]);
            return;
        }

        $this->renderWithConfig('catalogo/ayf_contacto', [
            'categorias' => $categoria->activas(),
            'marcas' => $marca->activas(),
            'error' => '',
            'success' => '',
            'nombre' => '',
            'email' => '',
            'telefono' => '',
            'mensaje' => '',
        ]);
    }

    private function getEmailPassword()
    {
        $file = __DIR__ . '/../../config/email.local.php';
        if (file_exists($file)) {
            $config = require $file;
            return $config['password'] ?? '';
        }
        return '';
    }
}
