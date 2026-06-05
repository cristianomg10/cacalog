<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    protected $casts = [
        'conteudo' => 'array',
    ];

    protected $fillable = [
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'conteudo',
        'nome_destinatario',
        'codigo_pedido',
        'cidade_id',
        'cliente_id',
        'status_entrega_id',
        'motoboy_id',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function status()
    {
        return $this->belongsTo(StatusEntrega::class, 'status_entrega_id');
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

    public function motoboy()
    {
        return $this->belongsTo(Motoboy::class);
    }
}
