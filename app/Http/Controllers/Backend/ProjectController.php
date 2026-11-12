<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post\Post;
use App\Models\Slider\Slider;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Routing\Controller;
use App\Traits\HasCrudActions;

class ProjectController extends Controller
{
    use HasCrudActions;
    public $model = Post::class;

    public $with = [
        'form' => ['relatedPosts']
    ];

    private function getTable()
    {
        return 'Projects';
    }

    private function beforeStore($request, $rules)
    {
        $request->merge(['type' => Post::TYPE_PROJECT]);
        return $rules;
    }

    private function beforeUpdate($request, $rules)
    {
        $request->merge(['type' => Post::TYPE_PROJECT]);
        return $rules;
    }

    private function beforeIndex($query)
    {
        return $query->where('type', Post::TYPE_PROJECT)
            ->orderBy('id', 'DESC');
    }

    public function index()
    {
        try {
            $this->checkAuthorize();

            if (request()->wantsJson()) {
                return $this->table();
            }

            $projectBanner = Slider::where('position_display', Slider::BANNER_PROJECT)->first()?->transform();

            return Inertia::render($this->folder() . '/Index', [
                'breadcrumbs' => [
                    [
                        'url' => route($this->getResource() . '.index'),
                        'name' => 'models.table_list.' . $this->getTable(),
                    ]
                ],
                'schema' => $this->getSchema(),
                'projectBanner' => $projectBanner,
            ]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function saveBanner(Request $request)
    {
        $slider = Slider::firstOrNew(['position_display' => Slider::BANNER_PROJECT]);
        $slider->status = Slider::STATUS_ACTIVE;
        $slider->position_display = Slider::BANNER_PROJECT;
        $title = $request->input('title', 'Dự án') ?: 'Dự án';

        $image = $request->input('image');
        $imageData = is_array($image) ? [
            'path' => $image['path'] ?? ($image['url'] ?? null),
            'alt' => $image['alt'] ?? $title,
        ] : $image;

        $imageMobile = $request->input('image_mobile');
        $imageMobileData = is_array($imageMobile) ? [
            'path' => $imageMobile['path'] ?? ($imageMobile['url'] ?? null),
            'alt' => $imageMobile['alt'] ?? $title,
        ] : $imageMobile;

        $defaultLocale = config('app.locale', 'vi');
        $slider->translateOrNew($defaultLocale)->fill([
            'title' => $title,
            'image' => $imageData,
            'image_mobile' => $imageMobileData,
        ]);

        if (function_exists('current_locale') && current_locale() !== $defaultLocale) {
            $slider->translateOrNew(current_locale())->fill([
                'title' => $title,
                'image' => $imageData,
                'image_mobile' => $imageMobileData,
            ]);
        }

        $slider->save();

        return back()->with('success', 'Cập nhật Banner trang Dự án thành công');
    }
}
