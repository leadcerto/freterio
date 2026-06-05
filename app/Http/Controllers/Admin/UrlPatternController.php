<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Neighborhood;
use App\Models\SeoPattern;
use App\Models\UrlPattern;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UrlPatternController extends Controller
{
    public function index(Request $request)
    {
        $patterns = UrlPattern::with('seoPattern')->orderBy('order')->get();

        $previewSlug = $request->input('preview', 'copacabana');
        $previewNeighborhood = Neighborhood::active()->where('slug', $previewSlug)->first()
            ?? Neighborhood::active()->first();

        $seoPatterns = SeoPattern::ativo()->orderBy('ordem')->get();

        return view('admin.url-patterns.index', compact('patterns', 'previewNeighborhood', 'seoPatterns'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'url_template' => 'required|string|max:200',
            'label'        => 'required|string|max:100',
            'order'        => 'required|integer|min:0',
        ]);

        $data = $this->parseTemplate($request->input('url_template'));
        $data['label']     = $request->input('label');
        $data['order']     = $request->input('order');
        $data['is_active'] = $request->boolean('is_active', true);

        UrlPattern::create($data);
        Cache::forget('url_patterns_active');

        return back()->with('success', 'Padrão de link criado!');
    }

    public function update(Request $request, UrlPattern $urlPattern)
    {
        $request->validate([
            'url_template' => 'required|string|max:200',
            'label'        => 'required|string|max:100',
            'order'        => 'required|integer|min:0',
        ]);

        $data = $this->parseTemplate($request->input('url_template'));
        $data['label'] = $request->input('label');
        $data['order'] = $request->input('order');

        $urlPattern->update($data);
        Cache::forget('url_patterns_active');

        return back()->with('success', 'Padrão atualizado!');
    }

    private function parseTemplate(string $template): array
    {
        $template = trim($template, '/ ');
        $template = str_replace('{slug}', '{bairro}', $template);

        if (str_contains($template, '{bairro}')) {
            [$before, $after] = explode('{bairro}', $template, 2);
            return [
                'prefix' => rtrim($before, '-'),
                'suffix' => ltrim($after, '-'),
            ];
        }

        return ['prefix' => $template, 'suffix' => ''];
    }

    public function assignSeo(Request $request, UrlPattern $urlPattern)
    {
        $data = $request->validate([
            'seo_pattern_id' => 'nullable|exists:seo_patterns,id',
        ]);

        $urlPattern->update(['seo_pattern_id' => $data['seo_pattern_id'] ?: null]);
        Cache::forget('url_patterns_active');

        return back()->with('success', 'Vínculo de SEO salvo!');
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
