@extends('layouts.app')

@section('title', 'Editar atividade')

@section('content')
    <section class="page-heading"><div><p class="eyebrow">Cadastro</p><h1>Editar atividade</h1><p class="muted">Atualize as informações da atividade selecionada.</p></div></section>
    <section class="form-card" aria-labelledby="form-title"><h2 id="form-title" class="sr-only">Dados da atividade</h2><form method="POST" action="{{ route('activities.update', $activity) }}">@csrf @method('PUT') @include('activities._form')<div class="form-actions"><a class="button button-secondary" href="{{ route('activities.index') }}">Cancelar</a><button class="button" type="submit">Salvar alterações</button></div></form></section>
@endsection
