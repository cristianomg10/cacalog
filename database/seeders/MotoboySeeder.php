<?php

namespace Database\Seeders;

use App\Models\Motoboy;
use Illuminate\Database\Seeder;

class MotoboySeeder extends Seeder
{
    public function run(): void
    {
        $motoboys = [
            [
                'nome' => 'Carlos Silva',
                'cpf' => '529.982.247-25',
                'telefone' => '(11) 99999-0001',
            ],
            [
                'nome' => 'Ana Oliveira',
                'cpf' => '284.576.398-40',
                'telefone' => '(11) 99999-0002',
            ],
            [
                'nome' => 'João Santos',
                'cpf' => '763.418.295-60',
                'telefone' => '(11) 99999-0003',
            ],
            [
                'nome' => 'Maria Costa',
                'cpf' => '186.325.749-03',
                'telefone' => '(11) 99999-0004',
            ],
            [
                'nome' => 'Pedro Souza',
                'cpf' => '341.697.582-77',
                'telefone' => '(11) 99999-0005',
            ],
        ];

        foreach ($motoboys as $motoboy) {
            Motoboy::firstOrCreate(
                ['cpf' => $motoboy['cpf']],
                $motoboy
            );
        }
    }
}
