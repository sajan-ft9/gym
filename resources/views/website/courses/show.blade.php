@extends('website.layout')

@section('content')
    <div class="container mt-5">
        <!-- Course Detail Section -->
        <section class="course-detail">
            <div class="row">
                <div class="col-md-8">
                    <!-- Course Info -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $course->title }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Course Details -->
                                <div class="col-md-6">
                                    <p><strong>Price:</strong> Rs. {{ number_format($course->price, 2) }}</p>
                                    <p><strong>Duration:</strong> {{ formatDuration($course->duration) }}</p>
                                    <p><strong>Level:</strong> {{ config('dropdown.level')[$course->level] }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Category:</strong> {{ $course->category->name }}</p>
                                </div>
                                <!-- Course Description -->
                                <div class="col-12">
                                    <p><strong>Description:</strong></p>
                                    <div>{!! $course->description !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lesson List Section -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="card-title">Lessons</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($course->lessons as $key => $lesson)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $lesson->title }}</td>
                                            <td>
                                                @if (isEnrolled($course->id))
                                                    <a href="{{route('website.lesson.video', $lesson->id)}}">View</a>
                                                @else
                                                    Not enrolled
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Section (Optional) -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Enroll in this Course</h5>
                        </div>
                        <div class="card-body text-center">
                            @if (isEnrolled($course->id))
                                <h2>Enrolled</h2>
                            @else
                            @auth

                            <p><strong>Enroll Now and Start Learning!</strong></p>
                            <h4 class="text-center text-primary">Rs. {{ $course->price }}</h4>
                            @include('website.payment.buybutton', compact('course'))
                            @else
                            <h4 class="text-center text-primary">Rs. {{ $course->price }}</h4>
                            <a class="btn btn-primary" href="{{route('website.login.form')}}">Login to buy and enroll</a>
                            @endauth
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
