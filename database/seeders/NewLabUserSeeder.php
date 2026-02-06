<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewLabUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['id' =>  '8', 'username' =>  'MM9878605', 'nombre' => 'Maribel Dayanne Mamani Mamani ', 'email' => null, 'password' => bcrypt('9878605')]
        ]);

        User::find(8)->assignRole('Cajero');

        // Adjust Table Sequence users
        DB::statement("SELECT setval(pg_get_serial_sequence('users', 'id'), coalesce(max(id), 0)+1, false) FROM users");
    }
}
