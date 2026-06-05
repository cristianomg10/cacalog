<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Entrega;
use App\Models\Motoboy;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClientes = Cliente::count();
        $totalEntregas = Entrega::count();
        $totalMotoboys = Motoboy::count();
        $entregasPendentes = Entrega::whereHas('status', fn($q) => $q->where('nome', 'Pendente'))->count();
        $ultimasEntregas = Entrega::with(['cliente', 'status', 'motoboy'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalClientes', 'totalEntregas', 'totalMotoboys',
            'entregasPendentes', 'ultimasEntregas'
        ));
    }
}
