<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Familia;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Banner;
use App\Models\BuenaPractica;

class CatalogController extends Controller
{
    public function index()
    {
        $familia = new Familia();
        $producto = new Producto();
        $banner = new Banner();
        $this->render('catalogo/index', [
            'familias' => $familia->activas(),
            'destacados' => $producto->destacados(8),
            'banners' => $banner->activos(),
        ]);
    }

    public function categoria($slug)
    {
        $familia = new Familia();
        $producto = new Producto();
        $marca = new Marca();

        $cat = $familia->findBySlug($slug);
        if (!$cat) {
            $cat = $familia->find($slug);
            if (!$cat) { http_response_code(404); echo 'Categoría no encontrada'; return; }
        }

        $search = $_GET['s'] ?? '';
        $marcaId = $_GET['marca'] ?? '';
        $productos = $producto->byFamilia($cat['id'], $search, $marcaId);

        $this->render('catalogo/categoria', [
            'categoria' => $cat,
            'productos' => $productos,
            'familias' => $familia->activas(),
            'marcas' => $marca->activas(),
        ]);
    }

    public function detalle($id)
    {
        $producto = new Producto();
        $prod = $producto->withRelations($id);
        if (!$prod) {
            http_response_code(404);
            echo 'Producto no encontrado';
            return;
        }

        $galeria = $producto->imagenes($id);
        $relacionados = $producto->relacionados($prod['familia_id'], $id);
        $familia = new Familia();

        $this->render('catalogo/detalle', [
            'producto' => $prod,
            'galeria' => $galeria,
            'relacionados' => $relacionados,
            'familias' => $familia->activas(),
        ]);
    }

    public function search()
    {
        $producto = new Producto();
        $search = $_GET['q'] ?? '';
        $familia = new Familia();
        $marca = new Marca();
        $familiaId = $_GET['familia'] ?? '';
        $marcaId = $_GET['marca'] ?? '';
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 12;
        $offset = ($page - 1) * $perPage;
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

        if ($familiaId || $marcaId || $search) {
            $total = $producto->filterAll($search, $familiaId, $marcaId, 0, 0, true);
            $productos = $producto->filterAll($search, $familiaId, $marcaId, $perPage, $offset);
        } else {
            $total = $producto->countAll();
            $productos = $producto->allWithRelations('p.orden ASC', $perPage, $offset);
        }

        $view = $isAjax ? 'catalogo/search-results' : 'catalogo/search';
        $this->render($view, [
            'productos' => $productos,
            'familias' => $familia->activas(),
            'marcas' => $marca->activas(),
            'search' => $search,
            'selectedFamilia' => $familiaId,
            'selectedMarca' => $marcaId,
            'currentPage' => $page,
            'totalPages' => max(1, ceil($total / $perPage)),
            'total' => $total,
        ]);
    }

    public function apiSearch()
    {
        $producto = new Producto();
        $search = $_GET['q'] ?? '';
        $results = $producto->search($search);
        $this->json($results);
    }

    public function buenasPracticas()
    {
        $search = $_GET['q'] ?? '';
        $categoria = $_GET['categoria'] ?? '';
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 12;
        $offset = ($page - 1) * $perPage;
        $model = new BuenaPractica();

        $countSql = "SELECT COUNT(*) as total FROM buenas_practicas WHERE estado = 1";
        $sql = "SELECT * FROM buenas_practicas WHERE estado = 1";
        $params = [];
        if ($search) {
            $clause = " AND (titulo LIKE ? OR descripcion LIKE ?)";
            $like = "%$search%";
            $params[] = $like;
            $params[] = $like;
            $countSql .= $clause;
            $sql .= $clause;
        }
        if ($categoria) {
            $clause = " AND categoria = ?";
            $params[] = $categoria;
            $countSql .= $clause;
            $sql .= $clause;
        }
        $total = $model->queryFirst($countSql, $params)['total'];
        $sql .= " ORDER BY created_at DESC LIMIT " . (int)$perPage . " OFFSET " . (int)$offset;
        $items = $model->query($sql, $params);

        $familias = (new Familia())->activas();
        $this->render('catalogo/buenas-practicas', [
            'items' => $items,
            'search' => $search,
            'selectedCategoria' => $categoria,
            'familias' => $familias,
            'currentPage' => $page,
            'totalPages' => max(1, ceil($total / $perPage)),
            'total' => $total,
        ]);
    }
}
