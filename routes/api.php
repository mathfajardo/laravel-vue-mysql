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
    Route::get('/produtos', [ProdutosController::class, 'index'])->middleware('ability:get-produtos');
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::post('/produtos', [ProdutosController::class, 'store']);
Route::get('/produtos/{produto}', [ProdutosController::class, 'show']);
Route::delete('/produtos/{produto}', [ProdutosController::class, 'destroy']);
Route::put('/produtos/{produto}', [ProdutosController::class, "update"]);

// rotas dos clientes
Route::get('/clientes', [ClientesController::class, 'index']);
Route::post('/clientes', [ClientesController::class, 'store']);
Route::get('/clientes/{cliente}', [ClientesController::class, 'show']);
Route::delete('/clientes/{cliente}', [ClientesController::class, 'destroy']);

// rotas das vendas
Route::get('/vendas', [VendasController::class, 'index']);
Route::post('/vendas', [VendasController::class, 'store']);
Route::get('/vendas/{venda}', [VendasController::class, 'show']);
Route::delete('/vendas/{venda}', [VendasController::class, 'destroy']);

// rota para autenticação
Route::post('/login', [AuthController::class, 'login']);

// rota dos users
Route::post('/user', [UserController::class, 'store']);  