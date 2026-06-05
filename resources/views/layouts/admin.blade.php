<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Painel') — Frete Rio Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-100 text-gray-800 antialiased">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 flex-shrink-0 text-white flex flex-col" style="background:#0170B9;">
        <div class="px-6 py-5 border-b border-blue-700">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-extrabold text-white">Frete Rio</a>
            <p class="text-xs text-blue-200 mt-1">Painel Administrativo</p>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-1 text-sm">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700 font-semibold' : '' }}">
                📊 Dashboard
            </a>
            <a href="{{ route('admin.neighborhoods.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('admin.neighborhoods.*') ? 'bg-blue-700 font-semibold' : '' }}">
                🏘️ Bairros
            </a>
            <a href="{{ route('admin.faqs.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('admin.faqs.*') ? 'bg-blue-700 font-semibold' : '' }}">
                ❓ FAQs
            </a>
            <a href="{{ route('admin.images.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('admin.images.*') ? 'bg-blue-700 font-semibold' : '' }}">
                🖼️ Imagens
            </a>
            <a href="{{ route('admin.url-patterns.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('admin.url-patterns.*') ? 'bg-blue-700 font-semibold' : '' }}">
                🔗 Padrões de Link
            </a>
        </nav>
        <div class="px-4 py-4 border-t border-blue-700">
            <p class="text-xs text-blue-200 mb-1">{{ auth()->user()->name }}</p>
            <p class="text-xs text-blue-300 mb-3">{{ auth()->user()->email }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left text-xs text-blue-200 hover:text-white transition px-2 py-1">
                    Sair →
                </button>
            </form>
        </div>
    </aside>

    <!-- CONTEÚDO -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="bg-white shadow-sm px-8 py-4 flex items-center justify-between">
            <h1 class="text-lg font-bold text-gray-800">@yield('title', 'Dashboard')</h1>
            <a href="{{ route('home') }}" target="_blank" class="text-sm text-blue-600 hover:underline">Ver site →</a>
        </header>

        <main class="flex-1 overflow-y-auto p-8">

            @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 text-sm px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 text-sm px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
