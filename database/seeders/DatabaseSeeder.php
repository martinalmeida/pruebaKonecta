<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);

        DB::table('status')->insert([
            'id' => 1,
            'status' => 'Activo',
        ]);
        DB::table('status')->insert([
            'id' => 2,
            'status' => 'Inactivo',
        ]);
        DB::table('status')->insert([
            'id' => 3,
            'status' => 'Agotado',
        ]);
        DB::table('status')->insert([
            'id' => 4,
            'status' => 'Eliminado',
        ]);
    }
}
