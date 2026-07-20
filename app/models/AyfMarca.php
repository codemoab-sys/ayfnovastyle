<?php
namespace App\Models;

use App\Core\Model;

class AyfMarca extends Model
{
    protected $table = 'ayf_marcas';

    public function activas()
    {
        return $this->where('estado', 1);
    }
}
