<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use Inertia\Inertia;
use Illuminate\Routing\Controller;


class PromotionController extends Controller
{
    public $model = Post::class;

    public function index()
    {
        try {

            $promotions_featured = Post::query()
                ->active()
                ->orderByPosition()
                ->wherePromotion()
                ->IsFeatured()
                ->get()
                ->map(fn($item) => $item->transform());

            $promotions = Post::query()
                ->active()
                ->orderByPosition()
                ->wherePromotion()
                ->get()
                ->map(fn($item) => $item->transform());

            $data = [
                'promotions_featured' => $promotions_featured,
                'promotions' => $promotions,
            ];

            if (request()->wantsJson()) {
                return response()->json($data);
            }

            return Inertia::render('Promotions/Index', $data);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function show($slug)
    {
        try {
            $promotion = Post::query()
                ->active()
                ->wherePromotion()
                ->whereSlug($slug)
                ->firstOrFail();

            $promotions = Post::query()
                ->active()
                ->orderByPosition()
                ->wherePromotion()
                ->where('id', '!=', $promotion->id)
                ->get()
                ->map(fn($item) => $item->transform());

            $data = [
                'promotion' => $promotion->transformDetails(),
                'related_promotions' => $promotions,
            ];

            return Inertia::render('Promotions/Show', $data)
                ->withViewData(['seo' => $promotion->transformSeo()]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
