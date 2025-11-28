<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use Illuminate\Routing\Controller;
use App\Models\Policy\Policy;

class PolicyController extends Controller
{
    public $model = Policy::class;

    public function index()
    {
        return $this->renderDataPage();
    }

    public function show($slug)
    {
        return $this->renderDataPage($slug);
    }

    public function renderDataPage($slug = null)
    {
        $policies = Policy::query()
            ->active()
            ->orderBy('position', 'ASC')
            ->get()
            ->map(fn($item) => $item->transform());

        if (!empty($slug)) {
            $content = $policies->where('slug', $slug)->first();
        } else {
            $content = $policies->first();
        }

        $data = [
            'list_sidebar' => $policies,
            'content' => $content
        ];

        if (request()->wantsJson()) {
            return response()->json($data);
        }

        return Inertia::render('Policy', $data);
    }
}
