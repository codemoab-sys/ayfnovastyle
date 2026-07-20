<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require __DIR__ . '/config/database.php';
require __DIR__ . '/app/core/helpers.php';

header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/app/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;
    $relativeClass = substr($class, $len);
    $parts = explode('\\', $relativeClass);
    $parts[0] = lcfirst($parts[0]); // lowercase first dir (core, controllers, models)
    $file = $baseDir . implode('/', $parts) . '.php';
    if (file_exists($file)) require $file;
});

use App\Core\Router;
use App\Controllers\AdminController;
use App\Controllers\CatalogController;
use App\Controllers\AyfAdminController;
use App\Controllers\AyfCatalogController;

$router = new Router();

$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '/index.php';
$basePath = rtrim(dirname($scriptName), '/');
if ($basePath !== '' && $basePath !== '.' && $basePath !== '/') {
    if (strpos($requestPath, $basePath) === 0) {
        $requestPath = substr($requestPath, strlen($basePath));
    }
}
$requestPath = '/' . trim($requestPath, '/');
if ($requestPath === '/' || $requestPath === '/index.php') {
    header('Location: ' . BASE_URL . 'ayf', true, 302);
    exit;
}

set_exception_handler(function ($e) {
    if (function_exists('error_log')) {
        error_log('[Fatal] ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
    }
    http_response_code(500);
    if (ini_get('display_errors')) {
        echo '<h1>Error interno</h1><p>' . htmlspecialchars($e->getMessage()) . '</p>';
    } else {
        echo '<h1>Error interno del servidor</h1>';
    }
    exit;
});

// ===== SISTEMA AYF (zapatillas) =====
$router->get('/ayf', [AyfCatalogController::class, 'index']);
$router->get('/ayf/categoria/{slug}', [AyfCatalogController::class, 'categoria']);
$router->get('/ayf/producto/{id}', [AyfCatalogController::class, 'detalle']);
$router->get('/ayf/buscar', [AyfCatalogController::class, 'search']);
$router->get('/ayf/api/buscar', [AyfCatalogController::class, 'apiSearch']);
$router->get('/ayf/contacto', [AyfCatalogController::class, 'contacto']);
$router->post('/ayf/contacto', [AyfCatalogController::class, 'contacto']);

$router->get('/ayf-admin', [AyfAdminController::class, 'dashboard']);
$router->post('/ayf-admin/login', [AyfAdminController::class, 'login']);
$router->get('/ayf-admin/logout', [AyfAdminController::class, 'logout']);
$router->get('/ayf-admin/categorias', [AyfAdminController::class, 'categorias']);
$router->post('/ayf-admin/categorias/guardar', [AyfAdminController::class, 'categoriaGuardar']);
$router->get('/ayf-admin/categorias/data/{id}', [AyfAdminController::class, 'categoriaData']);
$router->post('/ayf-admin/categorias/eliminar/{id}', [AyfAdminController::class, 'categoriaDelete']);
$router->get('/ayf-admin/marcas', [AyfAdminController::class, 'marcas']);
$router->post('/ayf-admin/marcas/guardar', [AyfAdminController::class, 'marcaGuardar']);
$router->get('/ayf-admin/marcas/data/{id}', [AyfAdminController::class, 'marcaData']);
$router->post('/ayf-admin/marcas/eliminar/{id}', [AyfAdminController::class, 'marcaDelete']);
$router->get('/ayf-admin/productos', [AyfAdminController::class, 'productos']);
$router->get('/ayf-admin/productos/crear', [AyfAdminController::class, 'productoCreate']);
$router->post('/ayf-admin/productos/crear', [AyfAdminController::class, 'productoCreate']);
$router->get('/ayf-admin/productos/editar/{id}', [AyfAdminController::class, 'productoEdit']);
$router->post('/ayf-admin/productos/editar/{id}', [AyfAdminController::class, 'productoEdit']);
$router->post('/ayf-admin/productos/eliminar/{id}', [AyfAdminController::class, 'productoDelete']);
$router->post('/ayf-admin/productos/eliminar-galeria/{id}', [AyfAdminController::class, 'productoDeleteGaleria']);
$router->get('/ayf-admin/banners', [AyfAdminController::class, 'banners']);
$router->get('/ayf-admin/banners/crear', [AyfAdminController::class, 'bannerCreate']);
$router->post('/ayf-admin/banners/crear', [AyfAdminController::class, 'bannerCreate']);
$router->get('/ayf-admin/banners/editar/{id}', [AyfAdminController::class, 'bannerEdit']);
$router->post('/ayf-admin/banners/editar/{id}', [AyfAdminController::class, 'bannerEdit']);
$router->post('/ayf-admin/banners/eliminar/{id}', [AyfAdminController::class, 'bannerDelete']);
$router->get('/ayf-admin/usuarios', [AyfAdminController::class, 'usuarios']);
$router->get('/ayf-admin/usuarios/crear', [AyfAdminController::class, 'usuarioCreate']);
$router->post('/ayf-admin/usuarios/crear', [AyfAdminController::class, 'usuarioCreate']);
$router->get('/ayf-admin/usuarios/editar/{id}', [AyfAdminController::class, 'usuarioEdit']);
$router->post('/ayf-admin/usuarios/editar/{id}', [AyfAdminController::class, 'usuarioEdit']);
$router->post('/ayf-admin/usuarios/eliminar/{id}', [AyfAdminController::class, 'usuarioDelete']);
$router->get('/ayf-admin/configuracion', [AyfAdminController::class, 'configuracion']);
$router->post('/ayf-admin/configuracion', [AyfAdminController::class, 'configuracion']);

$router->dispatch();
