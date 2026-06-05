<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Entrega;

class EntregaController extends Controller
{
    public function index()
    {
        $cliente = auth()->user()->cliente;

        if (!$cliente) {
            return view('cliente.entregas', ['entregas' => collect()]);
        }

        $entregas = Entrega::with(['status', 'cidade', 'motoboy'])
            ->where('cliente_id', $cliente->id)
            ->latest()
            ->paginate(10);

        return view('cliente.entregas', compact('entregas'));
    }
}
