<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoPattern;
use Illuminate\Http\Request;

class SeoPatternController extends Controller
{
    public function index()
    {
        $patterns = SeoPattern::orderBy('ordem')->get();
        return view('admin.seo-patterns.index', compact('patterns'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'rotulo'      => 'required|string|max:100',
            'title'       => 'required|string|max:100',
            'description' => 'required|string|max:200',
            'og_image'    => 'nullable|url|max:500',
            'ordem'       => 'required|integer|min:0',
        ]);

        $data['ativo'] = $request->boolean('ativo', true);

        SeoPattern::create($data);

        return back()->with('success', 'Padrão de SEO criado com sucesso!');
    }

    public function update(Request $request, SeoPattern $seoPattern)
    {
        $data = $request->validate([
            'rotulo'      => 'required|string|max:100',
            'title'       => 'required|string|max:100',
            'description' => 'required|string|max:200',
            'og_image'    => 'nullable|url|max:500',
            'ordem'       => 'required|integer|min:0',
        ]);

        $data['ativo'] = $request->boolean('ativo', true);
        $seoPattern->update($data);

        return back()->with('success', 'Padrão de SEO atualizado!');
    }

    public function toggle(SeoPattern $seoPattern)
    {
        $seoPattern->update(['ativo' => ! $seoPattern->ativo]);
        return back()->with('success', 'Status alterado!');
    }

    public function destroy(SeoPattern $seoPattern)
    {
        $seoPattern->delete();
        return back()->with('success', 'Padrão de SEO removido.');
    }
}
