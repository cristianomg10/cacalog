<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\PlanoEntrega;
use Illuminate\Http\Request;

class ClientePlanoController extends Controller
{
    public function vincular(Request $request, Cliente $cliente)
    {
        $data = $request->validate([
            'plano_entrega_id' => 'required|exists:planos_entrega,id',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date|after:data_inicio',
        ]);

        $cliente->planos()->attach($data['plano_entrega_id'], [
            'data_inicio' => $data['data_inicio'],
            'data_fim' => $data['data_fim'],
        ]);

        return redirect()->route('admin.clientes.show', $cliente)->with('success', 'Plano vinculado com sucesso!');
    }

    public function desvincular(Cliente $cliente, PlanoEntrega $plano)
    {
        $cliente->planos()->detach($plano->id);
        return redirect()->route('admin.clientes.show', $cliente)->with('success', 'Plano desvinculado com sucesso!');
    }
}
