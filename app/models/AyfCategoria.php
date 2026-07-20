<?php
namespace App\Models;

use App\Core\Model;

class AyfCategoria extends Model
{
    protected $table = 'ayf_categorias';

    public function activas()
    {
        return $this->where('estado', 1, 'orden ASC');
    }

    public function findBySlug($slug)
    {
        return $this->whereFirst('slug', $slug);
    }

    public static function slugify($text)
    {
        $text = mb_strtolower($text, 'UTF-8');
        $text = str_replace(
            ['á','é','í','ó','ú','ü','ñ','Á','É','Í','Ó','Ú','Ü','Ñ'],
            ['a','e','i','o','u','u','n','a','e','i','o','u','u','n'],
            $text
        );
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        return trim($text, '-');
    }
}
