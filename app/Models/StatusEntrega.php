<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusEntrega extends Model
{
    protected $fillable = [
        'nome',
    ];

    public function entregas()
    {
        return $this->hasMany(Entrega::class);
    }
}
