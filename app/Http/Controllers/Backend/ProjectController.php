<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post\Post;
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

    private function beforeIndex($query)
    {
        return $query->where('type', Post::TYPE_PROJECT)
            ->orderBy('id', 'DESC');
    }
}
