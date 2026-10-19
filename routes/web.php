<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolicitacaoAgendamentoController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Página principal (Home)
Route::get('/', function () {
    return view('malu_agendamentos');
})->name('home');

// Processa o agendamento vindo da view malu_agendamentos
Route::post('/agendamentos', [SolicitacaoAgendamentoController::class, 'store'])
    ->name('agendamentos.store');

// Exibe a página de cadastro
Route::get('/cadastro', function () {
    return view('cadastro');
})->name('cadastro.create');

// Processa o cadastro do usuário
Route::post('/cadastro', [UsuarioController::class, 'store'])
    ->name('usuarios.store');