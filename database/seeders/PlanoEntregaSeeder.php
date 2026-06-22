<?php

namespace Database\Seeders;

use App\Models\PlanoEntrega;
use Illuminate\Database\Seeder;

class PlanoEntregaSeeder extends Seeder
{
    public function run(): void
    {
        $planos = [
            [
                'nome' => 'Básico',
                'descricao' => 'Até 10 entregas por semana. Entregas adicionais: R$ 12,00 cada.',
                'valor_mensal' => 100.00,
            ],
            [
                'nome' => 'Premium',
                'descricao' => 'Até 50 entregas por semana. Entregas adicionais: R$ 10,00 cada.',
                'valor_mensal' => 450.00,
            ],
            [
                'nome' => 'Plus',
                'descricao' => 'Até 100 entregas por semana. Entregas adicionais: R$ 8,00 cada.',
                'valor_mensal' => 850.00,
            ],
        ];

        foreach ($planos as $plano) {
            PlanoEntrega::firstOrCreate(
                ['nome' => $plano['nome']],
                $plano
            );
        }
    }
}
