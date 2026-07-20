<?php
namespace App\Models;

use App\Core\Model;

class AyfConfiguracion extends Model
{
    protected $table = 'ayf_configuracion';

    public function get($clave, $default = '')
    {
        $row = $this->whereFirst('clave', $clave);
        return $row ? $row['valor'] : $default;
    }

    public function set($clave, $valor)
    {
        $existing = $this->whereFirst('clave', $clave);
        if ($existing) {
            return $this->update($existing['id'], ['valor' => $valor]);
        }
        return $this->create(['clave' => $clave, 'valor' => $valor]);
    }

    public function allAsArray()
    {
        $rows = $this->all();
        $result = [];
        foreach ($rows as $row) {
            $result[$row['clave']] = $row;
        }
        return $result;
    }
}
