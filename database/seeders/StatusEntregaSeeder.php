<?php

namespace Database\Seeders;

use App\Models\StatusEntrega;
use Illuminate\Database\Seeder;

class StatusEntregaSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['Pendente', 'Em Trânsito', 'Entregue', 'Cancelado', 'Devolvido'];

        foreach ($statuses as $nome) {
            StatusEntrega::firstOrCreate(['nome' => $nome]);
        }
    }
}
