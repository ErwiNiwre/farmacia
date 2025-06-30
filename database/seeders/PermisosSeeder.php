<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Operaciones de Usuario
        Permission::create(['name' => 'user.index']);
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.show']);
        Permission::create(['name' => 'user.edit']);
        Permission::create(['name' => 'user.destroy']);

        // Operaciones de Compras
        Permission::create(['name' => 'compra.index']);
        Permission::create(['name' => 'compra.create']);
        Permission::create(['name' => 'compra.show']);
        Permission::create(['name' => 'compra.edit']);
        Permission::create(['name' => 'compra.destroy']);

        // Operaciones de Ventas
        Permission::create(['name' => 'venta.index']);
        Permission::create(['name' => 'venta.create']);
        Permission::create(['name' => 'venta.show']);
        Permission::create(['name' => 'venta.edit']);
        Permission::create(['name' => 'venta.destroy']);

        // Operaciones de Productos
        Permission::create(['name' => 'producto.index']);
        Permission::create(['name' => 'producto.create']);
        Permission::create(['name' => 'producto.show']);
        Permission::create(['name' => 'producto.edit']);
        Permission::create(['name' => 'producto.destroy']);

        // Operaciones de unidad_medidas
        Permission::create(['name' => 'unidadMedida.index']);
        Permission::create(['name' => 'unidadMedida.create']);
        Permission::create(['name' => 'unidadMedida.show']);
        Permission::create(['name' => 'unidadMedida.edit']);
        Permission::create(['name' => 'unidadMedida.destroy']);

        // Operaciones de clasificaciones
        Permission::create(['name' => 'clasificacion.index']);
        Permission::create(['name' => 'clasificacion.create']);
        Permission::create(['name' => 'clasificacion.show']);
        Permission::create(['name' => 'clasificacion.edit']);
        Permission::create(['name' => 'clasificacion.destroy']);

        // Operaciones de laboratorio_servicios
        Permission::create(['name' => 'laboratorioServicio.index']);
        Permission::create(['name' => 'laboratorioServicio.create']);
        Permission::create(['name' => 'laboratorioServicio.show']);
        Permission::create(['name' => 'laboratorioServicio.edit']);
        Permission::create(['name' => 'laboratorioServicio.destroy']);  
    }
}
