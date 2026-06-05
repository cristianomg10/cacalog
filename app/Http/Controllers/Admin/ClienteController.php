<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\PlanoEntrega;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with('planos')->paginate(10);
        return view('admin.clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('admin.clientes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:clientes',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|unique:clientes',
            'senha' => 'required|string|min:6',
            'url_callback' => 'nullable|url',
            'token_autenticacao' => 'nullable|string|unique:clientes',
        ]);

        $data['senha'] = bcrypt($data['senha']);
        Cliente::create($data);

        return redirect()->route('admin.clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function show(Cliente $cliente)
    {
        $cliente->load('planos', 'entregas');
        $planosDisponiveis = PlanoEntrega::whereDoesntHave('clientes', fn($q) => $q->where('cliente_id', $cliente->id))->get();
        return view('admin.clientes.show', compact('cliente', 'planosDisponiveis'));
    }

    public function edit(Cliente $cliente)
    {
        return view('admin.clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:clientes,cnpj,' . $cliente->id,
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'senha' => 'nullable|string|min:6',
            'url_callback' => 'nullable|url',
            'token_autenticacao' => 'nullable|string|unique:clientes,token_autenticacao,' . $cliente->id,
        ]);

        if (!empty($data['senha'])) {
            $data['senha'] = bcrypt($data['senha']);
        } else {
            unset($data['senha']);
        }

        $cliente->update($data);
        return redirect()->route('admin.clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('admin.clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }
}
