<?php

namespace App\Http\Controllers;

use App\Models\Neighborhood;
use App\Models\UrlPattern;

class SitemapController extends Controller
{
    public function index()
    {
        $neighborhoods = Neighborhood::active()->select('slug', 'updated_at')->get();
        $patterns      = UrlPattern::active()->get();

        return response()
            ->view('sitemap', compact('neighborhoods', 'patterns'))
            ->header('Content-Type', 'application/xml');
    }
}
