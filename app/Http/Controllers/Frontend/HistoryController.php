<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post\Post;
use Inertia\Inertia;
use Illuminate\Routing\Controller;


class HistoryController extends Controller
{
    public function index()
    {

        $posts = Post::query()
            ->active()
            ->activeCategories()
            ->where('is_featured', 1)
            ->orderByPosition()
            ->take(1)
            ->get()
            ->map(fn($item) => $item->transform());


        $data = [
            'posts' => $posts,
        ];

        if (request()->wantsJson()) {
            return response()->json($data);
        }

        return Inertia::render('About', $data);
    }
}
