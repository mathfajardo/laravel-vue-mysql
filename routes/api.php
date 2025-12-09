<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendasController;
use App\Models\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// rotas dos produtos
Route::middleware('auth:sanctum')->group(function () {
    // rota dos produtos
    Route::get('/produtos', [ProdutosController::class, 'index']);//->middleware('ability:get-produtos');
    Route::post('/produtos', [ProdutosController::class, 'store']);
    Route::get('/produtos/{produto}', [ProdutosController::class, 'show']);
    Route::delete('/produtos/{produto}', [ProdutosController::class, 'destroy']);
    Route::put('/produtos/{produto}', [ProdutosController::class, 'update']);
    Route::get('/produtosTotal', [ProdutosController::class, 'produtosTotal']);

    // rotas dos clientes
    Route::get('/clientes', [ClientesController::class, 'index']);
    Route::post('/clientes', [ClientesController::class, 'store']);
    Route::get('/clientes/{cliente}', [ClientesController::class, 'show']);
    Route::delete('/clientes/{cliente}', [ClientesController::class, 'destroy']);
    Route::get('/clientesTotal', [ClientesController::class, 'clientesTotal']);

    // rotas das vendas
    Route::get('/vendas', [VendasController::class, 'index']);
    Route::post('/vendas', [VendasController::class, 'store']);
    Route::get('/vendas/{venda}', [VendasController::class, 'show']);
    Route::delete('/vendas/{venda}', [VendasController::class, 'destroy']);
    Route::get('/vendasTotal', [VendasController::class, 'vendasTotal']);
    Route::get('/vendasValorTotal', [VendasController::class, 'vendasValorTotal']);

    Route::post('/logout', [AuthController::class, 'logout']);
    
    // verifica token
    Route::get('login/verifica', [AuthController::class, 'verifica_token']);
});

// rota para autenticação
Route::post('/login', [AuthController::class, 'login']);

// rota dos users
Route::post('/user', [UserController::class, 'store']);  