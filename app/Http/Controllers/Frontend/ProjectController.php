<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post\Post;
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
                ->paginate(12)
                ->onEachSide(0)
                ->through(function ($item) {
                    return $item->transform();
                })
                ->withQueryString();

            $data = [
                'projects' => $projects,
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
