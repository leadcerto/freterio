@extends('layouts.admin')
@section('title', 'Perguntas Frequentes')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">Use <code class="bg-gray-100 px-1 rounded">{bairro}</code> nas respostas para injetar o nome do bairro dinamicamente.</p>
    <a href="{{ route('admin.faqs.create') }}" class="text-sm font-semibold px-4 py-2 rounded-lg text-white" style="background:#0170B9;">+ Nova Pergunta</a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="text-left px-6 py-3 font-semibold text-gray-600 w-8">#</th>
                <th class="text-left px-6 py-3 font-semibold text-gray-600">Pergunta</th>
                <th class="text-left px-6 py-3 font-semibold text-gray-600">Status</th>
                <th class="text-right px-6 py-3 font-semibold text-gray-600">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($faqs as $faq)
            <tr>
                <td class="px-6 py-3 text-gray-400 text-xs">{{ $faq->order }}</td>
                <td class="px-6 py-3 text-gray-800 max-w-xs truncate">{{ $faq->question }}</td>
                <td class="px-6 py-3">
                    @if($faq->is_active)
                        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Ativo</span>
                    @else
                        <span class="text-xs bg-gray-100 text-gray-500 px-2 py-1 rounded-full">Inativo</span>
                    @endif
                </td>
                <td class="px-6 py-3 text-right space-x-2">
                    <a href="{{ route('admin.faqs.edit', $faq) }}" class="text-blue-600 hover:underline text-xs">Editar</a>
                    <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" class="inline" onsubmit="return confirm('Remover esta pergunta?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline text-xs">Remover</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $faqs->links() }}
    </div>
</div>
@endsection
