@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>View Lesson</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Lesson Details</h3>
                <a class="btn-info btn-sm mx-2" href="{{ route('admin.courses.show', $lesson->course_id) }}">Back to List</a>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Lesson Title -->
                    <div class="col-md-4 mb-1">
                        <strong>Title:</strong>
                        <p>{{ $lesson->title }}</p>
                    </div>

                    <!-- Course -->
                    <div class="col-md-4 mb-1">
                        <strong>Course:</strong>
                        <p>{{ $lesson->course->title }}</p>
                    </div>

                    <!-- Lesson Order -->
                    <div class="col-md-4 mb-1">
                        <strong>Order:</strong>
                        <p>{{ $lesson->order }}</p>
                    </div>

                    <!-- Lesson Video -->
                    <div class="col-12 mb-3">
                        <strong>Video:</strong>
                        @if ($lesson->video_url)
                            <video width="600" controls>
                                <source src="{{ asset('storage/' . $lesson->video_url) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <p>No video available.</p>
                        @endif
                    </div>

                    <!-- Lesson Content -->
                    <div class="col-12 mb-3">
                        <strong>Content:</strong>
                        <p>{!! $lesson->content !!}</p>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <a class="btn btn-info" href="{{ route('admin.lessons.edit', $lesson->id) }}">Edit Lesson</a>
            </div>
        </div>
    </div>
@endsection
