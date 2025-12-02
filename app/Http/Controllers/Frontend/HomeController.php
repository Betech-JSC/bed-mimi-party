<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use Illuminate\Routing\Controller;
use App\Models\Post\Post;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        try {

            $services = Service::query()
                ->active()
                ->sortByPosition()
                ->take(3)
                ->get()
                ->map(fn($item) => $item->transform());

            $projects = Post::query()
                ->active()
                ->where('type', Post::TYPE_PROJECT)
                ->take(9)
                ->get()
                ->map(fn($item) => $item->transform());

            $posts = Post::query()
                ->active()
                ->where('type', Post::TYPE_POST)
                ->isFeatured()
                ->take(3)
                ->get()
                ->map(fn($item) => $item->transform());

            $partners = Post::query()
                ->active()
                ->where('type', Post::TYPE_PARTNER)
                ->orderBy('position', 'ASC')
                ->orderBy('id', 'DESC')
                ->get()
                ->map(fn($item) => $item->transform());

            $data = [
                'services' => $services,
                'posts' => $posts,
                'projects' => $projects,
                'partners' => $partners,
            ];

            return Inertia::render('Home', $data);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
