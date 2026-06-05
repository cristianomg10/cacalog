<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $fillable = [
        'nome',
        'estado',
    ];

    public function entregas()
    {
        return $this->hasMany(Entrega::class);
    }
}
