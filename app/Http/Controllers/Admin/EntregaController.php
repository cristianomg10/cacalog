<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cidade;
use App\Models\Cliente;
use App\Models\Entrega;
use App\Models\Motoboy;
use App\Models\StatusEntrega;
use App\Services\GeocodingService;
use Illuminate\Http\Request;

class EntregaController extends Controller
{
    public function index()
    {
        $entregas = Entrega::with(['cliente', 'status', 'cidade', 'motoboy'])->paginate(10);
        return view('admin.entregas.index', compact('entregas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $statuses = StatusEntrega::all();
        $cidades = Cidade::all();
        $motoboys = Motoboy::all();
        return view('admin.entregas.create', compact('clientes', 'statuses', 'cidades', 'motoboys'));
    }

    public function store(Request $request, GeocodingService $geocodingService)
    {
        $data = $request->validate([
            'cep' => 'required|string|max:9',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'conteudo' => 'required|json',
            'nome_destinatario' => 'required|string|max:255',
            'codigo_pedido' => 'required|string|max:255',
            'cidade_id' => 'required|exists:cidades,id',
            'cliente_id' => 'required|exists:clientes,id',
            'status_entrega_id' => 'required|exists:status_entregas,id',
            'motoboy_id' => 'required|exists:motoboys,id',
        ]);

        $data['conteudo'] = json_decode($data['conteudo'], true);

        $cidade = Cidade::find($data['cidade_id']);
        $address = $geocodingService->buildAddress(
            $data['logradouro'],
            $data['numero'],
            $data['complemento'] ?? null,
            $data['bairro'],
            $cidade?->nome ?? '',
            $cidade?->estado ?? '',
        );
        $coordinates = $geocodingService->geocode($address);

        if ($coordinates) {
            $data['latitude'] = $coordinates['lat'];
            $data['longitude'] = $coordinates['lng'];
        }

        Entrega::create($data);
        return redirect()->route('admin.entregas.index')->with('success', 'Entrega cadastrada com sucesso!');
    }

    public function show(Entrega $entrega)
    {
        $entrega->load(['cliente', 'status', 'cidade', 'motoboy']);
        return view('admin.entregas.show', compact('entrega'));
    }

    public function edit(Entrega $entrega)
    {
        $clientes = Cliente::all();
        $statuses = StatusEntrega::all();
        $cidades = Cidade::all();
        $motoboys = Motoboy::all();
        return view('admin.entregas.edit', compact('entrega', 'clientes', 'statuses', 'cidades', 'motoboys'));
    }

    public function update(Request $request, Entrega $entrega, GeocodingService $geocodingService)
    {
        $data = $request->validate([
            'cep' => 'required|string|max:9',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'conteudo' => 'required|json',
            'nome_destinatario' => 'required|string|max:255',
            'codigo_pedido' => 'required|string|max:255',
            'cidade_id' => 'required|exists:cidades,id',
            'cliente_id' => 'required|exists:clientes,id',
            'status_entrega_id' => 'required|exists:status_entregas,id',
            'motoboy_id' => 'nullable|exists:motoboys,id',
        ]);

        $data['conteudo'] = json_decode($data['conteudo'], true);

        $cidade = Cidade::find($data['cidade_id']);
        $address = $geocodingService->buildAddress(
            $data['logradouro'],
            $data['numero'],
            $data['complemento'] ?? null,
            $data['bairro'],
            $cidade?->nome ?? '',
            $cidade?->estado ?? '',
        );
        $coordinates = $geocodingService->geocode($address);

        if ($coordinates) {
            $data['latitude'] = $coordinates['lat'];
            $data['longitude'] = $coordinates['lng'];
        } else {
            $data['latitude'] = null;
            $data['longitude'] = null;
        }

        $entrega->update($data);
        return redirect()->route('admin.entregas.index')->with('success', 'Entrega atualizada com sucesso!');
    }

    public function destroy(Entrega $entrega)
    {
        $entrega->delete();
        return redirect()->route('admin.entregas.index')->with('success', 'Entrega excluída com sucesso!');
    }
}
