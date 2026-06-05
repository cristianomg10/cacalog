<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    public function index()
    {
        $cidades = Cidade::paginate(10);
        return view('admin.cidades.index', compact('cidades'));
    }

    public function create()
    {
        return view('admin.cidades.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'estado' => 'required|string|size:2',
        ]);

        Cidade::create($data);
        return redirect()->route('admin.cidades.index')->with('success', 'Cidade cadastrada com sucesso!');
    }

    public function edit(Cidade $cidade)
    {
        return view('admin.cidades.edit', compact('cidade'));
    }

    public function update(Request $request, Cidade $cidade)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'estado' => 'required|string|size:2',
        ]);

        $cidade->update($data);
        return redirect()->route('admin.cidades.index')->with('success', 'Cidade atualizada com sucesso!');
    }

    public function destroy(Cidade $cidade)
    {
        $cidade->delete();
        return redirect()->route('admin.cidades.index')->with('success', 'Cidade excluída com sucesso!');
    }
}
