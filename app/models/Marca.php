<?php
namespace App\Models;

use App\Core\Model;

class Marca extends Model
{
    protected $table = 'marcas';

    public function activas()
    {
        return $this->where('estado', 1);
    }
}
