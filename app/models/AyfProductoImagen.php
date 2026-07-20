<?php
namespace App\Models;

use App\Core\Model;

class AyfProductoImagen extends Model
{
    protected $table = 'ayf_producto_imagenes';

    public function byProducto($productoId)
    {
        return $this->where('producto_id', $productoId, 'orden ASC');
    }
}
