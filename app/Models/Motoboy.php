<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motoboy extends Model
{
    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
    ];

    public function entregas()
    {
        return $this->hasMany(Entrega::class);
    }
}
