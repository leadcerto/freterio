@extends('layouts.admin')
@section('title', 'Gerenciar Imagens')

@section('content')

{{-- Erros específicos do upload --}}
@if($errors->has('image'))
<div class="mb-6 bg-red-50 border border-red-200 text-red-800 text-sm px-4 py-3 rounded-lg">
    ⚠️ {{ $errors->first('image') }}
</div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
    <h2 class="font-semibold text-gray-700 mb-4">Enviar Nova Imagem</h2>

    <div class="mb-4 text-xs text-gray-500 bg-yellow-50 border border-yellow-200 px-4 py-3 rounded-lg">
        ⚠️ <strong>Formatos aceitos:</strong> JPG, JPEG, PNG, GIF ou WebP &nbsp;·&nbsp;
        <strong>Tamanho máximo:</strong> 150MB &nbsp;·&nbsp;
        A imagem será convertida automaticamente para WebP e redimensionada para no máximo 1920px.
    </div>

    <form id="uploadForm"
          method="POST"
          action="{{ route('admin.images.store') }}"
          enctype="multipart/form-data"
          class="flex flex-wrap gap-4 items-end"
          onsubmit="return validarForm()">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tipo da Imagem</label>
            <select name="type" class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                <option value="destaque">Destaque (hero das páginas de bairro)</option>
                <option value="frota">Frota — Imagem geral da frota</option>
                <option value="whatsapp">WhatsApp — Botão flutuante</option>
                <optgroup label="── Veículos individuais ──">
                    <option value="veiculo_1">Veículo 1 — Até 300Kg (Fiat Strada)</option>
                    <option value="veiculo_2">Veículo 2 — Até 400Kg (Utilitário)</option>
                    <option value="veiculo_3">Veículo 3 — Até 1.500Kg (Baú médio)</option>
                    <option value="veiculo_4">Veículo 4 — Até 2.000Kg (Baú grande)</option>
                    <option value="veiculo_5">Veículo 5 — Até 2.500Kg (Baú maior)</option>
                </optgroup>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Arquivo <span class="text-red-500">*</span></label>
            <input id="fileInput"
                   type="file"
                   name="image"
                   accept="image/jpeg,image/jpg,image/png,image/gif,image/webp"
                   class="text-sm border border-gray-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300">
            <p id="fileInfo" class="text-xs text-gray-400 mt-1">Nenhum arquivo selecionado</p>
        </div>

        <button id="submitBtn"
                type="submit"
                class="px-6 py-2 text-sm font-semibold text-white rounded-lg opacity-50 cursor-not-allowed"
                style="background:#0170B9;"
                disabled>
            Enviar Imagem
        </button>
    </form>
</div>

{{-- Grade de imagens — thumbnails pequenos --}}
@if($images->isNotEmpty())
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
    <div class="px-5 py-3 border-b border-gray-100 flex items-center justify-between">
        <h3 class="text-sm font-semibold text-gray-700">Imagens cadastradas <span class="text-gray-400 font-normal">({{ $images->total() }})</span></h3>
    </div>
    <div class="divide-y divide-gray-50">
        @foreach($images as $image)
        <div class="flex items-center gap-4 px-5 py-3 hover:bg-gray-50 transition">

            {{-- Thumbnail pequeno --}}
            <div class="flex-shrink-0 w-16 h-12 rounded-lg overflow-hidden border border-gray-100 bg-gray-50">
                <img src="{{ Storage::url($image->path) }}"
                     alt="{{ $image->type }}"
                     class="w-full h-full object-cover {{ $image->is_active ? '' : 'opacity-40 grayscale' }}"
                     loading="lazy"
                     onerror="this.src='data:image/svg+xml,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'64\' height=\'48\'><rect fill=\'%23f3f4f6\' width=\'64\' height=\'48\'/><text x=\'50%\' y=\'55%\' text-anchor=\'middle\' fill=\'%23d1d5db\' font-size=\'10\'>?</text></svg>'">
            </div>

            {{-- Info --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2 mb-0.5">
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full
                        {{ match($image->type) {
                            'destaque'  => 'bg-blue-100 text-blue-700',
                            'frota'     => 'bg-green-100 text-green-700',
                            'whatsapp'  => 'bg-emerald-100 text-emerald-700',
                            default     => 'bg-gray-100 text-gray-600'
                        } }}">
                        {{ match($image->type) {
                            'destaque' => '🖼 Destaque',
                            'frota'    => '🚛 Frota',
                            'whatsapp' => '💬 WhatsApp',
                            default    => ucfirst($image->type)
                        } }}
                    </span>
                    @if(!$image->is_active)
                        <span class="text-xs text-gray-400 italic">inativa</span>
                    @endif
                </div>
                <p class="text-xs text-gray-400 truncate">{{ $image->filename }}</p>
            </div>

            {{-- Ações --}}
            <div class="flex-shrink-0 flex items-center gap-3">

                {{-- Trocar tipo --}}
                <form method="POST" action="{{ route('admin.images.updateType', $image) }}" class="flex items-center gap-1">
                    @csrf @method('PATCH')
                    <select name="type" onchange="this.form.submit()"
                            class="text-xs border border-gray-200 rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-blue-300 bg-white">
                        @foreach([
                            'destaque'  => '🖼 Destaque',
                            'frota'     => '🚛 Frota geral',
                            'whatsapp'  => '💬 WhatsApp',
                            'veiculo_1' => '1️⃣ Veículo 1',
                            'veiculo_2' => '2️⃣ Veículo 2',
                            'veiculo_3' => '3️⃣ Veículo 3',
                            'veiculo_4' => '4️⃣ Veículo 4',
                            'veiculo_5' => '5️⃣ Veículo 5',
                        ] as $val => $label)
                            <option value="{{ $val }}" {{ $image->type === $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <a href="{{ Storage::url($image->path) }}" target="_blank"
                   class="text-xs text-blue-500 hover:underline">Ver</a>
                <form method="POST" action="{{ route('admin.images.toggle', $image) }}">
                    @csrf @method('PATCH')
                    <button class="text-xs {{ $image->is_active ? 'text-orange-500' : 'text-green-600' }} hover:underline">
                        {{ $image->is_active ? 'Desativar' : 'Ativar' }}
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.images.destroy', $image) }}"
                      onsubmit="return confirm('Remover esta imagem?')">
                    @csrf @method('DELETE')
                    <button class="text-xs text-red-400 hover:underline">Remover</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
<div class="text-center py-16 text-gray-400">
    <p class="text-4xl mb-3">🖼️</p>
    <p>Nenhuma imagem cadastrada ainda.</p>
    <p class="text-xs mt-1">Envie a primeira imagem usando o formulário acima.</p>
</div>
@endif

<div class="mt-2">{{ $images->links() }}</div>

<script>
const fileInput  = document.getElementById('fileInput');
const fileInfo   = document.getElementById('fileInfo');
const submitBtn  = document.getElementById('submitBtn');

fileInput.addEventListener('change', function () {
    const file = this.files[0];

    if (!file) {
        fileInfo.textContent = 'Nenhum arquivo selecionado';
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
        return;
    }

    const maxMB  = 150;
    const sizeMB = (file.size / 1024 / 1024).toFixed(2);

    if (file.size > maxMB * 1024 * 1024) {
        fileInfo.textContent = `❌ Arquivo muito grande: ${sizeMB}MB (máx. ${maxMB}MB)`;
        fileInfo.className   = 'text-xs text-red-500 mt-1';
        submitBtn.disabled   = true;
        submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
        return;
    }

    fileInfo.textContent = `✅ ${file.name} — ${sizeMB}MB`;
    fileInfo.className   = 'text-xs text-green-600 mt-1';
    submitBtn.disabled   = false;
    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
});

function validarForm() {
    if (!fileInput.files || !fileInput.files[0]) {
        alert('Selecione um arquivo de imagem antes de enviar.');
        return false;
    }
    submitBtn.textContent = 'Enviando...';
    submitBtn.disabled    = true;
    return true;
}
</script>

@endsection
