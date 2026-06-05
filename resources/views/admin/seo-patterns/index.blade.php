@extends('layouts.admin')
@section('title', 'Padrões de SEO')

@section('content')

{{-- ============================================================ --}}
{{-- FORMULÁRIO DE CRIAÇÃO / EDIÇÃO --}}
{{-- ============================================================ --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8" id="form-container">

    <div class="flex items-center justify-between mb-5">
        <div>
            <h2 class="font-bold text-gray-800 text-lg" id="form-heading">Adicionar Novo Padrão de SEO</h2>
            <p class="text-sm text-gray-500 mt-0.5">Configure title, description e og:image para grupos de páginas.</p>
        </div>
        <button type="button" id="btn-cancel"
                onclick="cancelEdit()"
                class="hidden text-sm text-gray-500 hover:text-gray-700 px-3 py-1.5 rounded-lg border border-gray-200 hover:border-gray-300 transition">
            ✕ Cancelar edição
        </button>
    </div>

    <form method="POST" id="seo-form" action="{{ route('admin.seo-patterns.store') }}" class="space-y-5">
        @csrf
        <input type="hidden" name="_method" id="form-method" value="POST">

        {{-- Linha 1: Rótulo + Ordem + Ativo --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-gray-600 mb-1">
                    Rótulo <span class="text-red-400">*</span>
                    <span class="text-gray-400 font-normal ml-1">— nome interno do padrão</span>
                </label>
                <input type="text" name="rotulo" id="field-rotulo" required maxlength="100"
                       placeholder="ex: Frete Mudança Transporte"
                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Ordem</label>
                <input type="number" name="ordem" id="field-ordem" min="0"
                       value="{{ \App\Models\SeoPattern::max('ordem') + 1 }}"
                       class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>
            <div class="flex flex-col justify-end pb-0.5">
                <label class="block text-xs font-semibold text-gray-600 mb-2">Status</label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="ativo" id="field-ativo" value="1" checked
                           class="w-4 h-4 rounded text-blue-600">
                    <span class="text-sm text-gray-700">Ativo</span>
                </label>
            </div>
        </div>

        {{-- Title --}}
        <div>
            <div class="flex items-center justify-between mb-1">
                <label class="block text-xs font-semibold text-gray-600">
                    Title <span class="text-red-400">*</span>
                </label>
                <span class="text-xs text-gray-400">
                    <span id="title-count" class="font-mono">0</span><span class="text-gray-300">/70</span>
                </span>
            </div>
            <input type="text" name="title" id="field-title" required maxlength="100"
                   placeholder="ex: 🛑🚚 Frete Mudança Transporte {bairro} | Frete Rio"
                   oninput="updatePreview()" onfocus="lastFocused=this"
                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 font-mono">
        </div>

        {{-- Description --}}
        <div>
            <div class="flex items-center justify-between mb-1">
                <label class="block text-xs font-semibold text-gray-600">
                    Description <span class="text-red-400">*</span>
                </label>
                <span class="text-xs text-gray-400">
                    <span id="desc-count" class="font-mono">0</span><span class="text-gray-300">/160</span>
                </span>
            </div>
            <textarea name="description" id="field-description" required maxlength="200" rows="2"
                      placeholder="ex: Precisando de serviço de Frete, Mudança, Transporte {bairro}? Orçamento Gratuito Online!"
                      oninput="updatePreview()" onfocus="lastFocused=this"
                      class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300 font-mono resize-none"></textarea>
        </div>

        {{-- og:image --}}
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1">og:image</label>
            <div class="flex gap-2">
                <input type="url" name="og_image" id="field-og_image"
                       placeholder="https://frete.rio.br/..."
                       oninput="updatePreview()" onfocus="lastFocused=this"
                       class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                <button type="button" onclick="openPicker()"
                        class="px-3 py-2 text-xs font-semibold rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition whitespace-nowrap">
                    📂 Biblioteca
                </button>
            </div>
            <p class="text-xs text-gray-400 mt-1">JPG ou PNG · 1200×630px · máx. 300KB · URL absoluta</p>

            {{-- Thumbnail da imagem selecionada --}}
            <div id="og-thumb-wrap" class="hidden mt-2">
                <img id="og-thumb" src="" alt="" class="h-16 rounded border border-gray-200 object-cover">
                <button type="button" onclick="clearOgImage()" class="ml-2 text-xs text-red-400 hover:text-red-600">✕ remover</button>
            </div>
        </div>

        {{-- ============ MODAL PICKER ============ --}}
        <div id="img-picker-modal"
             class="hidden fixed inset-0 z-50 flex items-center justify-center"
             style="background:rgba(0,0,0,0.5);">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800">Selecionar imagem da biblioteca</h3>
                    <button type="button" onclick="closePicker()" class="text-gray-400 hover:text-gray-600 text-xl leading-none">&times;</button>
                </div>
                <div class="p-4 max-h-96 overflow-y-auto">
                    @if($images->isEmpty())
                        <p class="text-center text-gray-400 text-sm py-8">Nenhuma imagem cadastrada ainda.</p>
                    @else
                        <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                            @foreach($images as $img)
                            <button type="button"
                                    onclick="selectImage('{{ $img['url'] }}')"
                                    class="group relative rounded-xl overflow-hidden border-2 border-transparent hover:border-blue-400 transition focus:outline-none focus:border-blue-500">
                                <img src="{{ $img['url'] }}" alt="{{ $img['type'] }}"
                                     class="w-full aspect-video object-cover">
                                <div class="absolute bottom-0 inset-x-0 bg-black/50 text-white text-xs text-center py-1 opacity-0 group-hover:opacity-100 transition">
                                    {{ $img['type'] }}
                                </div>
                            </button>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="px-6 py-3 border-t border-gray-100 text-right">
                    <button type="button" onclick="closePicker()"
                            class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800 border border-gray-200 rounded-lg hover:border-gray-300 transition">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>

        {{-- Variáveis disponíveis --}}
        <div class="p-3 bg-blue-50 rounded-lg border border-blue-100">
            <p class="text-xs font-semibold text-blue-600 mb-2">
                Variáveis disponíveis
                <span class="font-normal text-blue-400 ml-1">— clique para inserir no campo em foco</span>
            </p>
            <div class="flex flex-wrap gap-2">
                @foreach(['{bairro}' => 'Nome do bairro', '{slug}' => 'Slug do bairro', '{cidade}' => 'Nome da cidade', '{uf}' => 'Sigla do estado'] as $var => $desc)
                <button type="button" onclick="insertVar('{{ $var }}')"
                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-white border border-blue-200 text-blue-700 text-xs font-mono hover:bg-blue-100 transition">
                    {{ $var }}
                    <span class="text-blue-400 font-sans font-normal">{{ $desc }}</span>
                </button>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end pt-1">
            <button type="submit"
                    class="px-6 py-2 text-sm font-semibold text-white rounded-lg transition hover:opacity-90"
                    style="background:#0170B9;">
                <span id="btn-label">+ Adicionar Padrão</span>
            </button>
        </div>
    </form>
</div>

{{-- ============================================================ --}}
{{-- PREVIEW EM TEMPO REAL --}}
{{-- ============================================================ --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">

    <div class="flex flex-wrap items-center justify-between gap-4 mb-5">
        <div>
            <h2 class="font-bold text-gray-800 text-lg">Preview em Tempo Real</h2>
            <p class="text-sm text-gray-500 mt-0.5">Como ficará nos resultados de busca e no WhatsApp.</p>
        </div>
        <div class="flex items-center gap-2">
            <label class="text-xs text-gray-500 font-medium whitespace-nowrap">Bairro de exemplo:</label>
            <input type="text" id="preview-bairro" value="Copacabana"
                   oninput="updatePreview()"
                   class="border border-gray-200 rounded-lg px-3 py-1.5 text-sm w-36 focus:outline-none focus:ring-2 focus:ring-blue-300">
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Google SERP Preview --}}
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Preview Google</p>
            <div class="border border-gray-200 rounded-xl p-4 bg-gray-50 min-h-24">
                <p id="prev-title"
                   style="font-family: arial, sans-serif; color: #1a0dab; font-size: 18px; font-weight: 400; line-height: 1.3; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                    —
                </p>
                <p id="prev-url"
                   style="font-family: arial, sans-serif; color: #006621; font-size: 13px; margin: 2px 0;">
                    https://frete.rio.br/...
                </p>
                <p id="prev-desc"
                   style="font-family: arial, sans-serif; color: #545454; font-size: 13px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; margin: 2px 0 0;">
                    —
                </p>
            </div>
        </div>

        {{-- WhatsApp Preview --}}
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Preview WhatsApp</p>
            <div class="border border-gray-200 rounded-xl overflow-hidden bg-white" style="max-width:360px;">
                <div id="wa-img-wrap" class="hidden bg-gray-200" style="height:180px;">
                    <img id="wa-img-src" src="" alt=""
                         style="width:100%; height:100%; object-fit:cover; display:block;">
                </div>
                <div class="p-3 border-l-4" style="border-color:#25D366;">
                    <p id="wa-title" class="font-semibold text-gray-800 text-sm leading-tight mb-1">—</p>
                    <p id="wa-desc" class="text-gray-500 text-xs leading-snug mb-1">—</p>
                    <p class="text-gray-400 text-xs">frete.rio.br</p>
                </div>
            </div>
            <p id="wa-no-img" class="text-xs text-orange-500 mt-2 flex items-center gap-1 hidden">
                <span>⚠️</span> Sem og:image — WhatsApp não exibirá imagem no preview
            </p>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- TABELA DE PADRÕES CADASTRADOS --}}
{{-- ============================================================ --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="font-bold text-gray-800">
            Padrões de SEO Cadastrados
            <span class="text-sm font-normal text-gray-400">({{ $patterns->count() }} total)</span>
        </h2>
    </div>

    @if($patterns->isEmpty())
        <p class="text-center text-sm text-gray-400 py-12">Nenhum padrão de SEO cadastrado ainda.</p>
    @else
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100 text-xs text-gray-500 uppercase tracking-wide">
                <tr>
                    <th class="text-left px-4 py-3 w-8">#</th>
                    <th class="text-left px-4 py-3">Rótulo</th>
                    <th class="text-left px-4 py-3">Title</th>
                    <th class="text-left px-4 py-3">Description</th>
                    <th class="text-left px-4 py-3">og:image</th>
                    <th class="text-center px-4 py-3">Status</th>
                    <th class="text-right px-4 py-3">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($patterns as $pat)
                <tr class="{{ $pat->ativo ? '' : 'opacity-50' }}">
                    <td class="px-4 py-3 text-gray-400 text-xs">{{ $pat->ordem }}</td>
                    <td class="px-4 py-3 font-medium text-gray-700 max-w-[140px]">
                        <span class="truncate block" title="{{ $pat->rotulo }}">{{ $pat->rotulo }}</span>
                    </td>
                    <td class="px-4 py-3 max-w-[200px]">
                        <span class="font-mono text-xs text-gray-500 truncate block" title="{{ $pat->title }}">{{ $pat->title }}</span>
                    </td>
                    <td class="px-4 py-3 max-w-[200px]">
                        <span class="text-xs text-gray-400 truncate block" title="{{ $pat->description }}">{{ $pat->description }}</span>
                    </td>
                    <td class="px-4 py-3 max-w-[160px]">
                        @if($pat->og_image)
                            <a href="{{ $pat->og_image }}" target="_blank" rel="noopener"
                               class="text-xs text-blue-600 hover:underline truncate block"
                               title="{{ $pat->og_image }}">
                                {{ parse_url($pat->og_image, PHP_URL_PATH) }}
                            </a>
                        @else
                            <span class="text-xs text-gray-300 italic">sem imagem</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center">
                        <form method="POST" action="{{ route('admin.seo-patterns.toggle', $pat) }}" class="inline">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    class="text-xs px-2 py-1 rounded-full transition {{ $pat->ativo ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                {{ $pat->ativo ? 'Ativo' : 'Inativo' }}
                            </button>
                        </form>
                    </td>
                    <td class="px-4 py-3 text-right space-x-3 whitespace-nowrap">
                        <button type="button"
                                onclick="loadEdit({{ $pat->id }}, {{ json_encode($pat->rotulo) }}, {{ json_encode($pat->title) }}, {{ json_encode($pat->description) }}, {{ json_encode($pat->og_image ?? '') }}, {{ $pat->ordem }}, {{ $pat->ativo ? 'true' : 'false' }})"
                                class="text-xs text-blue-500 hover:text-blue-700 hover:underline">
                            Editar
                        </button>
                        <form method="POST" action="{{ route('admin.seo-patterns.destroy', $pat) }}"
                              class="inline" onsubmit="return confirm('Remover este padrão de SEO? Os padrões de link vinculados perderão o SEO configurado.')">
                            @csrf @method('DELETE')
                            <button class="text-xs text-red-400 hover:text-red-600 hover:underline">Remover</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

<script>
let lastFocused = null;
@php $nextOrdem = \App\Models\SeoPattern::max('ordem') + 1; @endphp
const NEXT_ORDEM = {{ $nextOrdem }};
const BASE_URL   = '{{ url("/admin/seo-patterns") }}';

['field-title', 'field-description', 'field-og_image'].forEach(function(id){
    document.getElementById(id).addEventListener('focus', function(){ lastFocused = this; });
});

function slugify(s) {
    return s.toLowerCase()
        .normalize('NFD').replace(/[̀-ͯ]/g, '')
        .replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
}

function applyVars(text, v) {
    for (var k in v) text = text.split('{' + k + '}').join(v[k]);
    return text;
}

function updatePreview() {
    var bairro = document.getElementById('preview-bairro').value.trim() || 'Copacabana';
    var slug   = slugify(bairro);
    var vars   = { bairro: bairro, slug: slug, cidade: 'Rio de Janeiro', uf: 'RJ' };

    var rawTitle = document.getElementById('field-title').value;
    var rawDesc  = document.getElementById('field-description').value;
    var rawImg   = document.getElementById('field-og_image').value.trim();

    var title = applyVars(rawTitle, vars);
    var desc  = applyVars(rawDesc,  vars);

    // Contadores
    var tc = document.getElementById('title-count');
    var dc = document.getElementById('desc-count');
    tc.textContent = rawTitle.length;
    dc.textContent = rawDesc.length;
    tc.style.color = rawTitle.length > 70  ? '#ef4444' : '#9ca3af';
    dc.style.color = rawDesc.length  > 160 ? '#ef4444' : '#9ca3af';

    // Google preview
    document.getElementById('prev-title').textContent = title || '—';
    document.getElementById('prev-url').textContent   = 'https://frete.rio.br/frete-mudanca-' + (slug || '...');
    document.getElementById('prev-desc').textContent  = desc  || '—';

    // WhatsApp preview
    document.getElementById('wa-title').textContent = title || '—';
    var shortDesc = desc ? (desc.length > 90 ? desc.substring(0, 90) + '…' : desc) : '—';
    document.getElementById('wa-desc').textContent  = shortDesc;

    var imgWrap = document.getElementById('wa-img-wrap');
    var imgEl   = document.getElementById('wa-img-src');
    var noImg   = document.getElementById('wa-no-img');

    if (rawImg) {
        imgWrap.classList.remove('hidden');
        imgEl.src = rawImg;
        noImg.classList.add('hidden');
    } else {
        imgWrap.classList.add('hidden');
        imgEl.src = '';
        noImg.classList.remove('hidden');
    }

    // Thumbnail no formulário
    updateOgThumb(rawImg);
}

function updateOgThumb(url) {
    var wrap  = document.getElementById('og-thumb-wrap');
    var thumb = document.getElementById('og-thumb');
    if (url) {
        thumb.src = url;
        wrap.classList.remove('hidden');
    } else {
        wrap.classList.add('hidden');
        thumb.src = '';
    }
}

function openPicker()  { document.getElementById('img-picker-modal').classList.remove('hidden'); }
function closePicker() { document.getElementById('img-picker-modal').classList.add('hidden'); }

function selectImage(url) {
    document.getElementById('field-og_image').value = url;
    closePicker();
    updatePreview();
}

function clearOgImage() {
    document.getElementById('field-og_image').value = '';
    updateOgThumb('');
    updatePreview();
}

function insertVar(v) {
    if (!lastFocused) return;
    var s   = lastFocused.selectionStart != null ? lastFocused.selectionStart : lastFocused.value.length;
    var e   = lastFocused.selectionEnd   != null ? lastFocused.selectionEnd   : lastFocused.value.length;
    var val = lastFocused.value;
    lastFocused.value = val.substring(0, s) + v + val.substring(e);
    lastFocused.selectionStart = lastFocused.selectionEnd = s + v.length;
    lastFocused.focus();
    updatePreview();
}

function loadEdit(id, rotulo, title, desc, ogImage, ordem, ativo) {
    var form = document.getElementById('seo-form');
    form.action = BASE_URL + '/' + id;
    document.getElementById('form-method').value  = 'PUT';
    document.getElementById('form-heading').textContent = 'Editando: ' + rotulo;
    document.getElementById('btn-label').textContent    = '✔ Salvar Alterações';
    document.getElementById('btn-cancel').classList.remove('hidden');

    document.getElementById('field-rotulo').value      = rotulo;
    document.getElementById('field-title').value       = title;
    document.getElementById('field-description').value = desc;
    document.getElementById('field-og_image').value    = ogImage;
    document.getElementById('field-ordem').value       = ordem;
    document.getElementById('field-ativo').checked     = ativo;
    updateOgThumb(ogImage);

    document.getElementById('form-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
    updatePreview();
}

function cancelEdit() {
    var form = document.getElementById('seo-form');
    form.action = '{{ route("admin.seo-patterns.store") }}';
    document.getElementById('form-method').value  = 'POST';
    document.getElementById('form-heading').textContent = 'Adicionar Novo Padrão de SEO';
    document.getElementById('btn-label').textContent    = '+ Adicionar Padrão';
    document.getElementById('btn-cancel').classList.add('hidden');
    form.reset();
    document.getElementById('field-ativo').checked = true;
    document.getElementById('field-ordem').value   = NEXT_ORDEM;
    updatePreview();
}

updatePreview();
</script>

@endsection
