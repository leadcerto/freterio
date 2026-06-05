<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('meta_title', 'Frete e Mudança no Rio de Janeiro | Frete Rio')</title>
    <meta name="description" content="@yield('meta_description', 'Frete e mudança no Rio de Janeiro com avaliação 5 estrelas no Google. Orçamento rápido pelo WhatsApp. Mais de 285 clientes satisfeitos.')">

    @hasSection('canonical')
        <link rel="canonical" href="@yield('canonical')">
    @endif

    <meta property="og:title" content="@yield('meta_title', 'Frete e Mudança no Rio de Janeiro')">
    <meta property="og:description" content="@yield('meta_description', 'Orçamento rápido pelo WhatsApp.')">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="pt_BR">
    <meta name="google-site-verification" content="IfQzZfmpFI4veIrf0cPXRHLV7N1fvu1RokB8f-p3xq0">
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YS5SLJYQQ3"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-YS5SLJYQQ3');</script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
        details > summary { list-style: none; cursor: pointer; }
        details > summary::-webkit-details-marker { display: none; }
        details[open] .chevron { transform: rotate(180deg); }
        .chevron { transition: transform .2s ease; }
    </style>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "LocalBusiness",
          "@id": "https://frete.rio.br/#business",
          "name": "Frete Rio",
          "alternateName": "Frete e Mudança Rio de Janeiro",
          "url": "https://frete.rio.br",
          "telephone": "+5521981813106",
          "description": "Empresa de fretes e mudanças no Rio de Janeiro com avaliação 5 estrelas no Google. Orçamento rápido pelo WhatsApp.",
          "address": {
            "@type": "PostalAddress",
            "addressLocality": "Rio de Janeiro",
            "addressRegion": "RJ",
            "addressCountry": "BR"
          },
          "areaServed": { "@type": "City", "name": "Rio de Janeiro" },
          "priceRange": "$$",
          "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+55-21-98181-3106",
            "contactType": "customer service",
            "availableLanguage": "Portuguese"
          }
        },
        {
          "@type": "WebSite",
          "@id": "https://frete.rio.br/#website",
          "url": "https://frete.rio.br",
          "name": "Frete Rio",
          "description": "Fretes e Mudanças no Rio de Janeiro",
          "publisher": { "@id": "https://frete.rio.br/#business" },
          "inLanguage": "pt-BR"
        }
      ]
    }
    </script>
    @stack('head_styles')
</head>
<body class="bg-white text-gray-800 antialiased">

    <!-- HEADER -->
    <header class="bg-white shadow-sm sticky top-0 z-40">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-1">
                <span class="text-2xl font-extrabold" style="color:#0170B9;">Frete</span>
                <span class="text-2xl font-extrabold text-gray-700">Rio</span>
            </a>
            <a href="https://wa.me/55{{ $whatsapp ?? '21981813106' }}?text={{ urlencode('Olá, gostaria de um orçamento de frete!') }}"
               target="_blank" rel="noopener"
               class="hidden sm:inline-flex items-center gap-2 text-white text-sm font-semibold px-4 py-2 rounded-full"
               style="background:#25D366;">
                <svg class="w-4 h-4 fill-white" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.122 1.532 5.851L.057 23.516a.75.75 0 0 0 .921.921l5.713-1.474A11.953 11.953 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.907 0-3.693-.528-5.217-1.446l-.374-.224-3.878 1-.996-3.824-.243-.389A9.956 9.956 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
                Orçamento pelo WhatsApp
            </a>
        </div>
    </header>

    <!-- CONTEÚDO PRINCIPAL -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-300 py-10 mt-16">
        <div class="max-w-6xl mx-auto px-4 text-center text-sm">
            <p class="font-bold text-white text-base mb-1">Frete Rio — Fretes e Mudanças no Rio de Janeiro</p>
            <p>WhatsApp: <a href="tel:+5521981813106" class="hover:text-white transition">(21) 98181-3106</a></p>
            <div class="flex flex-wrap justify-center gap-4 mt-3 text-xs text-gray-400">
                <a href="{{ route('frota') }}" class="hover:text-white transition">Nossa Frota</a>
                <a href="{{ route('depoimentos') }}" class="hover:text-white transition">Depoimentos</a>
                <a href="{{ route('contato') }}" class="hover:text-white transition">Fale Conosco</a>
                <a href="{{ route('privacy') }}" class="hover:text-white transition">Política de Privacidade</a>
            </div>
            <p class="mt-2 text-xs text-gray-500">© {{ date('Y') }} Frete Rio. Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- BOTÃO FLUTUANTE WHATSAPP — CSS INLINE PURO, SEM TAILWIND -->
    @php $waImg = \App\Models\Image::active()->ofType('whatsapp')->latest()->first(); @endphp
    @if($waImg)
        <a href="https://wa.me/55{{ $whatsapp ?? '21981813106' }}?text={{ $waMessage ?? urlencode('Olá, gostaria de um orçamento de frete!') }}"
           target="_blank" rel="noopener"
           aria-label="Fale conosco pelo WhatsApp"
           style="position:fixed; bottom:20px; right:20px; z-index:9999; display:block; opacity:1; transition:opacity .2s;">
            <img src="{{ Storage::url($waImg->path) }}"
                 alt="Orçamento Rápido pelo WhatsApp"
                 width="180"
                 style="display:block; max-width:180px; height:auto; filter:drop-shadow(0 4px 8px rgba(0,0,0,.35));">
        </a>
    @else
        <a href="https://wa.me/55{{ $whatsapp ?? '21981813106' }}?text={{ $waMessage ?? urlencode('Olá, gostaria de um orçamento de frete!') }}"
           target="_blank" rel="noopener"
           aria-label="Fale conosco pelo WhatsApp"
           style="position:fixed; bottom:20px; right:20px; z-index:9999; display:flex; align-items:center; justify-content:center; width:64px; height:64px; border-radius:50%; background:#25D366; box-shadow:0 4px 16px rgba(0,0,0,.3);">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="white">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.122 1.532 5.851L.057 23.516a.75.75 0 0 0 .921.921l5.713-1.474A11.953 11.953 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.907 0-3.693-.528-5.217-1.446l-.374-.224-3.878 1-.996-3.824-.243-.389A9.956 9.956 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
            </svg>
        </a>
    @endif

</body>
</html>
