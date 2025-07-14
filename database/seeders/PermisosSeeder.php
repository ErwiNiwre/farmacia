<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1. Crear todos los permisos
        |--------------------------------------------------------------------------
        */
        foreach (
            [
                // Roles
                'rol.index',
                'rol.create',
                'rol.show',
                'rol.edit',
                'rol.destroy',
                // Usuarios
                'user.index',
                'user.create',
                'user.show',
                'user.edit',
                'user.destroy',
                // Compras
                'compra.index',
                'compra.create',
                'compra.show',
                'compra.edit',
                'compra.destroy',
                // Ventas
                'venta.index',
                'venta.create',
                'venta.show',
                'venta.edit',
                'venta.destroy',
                // Productos
                'producto.index',
                'producto.create',
                'producto.show',
                'producto.edit',
                'producto.destroy',
                // Unidad Medidas
                'unidadMedida.index',
                'unidadMedida.create',
                'unidadMedida.show',
                'unidadMedida.edit',
                'unidadMedida.destroy',
                // Clasificaciones
                'clasificacion.index',
                'clasificacion.create',
                'clasificacion.show',
                'clasificacion.edit',
                'clasificacion.destroy',
                // laboratorio_servicios
                'laboratorioServicio.index',
                'laboratorioServicio.create',
                'laboratorioServicio.show',
                'laboratorioServicio.edit',
                'laboratorioServicio.destroy',
            ] as $perm
        ) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        /*
        |--------------------------------------------------------------------------
        | 2. Limpiar la caché de Spatie
        |--------------------------------------------------------------------------
        */
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /*
        |--------------------------------------------------------------------------
        | 3. Obtener los roles creados previamente
        |--------------------------------------------------------------------------
        */
        $administrador = Role::where('name', 'Administración')->first();
        $farmacia = Role::where('name', 'Farmacia')->first();
        $cajero = Role::where('name', 'Cajero')->first();

        /*
        |--------------------------------------------------------------------------
        | 4. Asignar permisos a cada rol
        |--------------------------------------------------------------------------
        */
        $permisosSinRoles = Permission::all()->reject(function ($permiso) {
            return str_starts_with($permiso->name, 'rol.');
        });
        $administrador->syncPermissions($permisosSinRoles);

        $farmacia->syncPermissions([
            // Compras
            'compra.index',
            'compra.create',
            'compra.show',
            'compra.edit',
            'compra.destroy',
            // Ventas
            'venta.index',
            'venta.create',
            'venta.show',
            'venta.edit',
            'venta.destroy',
            // Productos
            'producto.index',
            'producto.create',
            'producto.show',
            'producto.edit',
            'producto.destroy',
        ]);

        $cajero->syncPermissions([
            // Productos
            'producto.index',
            'producto.show',
            // Venta
            'venta.index',
            'venta.create',
            'venta.show',
            'venta.edit',
            'venta.destroy',
        ]);
    }
}
