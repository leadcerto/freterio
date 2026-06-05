@extends('layouts.public')

@section('meta_title', 'Fale Conosco | Frete Rio')
@section('meta_description', 'Entre em contato com a Frete Rio pelo WhatsApp ou telefone. Atendemos todo o Rio de Janeiro com fretes e mudanças. Orçamento rápido e gratuito.')
@section('canonical', route('contato'))

@section('content')

<div class="max-w-3xl mx-auto px-4 py-12">

    <div class="text-center mb-10">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-3">Fale Conosco</h1>
        <p class="text-gray-500 text-lg">Orçamento rápido e sem compromisso. Respondemos em minutos.</p>
    </div>

    {{-- WhatsApp principal --}}
    <div class="bg-green-50 rounded-2xl p-8 border border-green-200 text-center mb-6">
        <p class="text-sm font-semibold text-green-700 uppercase tracking-wide mb-2">Canal principal</p>
        <h2 class="text-2xl font-bold text-gray-800 mb-4">WhatsApp</h2>
        <a href="https://wa.me/5521981813106?text={{ urlencode('Olá, gostaria de um orçamento de frete!') }}"
           target="_blank" rel="noopener"
           onclick="gtag('event','whatsapp_click',{'button':'fale-conosco','page':'/fale-conosco'})"
           class="inline-flex items-center gap-3 text-white font-bold px-8 py-4 rounded-full text-xl transition hover:opacity-90 mb-4"
           style="background:#25D366;">
            <svg class="w-7 h-7 fill-white" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.122 1.532 5.851L.057 23.516a.75.75 0 0 0 .921.921l5.713-1.474A11.953 11.953 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.907 0-3.693-.528-5.217-1.446l-.374-.224-3.878 1-.996-3.824-.243-.389A9.956 9.956 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
            (21) 98181-3106
        </a>
        <p class="text-sm text-gray-500">Segunda a sábado · 7h às 20h</p>
    </div>

    {{-- Informações --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-xl border border-gray-100 p-5 text-center shadow-sm">
            <div class="text-3xl mb-2">📍</div>
            <p class="font-semibold text-gray-700 text-sm">Área de Atuação</p>
            <p class="text-gray-500 text-xs mt-1">Rio de Janeiro e Região Metropolitana</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 p-5 text-center shadow-sm">
            <div class="text-3xl mb-2">⏱️</div>
            <p class="font-semibold text-gray-700 text-sm">Atendimento</p>
            <p class="text-gray-500 text-xs mt-1">Seg–Sáb das 7h às 20h</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 p-5 text-center shadow-sm">
            <div class="text-3xl mb-2">⭐</div>
            <p class="font-semibold text-gray-700 text-sm">Avaliação</p>
            <p class="text-gray-500 text-xs mt-1">5 estrelas no Google</p>
        </div>
    </div>

    {{-- Links internos --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <a href="{{ route('frota') }}"
           class="flex items-center gap-4 bg-white rounded-xl border border-gray-100 p-5 shadow-sm hover:border-blue-300 hover:shadow-md transition group">
            <span class="text-3xl">🚛</span>
            <div>
                <p class="font-semibold text-gray-700 group-hover:text-blue-600 transition">Nossa Frota</p>
                <p class="text-xs text-gray-400">5 tipos de veículos disponíveis</p>
            </div>
        </a>
        <a href="{{ route('depoimentos') }}"
           class="flex items-center gap-4 bg-white rounded-xl border border-gray-100 p-5 shadow-sm hover:border-blue-300 hover:shadow-md transition group">
            <span class="text-3xl">💬</span>
            <div>
                <p class="font-semibold text-gray-700 group-hover:text-blue-600 transition">Depoimentos</p>
                <p class="text-xs text-gray-400">O que nossos clientes dizem</p>
            </div>
        </a>
    </div>

</div>
@endsection
