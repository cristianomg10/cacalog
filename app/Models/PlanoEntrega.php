<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanoEntrega extends Model
{
    protected $table = 'planos_entrega';

    protected $fillable = [
        'nome',
        'descricao',
        'valor_mensal',
    ];

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'cliente_plano_entrega')
            ->withPivot('data_inicio', 'data_fim')
            ->withTimestamps();
    }
}
