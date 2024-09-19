<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'video_url',
        'order',
        'course_id',
    ];

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
