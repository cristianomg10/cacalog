<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entrega;
use App\Models\Motoboy;
use App\Models\Setting;
use App\Models\StatusEntrega;
use App\Services\CallbackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

        $motoboys = Motoboy::orderBy('id')->get();

        if ($motoboys->isEmpty()) {
            return redirect()->route('admin.designacao.index')
                ->with('error', 'Cadastre pelo menos um motoboy antes de designar.');
        }

        $apiUrl = Setting::getValue('motoboy_api_url', '');

        if (empty($apiUrl)) {
            return redirect()->route('admin.designacao.index')
                ->with('error', 'URL da API de designação não configurada. Acesse Configurações.');
        }

        $apiUrl = str_replace('{numero_entregadores}', $motoboys->count(), $apiUrl);

        $payload = $entregas->map(fn($e) => [
                'cep' => $e->cep,
                'rua' => "{$e->logradouro}, {$e->numero}" . ($e->complemento ? " - {$e->complemento}" : '') . ", {$e->bairro}, {$e->cidade?->nome}/{$e->cidade?->estado}",
                'bairro' => $e->bairro,
            ])->toArray();

        #dd($payload);

        try {
            $response = Http::timeout(15)->post($apiUrl, $payload);
            
        } catch (\Exception $e) {
            return redirect()->route('admin.designacao.index')
                ->with('error', 'Falha ao conectar com a API de designação: ' . $e->getMessage());
        }

        if ($response->failed()) {
            return redirect()->route('admin.designacao.index')
                ->with('error', 'API de designação retornou erro HTTP ' . $response->status());
        }

        $designacoes = $response->json();

        if (!is_array($designacoes) || count($designacoes) !== $entregas->count()) {
            return redirect()->route('admin.designacao.index')
                ->with('error', 'Resposta inválida da API de designação.');
        }

        $associacao = [];
        foreach ($designacoes as $k=>$v) {
            if (!isset($associacao[$v['cep']])) {
                $associacao[$v['cep']] = $v['motoboy'];
            }
        }

        $associacao_motoboys = [];
        foreach ($motoboys as $k=>$m) {
            $associacao_motoboys[$k] = $m->id;
        }

        #dd($associacao);

        $erros = 0;
        foreach ($entregas as $i => $entrega) {
            $entrega->motoboy_id = $associacao_motoboys[$associacao[$entrega->cep]] ?? null;
            $entrega->status_entrega_id = $statusSaiu->id;
            $entrega->save();

            $callbackService->notify($entrega, $statusSaiu->nome);
        }

        $total = $entregas->count();
        $sucesso = $total - $erros;

        if ($erros > 0) {
            return redirect()->route('admin.designacao.index')
                ->with('warning', "{$sucesso} entrega(s) designada(s), mas {$erros} índice(s) inválido(s) retornado(s) pela API.");
        }

        return redirect()->route('admin.designacao.index')
            ->with('success', "{$sucesso} entrega(s) designada(s) com sucesso!");
    }
}
