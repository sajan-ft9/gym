<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        return view('lessons.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|mimes:mp4,mov,avi,wmv|max:50000',
            'order' => 'required|integer',
            'course_id' => 'required|exists:courses,id',
            'content' => 'nullable|string',
        ]);

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');
        }

        Lesson::create([
            'title' => $request->title,
            'content' => $request->content,
            'video_url' => $videoPath,
            'order' => $request->order,
            'course_id' => $request->course_id,
        ]);

        return redirect()->route('courses.show', $request->course_id)->with('success', 'Lesson created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        return view('lessons.show', compact('lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        return view('lessons.edit', compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:50000', // Allow nullable in case no new file is uploaded
            'order' => 'required|integer',
            'course_id' => 'required|exists:courses,id',
            'content' => 'nullable|string',
        ]);

        if ($request->hasFile('video')) {
            if ($lesson->video_url) {
                Storage::disk('public')->delete($lesson->video_url);
            }

            $videoPath = $request->file('video')->store('videos', 'public');
            $lesson->video_url = $videoPath;
        }

        $lesson->update([
            'title' => $request->title,
            'content' => $request->content,
            'order' => $request->order,
            'course_id' => $request->course_id,
        ]);

        return redirect()->route('courses.show', $request->course_id)->with('success', 'Lesson updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        //
    }
}
