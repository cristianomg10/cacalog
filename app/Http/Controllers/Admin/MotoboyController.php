<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Motoboy;
use Illuminate\Http\Request;

class MotoboyController extends Controller
{
    public function index()
    {
        $motoboys = Motoboy::paginate(10);
        return view('admin.motoboys.index', compact('motoboys'));
    }

    public function create()
    {
        return view('admin.motoboys.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:motoboys',
            'telefone' => 'required|string|max:20',
        ]);

        Motoboy::create($data);
        return redirect()->route('admin.motoboys.index')->with('success', 'Motoboy cadastrado com sucesso!');
    }

    public function edit(Motoboy $motoboy)
    {
        return view('admin.motoboys.edit', compact('motoboy'));
    }

    public function update(Request $request, Motoboy $motoboy)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:motoboys,cpf,' . $motoboy->id,
            'telefone' => 'required|string|max:20',
        ]);

        $motoboy->update($data);
        return redirect()->route('admin.motoboys.index')->with('success', 'Motoboy atualizado com sucesso!');
    }

    public function destroy(Motoboy $motoboy)
    {
        $motoboy->delete();
        return redirect()->route('admin.motoboys.index')->with('success', 'Motoboy excluído com sucesso!');
    }
}
