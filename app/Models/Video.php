<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'url',
        'course_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'course_id' => 'integer',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class,'progress')->withPivot('watched_duration');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
    public function progresses(): BelongsTo
    {
        return $this->belongsTo(Progress::class);
    }

    public function getCurrentCourseEpisodes()
    {
        return $this->course()->first()->videos();
    }
}
