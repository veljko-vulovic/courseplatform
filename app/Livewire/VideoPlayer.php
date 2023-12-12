<?php

namespace App\Livewire;

use App\Models\Progress;
use App\Models\Video;
use Livewire\Component;

class VideoPlayer extends Component
{
    public $videoId;
    public $videoUrl;
    public $user;
    public $watchedDuration = 0;
    public $currentWatchedDuration;

    protected $listeners = ['updateWatchedDuration' => 'updateWatchedDuration'];

    public function mount($videoUrl, $videoId)
    {
        $this->videoUrl = $videoUrl;
        $this->videoId = $videoId;
        $this->user = auth()->user();
        $this->currentWatchedDuration = Video::find($videoId)->users->find($this->user->id)->pivot->watched_duration ?? false;
    }

    public function updateWatchedDuration($duration)
    {
        $this->watchedDuration = $duration;

        // dd($this->currentWatchedDuration);
        if ($duration > $this->currentWatchedDuration) {
            $this->saveProgress();
        }
    }

    public function saveProgress()
    {

        // dd($this->user->id, $this->videoId, $this->formatDuration($this->watchedDuration));
        $watchedDuration = Progress::updateOrCreate(
            [
                'user_id' => $this->user->id,
                'video_id' => $this->videoId,
            ],
            ['watched_duration' => $this->watchedDuration]
        );
    }


    public function render()
    {
        return view('livewire.video-player');
    }
}
