<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kardex extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'kardex';

    public static function registrarKardex(array $data)
    {
        $kardex = new Kardex();
        $kardex->fecha            = now();
        $kardex->producto_id      = $data['producto_id'];
        $kardex->tipo_movimiento  = $data['tipo_movimiento'];
        $kardex->accion           = $data['accion'];
        $kardex->cantidad         = $data['cantidad'];
        $kardex->precio_unitario  = $data['precio_unitario'];
        $kardex->porcentaje       = $data['porcentaje'] ?? null;
        $kardex->subtotal         = $data['subtotal'];

        // asignar usuarios según acción
        if ($data['accion'] === 'A') $kardex->created_by = $data['user_id'];
        if ($data['accion'] === 'M') $kardex->updated_by = $data['user_id'];
        if ($data['accion'] === 'B') $kardex->deleted_by = $data['user_id'];

        $kardex->save();
    }
}
