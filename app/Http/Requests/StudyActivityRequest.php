<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudyActivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'max:2000'],
            'discipline' => ['required', 'string', 'max:100'],
            'due_date' => ['required', 'date'],
            'priority' => ['required', 'in:baixa,média,alta'],
            'status' => ['required', 'in:pendente,em andamento,concluída'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'string' => 'O campo :attribute deve ser um texto.',
            'max' => 'O campo :attribute não pode ultrapassar :max caracteres.',
            'date' => 'Informe uma data válida.',
            'in' => 'Selecione uma opção válida para :attribute.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'título',
            'description' => 'descrição',
            'discipline' => 'disciplina',
            'due_date' => 'data de entrega',
            'priority' => 'prioridade',
            'status' => 'status',
        ];
    }
}
