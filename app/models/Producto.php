<?php
namespace App\Models;

use App\Core\Model;

class Producto extends Model
{
    protected $table = 'productos';

    public function withRelations($id)
    {
        return $this->queryFirst("
            SELECT p.*, f.nombre as familia_nombre, f.slug as familia_slug, m.nombre as marca_nombre
            FROM productos p
            LEFT JOIN familias f ON p.familia_id = f.id
            LEFT JOIN marcas m ON p.marca_id = m.id
            WHERE p.id = ?
        ", [$id]);
    }

    public function imagenes($productoId)
    {
        return $this->query("SELECT * FROM producto_imagenes WHERE producto_id = ? AND estado = 1 ORDER BY orden ASC", [$productoId]);
    }

    public function allWithRelations($orderBy = 'p.orden ASC', $limit = 0, $offset = 0)
    {
        $sql = "SELECT p.*, f.nombre as familia_nombre, f.slug as familia_slug, m.nombre as marca_nombre
                FROM productos p
                LEFT JOIN familias f ON p.familia_id = f.id
                LEFT JOIN marcas m ON p.marca_id = m.id
                ORDER BY {$orderBy}";
        if ($limit) $sql .= " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
        return $this->query($sql);
    }

    public function countAll()
    {
        return $this->queryFirst("SELECT COUNT(*) as total FROM productos p WHERE p.estado = 1")['total'];
    }

    public function byFamilia($familiaId, $search = '', $marcaId = '')
    {
        $sql = "SELECT p.*, f.nombre as familia_nombre, f.slug as familia_slug, m.nombre as marca_nombre
                FROM productos p
                LEFT JOIN familias f ON p.familia_id = f.id
                LEFT JOIN marcas m ON p.marca_id = m.id
                WHERE p.familia_id = ? AND p.estado = 1";
        $params = [$familiaId];

        if ($search) {
            $sql .= " AND (p.nombre_comercial LIKE ? OR p.codigo LIKE ? OR p.nombre_producto LIKE ?)";
            $s = "%$search%";
            $params[] = $s; $params[] = $s; $params[] = $s;
        }

        if ($marcaId) {
            $sql .= " AND p.marca_id = ?";
            $params[] = $marcaId;
        }

        $sql .= " ORDER BY p.orden ASC, p.nombre_comercial ASC";
        return $this->query($sql, $params);
    }

    public function destacados($limit = 8)
    {
        return $this->query("
            SELECT p.*, f.nombre as familia_nombre, m.nombre as marca_nombre
            FROM productos p
            LEFT JOIN familias f ON p.familia_id = f.id
            LEFT JOIN marcas m ON p.marca_id = m.id
            WHERE p.destacado = 1 AND p.estado = 1
            ORDER BY p.orden ASC
            LIMIT ?
        ", [$limit]);
    }

    public function search($search)
    {
        $sql = "SELECT p.*, f.nombre as familia_nombre, m.nombre as marca_nombre
                FROM productos p
                LEFT JOIN familias f ON p.familia_id = f.id
                LEFT JOIN marcas m ON p.marca_id = m.id
                WHERE p.estado = 1 AND (p.nombre_comercial LIKE ? OR p.codigo LIKE ? OR p.nombre_producto LIKE ? OR p.descripcion LIKE ?)
                ORDER BY p.orden ASC";
        $s = "%$search%";
        return $this->query($sql, [$s, $s, $s, $s]);
    }

    public function filterAll($search = '', $familiaId = '', $marcaId = '', $limit = 0, $offset = 0, $countOnly = false)
    {
        $select = $countOnly ? "COUNT(*) as total" : "p.*, f.nombre as familia_nombre, f.slug as familia_slug, m.nombre as marca_nombre";
        $sql = "SELECT {$select}
                FROM productos p
                LEFT JOIN familias f ON p.familia_id = f.id
                LEFT JOIN marcas m ON p.marca_id = m.id
                WHERE p.estado = 1";
        $params = [];

        if ($search) {
            $sql .= " AND (p.nombre_comercial LIKE ? OR p.codigo LIKE ? OR p.nombre_producto LIKE ?)";
            $s = "%$search%";
            $params[] = $s; $params[] = $s; $params[] = $s;
        }

        if ($familiaId) {
            $sql .= " AND p.familia_id = ?";
            $params[] = $familiaId;
        }

        if ($marcaId) {
            $sql .= " AND p.marca_id = ?";
            $params[] = $marcaId;
        }

        if ($countOnly) return $this->queryFirst($sql, $params)['total'];

        $sql .= " ORDER BY p.orden ASC, p.nombre_comercial ASC";
        if ($limit) $sql .= " LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
        return $this->query($sql, $params);
    }

    public function relacionados($familiaId, $productoId, $limit = 4)
    {
        return $this->query(
            "SELECT p.*, f.nombre as familia_nombre FROM productos p
             LEFT JOIN familias f ON p.familia_id = f.id
             WHERE p.familia_id = ? AND p.id != ? AND p.estado = 1
             ORDER BY p.orden ASC LIMIT ?",
            [$familiaId, $productoId, $limit]
        );
    }
}
