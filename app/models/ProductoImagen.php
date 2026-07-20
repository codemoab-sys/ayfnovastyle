<?php
namespace App\Models;

use App\Core\Model;

class ProductoImagen extends Model
{
    protected $table = 'producto_imagenes';

    public function byProducto($productoId)
    {
        return $this->where('producto_id', $productoId, 'orden ASC');
    }
}
