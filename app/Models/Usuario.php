<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = [
    'nome', 'sobrenome', 'email', 'telefone',
    'cep', 'cidade', 'estado', 'endereco', 'bairro',
    'pet_nome', 'pet_raca', 'numero'
    ];

}