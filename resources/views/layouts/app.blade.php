<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Estuda UFMS') | Estuda UFMS</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <header class="site-header">
        <div class="container header-content">
            <a class="brand" href="{{ route('dashboard') }}">
                <span class="brand-mark" aria-hidden="true">EU</span>
                <span><strong>Estuda UFMS</strong><small>Organizador acadêmico</small></span>
            </a>
            <nav class="main-nav" aria-label="Navegação principal">
                <a class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                <a class="{{ request()->routeIs('activities.*') ? 'active' : '' }}" href="{{ route('activities.index') }}">Atividades</a>
                <a class="button button-small" href="{{ route('activities.create') }}">Nova atividade</a>
            </nav>
        </div>
    </header>

    <main class="container page-content">
        @if (session('success'))
            <div class="flash flash-success" role="status">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="flash flash-error" role="alert">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container">Projeto Integrador II · UFMS · Sistema de Gerenciamento de Estudos</div>
    </footer>
</body>
</html>
