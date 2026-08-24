<?php

namespace Database\Seeders;

use App\Models\StudyActivity;
use Illuminate\Database\Seeder;

class StudyActivitySeeder extends Seeder
{
    public function run(): void
    {
        StudyActivity::insert([
            [
                'title' => 'Finalizar relatório do Projeto Integrador II',
                'description' => 'Revisar a introdução, metodologia e referências do relatório.',
                'discipline' => 'Projeto Integrador II',
                'due_date' => now()->addDays(7)->toDateString(),
                'priority' => 'alta',
                'status' => 'em andamento',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Estudar consultas SQL',
                'description' => 'Praticar SELECT, JOIN, GROUP BY e subconsultas.',
                'discipline' => 'Banco de Dados',
                'due_date' => now()->addDays(3)->toDateString(),
                'priority' => 'média',
                'status' => 'pendente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Revisar conceitos de redes',
                'description' => 'Ler o material sobre protocolos e modelo TCP/IP.',
                'discipline' => 'Redes de Computadores',
                'due_date' => now()->addDays(10)->toDateString(),
                'priority' => 'baixa',
                'status' => 'pendente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Entregar exercício de lógica',
                'description' => 'Enviar a lista resolvida na plataforma da disciplina.',
                'discipline' => 'Lógica de Programação',
                'due_date' => now()->subDays(2)->toDateString(),
                'priority' => 'alta',
                'status' => 'concluída',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
