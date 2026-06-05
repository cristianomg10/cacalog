<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlanoEntrega;
use Illuminate\Http\Request;

class PlanoEntregaController extends Controller
{
    public function index()
    {
        $planos = PlanoEntrega::paginate(10);
        return view('admin.planos-entrega.index', compact('planos'));
    }

    public function create()
    {
        return view('admin.planos-entrega.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'valor_mensal' => 'required|numeric|min:0',
        ]);

        PlanoEntrega::create($data);
        return redirect()->route('admin.planos-entrega.index')->with('success', 'Plano cadastrado com sucesso!');
    }

    public function edit(PlanoEntrega $planosEntrega)
    {
        return view('admin.planos-entrega.edit', compact('planosEntrega'));
    }

    public function update(Request $request, PlanoEntrega $planosEntrega)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'valor_mensal' => 'required|numeric|min:0',
        ]);

        $planosEntrega->update($data);
        return redirect()->route('admin.planos-entrega.index')->with('success', 'Plano atualizado com sucesso!');
    }

    public function destroy(PlanoEntrega $planosEntrega)
    {
        $planosEntrega->delete();
        return redirect()->route('admin.planos-entrega.index')->with('success', 'Plano excluído com sucesso!');
    }
}
