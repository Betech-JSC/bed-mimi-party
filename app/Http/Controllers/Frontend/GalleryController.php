<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post\Post;
use Inertia\Inertia;
use Illuminate\Routing\Controller;

class GalleryController extends Controller
{
    public function index()
    {
        try {
            $gallery = Post::query()
                ->active()
                ->whereGalley()
                ->get()
                ->map(fn($item) => $item->transform());

            $data = [
                'galleries' => $gallery,
            ];

            if (request()->wantsJson()) {
                return response()->json($data);
            }

            return Inertia::render('Gallery', $data);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
