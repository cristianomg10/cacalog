<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cidade;
use App\Models\Entrega;
use App\Models\StatusEntrega;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class EntregaController extends Controller
{
    public function store(Request $request)
    {
        #dd($request->all());

        $validated = $request->validate([
            'codigo_pedido' => 'required|string|max:255',
            'cep' => 'required|string|max:9',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'nome_destinatario' => 'required|string|max:255',
            'conteudo' => 'required|array',
            'conteudo.*.nome' => 'required|string|max:255',
            'conteudo.*.quantidade' => 'required|integer|min:1',
        ]);

        $cep = preg_replace('/\D/', '', $validated['cep']);

        if (strlen($cep) !== 8) {
            throw ValidationException::withMessages([
                'cep' => 'O CEP deve conter 8 dígitos.',
            ]);
        }

        #dd("ok");

        $viaCepResponse = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($viaCepResponse->failed() || $viaCepResponse->json('erro')) {
            return response()->json([
                'success' => false,
                'message' => 'CEP inválido ou não encontrado.',
            ], 422);
        }

        $viaCepData = $viaCepResponse->json();

        #dd($viaCepData);

        $cidade = Cidade::firstOrCreate([
            'nome' => $viaCepData['localidade'],
            'estado' => $viaCepData['uf'],
        ]);

        $statusPendente = StatusEntrega::firstOrCreate([
            'nome' => 'Pendente',
        ]);

        #dd($statusPendente);


        /** @var \App\Models\Cliente $cliente */
        $cliente = $request->get('cliente_autenticado');

        #dd($cliente);

        $entrega = Entrega::create([
            'cliente_id' => $cliente->id,
            'codigo_pedido' => $validated['codigo_pedido'],
            'cep' => $cep,
            'logradouro' => $validated['logradouro'],
            'numero' => $validated['numero'],
            'complemento' => $validated['complemento'] ?? null,
            'bairro' => $validated['bairro'],
            'conteudo' => $validated['conteudo'],
            'nome_destinatario' => $validated['nome_destinatario'],
            'cidade_id' => $cidade->id,
            'status_entrega_id' => $statusPendente->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Entrega criada com sucesso.',
            'data' => [
                'id' => $entrega->id,
                'codigo_pedido' => $entrega->codigo_pedido,
                'conteudo' => $entrega->conteudo,
                'status' => $statusPendente->nome,
                'cidade' => $cidade->nome,
                'uf' => $cidade->estado,
                'created_at' => $entrega->created_at->toIso8601String(),
            ],
        ], 201);
    }
}
