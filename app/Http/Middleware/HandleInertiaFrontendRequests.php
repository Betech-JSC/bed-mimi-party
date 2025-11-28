<?php

namespace App\Http\Middleware;

use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use Inertia\Middleware;
use Illuminate\Http\Request;
use JamstackVietnam\Blog\Models\PostCategory;
use App\Models\Service;
use JamstackVietnam\MetaPage\Models\MetaPage;

class HandleInertiaFrontendRequests extends Middleware
{
    protected $rootView = 'frontend::app';
    protected const FEATURED_POSITION_POST_CATEGORIES = 1;
    protected const MENU_POSITION_POST_CATEGORIES = 2;

    public function share(Request $request)
    {
        try {
            $footer_products = Product::query()
                ->active()
                ->take(5)
                ->get();

            $relativeUrl = str_replace(env('APP_URL'), '',  url()->current());
            $metaPage = cache_response(
                $relativeUrl,
                function () use ($relativeUrl) {
                    return MetaPage::where('url', $relativeUrl ?: '/')->first();
                },
                'meta_pages',
            );

            $menuCategories = ProductCategory::query()
                ->whereMenuHeader()
                ->with([
                    'nodes.products'
                ])
                ->get()
                ->map(function ($category) {
                    // Format danh mục cấp 2
                    $formatCategory = function ($node) {
                        return [
                            'id' => $node->id,
                            'title' =>  $node->menu_title ?? $node->title,
                            'slug' => $node->seo_slug ?? $node->slug,
                            'products' => $node->products->take(4)->map(fn($product) => $product->transform()), // Lấy 4 sản phẩm đầu tiên sau khi query
                        ];
                    };

                    return [
                        'id' => $category->id,
                        'title' => $category->menu_title ?? $category->title,
                        'slug' => $category->seo_slug ?? $category->slug,
                        'nodes' => $category->nodes->map($formatCategory), // Format danh mục cấp 2
                    ];
                });


            $footerCategories = ProductCategory::query()
                ->active()
                // ->whereMenuFooter()
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'title' =>  $item->menu_title ?? $item->title,
                        'slug' => $item->seo_slug ?? $item->slug,
                    ];
                });

            $global = settings()
                ->group('general')
                ->all();

            if ($request->wantsJson()) {
                return parent::share($request);
            }

            $share = array_merge(parent::share($request), [
                'global' => $global,
                'locale' => [
                    'current' => current_locale(),
                    'default' => config('app.locale'),
                    'list' => config('app.locales'),
                ],
                'route' => [
                    'url' => $request->url(),
                    'path' => $request->path(),
                    'name' => $request->route()->getName(),
                    'query' => $request->query(),
                ],
                'data' => [
                    'menu_categories' => $menuCategories,
                    'footer_categories' => $footerCategories,
                    'featured_category' => [],
                    'footer_products' => $footer_products,
                ]
            ]);

            if ($metaPage) {
                $share['seo'] = $metaPage;
            }

            return $share;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
