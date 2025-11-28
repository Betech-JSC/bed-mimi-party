<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use Illuminate\Routing\Controller;
use App\Models\Post\Post;

class HomeController extends Controller
{
    public function index()
    {
        try {

            $rooms_featured = Post::query()
                ->active()
                ->whereRoom()
                ->IsFeatured()
                ->get()
                ->map(fn($item) => $item->transform());

            $promotions = Post::query()
                ->active()
                ->wherePromotion()
                ->IsFeatured()
                ->get()
                ->map(fn($item) => $item->transform());

            $data = [
                'rooms_featured' => $rooms_featured,
                'promotions' => $promotions,
            ];

            return Inertia::render('Home', $data);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
