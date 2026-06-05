<?php

namespace Database\Seeders;

use App\Models\UrlPattern;
use Illuminate\Database\Seeder;

class UrlPatternSeeder extends Seeder
{
    public function run(): void
    {
        $patterns = [
            // prefix, suffix, label, order
            ['',                             '',                  'Frete',                            1],
            ['frete',                        '',                  'Frete',                            2],
            ['mudanca',                      '',                  'Mudança',                          3],
            ['frete-mudanca',                '',                  'Frete e Mudança',                  4],
            ['frete-mudanca',                'rio-de-janeiro-rj', 'Frete e Mudança',                  5],
            ['pequenos-fretes',              '',                  'Pequenos Fretes',                  6],
            ['frete',                        'rio-de-janeiro-rj', 'Frete',                            7],
            ['fretes-e-cargas',              '',                  'Fretes e Cargas',                  8],
            ['fretes-e-cargas',              'rio-de-janeiro-rj', 'Fretes e Cargas',                  9],
            ['orcamento-frete',              'rio-de-janeiro-rj', 'Orçamento de Frete',               10],
            ['calcular-frete',               'rio-de-janeiro-rj', 'Calcular Frete',                   11],
            ['frete-olx',                    '',                  'Frete OLX',                        12],
            ['frete-olx-mudanca',            '',                  'Frete OLX Mudança',                13],
            ['olx-frete',                    '',                  'Frete OLX',                        14],
            ['olx-frete',                    'rio-de-janeiro-rj', 'Frete OLX',                        15],
            ['frete-barato',                 '',                  'Frete Barato',                     16],
            ['frete-barato',                 'rio-de-janeiro-rj', 'Frete Barato',                     17],
            ['frete-rapido',                 'rio-de-janeiro-rj', 'Frete Rápido',                     18],
            ['frete-e-mudancas',             'rio-de-janeiro-rj', 'Frete e Mudanças',                 19],
            ['frete-orcamento-online',       'rio-de-janeiro-rj', 'Orçamento de Frete Online',        20],
            ['frete-orcamento-online-gratis','rio-de-janeiro-rj', 'Orçamento de Frete Online Grátis', 21],
            ['frete-economico',              'rio-de-janeiro-rj', 'Frete Econômico',                  22],
            ['mudancas-economicas',          'rio-de-janeiro-rj', 'Mudanças Econômicas',              23],
            ['frete-rapido-confiavel',       'rio-de-janeiro-rj', 'Frete Rápido e Confiável',         24],
            ['frete-rapido-e-seguro',        'rio-de-janeiro-rj', 'Frete Rápido e Seguro',            25],
            ['frete-carga-rapida',           'rio-de-janeiro-rj', 'Frete para Carga Rápida',          26],
        ];

        foreach ($patterns as [$prefix, $suffix, $label, $order]) {
            UrlPattern::firstOrCreate(
                ['prefix' => $prefix, 'suffix' => $suffix],
                ['label' => $label, 'order' => $order, 'is_active' => true]
            );
        }
    }
}
