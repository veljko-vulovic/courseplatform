<?php

namespace App\Livewire;

use App\Models\Course;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CourseSearch extends Component
{
    public $search;
    public $searchResults = [];


    public function updatedSearch($newValue)
    {
        // if (strlen($this->search) < 3) {
        //     $this->searchResults = [];

        //     return;
        // }

        // $response = Http::get('https://itunes.apple.com/search?' . $this->search );
        $searchResults = Course::where('title', 'LIKE', '%' . $newValue . '%')->get(['id', 'title', 'user_id'])->toArray();
        $this->searchResults = $searchResults;
        // dd($searchResults);
        // dd($response);
        // $this->searchResults = $response->json()['results'];
    }

    public function render()
    {
        return view('livewire.course-search');
    }
}
