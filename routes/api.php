<?php

use App\Http\Controllers\Api\EntregaController;
use Illuminate\Support\Facades\Route;

Route::middleware('api.token')->post('/entregas', [EntregaController::class, 'store']);
