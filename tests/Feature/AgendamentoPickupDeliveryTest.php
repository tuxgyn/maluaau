<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AgendamentoPickupDeliveryTest extends TestCase
{
    use RefreshDatabase;

    public function test_banho_e_tosa_solicitacao_pode_incluir_busca_e_entrega(): void
    {
        $response = $this->post(route('agendamentos.store'), [
            'tutor_name' => 'Maria Oliveira',
            'phone' => '(62) 99999-9999',
            'pet_name' => 'Paçoca',
            'pet_type' => 'cachorro',
            'service' => 'banho_tosa',
            'pickup_delivery' => 'sim',
            'pickup_address' => 'Rua das Flores, 123, Centro, Goiânia',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('agendamentos', [
            'tutor_name' => 'Maria Oliveira',
            'phone' => '62999999999',
            'service' => 'Banho e Tosa',
            'pickup_delivery' => true,
            'pickup_address' => 'Rua das Flores, 123, Centro, Goiânia',
        ]);
    }

    public function test_busca_e_entrega_exige_endereco(): void
    {
        $response = $this->from('/')->post(route('agendamentos.store'), [
            'tutor_name' => 'Maria Oliveira',
            'phone' => '62999999999',
            'pet_name' => 'Paçoca',
            'pet_type' => 'cachorro',
            'service' => 'banho_tosa',
            'pickup_delivery' => 'sim',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('pickup_address');
        $this->assertDatabaseCount('agendamentos', 0);
    }

    public function test_busca_e_entrega_so_pode_ser_solicitada_para_banho_e_tosa(): void
    {
        $response = $this->from('/')->post(route('agendamentos.store'), [
            'tutor_name' => 'Maria Oliveira',
            'phone' => '62999999999',
            'pet_name' => 'Paçoca',
            'pet_type' => 'cachorro',
            'service' => 'consulta',
            'pickup_delivery' => 'sim',
            'pickup_address' => 'Rua das Flores, 123, Centro, Goiânia',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('pickup_delivery');
        $this->assertDatabaseCount('agendamentos', 0);
    }

    public function test_servicos_sem_busca_e_entrega_mantem_os_dados_de_transporte_vazios(): void
    {
        $response = $this->post(route('agendamentos.store'), [
            'tutor_name' => 'Maria Oliveira',
            'phone' => '62999999999',
            'pet_name' => 'Paçoca',
            'pet_type' => 'cachorro',
            'service' => 'banho_tosa',
            'pickup_delivery' => 'nao',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('agendamentos', [
            'service' => 'Banho e Tosa',
            'pickup_delivery' => false,
            'pickup_address' => null,
        ]);
    }
}
