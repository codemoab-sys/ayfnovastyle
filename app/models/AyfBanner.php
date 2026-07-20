<?php
namespace App\Models;

use App\Core\Model;

class AyfBanner extends Model
{
    protected $table = 'ayf_banners';

    public function activos()
    {
        return $this->where('estado', 1, 'orden ASC');
    }
}
