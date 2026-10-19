<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitacaoAgendamento extends Model
{
    use HasFactory;

    protected $table = 'agendamentos';

    protected $fillable = [
        'tutor_name',
        'phone',
        'pet_name',
        'pet_type',
        'service',
        'pickup_delivery',
        'pickup_address',
        'status',
    ];
}
