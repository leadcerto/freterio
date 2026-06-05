@extends('layouts.neighborhood')

@section('meta_title', $metaTitle)
@section('meta_description', $metaDescription)
@section('canonical', url()->current())

@if($ogImage)
@push('og_meta')
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
<meta name="twitter:image" content="{{ $ogImage }}">
@endpush
@endif

@push('head')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Frete Rio",
      "item": "https://frete.rio.br"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "{{ e($neighborhood->name) }}",
      "item": "{{ url()->current() }}"
    }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "@id": "{{ url()->current() }}#service",
  "name": "{{ e($h1) }}",
  "provider": { "@id": "https://frete.rio.br/#business" },
  "serviceType": "{{ e($serviceLabel) }}",
  "areaServed": {
    "@type": "Place",
    "name": "{{ e($neighborhood->name) }}, Rio de Janeiro, RJ"
  },
  "url": "{{ url()->current() }}",
  "description": "{{ e($metaDescription) }}"
}
</script>
@verbatim
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "VideoObject",
  "name": "Frete e Mudança no Rio de Janeiro — Frete Rio",
  "description": "Conheça os serviços de frete, mudança e transporte da Frete Rio no Rio de Janeiro. Equipe profissional, pontual e com avaliação 5 estrelas no Google.",
  "thumbnailUrl": "https://i.ytimg.com/vi/RIYUmJ6oLa8/maxresdefault.jpg",
  "uploadDate": "2024-03-26",
  "embedUrl": "https://www.youtube.com/embed/RIYUmJ6oLa8",
  "contentUrl": "https://www.youtube.com/watch?v=RIYUmJ6oLa8"
}
</script>
@endverbatim
@endpush

@section('content')

{{-- ============================================================ --}}
{{-- PRIMEIRA DOBRA — fundo azul gradiente, igual ao original     --}}
{{-- ============================================================ --}}
<div style="min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; padding: 10px 16px 120px; text-align: center; position: relative;">

    {{-- Nome do bairro — topo esquerdo, pequeno --}}
    <p style="width: 100%; text-align: left; color: rgba(0,0,0,0.75); font-size: 12px; margin-bottom: 10px; padding: 0 4px;">
        {{ $neighborhood->name }}
    </p>

    {{-- H1 centralizado --}}
    <h1 style="color: #1a1a1a; font-size: clamp(18px, 3vw, 26px); font-weight: 700; margin-bottom: 6px; line-height: 1.2; text-align: center;">
        {{ $neighborhood->name }}
    </h1>

    {{-- Subtítulo --}}
    <p style="color: #1a1a1a; font-size: clamp(13px, 2vw, 16px); font-weight: 700; margin-bottom: 24px; line-height: 1.4; text-align: center;">
        Temos o carro certo para o seu serviço<br>
        Frete Mudança Transporte
    </p>

    {{-- IMAGEM DA FROTA --}}
    @if($fleetImage)
        <img src="{{ Storage::url($fleetImage->path) }}"
             alt="Frota de veículos para {{ $serviceLabel }} em {{ $neighborhood->name }}"
             title="{{ $h1 }} — Frete Rio"
             fetchpriority="high"
             decoding="async"
             style="width: 100%; max-width: 600px; height: auto; margin: 0 auto; display: block; object-fit: contain; flex: 1;">
    @else
        {{-- Placeholder: 5 veículos numerados em vermelho --}}
        <div style="position: relative; width: 100%; max-width: 560px; height: 320px; margin: 0 auto;">

            {{-- Veículo 1 — topo esquerdo --}}
            <div style="position: absolute; top: 0; left: 10%;">
                <span style="color: #cc0000; font-size: 22px; font-weight: 900; font-style: italic;">1</span>
                <div style="background: rgba(255,255,255,0.25); border-radius: 10px; padding: 10px 18px; color: #fff; font-size: 11px; margin-top: 2px;">
                    Até 300kg
                </div>
            </div>

            {{-- Veículo 2 — topo direito --}}
            <div style="position: absolute; top: 0; right: 10%;">
                <span style="color: #cc0000; font-size: 22px; font-weight: 900; font-style: italic;">2</span>
                <div style="background: rgba(255,255,255,0.25); border-radius: 10px; padding: 10px 18px; color: #fff; font-size: 11px; margin-top: 2px;">
                    Até 700kg
                </div>
            </div>

            {{-- Veículo 3 — meio esquerdo --}}
            <div style="position: absolute; top: 35%; left: 5%;">
                <span style="color: #cc0000; font-size: 22px; font-weight: 900; font-style: italic;">3</span>
                <div style="background: rgba(255,255,255,0.25); border-radius: 10px; padding: 10px 18px; color: #fff; font-size: 11px; margin-top: 2px;">
                    Até 1.500kg
                </div>
            </div>

            {{-- Veículo 4 — meio direito --}}
            <div style="position: absolute; top: 35%; right: 5%;">
                <span style="color: #cc0000; font-size: 22px; font-weight: 900; font-style: italic;">4</span>
                <div style="background: rgba(255,255,255,0.25); border-radius: 10px; padding: 10px 18px; color: #fff; font-size: 11px; margin-top: 2px;">
                    Até 2.500kg
                </div>
            </div>

            {{-- Veículo 5 — centro baixo --}}
            <div style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%);">
                <span style="color: #cc0000; font-size: 22px; font-weight: 900; font-style: italic;">5</span>
                <div style="background: rgba(255,255,255,0.25); border-radius: 10px; padding: 10px 18px; color: #fff; font-size: 11px; margin-top: 2px;">
                    Até 4.500kg
                </div>
            </div>

        </div>
    @endif

</div>

{{-- ============================================================ --}}
{{-- SEGUNDA DOBRA — NOSSA FROTA                                  --}}
{{-- ============================================================ --}}
@php
$veiculos = [
    [
        'num'  => 1,
        'cap'  => 'Até 300Kg',
        'desc' => '<strong>Ideal para pequenas cargas.</strong> Facilidade de transitar pela cidade em horários de trânsito e acessar ruas de difícil acesso.',
        'comp' => '1 metro',
        'larg' => '1,20m',
        'alt'  => '1,80m',
        'msg'  => 'Olá! Estou precisando de um orçamento de Frete *Carro-01* Pode me, ajudar?',
    ],
    [
        'num'  => 2,
        'cap'  => 'Até 400Kg',
        'desc' => '<strong>Ideal para cargas médias.</strong> Facilidade de transitar pela cidade em horários de trânsito e acessar ruas de difícil acesso. Facilita o acesso em Garagens e ruas Estreitas; Ótimo para serviço em Eventos — levamos carga e até 4 pessoas no mesmo veículo.',
        'comp' => '2 metros',
        'larg' => '1,40m',
        'alt'  => '2,00m',
        'msg'  => 'Olá! Estou precisando de um orçamento de Frete *Carro-02* Pode me, ajudar?',
    ],
    [
        'num'  => 3,
        'cap'  => 'Até 1.500Kg',
        'desc' => '<strong>Ideal para cargas médias até 1.500Kg.</strong> Facilidade de transitar pela cidade; Utilizado em Pequenas Viagens para Municípios vizinhos; É o mais procurado por nossos clientes.',
        'comp' => '3 metros',
        'larg' => '2,20m',
        'alt'  => '2,00m',
        'msg'  => 'Olá! Estou precisando de um orçamento de Frete *Carro-03* Pode me, ajudar?',
    ],
    [
        'num'  => 4,
        'cap'  => 'Até 2.000Kg',
        'desc' => '<strong>Ideal para cargas médias até 2.500Kg.</strong> Perfeito para Mudanças maiores e entre longas distâncias; Utilizado em Pequenas Viagens para Municípios vizinhos e outros Estados da Região Sudeste.',
        'comp' => '6 metros',
        'larg' => '2,40m',
        'alt'  => '2,20m',
        'msg'  => 'Olá! Estou precisando de um orçamento de Frete *Carro-04* Pode me, ajudar?',
    ],
    [
        'num'  => 5,
        'cap'  => 'Até 2.500Kg',
        'desc' => '<strong>Ideal para cargas médias até 2.500Kg.</strong> Perfeito para Mudanças maiores e entre longas distâncias; Utilizado em Pequenas Viagens para Municípios vizinhos e outros Estados da Região Sudeste.',
        'comp' => '6 metros',
        'larg' => '2,40m',
        'alt'  => '2,20m',
        'msg'  => 'Olá! Estou precisando de um orçamento de Frete *Carro-05* Pode me, ajudar?',
    ],
];
@endphp

<section style="padding: 40px 20px 60px; background: rgba(0,0,0,0.08);">
    <div style="max-width: 1200px; margin: 0 auto;">

        <p style="text-align:center; color:#fff; font-weight:700; font-size:16px; margin-bottom:32px; letter-spacing:.5px;">
            Nossa Frota
        </p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 24px; align-items: start;">
            @foreach($veiculos as $v)
            <div style="text-align: left;">

                {{-- Imagem do veículo --}}
                @php
                    $imgVeiculo = \App\Models\Image::active()
                        ->ofType('veiculo_' . $v['num'])
                        ->first();
                @endphp
                @if($imgVeiculo)
                    <img src="{{ Storage::url($imgVeiculo->path) }}"
                         alt="Veículo {{ $v['num'] }} — {{ $v['cap'] }} para {{ $serviceLabel }} em {{ $neighborhood->name }}"
                         style="width:100%; max-height:140px; object-fit:contain; margin-bottom:16px; display:block;">
                @else
                    <div style="width:100%; height:120px; margin-bottom:16px; display:flex; align-items:center; justify-content:center; background:rgba(255,255,255,0.1); border-radius:10px;">
                        <span style="font-size:40px;">🚚</span>
                    </div>
                @endif

                {{-- Capacidade --}}
                <p style="color:#fff; font-size:18px; font-weight:700; margin-bottom:8px;">
                    {{ $v['cap'] }}
                </p>

                {{-- Descrição --}}
                <p style="color:rgba(255,255,255,0.85); font-size:13px; line-height:1.6; margin-bottom:12px;">
                    {!! $v['desc'] !!}
                </p>

                {{-- Dimensões --}}
                <p style="color:#fff; font-size:13px; font-weight:700; margin-bottom:4px;">Comprimento {{ $v['comp'] }}</p>
                <p style="color:#fff; font-size:13px; font-weight:700; margin-bottom:4px;">Largura {{ $v['larg'] }}</p>
                <p style="color:#fff; font-size:13px; font-weight:700; margin-bottom:20px;">Altura {{ $v['alt'] }}</p>

                {{-- Botão --}}
                <a href="https://api.whatsapp.com/send?phone=55{{ $whatsapp }}&text={{ urlencode($v['msg']) }}"
                   target="_blank" rel="noopener"
                   onclick="gtag('event','whatsapp_click',{'button':'veiculo_'+{{ $loop->index + 1 }},'page':window.location.pathname})"
                   style="display:inline-block; background:#c47b00; color:#fff; font-size:12px; font-weight:800; letter-spacing:.8px; padding:10px 18px; border-radius:6px; text-decoration:none; text-transform:uppercase;">
                    Solicite um Orçamento
                </a>

            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- SEÇÕES SEO (ABAIXO DA DOBRA)                                 --}}
{{-- ============================================================ --}}

{{-- SERVIÇOS --}}
<section style="padding: 60px 20px; background: rgba(0,0,0,0.18);">
    <div style="max-width: 960px; margin: 0 auto;">
        <h2 style="text-align:center; font-size: clamp(20px,3vw,28px); font-weight: 700; color: #fff; margin-bottom: 32px;">
            Frete Mudança Transporte em {{ $neighborhood->name }}
        </h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
            <div style="background:rgba(255,255,255,0.15); border-radius:16px; padding:24px; color:#fff;">
                <div style="font-size:28px; margin-bottom:10px;">📦</div>
                <h3 style="font-size:17px; font-weight:700; margin:0 0 8px;">Empacotamento</h3>
                <p style="font-size:14px; opacity:.9; margin:0; line-height:1.6;">Material completo e equipe especializada para proteger seus pertences.</p>
            </div>
            <div style="background:rgba(255,255,255,0.15); border-radius:16px; padding:24px; color:#fff;">
                <div style="font-size:28px; margin-bottom:10px;">💪</div>
                <h3 style="font-size:17px; font-weight:700; margin:0 0 8px;">Carregadores Profissionais</h3>
                <p style="font-size:14px; opacity:.9; margin:0; line-height:1.6;">Nossa equipe cuida do trabalho pesado com carrinhos, cobertores e cintas.</p>
            </div>
            <div style="background:rgba(255,255,255,0.15); border-radius:16px; padding:24px; color:#fff;">
                <div style="font-size:28px; margin-bottom:10px;">⭐</div>
                <h3 style="font-size:17px; font-weight:700; margin:0 0 8px;">Serviço 5 Estrelas</h3>
                <p style="font-size:14px; opacity:.9; margin:0; line-height:1.6;">5 estrelas no Google desde 2019. +285 clientes satisfeitos.</p>
            </div>
        </div>
    </div>
</section>

{{-- PROVA SOCIAL --}}
<section style="padding: 60px 20px; text-align: center; background: rgba(0,0,0,0.12);">
    <h2 style="font-size:clamp(22px,3vw,28px); font-weight:700; color:#fff; margin-bottom:12px;">+285 Clientes Satisfeitos</h2>
    <div style="display:flex; align-items:center; justify-content:center; gap:10px; margin-bottom:20px;">
        <span style="font-size:36px; font-weight:900; color:#fff;">5.0</span>
        <span style="font-size:28px;">⭐⭐⭐⭐⭐</span>
    </div>
</section>

{{-- DEPOIMENTOS DO GOOGLE --}}
@if($reviews->count())
<section id="secao-avaliacoes" style="padding: 60px 20px; background: rgba(0,0,0,0.15);">
    <div style="max-width: 960px; margin: 0 auto;">

        <p style="text-align:center; color:#fff; font-weight:700; font-size:16px; margin-bottom:6px; letter-spacing:.5px;">
            Depoimentos
        </p>
        <p style="text-align:center; color:rgba(255,255,255,0.65); font-size:13px; margin-bottom:32px;">
            O que nossos clientes dizem sobre o {{ $serviceLabel }} em {{ $neighborhood->name }}
        </p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
            @foreach($reviews as $review)
            <div style="background:rgba(255,255,255,0.12); border-radius:14px; padding:20px; border:1px solid rgba(255,255,255,0.12);">

                {{-- Cabeçalho: foto + nome + perfil --}}
                <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px;">
                    @if($review->profile_photo_url)
                        <img src="{{ $review->profile_photo_url }}"
                             alt="{{ $review->author_name }}"
                             loading="lazy"
                             decoding="async"
                             width="42" height="42"
                             style="width:42px; height:42px; border-radius:50%; object-fit:cover; flex-shrink:0;">
                    @else
                        <div style="width:42px; height:42px; border-radius:50%; background:rgba(255,255,255,0.25); display:flex; align-items:center; justify-content:center; font-weight:700; color:#fff; font-size:16px; flex-shrink:0;">
                            {{ mb_substr($review->author_name, 0, 1) }}
                        </div>
                    @endif
                    <div>
                        <p style="color:#fff; font-weight:600; font-size:13px; margin:0;">{{ $review->author_name }}</p>
                        <p style="color:rgba(255,255,255,0.75); font-size:11px; margin:2px 0 0;">
                            {{ $review->profile_name }} · {{ $review->relative_time_description }}
                        </p>
                    </div>
                </div>

                {{-- Estrelas --}}
                <div style="color:#fbbf24; font-size:14px; margin-bottom:10px; letter-spacing:1px;">
                    @for($i = 1; $i <= 5; $i++)
                        {{ $i <= $review->rating ? '★' : '☆' }}
                    @endfor
                </div>

                {{-- Texto --}}
                <p style="color:rgba(255,255,255,0.85); font-size:13px; line-height:1.65; margin:0;">
                    {{ $review->text }}
                </p>

            </div>
            @endforeach
        </div>

        {{-- Link para ver todas no Google --}}
        <p style="text-align:center; margin-top:28px;">
            <a href="https://www.google.com/maps/search/Frete+Rio+{{ urlencode($neighborhood->name) }}"
               target="_blank" rel="noopener"
               style="color:rgba(255,255,255,0.55); font-size:12px; text-decoration:underline;">
                Ver todas as avaliações no Google Maps →
            </a>
        </p>

    </div>
</section>
@endif

{{-- FAQ --}}
@if($faqs->count())
<section style="padding: 60px 20px; background: rgba(0,0,0,0.18);">
    <div style="max-width: 720px; margin: 0 auto;">
        <h2 style="font-size:clamp(20px,3vw,26px); font-weight:700; color:#fff; margin-bottom:8px; text-align:center;">Principais Dúvidas</h2>
        <p style="text-align:center; color:rgba(255,255,255,0.7); font-size:13px; margin-bottom:28px;">{{ $serviceLabel }} em {{ $neighborhood->name }}</p>
        @foreach($faqs as $faq)
        <details style="background:rgba(255,255,255,0.12); border-radius:12px; border:1px solid rgba(255,255,255,0.15); margin-bottom:8px; overflow:hidden;">
            <summary style="display:flex; align-items:center; justify-content:space-between; padding:14px 18px; font-weight:600; font-size:14px; color:#fff; cursor:pointer; list-style:none; gap:12px;">
                <h3 style="margin:0; font-size:14px; font-weight:600; text-align:left;">{{ $faq->question }}</h3>
                <span style="flex-shrink:0; color:rgba(255,255,255,0.5); font-size:12px;">▼</span>
            </summary>
            <div style="padding:14px 18px 16px; color:rgba(255,255,255,0.88); font-size:14px; border-top:1px solid rgba(255,255,255,0.1); line-height:1.6;">
                {{ $faq->answer }}
            </div>
        </details>
        @endforeach
    </div>
</section>
@endif

{{-- SOBRE O BAIRRO (SEO) --}}
@if($hasNeighborhoodInfo)
<section style="padding: 60px 20px; background: rgba(0,0,0,0.12);">
    <div style="max-width: 720px; margin: 0 auto;">
        <h2 style="font-size:clamp(20px,3vw,26px); font-weight:700; color:#fff; margin-bottom:8px; text-align:center;">Sobre {{ $neighborhood->name }}</h2>
        <p style="text-align:center; color:rgba(255,255,255,0.7); font-size:13px; margin-bottom:28px;">Informações sobre o bairro para planejar seu {{ $serviceLabel }}</p>
        @foreach([
            ['location_text',       '📍', 'Localização de '                . $neighborhood->name],
            ['nearby_neighborhoods','🗺️', 'Bairros Próximos a '           . $neighborhood->name],
            ['main_streets',        '🛣️', 'Principais Acessos em '        . $neighborhood->name],
            ['shortest_routes',     '⚡', 'Rotas Mais Rápidas saindo de ' . $neighborhood->name],
            ['access_notes',        'ℹ️', 'Observações sobre '            . $neighborhood->name],
        ] as [$field, $icon, $label])
            @if($neighborhoodTexts[$field])
            <details style="background:rgba(255,255,255,0.12); border-radius:12px; border:1px solid rgba(255,255,255,0.15); margin-bottom:8px; overflow:hidden;">
                <summary style="display:flex; align-items:center; justify-content:space-between; padding:14px 18px; font-weight:600; font-size:14px; color:#fff; cursor:pointer; list-style:none; gap:12px;">
                    <h3 style="margin:0; font-size:14px; font-weight:600; text-align:left;">{{ $icon }} {{ $label }}</h3>
                    <span style="flex-shrink:0; color:rgba(255,255,255,0.5); font-size:12px;">▼</span>
                </summary>
                <div style="padding:14px 18px 16px; color:rgba(255,255,255,0.88); font-size:14px; border-top:1px solid rgba(255,255,255,0.1); line-height:1.7;">
                    {!! $neighborhoodTexts[$field] !!}
                </div>
            </details>
            @endif
        @endforeach
    </div>
</section>
@endif

{{-- PERSONAL ORGANIZER --}}
<section style="padding: 60px 20px; background: rgba(0,0,0,0.12);">
    <div style="max-width: 960px; margin: 0 auto;">

        <p style="text-align:center; color:#fff; font-weight:700; font-size:16px; margin-bottom:32px; letter-spacing:.5px;">
            Personal Organizer
        </p>

        {{-- Duas colunas: texto + vídeo --}}
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start; margin-bottom: 40px;">

            <div style="color: rgba(255,255,255,0.9); font-size: 14px; line-height: 1.8;">
                <p style="margin-bottom: 16px;">
                    O Personal Organizer <strong style="color:#fff;">analisa, planeja e organiza de forma personalizada o espaço</strong>.
                    Ou seja, a tarefa vai além de uma arrumação comum: é necessário mapear a rotina do cliente,
                    entender quais são os objetos mais usados e encontrar maneiras estratégicas de disposição
                    para tornar o ambiente o mais acessível possível.
                </p>
                <p>
                    Para saber quanto custa um Personal Organizer, tenha em mente que o preço médio da hora
                    é entre <strong style="color:#fff;">R$ 80,00 e R$ 200,00</strong>. Já por projeto, ele é calculado
                    com base no tempo que o profissional vai levar para finalizar o trabalho.
                </p>
            </div>

            <div id="yt-facade"
                 style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 12px; cursor: pointer; background:#000;"
                 onclick="gtag('event','youtube_play',{'video':'Personal Organizer — Frete Rio','page':window.location.pathname});this.innerHTML='<iframe src=\'https://www.youtube.com/embed/RIYUmJ6oLa8?autoplay=1\' title=\'Personal Organizer — Frete Rio\' frameborder=\'0\' allow=\'autoplay; encrypted-media; picture-in-picture\' allowfullscreen style=\'position:absolute;top:0;left:0;width:100%;height:100%;border-radius:12px;\'></iframe>'"
                 aria-label="Assistir vídeo: Personal Organizer — Frete Rio"
                 role="button"
                 tabindex="0">
                <img src="https://i.ytimg.com/vi/RIYUmJ6oLa8/maxresdefault.jpg"
                     alt="Personal Organizer — Frete Rio: clique para assistir"
                     loading="lazy"
                     decoding="async"
                     style="position:absolute; top:0; left:0; width:100%; height:100%; object-fit:cover; border-radius:12px;">
                <div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); width:64px; height:44px; background:#ff0000; border-radius:10px; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 16px rgba(0,0,0,.5);">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="white" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
                </div>
            </div>

        </div>

        {{-- FAQ Personal Organizer --}}
        @php
        $faqPO = [
            [
                'q' => 'Qual é a função do Personal Organizer?',
                'a' => 'O Personal Organizer analisa, planeja e organiza de forma personalizada o espaço. Ou seja, a tarefa vai além de uma arrumação comum: é necessário mapear a rotina do cliente, entender quais são os objetos mais usados e encontrar maneiras estratégicas de disposição para tornar o ambiente o mais acessível possível.',
            ],
            [
                'q' => 'Quais as vantagens de contratar um Personal Organizer?',
                'a' => 'A vantagem de contratar um Personal Organizer é que ele atua em conjunto com o cliente para entender as suas necessidades e transformar o seu espaço, de modo que isso tenha um reflexo positivo no seu cotidiano. Uma casa ou ambiente de trabalho organizado ajuda a aumentar a produtividade e a poupar tempo para executar tarefas realmente imprescindíveis.',
            ],
            [
                'q' => 'Porque contratar um Personal Organizer para minha Mudança?',
                'a' => 'Diversos clientes afirmam que a principal vantagem é economizar tempo, reduzir estresse, evitar prejuízos por não saber embalar corretamente e ter tudo organizado em um espaço onde tudo é novo de forma simples e rápida. Um consultor pode oferecer serviços de organização empresarial, pós-reforma, preparação de mudanças, malas e até pós-luto.',
            ],
            [
                'q' => 'O que não faz uma Personal Organizer?',
                'a' => 'Limpeza Pesada: Um Personal Organizer não é um profissional de limpeza. Eles não se dedicam a tarefas como esfregar pisos, lavar janelas ou fazer a limpeza pesada de uma casa. Se seu espaço precisa de uma limpeza profunda, é necessário contratar uma equipe de limpeza especializada.',
            ],
            [
                'q' => 'Quais os 5 motivos para contratar um Personal Organizer?',
                'a' => 'Se você está cansado de viver em um ambiente desorganizado, sem saber onde estão suas coisas, perdendo tempo procurando objetos e enfrentando estresse diário, está na hora de contratar um personal organizer. Esse profissional vai te entender e identificar quais suas necessidades e vai te ajudar em toda organização da sua mudança residencial, na organização do seu escritório empresarial e até na organização da sua loja física se for necessário.',
            ],
        ];
        @endphp

        <div style="max-width:720px; margin:0 auto;">
            @foreach($faqPO as $item)
            <details style="background:rgba(255,255,255,0.12); border-radius:12px; border:1px solid rgba(255,255,255,0.15); margin-bottom:8px; overflow:hidden;">
                <summary style="display:flex; align-items:center; justify-content:space-between; padding:14px 18px; font-weight:600; font-size:14px; color:#fff; cursor:pointer; list-style:none; gap:12px;">
                    <h3 style="margin:0; font-size:14px; font-weight:600; text-align:left;">{{ $item['q'] }}</h3>
                    <span style="flex-shrink:0; color:rgba(255,255,255,0.5); font-size:12px;">▼</span>
                </summary>
                <div style="padding:14px 18px 16px; color:rgba(255,255,255,0.88); font-size:14px; border-top:1px solid rgba(255,255,255,0.1); line-height:1.7;">
                    {{ $item['a'] }}
                </div>
            </details>
            @endforeach
        </div>

    </div>
</section>

{{-- FAQ 2 — DETALHADO --}}
@php
$faqsDetalhado = [
    [
        'q' => 'Quanto custa o serviço de frete, transporte para uma mudança residencial/comercial?',
        'a' => 'O orçamento do serviço considera diversos pontos como endereços, tamanho do caminhão a ser utilizado, quantidade de carregadores, o esforço de trabalho e outros valores que se façam necessários como pedágios, estacionamento, pernoite e outros. Por esse motivo não temos um valor exato — é preciso analisar cada situação para fazer o orçamento.',
    ],
    [
        'q' => 'Como é calculado o valor do frete? É por hora, por quilômetro percorrido ou por tamanho do caminhão?',
        'a' => 'Todos os serviços de frete, de transporte ou de uma mudança residencial/comercial são calculados com base em diversos critérios, e tanto o tempo, a quilometragem e o tamanho do carro a ser utilizado fazem parte desse cálculo. Também é calculado o trabalho a ser realizado e os fatores que dificultam o serviço, como escadas e dificuldade de acesso do caminhão.',
    ],
    [
        'q' => 'Vocês oferecem serviço de embalagem e empacotamento?',
        'a' => 'Atualmente só embalamos móveis e eletrodomésticos de grande e médio porte — não fazemos empacotamento de caixas e sacos. Indicamos que o cliente faça ou contrate pessoas de sua confiança, pois muitas vezes envolve itens pessoais, de valor pessoal e financeiro, sendo necessário tomar certos cuidados.',
    ],
    [
        'q' => 'Vocês oferecem serviço de desmontagem/montagem de móveis?',
        'a' => 'Oferecemos o serviço de montagem e desmontagem de móveis, mas precisamos de fotos externas e internas dos móveis para fazer um orçamento. Trabalhamos com profissional de móveis e não usamos nossos carregadores para esse serviço.',
    ],
    [
        'q' => 'Qual é o tamanho do caminhão disponível para a mudança?',
        'a' => 'Temos uma ampla frota e, na hora de enviar o orçamento, apresentaremos as alternativas suficientes para transportar todos os seus pertences.',
    ],
    [
        'q' => 'Quais são as medidas de segurança adotadas para proteger meus móveis e objetos durante o transporte?',
        'a' => 'Toda a carga é amarrada e organizada, além de ser protegida com cobertores, papelão e outros materiais necessários. Porém, alguns itens devem ser embalados separadamente — como vidros, TVs, objetos frágeis e quadros. Quando necessário, enviamos um orçamento adicional pelo serviço de embalagem.',
    ],
    [
        'q' => 'Vocês possuem seguro para cobrir danos ou extravios durante a mudança?',
        'a' => 'Não possuímos seguro da carga, uma vez que não temos como declarar item por item. Porém nosso cliente pode contratar o seguro diretamente com a seguradora de sua preferência.',
    ],
    [
        'q' => 'Quanto tempo leva para concluir uma mudança residencial/comercial?',
        'a' => 'O tempo dependerá do acesso nos locais de embarque e desembarque, do volume e peso dos itens, do número de carregadores e do tamanho do caminhão. Só teremos uma noção de tempo na hora em que fizermos o seu orçamento.',
    ],
    [
        'q' => 'É necessário agendar o serviço com antecedência?',
        'a' => 'Quanto maior a antecedência, maior a chance de conseguir agendar e mais fácil de organizar seu serviço. Mas só agende quando tiver certeza da data. Cobramos um "Sinal" ou "Taxa de reserva" de 20% do valor total do serviço. Caso haja cancelamento após a confirmação, essa taxa não será devolvida, uma vez que deixamos de vender nosso serviço na data e hora do seu agendamento.',
    ],
    [
        'q' => 'Vocês têm disponibilidade para os finais de semana?',
        'a' => 'Sim, trabalhamos nos fins de semana e feriados, porém com agendamento prévio.',
    ],
    [
        'q' => 'Quais são as formas de pagamento aceitas?',
        'a' => 'Trabalhamos com pagamento com desconto no PIX e com cartão de crédito, onde as taxas do cartão e juros de parcelamento ficam a cargo do cliente.',
    ],
    [
        'q' => 'É possível contratar carregadores adicionais para auxiliar na carga e descarga?',
        'a' => 'Sim, temos carro extra para envio de carregadores adicionais caso seja necessário — muito utilizado em imóveis cujo acesso é feito exclusivamente por escadas ou que possuem dificuldade de acesso.',
    ],
];
@endphp

<section style="padding: 60px 20px; background: rgba(0,0,0,0.2);">
    <div style="max-width: 720px; margin: 0 auto;">
        <h2 style="font-size:clamp(20px,3vw,26px); font-weight:700; color:#fff; margin-bottom:8px; text-align:center;">
            Dúvidas sobre Frete e Mudança em {{ $neighborhood->name }}
        </h2>
        <p style="text-align:center; color:rgba(255,255,255,0.7); font-size:13px; margin-bottom:28px;">
            Tudo o que você precisa saber antes de contratar
        </p>
        @foreach($faqsDetalhado as $item)
        <details style="background:rgba(255,255,255,0.12); border-radius:12px; border:1px solid rgba(255,255,255,0.15); margin-bottom:8px; overflow:hidden;">
            <summary style="display:flex; align-items:center; justify-content:space-between; padding:14px 18px; font-weight:600; font-size:14px; color:#fff; cursor:pointer; list-style:none; gap:12px;">
                <h3 style="margin:0; font-size:14px; font-weight:600; text-align:left;">{{ $item['q'] }}</h3>
                <span style="flex-shrink:0; color:rgba(255,255,255,0.5); font-size:12px;">▼</span>
            </summary>
            <div style="padding:14px 18px 16px; color:rgba(255,255,255,0.88); font-size:14px; border-top:1px solid rgba(255,255,255,0.1); line-height:1.7;">
                {{ $item['a'] }}
            </div>
        </details>
        @endforeach
    </div>
</section>

<script>
// Scroll até avaliações
(function(){
    var el = document.getElementById('secao-avaliacoes');
    if (!el) return;
    var fired = false;
    new IntersectionObserver(function(entries){
        if (!fired && entries[0].isIntersecting) {
            fired = true;
            gtag('event','scroll_avaliacoes',{'page':window.location.pathname});
        }
    }, {threshold: 0.3}).observe(el);
})();

// FAQ aberto
document.querySelectorAll('details').forEach(function(d){
    d.addEventListener('toggle', function(){
        if (d.open) {
            var q = d.querySelector('summary');
            gtag('event','faq_aberto',{'pergunta': q ? q.textContent.trim() : '','page':window.location.pathname});
        }
    });
});
</script>

@endsection
