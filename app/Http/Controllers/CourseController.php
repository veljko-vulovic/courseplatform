<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseControllerStoreRequest;
use App\Http\Requests\CourseControllerUpdateRequest;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(Request $request): View
    {
        $courses = Course::all();

        return view('course.index', compact('courses'));
    }

    public function show(Request $request, Course $course): View
    {
        $course = Course::find($id);

        return view('course.show', compact('course'));
    }

    public function create(Request $request): View
    {
        return view('course.create');
    }

    public function store(CourseControllerStoreRequest $request): RedirectResponse
    {
        $course = Course::create($request->validated());

        return redirect()->route('course.index');
    }

    public function edit(Request $request, Course $course): View
    {
        $course = Course::find($id);

        return view('course.edit', compact('course'));
    }

    public function update(CourseControllerUpdateRequest $request, Course $course): RedirectResponse
    {
        $course->update($request->validated());

        return redirect()->route('course.index');
    }

    public function destroy(Request $request, Course $course): RedirectResponse
    {
        return redirect()->route('course.index');
    }
}
