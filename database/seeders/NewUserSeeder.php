<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['id' =>  '7', 'username' =>  'FT13436784', 'nombre' => 'Luis Gustavo Flores Triguero', 'email' => null, 'password' => bcrypt('13436784')]
        ]);

        User::find(7)->assignRole('Cajero');

        // Adjust Table Sequence users
        DB::statement("SELECT setval(pg_get_serial_sequence('users', 'id'), coalesce(max(id), 0)+1, false) FROM users");
    }
}
