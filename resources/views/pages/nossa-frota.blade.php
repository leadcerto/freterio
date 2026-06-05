@extends('layouts.public')

@section('meta_title', 'Nossa Frota de Veículos | Frete Rio')
@section('meta_description', 'Conheça a frota completa da Frete Rio: 5 tipos de veículos para fretes pequenos, médios e grandes mudanças no Rio de Janeiro. Orçamento pelo WhatsApp.')
@section('canonical', route('frota'))

@push('head_styles')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "name": "Frota de Veículos — Frete Rio",
  "description": "Veículos disponíveis para frete e mudança no Rio de Janeiro",
  "url": "{{ route('frota') }}",
  "numberOfItems": 5,
  "itemListElement": [
    {"@type":"ListItem","position":1,"name":"Fiorino — Pequenos Volumes"},
    {"@type":"ListItem","position":2,"name":"Pick-up — Móveis e Caixas"},
    {"@type":"ListItem","position":3,"name":"Baú Pequeno — Mudanças Médias"},
    {"@type":"ListItem","position":4,"name":"Baú Grande — Mudanças Residenciais"},
    {"@type":"ListItem","position":5,"name":"Caminhão Baú — Mudanças Completas"}
  ]
}
</script>
@endpush

@section('content')

@php
$descricoes = [
    1 => ['nome' => 'Fiorino', 'cap' => 'Até 500 kg', 'uso' => 'Pequenos volumes, caixas, entregas rápidas'],
    2 => ['nome' => 'Pick-up', 'cap' => 'Até 1 tonelada', 'uso' => 'Móveis avulsos, eletrodomésticos, bicicletas'],
    3 => ['nome' => 'Baú Pequeno', 'cap' => 'Até 3 toneladas', 'uso' => 'Mudanças de kitnet e apartamento pequeno'],
    4 => ['nome' => 'Baú Grande', 'cap' => 'Até 6 toneladas', 'uso' => 'Mudanças residenciais completas'],
    5 => ['nome' => 'Caminhão Baú', 'cap' => 'Até 10 toneladas', 'uso' => 'Mudanças de casas e grandes volumes'],
];
@endphp

<div class="max-w-5xl mx-auto px-4 py-12">

    <div class="text-center mb-10">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-3">Nossa Frota de Veículos</h1>
        <p class="text-gray-500 text-lg">Temos o veículo certo para cada necessidade — do pequeno volume à mudança completa.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        @foreach($veiculos as $v)
        @php $d = $descricoes[$v['num']]; @endphp
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
            @if($v['img'])
            <div class="bg-gray-50 flex items-center justify-center p-4" style="height:180px;">
                <img src="{{ Storage::url($v['img']->path) }}"
                     alt="{{ $d['nome'] }} — Frete Rio"
                     class="max-h-full w-auto object-contain"
                     loading="lazy">
            </div>
            @else
            <div class="bg-gray-100 flex items-center justify-center" style="height:180px;">
                <span class="text-4xl font-black text-gray-300">{{ $v['num'] }}</span>
            </div>
            @endif
            <div class="p-5">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-2xl font-black" style="color:#0170B9;">{{ $v['num'] }}</span>
                    <h2 class="text-lg font-bold text-gray-800">{{ $d['nome'] }}</h2>
                </div>
                <p class="text-sm font-semibold text-green-600 mb-1">{{ $d['cap'] }}</p>
                <p class="text-sm text-gray-500">{{ $d['uso'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- CTA --}}
    <div class="text-center bg-blue-50 rounded-2xl p-8 border border-blue-100">
        <h2 class="text-xl font-bold text-gray-800 mb-2">Não sabe qual veículo escolher?</h2>
        <p class="text-gray-500 mb-6">Fale com a gente pelo WhatsApp — indicamos o veículo ideal para o seu frete.</p>
        <a href="https://wa.me/5521981813106?text={{ urlencode('Olá, gostaria de saber qual veículo é ideal para o meu frete!') }}"
           target="_blank" rel="noopener"
           onclick="gtag('event','whatsapp_click',{'button':'frota','page':'/nossa-frota'})"
           class="inline-flex items-center gap-3 text-white font-bold px-8 py-4 rounded-full text-lg transition hover:opacity-90"
           style="background:#25D366;">
            <svg class="w-6 h-6 fill-white" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.122 1.532 5.851L.057 23.516a.75.75 0 0 0 .921.921l5.713-1.474A11.953 11.953 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.907 0-3.693-.528-5.217-1.446l-.374-.224-3.878 1-.996-3.824-.243-.389A9.956 9.956 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
            Falar pelo WhatsApp
        </a>
    </div>

</div>
@endsection
