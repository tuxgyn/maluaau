<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitacaoAgendamento extends Model
{
    use HasFactory;

    // Adicione esta linha para informar o nome correto da tabela no banco
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