<?php

use App\Http\Controllers\SolicitacaoAgendamentoController;
use Illuminate\Support\Facades\Route;

// Copie esta rota para routes/web.php, ou inclua este arquivo no web.php.
Route::post('/agendamentos', [SolicitacaoAgendamentoController::class, 'store'])
    ->name('agendamentos.store');
