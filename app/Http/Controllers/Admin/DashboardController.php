<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Image;
use App\Models\Neighborhood;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $neighborhoodsQuery = Neighborhood::withTrashed();
        if (! $user->isAdmin()) {
            $neighborhoodsQuery->where('user_id', $user->id);
        }

        $stats = [
            'neighborhoods_active'   => (clone $neighborhoodsQuery)->where('is_active', true)->count(),
            'neighborhoods_inactive' => (clone $neighborhoodsQuery)->where('is_active', false)->count(),
            'faqs'                   => Faq::count(),
            'images'                 => $user->isAdmin() ? Image::count() : Image::where('user_id', $user->id)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
