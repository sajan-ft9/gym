<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentCourseController extends Controller
{
    public function courses()
    {
        $courses = Course::with(['users','lessons'])->get();
        return view('website.courses.index', compact('courses'));  // Return the 'courses' view
    }

    public function coursesShow(Course $course)
    {
        return view('website.courses.show', compact('course'));  // Return the 'courses' view
    }

    public function enroll(Course $course)
    {
        return view('website.courses.show', compact('course'));  // Return the 'courses' view
    }

    public function lesson(Lesson $lesson)
    {
        if (Auth::check() && Auth::user()->courses->contains($lesson->course->id)) {
            return view('website.courses.video', compact('lesson'));
        } else {
            return redirect()->route('website.home')->with('error', 'You must be enrolled in the course to view this lesson.');
        }
    }

    public function enrolledCourses()
    {
        $courses = Auth::user()->courses;
        return view('website.courses.enrolled', compact('courses'));
    }
}
