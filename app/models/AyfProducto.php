<?php
namespace App\Models;

use App\Core\Model;

class AyfProducto extends Model
{
    protected $table = 'ayf_productos';

    public function withRelations($id)
    {
        return $this->queryFirst("
            SELECT p.*, c.nombre as categoria_nombre, c.slug as categoria_slug, m.nombre as marca_nombre
            FROM ayf_productos p
            LEFT JOIN ayf_categorias c ON p.categoria_id = c.id
            LEFT JOIN ayf_marcas m ON p.marca_id = m.id
            WHERE p.id = ?
        ", [$id]);
    }

    public function imagenes($productoId)
    {
        return $this->query("SELECT * FROM ayf_producto_imagenes WHERE producto_id = ? AND estado = 1 ORDER BY orden ASC", [$productoId]);
    }

    public function allWithRelations($orderBy = 'p.orden ASC', $limit = 0, $offset = 0)
    {
        $orderBy = preg_replace('/[^a-zA-Z0-9_\.` ,]+/', '', $orderBy);
        $sql = "SELECT p.*, c.nombre as categoria_nombre, c.slug as categoria_slug, m.nombre as marca_nombre
                FROM ayf_productos p
                LEFT JOIN ayf_categorias c ON p.categoria_id = c.id
                LEFT JOIN ayf_marcas m ON p.marca_id = m.id
                ORDER BY {$orderBy}";
        if ($limit) $sql .= " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
        return $this->query($sql);
    }

    public function countAll()
    {
        return $this->queryFirst("SELECT COUNT(*) as total FROM ayf_productos p WHERE p.estado = 1")['total'];
    }

    public function byCategoria($categoriaId, $search = '', $marcaId = '')
    {
        $sql = "SELECT p.*, c.nombre as categoria_nombre, c.slug as categoria_slug, m.nombre as marca_nombre
                FROM ayf_productos p
                LEFT JOIN ayf_categorias c ON p.categoria_id = c.id
                LEFT JOIN ayf_marcas m ON p.marca_id = m.id
                WHERE p.categoria_id = ? AND p.estado = 1";
        $params = [$categoriaId];

        if ($search) {
            $sql .= " AND (p.nombre LIKE ? OR p.codigo LIKE ?)";
            $s = "%$search%";
            $params[] = $s; $params[] = $s;
        }

        if ($marcaId) {
            $sql .= " AND p.marca_id = ?";
            $params[] = $marcaId;
        }

        $sql .= " ORDER BY p.orden ASC, p.nombre ASC";
        return $this->query($sql, $params);
    }

    public function destacados($limit = 8)
    {
        return $this->query("
            SELECT p.*, c.nombre as categoria_nombre, m.nombre as marca_nombre
            FROM ayf_productos p
            LEFT JOIN ayf_categorias c ON p.categoria_id = c.id
            LEFT JOIN ayf_marcas m ON p.marca_id = m.id
            WHERE p.destacado = 1 AND p.estado = 1
            ORDER BY p.orden ASC
            LIMIT ?
        ", [$limit]);
    }

    public function search($search)
    {
        $sql = "SELECT p.*, c.nombre as categoria_nombre, m.nombre as marca_nombre
                FROM ayf_productos p
                LEFT JOIN ayf_categorias c ON p.categoria_id = c.id
                LEFT JOIN ayf_marcas m ON p.marca_id = m.id
                WHERE p.estado = 1 AND (p.nombre LIKE ? OR p.codigo LIKE ? OR p.descripcion LIKE ?)
                ORDER BY p.orden ASC";
        $s = "%$search%";
        return $this->query($sql, [$s, $s, $s]);
    }

    public function filterAll($search = '', $categoriaId = '', $marcaId = '', $limit = 0, $offset = 0, $countOnly = false)
    {
        $select = $countOnly ? "COUNT(*) as total" : "p.*, c.nombre as categoria_nombre, c.slug as categoria_slug, m.nombre as marca_nombre";
        $sql = "SELECT {$select}
                FROM ayf_productos p
                LEFT JOIN ayf_categorias c ON p.categoria_id = c.id
                LEFT JOIN ayf_marcas m ON p.marca_id = m.id
                WHERE p.estado = 1";
        $params = [];

        if ($search) {
            $sql .= " AND (p.nombre LIKE ? OR p.codigo LIKE ?)";
            $s = "%$search%";
            $params[] = $s; $params[] = $s;
        }

        if ($categoriaId) {
            $sql .= " AND p.categoria_id = ?";
            $params[] = $categoriaId;
        }

        if ($marcaId) {
            $sql .= " AND p.marca_id = ?";
            $params[] = $marcaId;
        }

        if ($countOnly) return $this->queryFirst($sql, $params)['total'];

        $sql .= " ORDER BY p.orden ASC, p.nombre ASC";
        if ($limit) $sql .= " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
        return $this->query($sql, $params);
    }

    public function relacionados($categoriaId, $productoId, $limit = 4)
    {
        return $this->query(
            "SELECT p.*, c.nombre as categoria_nombre FROM ayf_productos p
             LEFT JOIN ayf_categorias c ON p.categoria_id = c.id
             WHERE p.categoria_id = ? AND p.id != ? AND p.estado = 1
             ORDER BY p.orden ASC LIMIT ?",
            [$categoriaId, $productoId, $limit]
        );
    }
}
