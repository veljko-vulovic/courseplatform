<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgressControllerStoreRequest;
use App\Http\Requests\ProgressControllerUpdateRequest;
use App\Models\Progress;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProgressController extends Controller
{
    public function index(Request $request): View
    {
        $progress = Progress::all();

        return view('progress.index', compact('progresses'));
    }

    public function show(Request $request, Progress $progress): View
    {
        $progress = Progress::find($id);

        return view('progress.show', compact('progress'));
    }

    public function create(Request $request): View
    {
        return view('progress.create');
    }

    public function store(ProgressControllerStoreRequest $request): RedirectResponse
    {
        $progress = Progress::create($request->validated());

        return redirect()->route('progress.index');
    }

    public function edit(Request $request, Progress $progress): View
    {
        $progress = Progress::find($id);

        return view('progress.edit', compact('progress'));
    }

    public function update(ProgressControllerUpdateRequest $request, Progress $progress): RedirectResponse
    {
        $progress->update($request->validated());

        return redirect()->route('progress.index');
    }

    public function destroy(Request $request, Progress $progress): RedirectResponse
    {
        return redirect()->route('progress.index');
    }
}
