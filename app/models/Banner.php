<?php
namespace App\Models;

use App\Core\Model;

class Banner extends Model
{
    protected $table = 'banners';

    public function activos()
    {
        return $this->where('estado', 1, 'orden ASC');
    }
}
