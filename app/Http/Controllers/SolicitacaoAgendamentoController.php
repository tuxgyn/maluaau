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

        // NOVO: mapa de normalização de serviços.
        // O Blade novo envia os valores canônicos ('banho_tosa', 'plano_leve'...)
        // e o Blade antigo envia o nome completo ('Banho e Tosa', 'Plano AuAu Leve'...).
        // Tudo é convertido para o nome completo ANTES da validação — assim a
        // lista $servicosPermitidos e o banco de dados continuam consistentes.
        $mapaServicos = [
            'banho_tosa'     => 'Banho e Tosa',
            'consulta'       => 'Consulta Veterinária',
            'hospedagem'     => 'Hospedagem & Day Care',
            'plano_leve'     => 'Plano AuAu Leve',
            'plano_conforto' => 'Plano AuAu Conforto',
            'plano_vip'      => 'Plano AuAu VIP Care',
        ];

        // NOVO: aplica o mapa. Valores que não estão no mapa (os nomes
        // completos do Blade antigo) passam intactos e continuam válidos.
        $serviceInput = is_string($request->input('service'))
            ? $request->input('service')
            : '';

        $request->merge([
            'service' => $mapaServicos[$serviceInput] ?? $serviceInput,
            'pickup_delivery' => $request->input('pickup_delivery', 'nao'),
        ]);
        // FIM DO BLOCO NOVO

        $dados = $request->validate([
            'tutor_name' => ['nullable', 'string', 'max:120', 'required_with:phone'],
            'phone'      => ['nullable', 'string', 'max:20', 'required_with:tutor_name'],
            'pet_name'   => ['required', 'string', 'max:100'],
            'pet_type'   => ['nullable', Rule::in(['cachorro', 'gato', 'outro'])],
            'service'    => ['required', Rule::in($servicosPermitidos)],
            'pickup_delivery' => ['required', Rule::in(['nao', 'sim'])],
            'pickup_address' => ['nullable', 'string', 'max:255', 'required_if:pickup_delivery,sim'],
        ], [
            'tutor_name.required_with' => 'Informe o nome do tutor.',
            'phone.required_with' => 'Informe o WhatsApp com DDD.',
            'pet_name.required' => 'Informe o nome do pet.',
            'pet_name.max' => 'O nome do pet deve ter no máximo 100 caracteres.',
            'pet_type.in' => 'Selecione um tipo de pet válido.',
            'service.required' => 'Selecione o serviço desejado.',
            'service.in' => 'O serviço selecionado não é válido.',
            'pickup_delivery.in' => 'Selecione uma opção válida para busca e entrega.',
            'pickup_address.required_if' => 'Informe o endereço para a busca e devolução do pet.',
            'pickup_address.max' => 'O endereço deve ter no máximo 255 caracteres.',
        ]);

        if ($dados['pickup_delivery'] === 'sim' && $dados['service'] !== 'Banho e Tosa') {
            return back()
                ->withErrors(['pickup_delivery' => 'A busca e entrega está disponível somente para Banho e Tosa.'])
                ->withInput();
        }

        if (!empty($dados['phone'])) {
            $digitos = preg_replace('/\D+/', '', $dados['phone']);

            if (!in_array(strlen($digitos), [10, 11], true)) {
                return back()
                    ->withErrors(['phone' => 'Informe um WhatsApp válido com DDD.'])
                    ->withInput();
            }

            $dados['phone'] = $digitos;
        }

        $dados['pickup_delivery'] = $dados['pickup_delivery'] === 'sim';
        if (!$dados['pickup_delivery']) {
            $dados['pickup_address'] = null;
        }

        $dados['status'] = 'pendente';

        SolicitacaoAgendamento::create($dados);

        return back()->with(
            'success',
            'Solicitação registrada com sucesso! O agendamento ainda depende da confirmação da equipe.'
        );
    }
}