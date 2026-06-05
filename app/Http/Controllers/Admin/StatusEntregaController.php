<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatusEntrega;
use Illuminate\Http\Request;

class StatusEntregaController extends Controller
{
    public function index()
    {
        $statuses = StatusEntrega::paginate(10);
        return view('admin.status-entregas.index', compact('statuses'));
    }

    public function create()
    {
        return view('admin.status-entregas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255|unique:status_entregas',
        ]);

        StatusEntrega::create($data);
        return redirect()->route('admin.status-entregas.index')->with('success', 'Status cadastrado com sucesso!');
    }

    public function edit(StatusEntrega $statusEntrega)
    {
        return view('admin.status-entregas.edit', compact('statusEntrega'));
    }

    public function update(Request $request, StatusEntrega $statusEntrega)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255|unique:status_entregas,nome,' . $statusEntrega->id,
        ]);

        $statusEntrega->update($data);
        return redirect()->route('admin.status-entregas.index')->with('success', 'Status atualizado com sucesso!');
    }

    public function destroy(StatusEntrega $statusEntrega)
    {
        $statusEntrega->delete();
        return redirect()->route('admin.status-entregas.index')->with('success', 'Status excluído com sucesso!');
    }
}
