<?php

namespace App\Http\Controllers;
 
use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VideoController extends Controller
{
    public function index(Request $request): View
    {
        $videos = Video::all();

        return view('video.index', compact('videos'));
    }

    public function show(Request $request, Video $video): View
    {
        return view('video.show', [
            'video' => $video,
            'courseEpisodes' => $video->getCurrentCourseEpisodes, //
        ]);
    }

    public function create(Request $request): View
    {
        return view('video.create');
    }

    public function store( $request): RedirectResponse
    {
        $video = Video::create($request->validated());

        return redirect()->route('video.index');
    }

    public function edit(Request $request, Video $video): View
    {
        $video = Video::find($video);

        return view('video.edit', compact('video'));
    }

    public function update($request, Video $video): RedirectResponse
    {
        $video->update($request->validated());

        return redirect()->route('video.index');
    }

    public function destroy(Request $request, Video $video): RedirectResponse
    {
        return redirect()->route('video.index');
    }
}
