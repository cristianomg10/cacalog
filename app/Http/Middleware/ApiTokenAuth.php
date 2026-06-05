<?php

namespace App\Http\Middleware;

use App\Models\Cliente;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->input('token');

        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Token de autenticação não informado.',
            ], 401);
        }

        $cliente = Cliente::where('token_autenticacao', $token)->first();

        if (!$cliente) {
            return response()->json([
                'success' => false,
                'message' => 'Token de autenticação inválido.',
            ], 401);
        }

        $request->merge(['cliente_autenticado' => $cliente]);

        return $next($request);
    }
}
