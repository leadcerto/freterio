@extends('layouts.admin')
@section('title', isset($neighborhood->id) ? 'Editar Bairro' : 'Novo Bairro')

@section('content')
<div class="max-w-2xl">
    <a href="{{ route('admin.neighborhoods.index') }}" class="text-sm text-blue-600 hover:underline mb-6 inline-block">← Voltar</a>

    <form method="POST"
          action="{{ isset($neighborhood->id) ? route('admin.neighborhoods.update', $neighborhood) : route('admin.neighborhoods.store') }}"
          class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-5">
        @csrf
        @if(isset($neighborhood->id)) @method('PUT') @endif

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome do Bairro *</label>
                <input type="text" name="name" value="{{ old('name', $neighborhood->name) }}" required
                       class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cidade *</label>
                <input type="text" name="city" value="{{ old('city', $neighborhood->city) }}" required
                       class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title (SEO)</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $neighborhood->meta_title) }}"
                   placeholder="Ex: Frete em Copacabana | Frete Rio"
                   class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description (SEO)</label>
            <textarea name="meta_description" rows="2"
                      placeholder="Descrição que aparece no Google (máx. 160 caracteres)"
                      class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">{{ old('meta_description', $neighborhood->meta_description) }}</textarea>
        </div>

        <hr class="border-gray-100">
        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Enriquecimento SEO</p>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Localização do Bairro</label>
            <textarea name="location_text" rows="4"
                      class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">{{ old('location_text', $neighborhood->location_text) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Bairros Próximos</label>
            <textarea name="nearby_neighborhoods" rows="3"
                      class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">{{ old('nearby_neighborhoods', $neighborhood->nearby_neighborhoods) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Ruas e Avenidas Principais</label>
            <textarea name="main_streets" rows="3"
                      class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">{{ old('main_streets', $neighborhood->main_streets) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Rotas Mais Rápidas</label>
            <textarea name="shortest_routes" rows="3"
                      class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">{{ old('shortest_routes', $neighborhood->shortest_routes) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Observações de Acesso</label>
            <textarea name="access_notes" rows="2"
                      class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">{{ old('access_notes', $neighborhood->access_notes) }}</textarea>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="px-6 py-2 text-sm font-semibold text-white rounded-lg" style="background:#0170B9;">
                {{ isset($neighborhood->id) ? 'Salvar Alterações' : 'Criar Bairro' }}
            </button>
            <a href="{{ route('admin.neighborhoods.index') }}" class="px-6 py-2 text-sm font-semibold text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition">Cancelar</a>
        </div>
    </form>
</div>
@endsection
