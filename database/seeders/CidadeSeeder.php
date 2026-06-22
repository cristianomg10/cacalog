<?php

namespace Database\Seeders;

use App\Models\Cidade;
use Illuminate\Database\Seeder;

class CidadeSeeder extends Seeder
{
    public function run(): void
    {
        $cidades = [
            ['nome' => 'Caçador', 'estado' => 'SC'],
            ['nome' => 'Videira', 'estado' => 'SC'],
        ];

        foreach ($cidades as $cidade) {
            Cidade::firstOrCreate(
                ['nome' => $cidade['nome'], 'estado' => $cidade['estado']],
                $cidade
            );
        }
    }
}
