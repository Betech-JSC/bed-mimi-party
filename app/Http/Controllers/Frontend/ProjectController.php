<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post\Post;
use App\Models\Slider\Slider;
use Inertia\Inertia;
use Illuminate\Routing\Controller;

class ProjectController extends Controller
{
    public $model = Post::class;

    public function index()
    {
        try {
            $projects = Post::query()
                ->active()
                ->where('type', Post::TYPE_PROJECT)
                ->paginate(6)
                ->onEachSide(0)
                ->through(function ($item) {
                    return $item->transform();
                })
                ->withQueryString();

            $banner = Slider::getByPosition('BANNER_PROJECT');

            $data = [
                'projects' => $projects,
                'banner' => $banner,
            ];

            if (request()->wantsJson()) {
                return response()->json($data);
            }

            return Inertia::render('Projects/Index', $data);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function show($slug) {}
}
