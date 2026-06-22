<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entrega;
use App\Models\Motoboy;
use App\Models\StatusEntrega;
use App\Services\CallbackService;
use App\Services\DesignacaoService;
use Illuminate\Http\Request;

class DesignacaoController extends Controller
{
    public function index()
    {
        $statusPendente = StatusEntrega::where('nome', 'Pendente')->first();
        $entregas = Entrega::with(['cliente', 'cidade'])
            ->where('status_entrega_id', $statusPendente?->id)
            ->get();
        $motoboys = Motoboy::orderBy('id')->get();

        $entregasJson = $entregas
            ->filter(fn($e) => $e->latitude && $e->longitude)
            ->values()
            ->map(fn($e) => [
                'id' => $e->id,
                'destinatario' => $e->nome_destinatario,
                'endereco' => "{$e->logradouro}, {$e->numero}" . ($e->complemento ? " - {$e->complemento}" : '') . ", {$e->bairro}",
                'cidade' => "{$e->cidade?->nome}/{$e->cidade?->estado}",
                'cep' => $e->cep,
                'cliente' => $e->cliente?->nome ?? '-',
                'lat' => (float) $e->latitude,
                'lng' => (float) $e->longitude,
            ]);

        return view('admin.designacao.index', compact('entregas', 'motoboys', 'entregasJson'));
    }

    public function designar(Request $request, CallbackService $callbackService)
    {
        $statusPendente = StatusEntrega::where('nome', 'Pendente')->first();
        $statusSaiu = StatusEntrega::where('nome', 'Saiu para entrega')->first();

        if (!$statusPendente || !$statusSaiu) {
            return redirect()->route('admin.designacao.index')
                ->with('error', 'Status necessários não encontrados. Verifique os status de entrega.');
        }

        $entregas = Entrega::with('cliente')
            ->where('status_entrega_id', $statusPendente->id)
            ->get();

        if ($entregas->isEmpty()) {
            return redirect()->route('admin.designacao.index')
                ->with('error', 'Nenhuma entrega pendente para designar.');
        }

        $motoboyIds = $request->input('motoboy_ids', []);

        if (empty($motoboyIds)) {
            return redirect()->route('admin.designacao.index')
                ->with('error', 'Selecione pelo menos um motoboy para designar.');
        }

        $motoboys = Motoboy::orderBy('id')->whereIn('id', $motoboyIds)->get();

        if ($motoboys->isEmpty()) {
            return redirect()->route('admin.designacao.index')
                ->with('error', 'Nenhum motoboy encontrado com os IDs selecionados.');
        }

        $designacaoService = app(DesignacaoService::class);
        $assignment = $designacaoService->designar($entregas, $motoboys);

        foreach ($entregas as $entrega) {
            $entrega->motoboy_id = $assignment[$entrega->id] ?? null;
            $entrega->status_entrega_id = $statusSaiu->id;
            $entrega->save();

            $callbackService->notify($entrega, $statusSaiu->nome);
        }

        $sucesso = $entregas->count();

        return redirect()->route('admin.designacao.index')
            ->with('success', "{$sucesso} entrega(s) designada(s) com sucesso!");
    }
}
