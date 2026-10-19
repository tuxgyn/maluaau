<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitacaoAgendamento extends Model
{
    use HasFactory;

    // Linha obrigatória para apontar para a tabela correta no banco
    protected $table = 'agendamentos';

    protected $fillable = [
        'tutor_name',
        'phone',
        'pet_name',
        'pet_type',
        'service',
        'status',
    ];
}