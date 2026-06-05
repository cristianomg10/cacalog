<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nome',
        'cnpj',
        'telefone',
        'email',
        'senha',
        'url_callback',
        'token_autenticacao',
    ];

    public function entregas()
    {
        return $this->hasMany(Entrega::class);
    }

    public function planos()
    {
        return $this->belongsToMany(PlanoEntrega::class, 'cliente_plano_entrega')
            ->withPivot('data_inicio', 'data_fim')
            ->withTimestamps();
    }

    public function usuarios()
    {
        return $this->hasMany(User::class);
    }
}
