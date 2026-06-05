<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Neighborhood;
use App\Models\UrlPattern;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UrlPatternController extends Controller
{
    public function index(Request $request)
    {
        $patterns = UrlPattern::orderBy('order')->get();

        // Preview: gera todos os links para um bairro de exemplo
        $previewSlug = $request->get('preview', 'copacabana');
        $previewNeighborhood = Neighborhood::active()->where('slug', $previewSlug)->first()
            ?? Neighborhood::active()->first();

        return view('admin.url-patterns.index', compact('patterns', 'previewNeighborhood'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'prefix'    => 'nullable|string|max:100',
            'suffix'    => 'nullable|string|max:100',
            'label'     => 'required|string|max:100',
            'order'     => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data['prefix']    = $data['prefix'] ?? '';
        $data['suffix']    = $data['suffix'] ?? '';
        $data['is_active'] = $request->boolean('is_active', true);

        UrlPattern::create($data);

        Cache::forget('url_patterns_active');

        return back()->with('success', 'Padrão de link criado!');
    }

    public function update(Request $request, UrlPattern $urlPattern)
    {
        $data = $request->validate([
            'prefix'    => 'nullable|string|max:100',
            'suffix'    => 'nullable|string|max:100',
            'label'     => 'required|string|max:100',
            'order'     => 'required|integer|min:0',
        ]);

        $data['prefix'] = $data['prefix'] ?? '';
        $data['suffix'] = $data['suffix'] ?? '';
        $urlPattern->update($data);

        Cache::forget('url_patterns_active');

        return back()->with('success', 'Padrão atualizado!');
    }

    public function toggle(UrlPattern $urlPattern)
    {
        $urlPattern->update(['is_active' => ! $urlPattern->is_active]);
        Cache::forget('url_patterns_active');
        return back()->with('success', 'Status alterado!');
    }

    public function destroy(UrlPattern $urlPattern)
    {
        $urlPattern->delete();
        Cache::forget('url_patterns_active');
        return back()->with('success', 'Padrão removido.');
    }
}
