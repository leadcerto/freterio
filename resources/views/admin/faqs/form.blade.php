@extends('layouts.admin')
@section('title', isset($faq->id) ? 'Editar Pergunta' : 'Nova Pergunta')

@section('content')
<div class="max-w-2xl">
    <a href="{{ route('admin.faqs.index') }}" class="text-sm text-blue-600 hover:underline mb-6 inline-block">← Voltar</a>

    <div class="mb-4 bg-blue-50 border border-blue-200 text-blue-800 text-xs px-4 py-3 rounded-lg">
        💡 Use <strong>{bairro}</strong> na pergunta e na resposta. Ex: "Fazemos frete em {bairro}?" será substituído automaticamente pelo nome do bairro no site.
    </div>

    <form method="POST"
          action="{{ isset($faq->id) ? route('admin.faqs.update', $faq) : route('admin.faqs.store') }}"
          class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-5">
        @csrf
        @if(isset($faq->id)) @method('PUT') @endif

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Pergunta *</label>
            <input type="text" name="question" value="{{ old('question', $faq->question) }}" required
                   class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Resposta *</label>
            <textarea name="answer" rows="5" required
                      class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">{{ old('answer', $faq->answer) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ordem de exibição</label>
                <input type="number" name="order" value="{{ old('order', $faq->order ?? 0) }}" min="0"
                       class="w-full border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>
            <div class="flex items-end pb-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $faq->is_active ?? true) ? 'checked' : '' }}
                           class="w-4 h-4 rounded border-gray-300 text-blue-600">
                    <span class="text-sm font-medium text-gray-700">Ativo</span>
                </label>
            </div>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="px-6 py-2 text-sm font-semibold text-white rounded-lg" style="background:#0170B9;">
                {{ isset($faq->id) ? 'Salvar Alterações' : 'Criar Pergunta' }}
            </button>
            <a href="{{ route('admin.faqs.index') }}" class="px-6 py-2 text-sm font-semibold text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition">Cancelar</a>
        </div>
    </form>
</div>
@endsection
