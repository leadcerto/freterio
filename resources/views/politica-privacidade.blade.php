@extends('layouts.public')

@section('meta_title', 'Política de Privacidade | Frete Rio')
@section('meta_description', 'Política de privacidade do site Frete Rio. Saiba como coletamos e usamos seus dados em conformidade com a LGPD.')
@section('canonical', url('/politica-de-privacidade'))

@section('content')
<div style="max-width: 860px; margin: 0 auto; padding: 48px 24px 80px;">

    <h1 style="font-size: 28px; font-weight: 800; color: #0170B9; margin-bottom: 8px;">Política de Privacidade</h1>
    <p style="color: #6b7280; font-size: 14px; margin-bottom: 40px;">Última atualização: {{ date('d/m/Y') }}</p>

    @php
    $sections = [
        [
            'title' => '1. Quem somos',
            'text'  => 'A <strong>Frete Rio</strong> é uma empresa de fretes e mudanças que atua em todo o <strong>Estado do Rio de Janeiro</strong> e realiza viagens interestaduais entre o Rio de Janeiro e os estados de <strong>São Paulo</strong>, <strong>Minas Gerais</strong> e <strong>Espírito Santo</strong>. Este site (<strong>frete.rio.br</strong>) é operado pela Frete Rio e tem como objetivo apresentar nossos serviços e facilitar o contato de clientes via WhatsApp.',
        ],
        [
            'title' => '2. Dados que coletamos',
            'text'  => 'Não coletamos dados pessoais identificáveis diretamente neste site (como nome, e-mail ou CPF). Ao clicar no botão do WhatsApp, você é direcionado ao aplicativo WhatsApp, onde o tratamento de dados é regido pela política de privacidade do próprio WhatsApp.<br><br>Utilizamos ferramentas de análise que coletam dados de forma anônima e agregada:<ul style="margin:12px 0 0 20px; list-style:disc;"><li style="margin-bottom:6px;"><strong>Google Analytics 4 (GA4):</strong> registra páginas visitadas, tempo de navegação, origem do acesso, dispositivo e interações como cliques e rolagem de tela — sem identificar o usuário individualmente.</li><li style="margin-bottom:6px;"><strong>Google Places API:</strong> usada para buscar e exibir avaliações públicas do Google Meu Negócio das nossas filiais.</li></ul>',
        ],
        [
            'title' => '3. Cookies',
            'text'  => 'Este site utiliza cookies de análise do Google Analytics para entender como os visitantes interagem com o conteúdo. Os cookies são pequenos arquivos armazenados no seu navegador. Você pode desativá-los a qualquer momento nas configurações do seu navegador.<br><br>Não utilizamos cookies de publicidade ou rastreamento de terceiros além do Google Analytics.',
        ],
        [
            'title' => '4. Como usamos os dados',
            'text'  => 'As informações coletadas pelo Google Analytics são usadas exclusivamente para:<ul style="margin:12px 0 0 20px; list-style:disc;"><li style="margin-bottom:6px;">Entender quais páginas e bairros recebem mais visitas;</li><li style="margin-bottom:6px;">Melhorar a experiência de navegação;</li><li style="margin-bottom:6px;">Identificar quais botões de WhatsApp são mais clicados;</li><li style="margin-bottom:6px;">Aprimorar nosso conteúdo e serviços.</li></ul>Não vendemos, alugamos ou compartilhamos dados com terceiros para fins comerciais.',
        ],
        [
            'title' => '5. Base legal (LGPD)',
            'text'  => 'O tratamento de dados neste site é realizado com base no <strong>legítimo interesse</strong> (art. 7º, IX da Lei 13.709/2018 — LGPD), especificamente para análise de desempenho do site e melhoria dos nossos serviços, de forma que não prejudica os direitos e liberdades fundamentais dos titulares.',
        ],
        [
            'title' => '6. Seus direitos',
            'text'  => 'Nos termos da LGPD, você tem direito a:<ul style="margin:12px 0 0 20px; list-style:disc;"><li style="margin-bottom:6px;">Confirmar se seus dados são tratados;</li><li style="margin-bottom:6px;">Solicitar acesso, correção ou exclusão dos dados;</li><li style="margin-bottom:6px;">Revogar consentimento a qualquer momento;</li><li style="margin-bottom:6px;">Opor-se ao tratamento realizado com base em legítimo interesse.</li></ul>Como não coletamos dados pessoais identificáveis diretamente, a maioria dessas solicitações deve ser direcionada ao Google (para dados do Analytics). Para dados coletados via WhatsApp, consulte a política do WhatsApp.',
        ],
        [
            'title' => '7. Retenção de dados',
            'text'  => 'Os dados coletados pelo Google Analytics são retidos conforme as configurações padrão da plataforma (até 14 meses). As avaliações do Google Places são atualizadas periodicamente e armazenadas em nosso servidor apenas para exibição no site.',
        ],
        [
            'title' => '8. Segurança',
            'text'  => 'Este site utiliza protocolo <strong>HTTPS</strong> (certificado SSL) para garantir que os dados trafeguem de forma criptografada entre seu navegador e nosso servidor.',
        ],
        [
            'title' => '9. Links externos',
            'text'  => 'Nosso site contém links para o WhatsApp (wa.me) e para o YouTube (youtube.com). Ao acessar esses serviços, você estará sujeito às políticas de privacidade dessas plataformas, sobre as quais não temos controle.',
        ],
        [
            'title' => '10. Contato',
            'text'  => 'Para exercer seus direitos ou esclarecer dúvidas sobre esta política, entre em contato:<br><br><strong>Frete Rio</strong><br>E-mail: <a href="mailto:sac@frete.rio.br" style="color:#0170B9;">sac@frete.rio.br</a><br>WhatsApp: <a href="https://wa.me/5521981813106" target="_blank" rel="noopener" style="color:#0170B9;">(21) 98181-3106</a>',
        ],
    ];
    @endphp

    @foreach($sections as $section)
    <div style="margin-bottom: 36px;">
        <h2 style="font-size: 17px; font-weight: 700; color: #1f2937; margin-bottom: 12px; padding-bottom: 8px; border-bottom: 2px solid #e5e7eb;">
            {{ $section['title'] }}
        </h2>
        <p style="color: #374151; font-size: 15px; line-height: 1.75;">{!! $section['text'] !!}</p>
    </div>
    @endforeach

    <div style="margin-top: 48px; padding: 20px 24px; background: #f0f7ff; border-radius: 10px; border-left: 4px solid #0170B9;">
        <p style="color: #1e3a5f; font-size: 14px; margin: 0;">
            Esta política pode ser atualizada periodicamente. Recomendamos revisitá-la de tempos em tempos.
            A data da última atualização está indicada no topo desta página.
        </p>
    </div>

</div>
@endsection
