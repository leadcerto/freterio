<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('order')->paginate(20);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.form', ['faq' => new Faq]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question'  => 'required|string',
            'answer'    => 'required|string',
            'order'     => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        Faq::create($data);

        return redirect()->route('admin.faqs.index')->with('success', 'Pergunta criada!');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.form', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'question'  => 'required|string',
            'answer'    => 'required|string',
            'order'     => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $faq->update($data);

        return redirect()->route('admin.faqs.index')->with('success', 'Pergunta atualizada!');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return back()->with('success', 'Pergunta removida.');
    }
}
