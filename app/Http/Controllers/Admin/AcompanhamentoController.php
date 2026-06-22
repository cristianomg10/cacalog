<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entrega;
use App\Models\StatusEntrega;
use App\Services\CallbackService;
use Illuminate\Http\Request;

class AcompanhamentoController extends Controller
{
    public function index()
    {
        $statusSaiu = StatusEntrega::where('nome', 'Saiu para entrega')->first();

        $entregas = Entrega::with(['cliente', 'cidade', 'motoboy', 'status'])
            ->where('status_entrega_id', $statusSaiu?->id)
            ->whereNotNull('motoboy_id')
            ->get();

        $motoboys = $entregas->groupBy('motoboy_id')->map(fn($group) => [
            'nome' => $group->first()->motoboy?->nome ?? 'Desconhecido',
            'total' => $group->count(),
        ]);

        $palette = ['#e6194b', '#3cb44b', '#ffe119', '#4363d8', '#f58231', '#911eb4', '#42d4f4', '#f032e6', '#bfef45', '#469990'];

        $entregasJson = $entregas
            ->filter(fn($e) => $e->latitude && $e->longitude)
            ->values()
            ->map(function ($e) use ($palette) {
                $motoboyId = $e->motoboy_id;
                return [
                    'id' => $e->id,
                    'destinatario' => $e->nome_destinatario,
                    'endereco' => "{$e->logradouro}, {$e->numero}" . ($e->complemento ? " - {$e->complemento}" : '') . ", {$e->bairro}",
                    'cep' => $e->cep,
                    'cidade' => "{$e->cidade?->nome}/{$e->cidade?->estado}",
                    'cliente' => $e->cliente?->nome ?? '-',
                    'motoboy' => $e->motoboy?->nome ?? '-',
                    'motoboy_id' => $motoboyId,
                    'lat' => (float) $e->latitude,
                    'lng' => (float) $e->longitude,
                    'cor' => $palette[$motoboyId % count($palette)],
                ];
            });

        $statuses = StatusEntrega::orderBy('nome')->get();

        return view('admin.acompanhamento.index', compact('entregas', 'motoboys', 'entregasJson', 'statuses'));
    }

    public function updateStatus(Request $request, Entrega $entrega, CallbackService $callbackService)
    {
        $request->validate([
            'status_entrega_id' => 'required|exists:status_entregas,id',
        ]);

        $novoStatus = StatusEntrega::find($request->status_entrega_id);
        $entrega->status_entrega_id = $novoStatus->id;
        $entrega->save();

        $callbackService->notify($entrega, $novoStatus->nome);

        return redirect()->route('admin.acompanhamento.index')
            ->with('success', "Entrega #{$entrega->id} atualizada para \"{$novoStatus->nome}\".");
    }
}
