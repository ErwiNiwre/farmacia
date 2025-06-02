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
        Permission::create(['name' => 'unidad_medidas.index']);
        Permission::create(['name' => 'unidad_medidas.create']);
        Permission::create(['name' => 'unidad_medidas.show']);
        Permission::create(['name' => 'unidad_medidas.edit']);
        Permission::create(['name' => 'unidad_medidas.destroy']);

        // Operaciones de clasificaciones
        Permission::create(['name' => 'clasificaciones.index']);
        Permission::create(['name' => 'clasificaciones.create']);
        Permission::create(['name' => 'clasificaciones.show']);
        Permission::create(['name' => 'clasificaciones.edit']);
        Permission::create(['name' => 'clasificaciones.destroy']);

        // Operaciones de laboratorio_servicios
        Permission::create(['name' => 'laboratorio_servicios.index']);
        Permission::create(['name' => 'laboratorio_servicios.create']);
        Permission::create(['name' => 'laboratorio_servicios.show']);
        Permission::create(['name' => 'laboratorio_servicios.edit']);
        Permission::create(['name' => 'laboratorio_servicios.destroy']);
    }
}
