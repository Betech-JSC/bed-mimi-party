<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post\Post;
use Illuminate\Routing\Controller;
use App\Traits\HasCrudActions;

class PromotionController extends Controller
{
    use HasCrudActions;
    public $model = Post::class;

    private function getTable()
    {
        return 'Promotions';
    }

    public $with = [
        'form' => ['relatedPosts']
    ];

    private function beforeIndex($query)
    {
        return $query->where('type', Post::TYPE_PROMOTION)
            ->orderBy('id', 'DESC');
    }
}
