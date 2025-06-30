<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AjustarSecuenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Adjust Table Sequence users
        DB::statement("SELECT setval(pg_get_serial_sequence('users', 'id'), coalesce(max(id), 0)+1, false) FROM users");

        // Adjust Table Sequence unidad_medidas
        DB::statement("SELECT setval(pg_get_serial_sequence('unidad_medidas', 'id'), coalesce(max(id), 0)+1, false) FROM unidad_medidas");

        // Adjust Table Sequence clasificaciones
        DB::statement("SELECT setval(pg_get_serial_sequence('clasificaciones', 'id'), coalesce(max(id), 0)+1, false) FROM clasificaciones");

        // Adjust Table Sequence laboratorio_servicios
        DB::statement("SELECT setval(pg_get_serial_sequence('laboratorio_servicios', 'id'), coalesce(max(id), 0)+1, false) FROM laboratorio_servicios");

        // Adjust Table Sequence venta_detalles
        DB::statement("SELECT setval(pg_get_serial_sequence('venta_detalles', 'id'), coalesce(max(id), 0)+1, false) FROM venta_detalles");

        // Adjust Table Sequence ventas
        DB::statement("SELECT setval(pg_get_serial_sequence('ventas', 'id'), coalesce(max(id), 0)+1, false) FROM ventas");

        // Adjust Table Sequence compra_detalles
        DB::statement("SELECT setval(pg_get_serial_sequence('compra_detalles', 'id'), coalesce(max(id), 0)+1, false) FROM compra_detalles");

        // Adjust Table Sequence compras
        DB::statement("SELECT setval(pg_get_serial_sequence('compras', 'id'), coalesce(max(id), 0)+1, false) FROM compras");

        // Adjust Table Sequence kardex
        DB::statement("SELECT setval(pg_get_serial_sequence('kardex', 'id'), coalesce(max(id), 0)+1, false) FROM kardex");

        // Adjust Table Sequence productos
        DB::statement("SELECT setval(pg_get_serial_sequence('productos', 'id'), coalesce(max(id), 0)+1, false) FROM productos");

        // Adjust Table Sequence concentraciones
        DB::statement("SELECT setval(pg_get_serial_sequence('concentraciones', 'id'), coalesce(max(id), 0)+1, false) FROM concentraciones");

        // Adjust Table Sequence marcas
        DB::statement("SELECT setval(pg_get_serial_sequence('marcas', 'id'), coalesce(max(id), 0)+1, false) FROM marcas");

        // Adjust Table Sequence presentaciones
        DB::statement("SELECT setval(pg_get_serial_sequence('presentaciones', 'id'), coalesce(max(id), 0)+1, false) FROM presentaciones");

        // Adjust Table Sequence accion_terapeuticas
        DB::statement("SELECT setval(pg_get_serial_sequence('accion_terapeuticas', 'id'), coalesce(max(id), 0)+1, false) FROM accion_terapeuticas");
    }
}
