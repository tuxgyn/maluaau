<?php

namespace App\Http\Controllers;

use App\Models\SolicitacaoAgendamento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SolicitacaoAgendamentoController extends Controller
{
    /**
     * Registra uma solicitação de atendimento.
     *
     * Importante: registrar a solicitação não confirma um agendamento.
     */
    public function store(Request $request): RedirectResponse
    {
        $servicosPermitidos = [
            'Banho e Tosa',
            'Banho e Tosa Estético/Terapêutico',
            'Consulta Veterinária',
            'Consulta Veterinária Preventiva',
            'Hospedagem',
            'Hospedagem & Day Care',
            'Plano AuAu',
            'Plano AuAu Conforto',
            'Plano AuAu Leve',
            'Plano AuAu VIP Care',
        ];

        $dados = $request->validate([
            'tutor_name' => ['nullable', 'string', 'max:120', 'required_with:phone'],
            'phone'      => ['nullable', 'string', 'max:20', 'required_with:tutor_name'],
            'pet_name'  => ['required', 'string', 'max:100'],
            'pet_type'  => ['nullable', Rule::in(['cachorro', 'gato', 'outro'])],
            'service'   => ['required', Rule::in($servicosPermitidos)],
        ], [
            'tutor_name.required_with' => 'Informe o nome do tutor.',
            'phone.required_with' => 'Informe o WhatsApp com DDD.',
            'pet_name.required' => 'Informe o nome do pet.',
            'pet_name.max' => 'O nome do pet deve ter no máximo 100 caracteres.',
            'pet_type.in' => 'Selecione um tipo de pet válido.',
            'service.required' => 'Selecione o serviço desejado.',
            'service.in' => 'O serviço selecionado não é válido.',
        ]);

        if (!empty($dados['phone'])) {
            $digitos = preg_replace('/\D+/', '', $dados['phone']);

            if (!in_array(strlen($digitos), [10, 11], true)) {
                return back()
                    ->withErrors(['phone' => 'Informe um WhatsApp válido com DDD.'])
                    ->withInput();
            }

            $dados['phone'] = $digitos;
        }

        $dados['status'] = 'pendente';

        SolicitacaoAgendamento::create($dados);

        return back()->with(
            'success',
            'Solicitação registrada com sucesso! O agendamento ainda depende da confirmação da equipe.'
        );
    }
}
