@extends('layouts.admin')
@section('title', 'Bairros')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div></div>
    <a href="{{ route('admin.neighborhoods.create') }}" class="text-sm font-semibold px-4 py-2 rounded-lg text-white" style="background:#0170B9;">+ Novo Bairro</a>
</div>

<form method="GET" class="mb-4 flex gap-2">
    <input type="text" name="search" value="{{ request('search') }}"
           placeholder="Buscar bairro..."
           class="flex-1 border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
    <button type="submit" class="px-4 py-2 text-sm rounded-lg text-white" style="background:#0170B9;">Buscar</button>
</form>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="text-left px-6 py-3 font-semibold text-gray-600">Bairro</th>
                <th class="text-left px-6 py-3 font-semibold text-gray-600">Cidade</th>
                <th class="text-left px-6 py-3 font-semibold text-gray-600">Status</th>
                <th class="text-right px-6 py-3 font-semibold text-gray-600">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($neighborhoods as $neighborhood)
            <tr class="{{ $neighborhood->trashed() ? 'opacity-40' : '' }}">
                <td class="px-6 py-3 font-medium text-gray-800">{{ $neighborhood->name }}</td>
                <td class="px-6 py-3 text-gray-500">{{ $neighborhood->city }}</td>
                <td class="px-6 py-3">
                    @if($neighborhood->trashed())
                        <span class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded-full">Excluído</span>
                    @elseif($neighborhood->is_active)
                        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Ativo</span>
                    @else
                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full">Inativo</span>
                    @endif
                </td>
                <td class="px-6 py-3 text-right space-x-2">
                    @unless($neighborhood->trashed())
                    <a href="{{ route('admin.neighborhoods.edit', $neighborhood) }}" class="text-blue-600 hover:underline text-xs">Editar</a>
                    <form method="POST" action="{{ route('admin.neighborhoods.toggle', $neighborhood) }}" class="inline">
                        @csrf @method('PATCH')
                        <button class="text-xs {{ $neighborhood->is_active ? 'text-orange-500' : 'text-green-600' }} hover:underline">
                            {{ $neighborhood->is_active ? 'Desativar' : 'Ativar' }}
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.neighborhoods.destroy', $neighborhood) }}" class="inline" onsubmit="return confirm('Confirmar exclusão (soft delete)?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline text-xs">Excluir</button>
                    </form>
                    @endunless
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $neighborhoods->links() }}
    </div>
</div>
@endsection
