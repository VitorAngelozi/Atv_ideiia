@extends('layouts.app')

@section('title', 'Nova atividade')

@section('content')
    <section class="page-heading"><div><p class="eyebrow">Cadastro</p><h1>Nova atividade</h1><p class="muted">Preencha os dados da atividade acadêmica.</p></div></section>
    <section class="form-card" aria-labelledby="form-title"><h2 id="form-title" class="sr-only">Dados da atividade</h2><form method="POST" action="{{ route('activities.store') }}">@csrf @include('activities._form')<div class="form-actions"><a class="button button-secondary" href="{{ route('activities.index') }}">Cancelar</a><button class="button" type="submit">Salvar atividade</button></div></form></section>
@endsection
