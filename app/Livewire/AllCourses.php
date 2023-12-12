<?php

namespace App\Livewire;

use Livewire\WithPagination;
use App\Models\Course;
use Livewire\Component;

class AllCourses extends Component
{
    use WithPagination;

    public function paginationView()
    {
        return 'custom-pagination-links-view';
    }

    public function render()
    {
        return view(
            'livewire.all-courses',
            [
                'courses' => Course::paginate(4),
            ]
        );
    }
}
