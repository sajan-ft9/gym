@extends('website.layout')
@section('content')
    <!-- Courses Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h1>{{ $lesson->title }}</h1>
            </div>
            <div class="row">
                <!-- Lesson Title -->
                <div class="col-md-4">



                <!-- Course -->

                    <strong>Course:</strong>
                    <p>{{ $lesson->course->title }}</p>




                    <strong>Content:</strong>
                    <p>{!! $lesson->content !!}</p>

            </div>


                <!-- Lesson Video -->
                <div class="col-md-8 mb-3">
                    @if ($lesson->video_url)
                        <video width="600" controls>
                            <source src="{{ asset('storage/' . $lesson->video_url) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        <p>No video available.</p>
                    @endif
                </div>


            </div>
        </div>
    </div>
    </div>
    <!-- Courses End -->
@endsection
