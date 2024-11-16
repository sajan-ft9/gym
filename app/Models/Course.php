<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'duration',
        'level',
        'category_id',
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'enrollments')
            ->withPivot('enrollment_date')
            ->withTimestamps();
    }
}
