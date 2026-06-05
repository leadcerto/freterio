<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('meta_title', 'Frete e Mudança | Frete Rio')</title>
    <meta name="description" content="@yield('meta_description', 'Frete e mudança no Rio de Janeiro.')">
    @hasSection('canonical')
        <link rel="canonical" href="@yield('canonical')">
    @endif
    <meta property="og:title" content="@yield('meta_title')">
    <meta property="og:description" content="@yield('meta_description')">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="pt_BR">
    <meta name="google-site-verification" content="IfQzZfmpFI4veIrf0cPXRHLV7N1fvu1RokB8f-p3xq0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(170deg, #7baac9 0%, #4a7faa 40%, #2e6491 100%);
            min-height: 100vh;
        }
        details > summary { list-style: none; cursor: pointer; }
        details > summary::-webkit-details-marker { display: none; }
    </style>
</head>
<body>

    @yield('content')

    <!-- RODAPÉ MÍNIMO -->
    <footer style="background: rgba(0,0,0,0.25); padding: 16px 16px 260px; text-align: center; margin-top: 40px;">
        <p style="color: rgba(255,255,255,0.55); font-size: 12px;">
            © {{ date('Y') }} Frete Rio — Fretes e Mudanças no Rio de Janeiro &nbsp;·&nbsp;
            <a href="{{ route('home') }}" style="color: rgba(255,255,255,0.5); text-decoration:none;">Início</a>
        </p>
    </footer>

    <!-- BOTÃO WHATSAPP FIXO — BANNER CENTRALIZADO NA BASE -->
    @php $waImg = \App\Models\Image::active()->ofType('whatsapp')->latest()->first(); @endphp
    @if($waImg)
        <a href="https://wa.me/55{{ $whatsapp ?? '21981813106' }}?text={{ $waMessage ?? urlencode('Olá, gostaria de um orçamento de frete!') }}"
           target="_blank" rel="noopener"
           aria-label="Orçamento pelo WhatsApp"
           style="position:fixed; bottom:16px; left:50%; transform:translateX(-50%); z-index:9999; display:block;">
            <img src="{{ Storage::url($waImg->path) }}"
                 alt="Orçamento Rápido pelo WhatsApp — Clique Aqui"
                 style="width:320px; max-width:90vw; height:auto; display:block; filter:drop-shadow(0 4px 12px rgba(0,0,0,.5));">
        </a>
    @else
        <a href="https://wa.me/55{{ $whatsapp ?? '21981813106' }}?text={{ $waMessage ?? urlencode('Olá, gostaria de um orçamento de frete!') }}"
           target="_blank" rel="noopener"
           style="position:fixed; bottom:16px; left:50%; transform:translateX(-50%); z-index:9999;
                  display:inline-flex; align-items:center; gap:10px;
                  background:#000; color:#fff;
                  font-size:16px; font-weight:800;
                  padding:12px 24px; border-radius:60px;
                  text-decoration:none; white-space:nowrap;
                  box-shadow:0 6px 24px rgba(0,0,0,.5);">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="#25D366" style="flex-shrink:0">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.122 1.532 5.851L.057 23.516a.75.75 0 0 0 .921.921l5.713-1.474A11.953 11.953 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.907 0-3.693-.528-5.217-1.446l-.374-.224-3.878 1-.996-3.824-.243-.389A9.956 9.956 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
            </svg>
            <span>
                <span style="display:block; font-size:18px; font-weight:900; line-height:1.1;">Orçamento Rápido</span>
                <span style="display:block; font-size:13px; color:#cc0000; font-weight:800;">Clique Aqui</span>
            </span>
        </a>
    @endif

</body>
</html>
