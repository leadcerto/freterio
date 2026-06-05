<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Quanto custa um frete em {bairro}?',
                'answer'   => 'O valor do frete em {bairro} varia conforme a distância, o volume e o tipo de serviço. Entre em contato pelo WhatsApp e receba um orçamento rápido e gratuito em minutos.',
                'order'    => 1,
            ],
            [
                'question' => 'Como é calculado o preço do frete em {bairro}?',
                'answer'   => 'O preço é calculado com base no peso e volume da carga, distância percorrida, tipo de veículo necessário e serviços adicionais (empacotamento, carregadores). Fazemos uma análise personalizada para {bairro}.',
                'order'    => 2,
            ],
            [
                'question' => 'Vocês oferecem serviço de embalagem em {bairro}?',
                'answer'   => 'Só embalamos itens frágeis como TVs, espelhos, vidros e quadros. Os demais itens são protegidos por cobertores dentro do caminhão. Não organizamos em caixas — tudo já deve estar encaixotado antes da coleta.',
                'order'    => 3,
            ],
            [
                'question' => 'Qual o prazo para agendar um frete em {bairro}?',
                'answer'   => 'Atendemos com agendamento ou, dependendo da disponibilidade, no mesmo dia. Consulte pelo WhatsApp a disponibilidade para {bairro}.',
                'order'    => 4,
            ],
            [
                'question' => 'Vocês fazem mudanças residenciais em {bairro}?',
                'answer'   => 'Sim! Realizamos mudanças residenciais completas em {bairro} com veículos de diferentes tamanhos, carregadores profissionais e equipamentos de proteção (cobertores, cintas, carrinhos).',
                'order'    => 5,
            ],
            [
                'question' => 'Atendem finais de semana e feriados em {bairro}?',
                'answer'   => 'Sim, atendemos finais de semana e feriados em {bairro}. Consulte a disponibilidade pelo WhatsApp com antecedência.',
                'order'    => 6,
            ],
            [
                'question' => 'Qual o menor e maior veículo disponível?',
                'answer'   => 'Nossa frota vai de veículos para cargas leves (até 300kg) até caminhões para mudanças pesadas (até 4.500kg). Temos o carro certo para cada necessidade.',
                'order'    => 7,
            ],
            [
                'question' => 'O seguro da carga está incluído?',
                'answer'   => 'Trabalhamos com todo o cuidado para garantir a integridade da sua carga. Consulte os detalhes sobre cobertura de seguro ao solicitar seu orçamento.',
                'order'    => 8,
            ],
            [
                'question' => 'Fazem fretes para outras cidades saindo de {bairro}?',
                'answer'   => 'Sim! Realizamos fretes e mudanças intermunicipais saindo de {bairro} para outras cidades do estado do Rio de Janeiro e também para outros estados.',
                'order'    => 9,
            ],
            [
                'question' => 'Como faço para pedir um orçamento?',
                'answer'   => 'É simples! Clique no botão do WhatsApp, descreva o que você precisa transportar em {bairro} e em minutos enviamos uma proposta personalizada.',
                'order'    => 10,
            ],
            [
                'question' => 'Vocês têm avaliações de clientes?',
                'answer'   => 'Sim! Somos avaliados com 5 estrelas no Google desde 2019, com mais de 285 clientes satisfeitos. Você pode consultar as avaliações diretamente no nosso perfil do Google.',
                'order'    => 11,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::firstOrCreate(
                ['question' => $faq['question']],
                array_merge($faq, ['is_active' => true])
            );
        }
    }
}
