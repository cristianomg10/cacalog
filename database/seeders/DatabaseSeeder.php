<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'cristianooo@gmail.com'],
            [
                'name' => 'Cristiano',
                'password' => bcrypt('ifsc123'),
                'role' => 'admin',
            ]
        );

        $this->call([
            StatusEntregaSeeder::class,
            PlanoEntregaSeeder::class,
            MotoboySeeder::class,
            CidadeSeeder::class,
        ]);
    }
}
