<?php

namespace Database\Seeders;

use App\Models\Neighborhood;
use Illuminate\Database\Seeder;

class BarraDaTijucaSampleSeeder extends Seeder
{
    public function run(): void
    {
        $n = Neighborhood::where('slug', 'barra-da-tijuca')->first();
        if (! $n) {
            return;
        }

        $n->location_text = 'O bairro da Barra da Tijuca está localizado na Zona Oeste do município do Rio de Janeiro, no Estado do Rio de Janeiro. É um dos bairros mais modernos e populosos da cidade, conhecido por suas praias, seus condomínios de luxo e sua vida noturna agitada.';

        $n->nearby_neighborhoods = "Os bairros ao redor da Barra da Tijuca são:\n\nRecreiro dos Bandeirantes: Um bairro residencial com uma grande quantidade de casas e prédios, conhecido por suas praias e por abrigar o Parque Nacional da Tijuca.\nVargem Grande: Um bairro com uma grande área verde, conhecido por seus restaurantes, bares e vida noturna.\nJacarepaguá: Um bairro com uma grande variedade de opções de lazer, como trilhas, praias e restaurantes.\nCamorim: Um bairro residencial com atmosfera tranquila e o Parque Natural Municipal de Camorim.\nJoá: Um bairro com grande área verde, conhecido por seus restaurantes e vida noturna.";

        $n->main_streets = "Principais Ruas e Avenidas da Barra da Tijuca:\n\nAvenida das Américas: A principal via de acesso, conectando a Barra da Tijuca à Zona Sul e à Zona Oeste.\nAvenida Lúcio Costa: Uma das principais vias, com comércio variado e acesso a outras ruas importantes.\nAvenida Armando Lombardi: Via importante com comércio variado.";

        $n->shortest_routes = "Barra da Tijuca – Aeroporto Santos Dumont:\nCarro: Avenida das Américas em direção à Zona Sul, seguindo pela Avenida Presidente Vargas.\nÔnibus: Linhas que passam pela Avenida das Américas, como a 474.\n\nBarra da Tijuca – Aeroporto Tom Jobim:\nCarro: Avenida das Américas em direção à Zona Oeste, seguindo pela Linha Amarela até o Galeão.\nÔnibus: Linhas pela Avenida das Américas, como a 474, até o Aeroporto Tom Jobim.\n\nBarra da Tijuca – Rodoviária Novo Rio:\nCarro: Avenida das Américas em direção à Zona Sul, seguindo pela Avenida Presidente Vargas.\nÔnibus: Linhas pela Avenida das Américas até a Rodoviária Novo Rio.";

        $n->access_notes = 'As rotas e tempos de viagem podem variar dependendo do trânsito e da hora do dia. É recomendável consultar aplicativos de navegação para obter informações mais precisas. As informações acima são apenas indicativas e podem ser modificadas sem aviso prévio.';

        $n->save();

        $this->command->info('Barra da Tijuca atualizada com conteúdo de exemplo!');
    }
}
