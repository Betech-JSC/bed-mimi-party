<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use Inertia\Inertia;
use Illuminate\Routing\Controller;


class PostController extends Controller
{
    public $model = Post::class;

    public function index()
    {
        try {
            $posts = Post::query()
                ->active()
                ->where('type', Post::TYPE_POST)
                ->filter(request()->all())
                ->paginate(12)
                ->onEachSide(0)
                ->through(function ($item) {
                    return $item->transform();
                })
                ->withQueryString();

            $data = [
                'posts' => $posts,
            ];

            if (request()->wantsJson()) {
                return response()->json($data);
            }

            return Inertia::render('Posts/Index', $data);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function show($slug)
    {
        try {
            $post = $this->model::query()
                ->active()
                ->where('type', Post::TYPE_POST)
                ->whereSlug($slug)
                ->firstOrFail();

            $post->increment('view_count');

            $relatedPosts = $post->relatedPosts()
                ->active()
                ->orderByPosition()
                ->orderBy('id', 'desc')
                ->take(8)
                ->get()
                ->map(fn($item) => $item->transform());

            $data = [
                'post' => $post->transformDetails(),
                'seo' => $post->transformSeo(),
                'related_posts' => $relatedPosts,
            ];

            if (request()->wantsJson()) {
                return response()->json($data);
            }

            return Inertia::render('Posts/Show', $data)
                ->withViewData(['seo' => $post->transformSeo()]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function relatedPosts($postId)
    {
        $post = Post::query()
            ->setEagerLoads([])
            ->with('relatedPosts', 'categories')
            ->find($postId);

        $items = $post->relatedPosts()
            ->active()
            ->get()
            ->map(fn($item) => $item->transform());

        if ($items->count() == 0) {
            $category = $post->categories
                ->where('status', PostCategory::STATUS_ACTIVE)
                ->values()
                ->first();

            $items = Post::query()
                ->active()
                ->whereHas('categories', function ($query) use ($category) {
                    $query->where('post_categories.id', $category?->id);
                })
                ->orderByPosition()
                ->orderBy('id', 'desc')
                ->take(8)
                ->get()
                ->map(fn($item) => $item->transform());
        }

        return response()->json([
            'success' => true,
            'data' => $items,
            'message' => 'OK',
        ], 200);
    }
}
