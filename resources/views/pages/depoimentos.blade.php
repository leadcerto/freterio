@extends('layouts.public')

@section('meta_title', 'Depoimentos e Avaliações | Frete Rio')
@section('meta_description', 'Veja o que nossos clientes dizem sobre a Frete Rio. Avaliação 5 estrelas no Google. Mais de 285 clientes satisfeitos no Rio de Janeiro.')
@section('canonical', route('depoimentos'))

@push('head_styles')
@if($reviews->isNotEmpty())
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "@id": "https://frete.rio.br/#business",
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5",
    "bestRating": "5",
    "reviewCount": "{{ $reviews->count() }}"
  },
  "review": [
    @foreach($reviews->take(5) as $i => $r)
    {
      "@type": "Review",
      "author": { "@type": "Person", "name": "{{ e($r->author_name) }}" },
      "reviewRating": { "@type": "Rating", "ratingValue": "{{ $r->rating }}", "bestRating": "5" },
      "reviewBody": "{{ e(Str::limit($r->text, 200)) }}"
    }{{ !$loop->last ? ',' : '' }}
    @endforeach
  ]
}
</script>
@endif
@endpush

@section('content')

<div class="max-w-4xl mx-auto px-4 py-12">

    <div class="text-center mb-10">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-3">O que nossos clientes dizem</h1>
        <div class="flex items-center justify-center gap-2 mb-2">
            <span class="text-3xl">⭐⭐⭐⭐⭐</span>
            <span class="text-2xl font-bold text-gray-800">5,0</span>
        </div>
        <p class="text-gray-500">Avaliação no Google · {{ $reviews->count() }} avaliações verificadas</p>
    </div>

    @if($reviews->isEmpty())
        <p class="text-center text-gray-400 py-16">Nenhuma avaliação cadastrada ainda.</p>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-12">
        @foreach($reviews as $review)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
            <div class="flex items-start gap-4 mb-3">
                @if($review->profile_photo_url)
                <img src="{{ $review->profile_photo_url }}" alt="{{ e($review->author_name) }}"
                     class="w-10 h-10 rounded-full object-cover flex-shrink-0"
                     loading="lazy" onerror="this.style.display='none'">
                @else
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                    <span class="text-blue-600 font-bold text-sm">{{ strtoupper(substr($review->author_name, 0, 1)) }}</span>
                </div>
                @endif
                <div class="min-w-0">
                    <p class="font-semibold text-gray-800 text-sm truncate">{{ $review->author_name }}</p>
                    <p class="text-yellow-400 text-sm leading-none mt-0.5">{{ $review->stars() }}</p>
                    @if($review->relative_time_description)
                    <p class="text-xs text-gray-400 mt-0.5">{{ $review->relative_time_description }}</p>
                    @endif
                </div>
            </div>
            <p class="text-gray-600 text-sm leading-relaxed">{{ $review->text }}</p>
        </div>
        @endforeach
    </div>
    @endif

    {{-- CTA --}}
    <div class="text-center bg-green-50 rounded-2xl p-8 border border-green-100">
        <h2 class="text-xl font-bold text-gray-800 mb-2">Quer fazer parte dessas histórias?</h2>
        <p class="text-gray-500 mb-6">Solicite seu orçamento agora e experimente o serviço que nossos clientes aprovam.</p>
        <a href="https://wa.me/5521981813106?text={{ urlencode('Olá, gostaria de um orçamento de frete!') }}"
           target="_blank" rel="noopener"
           onclick="gtag('event','whatsapp_click',{'button':'depoimentos','page':'/depoimentos'})"
           class="inline-flex items-center gap-3 text-white font-bold px-8 py-4 rounded-full text-lg transition hover:opacity-90"
           style="background:#25D366;">
            <svg class="w-6 h-6 fill-white" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.122 1.532 5.851L.057 23.516a.75.75 0 0 0 .921.921l5.713-1.474A11.953 11.953 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.907 0-3.693-.528-5.217-1.446l-.374-.224-3.878 1-.996-3.824-.243-.389A9.956 9.956 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
            Solicitar Orçamento Grátis
        </a>
    </div>

</div>
@endsection
