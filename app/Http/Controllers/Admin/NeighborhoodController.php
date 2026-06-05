<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Neighborhood;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NeighborhoodController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Neighborhood::withTrashed()->with('user');

        if (! $user->isAdmin()) {
            $query->where('user_id', $user->id);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $neighborhoods = $query->orderBy('name')->paginate(30)->withQueryString();

        return view('admin.neighborhoods.index', compact('neighborhoods'));
    }

    public function create()
    {
        return view('admin.neighborhoods.form', ['neighborhood' => new Neighborhood]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'                 => 'required|string|max:255',
            'city'                 => 'required|string|max:255',
            'state'                => 'required|string|max:2',
            'meta_title'           => 'nullable|string|max:255',
            'meta_description'     => 'nullable|string|max:500',
            'location_text'        => 'nullable|string',
            'nearby_neighborhoods' => 'nullable|string',
            'main_streets'         => 'nullable|string',
            'shortest_routes'      => 'nullable|string',
            'access_notes'         => 'nullable|string',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['user_id'] = auth()->id();
        $data['is_active'] = true;

        Neighborhood::create($data);

        return redirect()->route('admin.neighborhoods.index')->with('success', 'Bairro criado com sucesso!');
    }

    public function edit(Neighborhood $neighborhood)
    {
        $this->authorizeNeighborhood($neighborhood);
        return view('admin.neighborhoods.form', compact('neighborhood'));
    }

    public function update(Request $request, Neighborhood $neighborhood)
    {
        $this->authorizeNeighborhood($neighborhood);

        $data = $request->validate([
            'name'                 => 'required|string|max:255',
            'city'                 => 'required|string|max:255',
            'state'                => 'required|string|max:2',
            'meta_title'           => 'nullable|string|max:255',
            'meta_description'     => 'nullable|string|max:500',
            'location_text'        => 'nullable|string',
            'nearby_neighborhoods' => 'nullable|string',
            'main_streets'         => 'nullable|string',
            'shortest_routes'      => 'nullable|string',
            'access_notes'         => 'nullable|string',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $neighborhood->update($data);

        return redirect()->route('admin.neighborhoods.index')->with('success', 'Bairro atualizado!');
    }

    public function toggle(Neighborhood $neighborhood)
    {
        $this->authorizeNeighborhood($neighborhood);
        $neighborhood->update(['is_active' => ! $neighborhood->is_active]);

        return back()->with('success', 'Status do bairro alterado!');
    }

    public function destroy(Neighborhood $neighborhood)
    {
        $this->authorizeNeighborhood($neighborhood);
        $neighborhood->delete(); // SoftDelete
        return back()->with('success', 'Bairro desativado (soft delete).');
    }

    private function authorizeNeighborhood(Neighborhood $neighborhood): void
    {
        $user = auth()->user();
        if (! $user->isAdmin() && $neighborhood->user_id !== $user->id) {
            abort(403);
        }
    }
}
