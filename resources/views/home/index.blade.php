@extends('layouts.public')

@section('meta_title', 'Frete e Mudança no Rio de Janeiro | Frete Rio')
@section('meta_description', 'Empresa de fretes e mudanças no Rio de Janeiro com avaliação 5 estrelas no Google desde 2019. Orçamento rápido pelo WhatsApp. Mais de 285 clientes satisfeitos.')
@section('canonical', url('/'))

@section('content')

{{-- SEÇÃO 1: HERO --}}
<section class="text-white py-20 px-4 text-center relative overflow-hidden" style="background: linear-gradient(135deg, #0170B9 0%, #015a94 100%);">
    <div class="max-w-3xl mx-auto relative z-10">
        <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4">
            🚚 Frete e Mudança no Rio de Janeiro
        </h1>
        <p class="text-lg md:text-xl text-blue-100 mb-8">
            Orçamento Rápido 24H &bull; Avaliação ⭐⭐⭐⭐⭐ no Google &bull; +285 clientes satisfeitos
        </p>
        <a href="https://wa.me/55{{ $whatsapp }}?text={{ urlencode('Olá, gostaria de um orçamento de frete no Rio de Janeiro!') }}"
           target="_blank" rel="noopener"
           class="inline-flex items-center gap-3 text-white font-bold text-xl px-8 py-4 rounded-full shadow-xl hover:opacity-90 transition"
           style="background:#25D366;">
            <svg class="w-7 h-7 fill-white flex-shrink-0" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.122 1.532 5.851L.057 23.516a.75.75 0 0 0 .921.921l5.713-1.474A11.953 11.953 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.907 0-3.693-.528-5.217-1.446l-.374-.224-3.878 1-.996-3.824-.243-.389A9.956 9.956 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
            Orçamento Rápido pelo WhatsApp
        </a>
    </div>
</section>

{{-- SEÇÃO 2: NOSSA FROTA --}}
<section class="py-16 px-4 bg-white">
    <div class="max-w-5xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Nossa Frota — Até 300Kg a 4.500Kg</h2>
        <p class="text-gray-500 mb-10">Temos o veículo certo para o seu serviço, desde cargas leves até grandes mudanças.</p>

        @if($fleetImage)
            <img src="{{ Storage::url($fleetImage->path) }}"
                 alt="Frota completa de veículos para frete e mudança no Rio de Janeiro"
                 title="Nossa frota de veículos — Frete Rio de Janeiro"
                 class="mx-auto"
                 style="max-width: 100%; max-height: 520px; object-fit: contain;"
                 loading="lazy">
        @else
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                @foreach([['1','Até 300kg'],['2','Até 700kg'],['3','Até 1.000kg'],['4','Até 2.500kg'],['5','Até 4.500kg']] as [$num, $cap])
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <p class="text-4xl font-extrabold mb-1" style="color:#0170B9;">{{ $num }}</p>
                    <p class="text-sm font-semibold text-gray-700">{{ $cap }}</p>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- SEÇÃO 3: SERVIÇOS E BENEFÍCIOS --}}
<section class="py-16 px-4" style="background:#f3f4f6;">
    <div class="max-w-5xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Frete Mudança Transporte no Rio de Janeiro</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="text-3xl mb-3">📦</div>
                <h3 class="text-lg font-bold mb-2" style="color:#0170B9;">Empacotamento</h3>
                <p class="text-gray-600 text-sm">Equipe especializada e fornecimento de material: caixas, plástico bolha, fita e mão de obra para proteger seus bens.</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="text-3xl mb-3">💪</div>
                <h3 class="text-lg font-bold mb-2" style="color:#0170B9;">Carregadores Profissionais</h3>
                <p class="text-gray-600 text-sm">Nossa equipe cuida de todo o trabalho pesado com carrinhos de carga, cobertores e cintas de proteção.</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="text-3xl mb-3">⭐</div>
                <h3 class="text-lg font-bold mb-2" style="color:#0170B9;">Serviço 5 Estrelas</h3>
                <p class="text-gray-600 text-sm">Avaliados com 5 estrelas no Google desde 2019. Pontualidade e segurança em cada atendimento.</p>
            </div>
        </div>
    </div>
</section>

{{-- SEÇÃO 4: PROVA SOCIAL --}}
<section class="py-16 px-4 bg-white text-center">
    <div class="max-w-3xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">+285 Clientes Satisfeitos</h2>
        <div class="flex items-center justify-center gap-2 mb-6">
            <span class="text-4xl font-extrabold" style="color:#0170B9;">5.0</span>
            <div class="text-yellow-400 text-3xl">⭐⭐⭐⭐⭐</div>
        </div>
        <p class="text-gray-500 mb-8">Avaliação média no Google desde 2019. Confira as avaliações dos nossos clientes.</p>
        <a href="https://wa.me/55{{ $whatsapp }}?text={{ urlencode('Olá, gostaria de um orçamento de frete no Rio de Janeiro!') }}"
           target="_blank" rel="noopener"
           class="inline-flex items-center gap-2 text-white font-bold px-8 py-4 rounded-full text-lg transition hover:opacity-90"
           style="background:#25D366;">
            Solicitar Orçamento Agora
        </a>
    </div>
</section>

{{-- SEÇÃO 5: FAQ --}}
@if($faqs->count())
<section class="py-16 px-4" style="background:#f3f4f6;">
    <div class="max-w-3xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Principais Dúvidas</h2>
        <div class="space-y-3">
            @foreach($faqs as $faq)
            <details class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <summary class="flex items-center justify-between gap-4 px-6 py-4 font-semibold text-gray-800 select-none">
                    <h3 class="text-sm md:text-base">{{ $faq->question }}</h3>
                    <svg class="chevron w-5 h-5 flex-shrink-0 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </summary>
                <div class="px-6 pb-5 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4">
                    {{ $faq->answer }}
                </div>
            </details>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
