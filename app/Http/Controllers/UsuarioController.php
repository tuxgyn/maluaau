<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Registra o cadastro do usuário (tutor) e do pet.
     *
     * Importante: o cadastro não confirma nenhum agendamento.
     */
    public function store(Request $request): RedirectResponse
    {
        $dados = $request->validate([
            'nome'      => ['required', 'string', 'max:100'],
            'sobrenome' => ['required', 'string', 'max:100'],
            'email'     => [
                'required',
                'email',
                'max:255',
                'unique:usuarios,email',
            ],
            'telefone'  => ['required', 'string', 'max:20'],
            'cep'       => [
                'required',
                'string',
                'regex:/^\d{5}-?\d{3}$/',
            ],
            'endereco'  => ['required', 'string', 'max:255'],
            'numero'    => ['required', 'string', 'max:20'],
            'cidade'    => ['required', 'string', 'max:100'],
            'estado'    => [
                'required',
                'string',
                'size:2',
                'in:AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO',
            ],
            'bairro'    => ['required', 'string', 'max:100'],
            'pet_nome'  => ['required', 'string', 'max:100'],
            'pet_raca'  => ['required', 'string', 'max:100'],
        ], [
            'nome.required'      => 'Informe o seu nome.',
            'nome.max'           => 'O nome deve ter no máximo 100 caracteres.',

            'sobrenome.required' => 'Informe o seu sobrenome.',
            'sobrenome.max'      => 'O sobrenome deve ter no máximo 100 caracteres.',

            'email.required'     => 'Informe o e-mail.',
            'email.email'        => 'Informe um e-mail válido.',
            'email.unique'       => 'Este e-mail já está cadastrado.',

            'telefone.required'  => 'Informe o WhatsApp com DDD.',
            'telefone.max'       => 'O telefone deve ter no máximo 20 caracteres.',

            'cep.required'       => 'Informe o CEP.',
            'cep.regex'          => 'Informe um CEP válido com 8 dígitos.',

            'endereco.required'  => 'Informe o endereço.',
            'endereco.max'       => 'O endereço deve ter no máximo 255 caracteres.',

            'numero.required'    => 'Informe o número do endereço.',
            'numero.max'         => 'O número deve ter no máximo 20 caracteres.',

            'cidade.required'    => 'Informe a cidade.',
            'cidade.max'         => 'A cidade deve ter no máximo 100 caracteres.',

            'estado.required'    => 'Selecione o estado.',
            'estado.size'        => 'Selecione uma UF válida.',
            'estado.in'          => 'Selecione uma UF válida.',

            'bairro.required'    => 'Informe o bairro.',
            'bairro.max'         => 'O bairro deve ter no máximo 100 caracteres.',

            'pet_nome.required'  => 'Informe o nome do pet.',
            'pet_nome.max'       => 'O nome do pet deve ter no máximo 100 caracteres.',

            'pet_raca.required'  => 'Informe a raça do pet.',
            'pet_raca.max'       => 'A raça do pet deve ter no máximo 100 caracteres.',
        ]);

        // Normaliza o telefone para guardar somente dígitos.
        $digitos = preg_replace('/\D+/', '', $dados['telefone']);

        if (!in_array(strlen($digitos), [10, 11], true)) {
            return back()
                ->withErrors([
                    'telefone' => 'Informe um WhatsApp válido com DDD.',
                ])
                ->withInput();
        }

        $dados['telefone'] = $digitos;

        // Normaliza o CEP para guardar somente os 8 dígitos.
        $dados['cep'] = preg_replace('/\D+/', '', $dados['cep']);

        // Grava os dados validados no banco.
        Usuario::create($dados);

        return back()->with(
            'success',
            'Cadastro recebido com sucesso! Nossa equipe entrará em contato em breve.'
        );
    }
}