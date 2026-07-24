<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewInternUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['id' =>  '9', 'username' =>  'GC7051353', 'nombre' => 'Erika Elizabeth Gutierrez Castillo  ', 'email' => null, 'password' => bcrypt('7051353')]
        ]);

        User::find(8)->assignRole('Cajero');

        // Adjust Table Sequence users
        DB::statement("SELECT setval(pg_get_serial_sequence('users', 'id'), coalesce(max(id), 0)+1, false) FROM users");
    }
}
