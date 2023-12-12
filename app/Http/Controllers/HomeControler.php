<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class HomeControler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        return view('home', [
            'featuredCourses' => Course::where('featured',true)->take(4)->get(),
            
        ]);
    }
}
