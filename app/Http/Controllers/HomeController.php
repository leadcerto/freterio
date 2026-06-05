<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Image;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $faqs = Faq::active()->get()->map(fn($faq) => $faq->resolveForNeighborhood('Rio de Janeiro'));

        $hasDestaque  = Image::active()->ofType('destaque')->exists();
        $fleetImage   = Image::active()->ofType('frota')->first();
        $hasWhatsappImg = Image::active()->ofType('whatsapp')->exists();

        $whatsapp = User::where('role', 'company')
            ->where('city', 'Rio de Janeiro')
            ->value('whatsapp') ?? '21981813106';

        $waMessage = urlencode('Olá, gostaria de um orçamento de frete no Rio de Janeiro!');

        return view('home.index', compact(
            'faqs', 'hasDestaque', 'fleetImage', 'hasWhatsappImg', 'whatsapp', 'waMessage'
        ));
    }
}
