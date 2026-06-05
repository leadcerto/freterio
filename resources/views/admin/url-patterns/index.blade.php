@extends('layouts.admin')
@section('title', 'Padrões de Link SEO')

@section('content')

{{-- ============================================================ --}}
{{-- PRÉVIA DOS LINKS GERADOS --}}
{{-- ============================================================ --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">

    <div class="flex flex-wrap items-center justify-between gap-4 mb-5">
        <div>
            <h2 class="font-bold text-gray-800 text-lg">Preview de Links Gerados</h2>
            <p class="text-sm text-gray-500 mt-0.5">Veja todos os links que serão criados para um bairro específico.</p>
        </div>

        {{-- Seletor de bairro para preview --}}
        <form method="GET" action="{{ route('admin.url-patterns.index') }}" class="flex gap-2">
            <input type="text"
                   name="preview"
                   value="{{ $previewNeighborhood?->slug ?? 'copacabana' }}"
                   placeholder="slug do bairro (ex: copacabana)"
                   class="border border-gray-200 rounded-lg px-3 py-2 text-sm w-52 focus:outline-none focus:ring-2 focus:ring-blue-300">
            <button type="submit" class="px-4 py-2 text-sm font-semibold text-white rounded-lg" style="background:#0170B9;">
                Visualizar
            </button>
        </form>
    </div>

    @if($previewNeighborhood)
        <p class="text-xs text-gray-400 mb-3 font-mono">
            Bairro: <strong class="text-gray-700">{{ $previewNeighborhood->name }}</strong>
            — slug: <strong class="text-gray-700">{{ $previewNeighborhood->slug }}</strong>
            — {{ \App\Models\UrlPattern::active()->count() }} links ativos
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 max-h-96 overflow-y-auto pr-1">
            @foreach(\App\Models\UrlPattern::active()->orderBy('order')->get() as $pattern)
                @php
                    $url = url($pattern->buildUrl($previewNeighborhood->slug));
                @endphp
                <a href="{{ $url }}" target="_blank" rel="noopener"
                   class="flex items-center gap-2 text-xs px-3 py-2 rounded-lg border border-gray-100 hover:border-blue-300 hover:bg-blue-50 transition group">
                    <span class="w-2 h-2 rounded-full flex-shrink-0 {{ $pattern->is_active ? 'bg-green-400' : 'bg-gray-300' }}"></span>
                    <span class="text-gray-500 flex-shrink-0 w-44 truncate font-medium">{{ $pattern->label }}</span>
                    <span class="text-blue-600 font-mono truncate group-hover:underline">
                        /{{ $pattern->buildSlug($previewNeighborhood->slug) }}
                    </span>
                </a>
            @endforeach
        </div>

        <p class="mt-4 text-xs text-gray-400">
            Total de links gerados por bairro: <strong class="text-gray-600">{{ \App\Models\UrlPattern::active()->count() }}</strong>
            &times;
            {{ \App\Models\Neighborhood::active()->count() }} bairros ativos
            =
            <strong class="text-blue-600">{{ \App\Models\UrlPattern::active()->count() * \App\Models\Neighborhood::active()->count() }} URLs indexáveis</strong>
        </p>
    @else
        <p class="text-sm text-gray-400 py-4 text-center">Nenhum bairro encontrado com esse slug.</p>
    @endif
</div>

{{-- ============================================================ --}}
{{-- FORMULÁRIO: NOVO PADRÃO --}}
{{-- ============================================================ --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
    <h2 class="font-bold text-gray-800 mb-4">Adicionar Novo Padrão de Link</h2>

    <form method="POST" action="{{ route('admin.url-patterns.store') }}" class="grid grid-cols-1 md:grid-cols-5 gap-3 items-end">
        @csrf

        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1">Prefixo <span class="text-gray-400 font-normal">(antes do bairro)</span></label>
            <input type="text" name="prefix" placeholder="ex: frete-barato"
                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
            <p class="text-xs text-gray-400 mt-1">Deixe vazio para <code class="bg-gray-100 px-1 rounded">/{bairro}</code></p>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1">Sufixo <span class="text-gray-400 font-normal">(após o bairro)</span></label>
            <input type="text" name="suffix" placeholder="ex: rio-de-janeiro-rj"
                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
            <p class="text-xs text-gray-400 mt-1">Deixe vazio para sem sufixo</p>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1">Rótulo <span class="text-red-400">*</span></label>
            <input type="text" name="label" placeholder="ex: Frete Barato" required
                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
            <p class="text-xs text-gray-400 mt-1">Aparece no H1 da página</p>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1">Ordem</label>
            <input type="number" name="order" value="{{ \App\Models\UrlPattern::max('order') + 1 }}" min="0"
                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
        </div>

        <div class="flex items-center gap-3">
            <label class="flex items-center gap-1.5 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 rounded text-blue-600">
                <span class="text-sm text-gray-700">Ativo</span>
            </label>
            <button type="submit" class="px-5 py-2 text-sm font-semibold text-white rounded-lg whitespace-nowrap" style="background:#0170B9;">
                + Adicionar
            </button>
        </div>
    </form>

    <div class="mt-4 p-3 bg-blue-50 border border-blue-100 rounded-lg text-xs text-blue-700">
        💡 <strong>Como funciona:</strong>
        URL gerada = <code class="bg-white px-1 rounded border">/{prefixo}-{slug-do-bairro}-{sufixo}</code>
        &nbsp;·&nbsp;
        Ex: prefixo <code class="bg-white px-1 rounded border">frete-barato</code> + bairro <code class="bg-white px-1 rounded border">copacabana</code> + sufixo <code class="bg-white px-1 rounded border">rio-de-janeiro-rj</code>
        = <code class="bg-white px-1 rounded border">/frete-barato-copacabana-rio-de-janeiro-rj</code>
    </div>
</div>

{{-- ============================================================ --}}
{{-- TABELA DE PADRÕES EXISTENTES --}}
{{-- ============================================================ --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="font-bold text-gray-800">Padrões Cadastrados <span class="text-sm font-normal text-gray-400">({{ $patterns->count() }} total)</span></h2>
        <div class="flex gap-3 text-xs text-gray-500">
            <span class="flex items-center gap-1"><span class="w-2 h-2 bg-green-400 rounded-full"></span>Ativo</span>
            <span class="flex items-center gap-1"><span class="w-2 h-2 bg-gray-300 rounded-full"></span>Inativo</span>
        </div>
    </div>

    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100 text-xs text-gray-500 uppercase tracking-wide">
            <tr>
                <th class="text-left px-4 py-3 w-6">#</th>
                <th class="text-left px-4 py-3">Prefixo</th>
                <th class="text-left px-4 py-3">Sufixo</th>
                <th class="text-left px-4 py-3">Rótulo (H1)</th>
                <th class="text-left px-4 py-3">URL gerada (exemplo)</th>
                <th class="text-center px-4 py-3">Status</th>
                <th class="text-right px-4 py-3">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($patterns as $pattern)
            <tr class="{{ $pattern->is_active ? '' : 'opacity-50' }}" id="pattern-{{ $pattern->id }}">
                <td class="px-4 py-3 text-gray-400 text-xs">{{ $pattern->order }}</td>

                <td class="px-4 py-3">
                    @if($pattern->prefix)
                        <code class="text-xs bg-blue-50 text-blue-700 px-2 py-0.5 rounded">{{ $pattern->prefix }}</code>
                    @else
                        <span class="text-xs text-gray-400 italic">(sem prefixo)</span>
                    @endif
                </td>

                <td class="px-4 py-3">
                    @if($pattern->suffix)
                        <code class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded">{{ $pattern->suffix }}</code>
                    @else
                        <span class="text-xs text-gray-400 italic">(sem sufixo)</span>
                    @endif
                </td>

                <td class="px-4 py-3 font-medium text-gray-700">{{ $pattern->label }}</td>

                <td class="px-4 py-3">
                    @if($previewNeighborhood)
                        <code class="text-xs text-blue-600 font-mono">/{{ $pattern->buildSlug($previewNeighborhood->slug) }}</code>
                    @else
                        <code class="text-xs text-gray-400 font-mono">
                            {{ $pattern->prefix ? '/' . $pattern->prefix . '-' : '/' }}{bairro}{{ $pattern->suffix ? '-' . $pattern->suffix : '' }}
                        </code>
                    @endif
                </td>

                <td class="px-4 py-3 text-center">
                    <form method="POST" action="{{ route('admin.url-patterns.toggle', $pattern) }}" class="inline">
                        @csrf @method('PATCH')
                        <button type="submit"
                                class="text-xs px-2 py-1 rounded-full {{ $pattern->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }} transition">
                            {{ $pattern->is_active ? 'Ativo' : 'Inativo' }}
                        </button>
                    </form>
                </td>

                <td class="px-4 py-3 text-right">
                    <form method="POST" action="{{ route('admin.url-patterns.destroy', $pattern) }}"
                          class="inline" onsubmit="return confirm('Remover este padrão? Os links existentes pararão de funcionar.')">
                        @csrf @method('DELETE')
                        <button class="text-xs text-red-400 hover:text-red-600 hover:underline">Remover</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
