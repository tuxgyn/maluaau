<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;


class AgendamentoController extends Controller
{
    public function store(Request $request)
    {
        // Validação dos campos vindos do formulário
        $validated = $request->validate([
            'tutor_name' => 'required|string|max:100',
            'phone'      => 'required|string|max:20',
            'pet_name'   => 'required|string|max:100',
            'pet_type'   => 'required|string|max:50',
            'service'    => 'required|string|max:100',
        ]);

        // Salvando no banco de dados
        Agendamento::create($validated);

        // Retorna redirecionando de volta com uma mensagem de sucesso
        return redirect()->back()->with('success', 'Solicitação de agendamento realizada com sucesso!');
    }
}