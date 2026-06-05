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
            <p class="text-sm text-gray-500 mt-0.5">Veja todos os links gerados para um bairro específico.</p>
        </div>
        <form method="GET" action="{{ route('admin.url-patterns.index') }}" class="flex gap-2">
            <input type="text" name="preview"
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
            @foreach(\App\Models\UrlPattern::active()->orderBy('order')->get() as $p)
                <a href="{{ url($p->buildUrl($previewNeighborhood->slug)) }}" target="_blank" rel="noopener"
                   class="flex items-center gap-2 text-xs px-3 py-2 rounded-lg border border-gray-100 hover:border-blue-300 hover:bg-blue-50 transition group">
                    <span class="w-2 h-2 rounded-full flex-shrink-0 bg-green-400"></span>
                    <span class="text-gray-500 flex-shrink-0 w-44 truncate font-medium">{{ $p->label }}</span>
                    <span class="text-blue-600 font-mono truncate group-hover:underline">
                        /{{ $p->buildSlug($previewNeighborhood->slug) }}
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
{{-- FORMULÁRIO: CRIAR / EDITAR PADRÃO --}}
{{-- ============================================================ --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8" id="form-wrap">

    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold text-gray-800" id="form-heading">Adicionar Novo Padrão de Link</h2>
        <button type="button" id="btn-cancel" onclick="cancelEdit()"
                class="hidden text-sm text-gray-500 hover:text-gray-700 px-3 py-1.5 rounded-lg border border-gray-200 hover:border-gray-300 transition">
            ✕ Cancelar edição
        </button>
    </div>

    <form method="POST" id="link-form" action="{{ route('admin.url-patterns.store') }}">
        @csrf
        <input type="hidden" name="_method" id="form-method" value="POST">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">

            {{-- Template da URL --}}
            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-gray-600 mb-1">
                    Template da URL <span class="text-red-400">*</span>
                </label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-mono select-none">/</span>
                    <input type="text" name="url_template" id="field-template" required
                           oninput="updateLinkPreview()"
                           placeholder="ex: frete-mudanca-transporte-{bairro}-rio-de-janeiro-rj"
                           class="w-full border border-gray-200 rounded-lg pl-6 pr-3 py-2 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>
                <p class="text-xs text-gray-400 mt-1">
                    Use <code class="bg-gray-100 px-1 rounded font-mono">{bairro}</code> onde o nome do bairro deve aparecer
                </p>
            </div>

            {{-- Rótulo (H1) --}}
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">
                    Rótulo (H1) <span class="text-red-400">*</span>
                </label>
                <input type="text" name="label" id="field-label" required
                       placeholder="ex: Frete Mudança Transporte"
                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                <p class="text-xs text-gray-400 mt-1">Aparece no H1 da página</p>
            </div>

            {{-- Ordem + Ativo + Botão --}}
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-2">
                    <div class="flex-1">
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Ordem</label>
                        <input type="number" name="order" id="field-order"
                               value="{{ \App\Models\UrlPattern::max('order') + 1 }}" min="0"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                    </div>
                    <div class="flex flex-col justify-end pb-0.5">
                        <label class="block text-xs font-semibold text-gray-600 mb-2">Ativo</label>
                        <input type="checkbox" name="is_active" id="field-active" value="1" checked
                               class="w-4 h-4 rounded text-blue-600">
                    </div>
                </div>
                <button type="submit"
                        class="w-full px-4 py-2 text-sm font-semibold text-white rounded-lg whitespace-nowrap transition hover:opacity-90"
                        style="background:#0170B9;">
                    <span id="btn-label">+ Adicionar</span>
                </button>
            </div>
        </div>

        {{-- Preview inline --}}
        <div id="link-preview-wrap" class="hidden mt-4 p-3 bg-blue-50 border border-blue-100 rounded-lg">
            <p class="text-xs text-blue-600 font-semibold mb-1">Preview para <em>copacabana</em>:</p>
            <code id="link-preview-url" class="text-sm text-blue-800 font-mono"></code>
        </div>

        <div class="mt-4 p-3 bg-gray-50 border border-gray-100 rounded-lg text-xs text-gray-500">
            💡 <strong>Exemplos válidos:</strong>
            <span class="font-mono ml-1">frete-mudanca-{bairro}</span> ·
            <span class="font-mono">frete-barato-{bairro}-rio-de-janeiro-rj</span> ·
            <span class="font-mono">calcular-frete-{bairro}-rj</span>
        </div>
    </form>
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
                <th class="text-left px-4 py-3">Padrão de URL</th>
                <th class="text-left px-4 py-3">Rótulo (H1)</th>
                <th class="text-left px-4 py-3">URL exemplo ({{ $previewNeighborhood?->name ?? 'bairro' }})</th>
                <th class="text-left px-4 py-3">Padrão de SEO</th>
                <th class="text-center px-4 py-3">Status</th>
                <th class="text-right px-4 py-3">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($patterns as $pattern)
            <tr class="{{ $pattern->is_active ? '' : 'opacity-50' }}">
                <td class="px-4 py-3 text-gray-400 text-xs">{{ $pattern->order }}</td>

                <td class="px-4 py-3">
                    <code class="text-xs bg-blue-50 text-blue-700 px-2 py-1 rounded font-mono">
                        /{{ $pattern->toTemplate() }}
                    </code>
                </td>

                <td class="px-4 py-3 font-medium text-gray-700">{{ $pattern->label }}</td>

                <td class="px-4 py-3">
                    @if($previewNeighborhood)
                        <code class="text-xs text-blue-600 font-mono">/{{ $pattern->buildSlug($previewNeighborhood->slug) }}</code>
                    @else
                        <span class="text-xs text-gray-400 font-mono">/{{ $pattern->toTemplate() }}</span>
                    @endif
                </td>

                <td class="px-4 py-3">
                    <form method="POST" action="{{ route('admin.url-patterns.assign-seo', $pattern) }}"
                          class="flex items-center gap-1.5">
                        @csrf @method('PATCH')
                        <select name="seo_pattern_id"
                                onchange="this.form.submit()"
                                class="border border-gray-200 rounded-md px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-blue-300 bg-white max-w-[160px]">
                            <option value="">— sem padrão —</option>
                            @foreach($seoPatterns as $sp)
                                <option value="{{ $sp->id }}"
                                    {{ $pattern->seo_pattern_id == $sp->id ? 'selected' : '' }}>
                                    {{ $sp->rotulo }}
                                </option>
                            @endforeach
                        </select>
                    </form>
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

                <td class="px-4 py-3 text-right space-x-3 whitespace-nowrap">
                    <button type="button"
                            onclick="loadEdit({{ $pattern->id }}, {{ json_encode($pattern->toTemplate()) }}, {{ json_encode($pattern->label) }}, {{ $pattern->order }}, {{ $pattern->is_active ? 'true' : 'false' }})"
                            class="text-xs text-blue-500 hover:text-blue-700 hover:underline">
                        Editar
                    </button>
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

<script>
const BASE_LINKS_URL = '{{ url("/admin/links") }}';
@php $nextOrder = \App\Models\UrlPattern::max('order') + 1; @endphp
const NEXT_ORDER = {{ $nextOrder }};

function slugify(s) {
    return s.toLowerCase()
        .normalize('NFD').replace(/[̀-ͯ]/g, '')
        .replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
}

function updateLinkPreview() {
    var tpl = document.getElementById('field-template').value.trim().replace(/^\//, '');
    var wrap = document.getElementById('link-preview-wrap');
    var urlEl = document.getElementById('link-preview-url');

    if (!tpl) { wrap.classList.add('hidden'); return; }

    var preview = '/' + tpl.split('{bairro}').join('copacabana');
    urlEl.textContent = preview;
    wrap.classList.remove('hidden');
}

function loadEdit(id, template, label, order, active) {
    var form = document.getElementById('link-form');
    form.action = BASE_LINKS_URL + '/' + id;
    document.getElementById('form-method').value = 'PUT';
    document.getElementById('form-heading').textContent = 'Editando padrão';
    document.getElementById('btn-label').textContent    = '✔ Salvar';
    document.getElementById('btn-cancel').classList.remove('hidden');

    document.getElementById('field-template').value = template;
    document.getElementById('field-label').value    = label;
    document.getElementById('field-order').value    = order;
    document.getElementById('field-active').checked = active;

    document.getElementById('form-wrap').scrollIntoView({ behavior: 'smooth', block: 'start' });
    updateLinkPreview();
}

function cancelEdit() {
    var form = document.getElementById('link-form');
    form.action = '{{ route("admin.url-patterns.store") }}';
    document.getElementById('form-method').value = 'POST';
    document.getElementById('form-heading').textContent = 'Adicionar Novo Padrão de Link';
    document.getElementById('btn-label').textContent    = '+ Adicionar';
    document.getElementById('btn-cancel').classList.add('hidden');
    form.reset();
    document.getElementById('field-active').checked = true;
    document.getElementById('field-order').value    = NEXT_ORDER;
    document.getElementById('link-preview-wrap').classList.add('hidden');
}
</script>

@endsection
