<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProdutosController;
use App\Models\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// rotas dos produtos
Route::get('/produtos', [ProdutosController::class, 'index']);
Route::post('/produtos', [ProdutosController::class, 'store']);
Route::get('/produtos/{produto}', [ProdutosController::class, 'show']);
Route::delete('/produtos/{produto}', [ProdutosController::class, 'destroy']);

// rotas dos clientes
Route::get('/clientes', [ClientesController::class, 'index']);
Route::post('/clientes', [ClientesController::class, 'store']);
Route::get('/clientes/{cliente}', [ClientesController::class, 'show']);
Route::delete('/clientes/{cliente}', [ClientesController::class, 'destroy']);

