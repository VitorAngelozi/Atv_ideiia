@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <section class="page-heading">
        <div>
            <p class="eyebrow">Visão geral</p>
            <h1>Olá, estudante!</h1>
            <p class="muted">Acompanhe suas atividades e mantenha os estudos em dia.</p>
        </div>
        <a class="button" href="{{ route('activities.create') }}">+ Cadastrar atividade</a>
    </section>

    <section class="summary-grid" aria-label="Resumo das atividades">
        <article class="summary-card summary-blue">
            <span class="summary-label">Total de atividades</span>
            <strong>{{ $totalActivities }}</strong>
            <span class="summary-detail">cadastradas</span>
        </article>
        <article class="summary-card summary-orange">
            <span class="summary-label">Atividades pendentes</span>
            <strong>{{ $pendingActivities }}</strong>
            <span class="summary-detail">aguardando início</span>
        </article>
        <article class="summary-card summary-purple">
            <span class="summary-label">Em andamento</span>
            <strong>{{ $inProgressActivities }}</strong>
            <span class="summary-detail">em desenvolvimento</span>
        </article>
        <article class="summary-card summary-green">
            <span class="summary-label">Concluídas</span>
            <strong>{{ $completedActivities }}</strong>
            <span class="summary-detail">finalizadas</span>
        </article>
    </section>

    <section class="content-section" aria-labelledby="upcoming-title">
        <div class="section-heading">
            <div>
                <p class="eyebrow">Organização</p>
                <h2 id="upcoming-title">Próximas atividades</h2>
            </div>
            <a class="text-link" href="{{ route('activities.index') }}">Ver todas →</a>
        </div>

        @if ($upcomingActivities->isEmpty())
            <div class="empty-state">Você não possui atividades próximas pendentes.</div>
        @else
            <div class="activity-list">
                @foreach ($upcomingActivities as $activity)
                    <article class="activity-card">
                        <div class="activity-card-main">
                            <div class="activity-title-row">
                                <h3>{{ $activity->title }}</h3>
                                <span class="badge badge-{{ $activity->priority }}">{{ ucfirst($activity->priority) }}</span>
                            </div>
                            <p>{{ $activity->discipline }}</p>
                        </div>
                        <div class="activity-card-meta">
                            <span class="due-date">Entrega: {{ $activity->due_date->format('d/m/Y') }}</span>
                            <span class="status status-{{ str_replace(' ', '-', $activity->status) }}">{{ ucfirst($activity->status) }}</span>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>
@endsection
