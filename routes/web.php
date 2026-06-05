<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ConfiguracaoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\PlanoEntregaController;
use App\Http\Controllers\Admin\StatusEntregaController;
use App\Http\Controllers\Admin\CidadeController;
use App\Http\Controllers\Admin\MotoboyController;
use App\Http\Controllers\Admin\EntregaController;
use App\Http\Controllers\Admin\DesignacaoController;
use App\Http\Controllers\Admin\AcompanhamentoController;
use App\Http\Controllers\Admin\ClientePlanoController;
use App\Http\Controllers\Cliente\EntregaController as ClienteEntregaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'index'])->name('landing');

Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('cliente.entregas');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('clientes', ClienteController::class);
    Route::resource('planos-entrega', PlanoEntregaController::class);
    Route::resource('status-entregas', StatusEntregaController::class);
    Route::resource('cidades', CidadeController::class);
    Route::resource('motoboys', MotoboyController::class);
    Route::resource('entregas', EntregaController::class);
    Route::post('/clientes/{cliente}/planos', [ClientePlanoController::class, 'vincular'])->name('clientes.planos.vincular');
    Route::delete('/clientes/{cliente}/planos/{plano}', [ClientePlanoController::class, 'desvincular'])->name('clientes.planos.desvincular');
    Route::get('/configuracoes', [ConfiguracaoController::class, 'index'])->name('configuracoes.index');
    Route::post('/configuracoes', [ConfiguracaoController::class, 'update'])->name('configuracoes.update');
    Route::get('/designacao', [DesignacaoController::class, 'index'])->name('designacao.index');
    Route::post('/designacao', [DesignacaoController::class, 'designar'])->name('designacao.designar');
    Route::get('/acompanhamento', [AcompanhamentoController::class, 'index'])->name('acompanhamento.index');
});

Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/minhas-entregas', [ClienteEntregaController::class, 'index'])->name('cliente.entregas');
});

require __DIR__.'/auth.php';
