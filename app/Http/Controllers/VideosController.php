<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\Models\Video;
use Illuminate\Database\Eloquent\Builder;

class VideosController
{
    public function index()
    {
        $allSeries = Series::with(['purchasables', 'videos'])
            ->unless(
                current_user()?->hasAccessToUnReleasedProducts(),
                fn(Builder $query) => $query->where('visible', true)
            )
            ->orderBy('sort_order')
            ->get();

        return view('front.pages.videos.index', compact('allSeries'));
    }

    public function show(Series $series, Video $video)
    {
        $previousVideo = $video->getPrevious();
        $nextVideo = $video->getNext();
        $currentVideo = $video;

        $title = $currentVideo->title;
        $description = $currentVideo->description;

        $series->load(['purchasables.product']);

        return view('front.pages.videos.show', compact(
            'title',
            'description',
            'series',
            'currentVideo',
            'previousVideo',
            'nextVideo',
        ));
    }
}
