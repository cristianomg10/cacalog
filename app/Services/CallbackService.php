<?php

namespace App\Services;

use App\Models\Entrega;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CallbackService
{
    public function notify(Entrega $entrega, string $statusNome): void
    {
        $cliente = $entrega->cliente;

        if (!$cliente || !$cliente->url_callback) {
            return;
        }

        try {
            Http::timeout(10)->post($cliente->url_callback, [
                'codigo_pedido' => $entrega->codigo_pedido,
                'status' => $statusNome,
            ]);
        } catch (\Exception $e) {
            Log::warning('Falha ao notificar callback do cliente {cliente} para entrega {entrega}: {error}', [
                'cliente' => $cliente->id,
                'entrega' => $entrega->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
