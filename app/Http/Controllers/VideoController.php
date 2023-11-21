<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoControllerStoreRequest;
use App\Http\Requests\VideoControllerUpdateRequest;
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
        $video = Video::find($id);

        return view('video.show', compact('video'));
    }

    public function create(Request $request): View
    {
        return view('video.create');
    }

    public function store(VideoControllerStoreRequest $request): RedirectResponse
    {
        $video = Video::create($request->validated());

        return redirect()->route('video.index');
    }

    public function edit(Request $request, Video $video): View
    {
        $video = Video::find($id);

        return view('video.edit', compact('video'));
    }

    public function update(VideoControllerUpdateRequest $request, Video $video): RedirectResponse
    {
        $video->update($request->validated());

        return redirect()->route('video.index');
    }

    public function destroy(Request $request, Video $video): RedirectResponse
    {
        return redirect()->route('video.index');
    }
}
