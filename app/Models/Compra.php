<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'productos';

    /**
     * Recalcula el estado del producto según la cantidad actual y el stock mínimo.
     */
    public function refreshEstado(): void
    {
        // Ajusta el nombre de la columna si no es 'stock_minimo'
        $stockMinimo = $this->stock_minimo ?? 0;

        if ($this->cantidad <= 0) {
            $this->estado = 'A'; // Agotado
        } elseif ($this->cantidad <= $stockMinimo) {
            $this->estado = 'M'; // Stock mínimo
        } else {
            $this->estado = 'D'; // Disponible
        }
    }

    /**
     * Ajusta la cantidad de stock y actualiza automáticamente el estado.
     * @param int $cantidad positiva para compras, negativa para ventas
     */
    public function ajustarStock(int $cantidad): void
    {
        $this->cantidad += $cantidad;
        $this->refreshEstado();
        $this->save();
    }
}