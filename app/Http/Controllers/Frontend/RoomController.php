<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use Inertia\Inertia;
use Illuminate\Routing\Controller;


class RoomController extends Controller
{
    public $model = Post::class;

    public function index()
    {
        try {

            $rooms = Post::query()
                ->active()
                ->whereRoom()
                ->get()
                ->map(fn($item) => $item->transform());

            $data = [
                'rooms' => $rooms,
            ];

            if (request()->wantsJson()) {
                return response()->json($data);
            }

            return Inertia::render('Rooms/Index', $data);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function show($slug)
    {
        try {
            $room = Post::query()
                ->active()
                ->whereRoom()
                ->whereSlug($slug)
                ->firstOrFail();

            $rooms = Post::query()
                ->active()
                ->orderByPosition()
                ->whereRoom()
                ->where('id', '!=', $room->id)
                ->get()
                ->map(fn($item) => $item->transform());

            $data = [
                'room' => $room->transformDetails(),
                'related_rooms' => $rooms,
            ];

            return Inertia::render('Rooms/Show', $data)
                ->withViewData(['seo' => $room->transformSeo()]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
