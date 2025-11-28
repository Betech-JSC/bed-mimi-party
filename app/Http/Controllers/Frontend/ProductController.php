<?php


namespace App\Http\Controllers\Frontend;

use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use Inertia\Inertia;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{

    protected function listCategory()
    {
        return ProductCategory::query()
            ->active()
            ->whereParent()
            ->sortByPosition()
            ->get()
            ->map(function ($category) {
                return [
                    'id' => $category->id,
                    'title' => $category->title,
                    'value' => $category->id,
                    'slug' => $category->seo_slug ?? $category->slug,
                    'url' => $category->url,
                    'nodes' => $this->transformNodes($category->nodes), // Xử lý phân cấp các nodes
                ];
            });
    }

    protected function transformNodes($nodes)
    {
        return $nodes->map(function ($node) {
            return [
                'id' => $node->id,
                'title' => $node->title,
                'value' => $node->id,
                'slug' => $node->seo_slug ?? $node->slug,
                'url' => $node->url,
                'nodes' => $this->transformNodes($node->nodes), // Đệ quy để phân cấp
            ];
        });
    }

    public function index()
    {
        try {
            $query = Product::query()->active();

            $products = $query->filter(request()->all())
                ->orderByPosition()
                ->get()
                ->paginate(8)
                ->through(function ($item) {
                    return $item->transform();
                })->withQueryString();

            $data = [
                'categories' => $this->listCategory(),
                'products' => $products,
            ];

            if (request()->wantsJson()) {
                return response()->json($data);
            }

            return Inertia::render('Products/Index', $data);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function show($slug)
    {
        try {
            $product = Product::query()
                ->active()
                ->whereSlug($slug)
                ->firstOrFail();

            $product->increment('view_count');

            $relatedProducts = $product->related();

            $mostViewedProducts = Product::query()
                ->active()
                ->orderBy('view_count', 'desc')
                ->take(10)
                ->get()
                ->map(fn($item) => $item->transform());

            $data = [
                'product' => $product->transformDetails(),
                'related_products' => $relatedProducts,
                'most_viewed_products' => $mostViewedProducts,
                'seo' => $product->transformSeo(),

            ];

            if (request()->wantsJson()) {
                return response()->json($data);
            }

            return Inertia::render('Products/Show', $data)
                ->withViewData(['seo' => $data['seo']]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
