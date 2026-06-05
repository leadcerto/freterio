@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <p class="text-sm text-gray-500 mb-1">Bairros Ativos</p>
        <p class="text-4xl font-extrabold" style="color:#0170B9;">{{ $stats['neighborhoods_active'] }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <p class="text-sm text-gray-500 mb-1">Bairros Inativos</p>
        <p class="text-4xl font-extrabold text-gray-400">{{ $stats['neighborhoods_inactive'] }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <p class="text-sm text-gray-500 mb-1">Perguntas (FAQ)</p>
        <p class="text-4xl font-extrabold text-gray-700">{{ $stats['faqs'] }}</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <p class="text-sm text-gray-500 mb-1">Imagens</p>
        <p class="text-4xl font-extrabold text-gray-700">{{ $stats['images'] }}</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
    <h2 class="font-bold text-gray-700 mb-4">Acesso rápido</h2>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.neighborhoods.create') }}" class="text-sm font-semibold px-4 py-2 rounded-lg text-white" style="background:#0170B9;">+ Novo Bairro</a>
        <a href="{{ route('admin.faqs.create') }}" class="text-sm font-semibold px-4 py-2 rounded-lg bg-gray-700 text-white">+ Nova FAQ</a>
        <a href="{{ route('admin.images.index') }}" class="text-sm font-semibold px-4 py-2 rounded-lg bg-gray-100 text-gray-700 border">📁 Gerenciar Imagens</a>
    </div>
</div>
@endsection
