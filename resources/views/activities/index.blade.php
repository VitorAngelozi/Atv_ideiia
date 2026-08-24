@extends('layouts.app')

@section('title', 'Atividades')

@section('content')
    <section class="page-heading">
        <div>
            <p class="eyebrow">Gerenciamento</p>
            <h1>Minhas atividades</h1>
            <p class="muted">Cadastre e acompanhe todas as suas tarefas acadêmicas.</p>
        </div>
        <a class="button" href="{{ route('activities.create') }}">+ Nova atividade</a>
    </section>

    <section class="filter-panel" aria-labelledby="filter-title">
        <h2 id="filter-title">Filtrar atividades</h2>
        <form method="GET" action="{{ route('activities.index') }}" class="filter-form">
            <div class="field">
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="">Todos os status</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" @selected($selectedStatus === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label for="discipline">Disciplina</label>
                <select id="discipline" name="discipline">
                    <option value="">Todas as disciplinas</option>
                    @foreach ($disciplines as $discipline)
                        <option value="{{ $discipline }}" @selected($selectedDiscipline === $discipline)>{{ $discipline }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-actions">
                <button class="button" type="submit">Aplicar filtros</button>
                <a class="button button-secondary" href="{{ route('activities.index') }}">Limpar</a>
            </div>
        </form>
    </section>

    <section class="content-section" aria-labelledby="list-title">
        <div class="section-heading"><h2 id="list-title">Lista de atividades</h2><span class="muted">{{ $activities->total() }} registro(s)</span></div>
        @if ($activities->isEmpty())
            <div class="empty-state">Nenhuma atividade encontrada com os filtros selecionados.</div>
        @else
            <div class="table-wrapper">
                <table>
                    <caption class="sr-only">Atividades acadêmicas cadastradas</caption>
                    <thead><tr><th>Atividade</th><th>Disciplina</th><th>Entrega</th><th>Prioridade</th><th>Status</th><th><span class="sr-only">Ações</span></th></tr></thead>
                    <tbody>
                    @foreach ($activities as $activity)
                        <tr>
                            <td><strong>{{ $activity->title }}</strong><small>{{ Str::limit($activity->description, 60) }}</small></td>
                            <td>{{ $activity->discipline }}</td>
                            <td>{{ $activity->due_date->format('d/m/Y') }}</td>
                            <td><span class="badge badge-{{ $activity->priority }}">{{ ucfirst($activity->priority) }}</span></td>
                            <td>
                                <form method="POST" action="{{ route('activities.status', $activity) }}" class="status-form">
                                    @csrf @method('PATCH')
                                    <label class="sr-only" for="status-{{ $activity->id }}">Alterar status de {{ $activity->title }}</label>
                                    <select id="status-{{ $activity->id }}" name="status" onchange="this.form.submit()">
                                        @foreach ($statuses as $status)<option value="{{ $status }}" @selected($activity->status === $status)>{{ ucfirst($status) }}</option>@endforeach
                                    </select>
                                </form>
                            </td>
                            <td><div class="actions"><a class="text-link" href="{{ route('activities.edit', $activity) }}">Editar</a><form method="POST" action="{{ route('activities.destroy', $activity) }}" onsubmit="return confirm('Excluir esta atividade?')">@csrf @method('DELETE')<button class="link-danger" type="submit">Excluir</button></form></div></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination">{{ $activities->links() }}</div>
        @endif
    </section>
@endsection
