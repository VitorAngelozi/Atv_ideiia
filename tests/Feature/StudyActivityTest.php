<?php

namespace Tests\Feature;

use App\Models\StudyActivity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudyActivityTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_displays_activity_summary(): void
    {
        StudyActivity::create([
            'title' => 'Revisar álgebra',
            'description' => 'Resolver exercícios da lista.',
            'discipline' => 'Matemática',
            'due_date' => '2026-09-10',
            'priority' => 'alta',
            'status' => 'pendente',
        ]);

        $this->get('/')->assertOk()
            ->assertSee('Revisar álgebra')
            ->assertSee('Atividades pendentes');
    }

    public function test_activity_listing_can_be_filtered_by_status_and_discipline(): void
    {
        StudyActivity::create([
            'title' => 'Estudar banco de dados',
            'description' => 'Revisar normalização.',
            'discipline' => 'Banco de Dados',
            'due_date' => '2026-09-12',
            'priority' => 'média',
            'status' => 'em andamento',
        ]);
        StudyActivity::create([
            'title' => 'Ler artigo de redes',
            'description' => 'Fazer anotações.',
            'discipline' => 'Redes',
            'due_date' => '2026-09-13',
            'priority' => 'baixa',
            'status' => 'pendente',
        ]);

        $this->get('/atividades?status=em+andamento&discipline=Banco+de+Dados')
            ->assertOk()
            ->assertSee('Estudar banco de dados')
            ->assertDontSee('Ler artigo de redes');
    }

    public function test_activity_can_be_created_with_valid_data(): void
    {
        $response = $this->post('/atividades', [
            'title' => 'Preparar seminário',
            'description' => 'Montar os slides da apresentação.',
            'discipline' => 'Projeto Integrador II',
            'due_date' => '2026-10-01',
            'priority' => 'alta',
            'status' => 'pendente',
        ]);

        $response->assertRedirect('/atividades')
            ->assertSessionHas('success');

        $this->assertDatabaseHas('study_activities', [
            'title' => 'Preparar seminário',
            'status' => 'pendente',
        ]);
    }

    public function test_activity_creation_requires_valid_fields(): void
    {
        $response = $this->from('/atividades/criar')->post('/atividades', [
            'title' => '',
            'description' => '',
            'discipline' => '',
            'due_date' => 'not-a-date',
            'priority' => 'urgente',
            'status' => 'aberta',
        ]);

        $response->assertRedirect('/atividades/criar')
            ->assertSessionHasErrors(['title', 'description', 'discipline', 'due_date', 'priority', 'status']);
    }

    public function test_activity_can_be_updated(): void
    {
        $activity = StudyActivity::create([
            'title' => 'Título antigo',
            'description' => 'Descrição antiga.',
            'discipline' => 'História',
            'due_date' => '2026-09-20',
            'priority' => 'baixa',
            'status' => 'pendente',
        ]);

        $this->put("/atividades/{$activity->id}", [
            'title' => 'Título atualizado',
            'description' => 'Descrição atualizada.',
            'discipline' => 'História',
            'due_date' => '2026-09-21',
            'priority' => 'média',
            'status' => 'em andamento',
        ])->assertRedirect('/atividades')
            ->assertSessionHas('success');

        $this->assertDatabaseHas('study_activities', [
            'id' => $activity->id,
            'title' => 'Título atualizado',
            'status' => 'em andamento',
        ]);
    }

    public function test_activity_status_can_be_changed(): void
    {
        $activity = StudyActivity::create([
            'title' => 'Atividade de teste',
            'description' => 'Descrição.',
            'discipline' => 'Filosofia',
            'due_date' => '2026-09-22',
            'priority' => 'média',
            'status' => 'pendente',
        ]);

        $this->patch("/atividades/{$activity->id}/status", [
            'status' => 'concluída',
        ])->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('study_activities', [
            'id' => $activity->id,
            'status' => 'concluída',
        ]);
    }

    public function test_activity_can_be_deleted(): void
    {
        $activity = StudyActivity::create([
            'title' => 'Atividade removível',
            'description' => 'Descrição.',
            'discipline' => 'Química',
            'due_date' => '2026-09-23',
            'priority' => 'baixa',
            'status' => 'concluída',
        ]);

        $this->delete("/atividades/{$activity->id}")
            ->assertRedirect('/atividades')
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('study_activities', ['id' => $activity->id]);
    }
}
