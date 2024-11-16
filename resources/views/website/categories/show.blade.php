@extends('website.layout')
@section('content')
    <!-- Category Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h1>{{ $cat->name }} Courses</h1>
            </div>
            <div class="row">
                @foreach ($courses as $course)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="rounded overflow-hidden mb-2">
                            <img class="img-fluid" src="/website/img/course-1.jpg" alt="">
                            <div class="bg-secondary p-4">
                                <div class="d-flex justify-content-between mb-3">
                                    <small class="m-0"><i
                                            class="fa fa-users text-primary mr-2"></i>{{ $course->users->count() }}
                                        Students</small>
                                    <small class="m-0"><i
                                            class="far fa-clock text-primary mr-2"></i>{{ formatDuration($course->duration) }}</small>
                                </div>
                                <a class="h5"
                                    href="{{ route('website.courses.show', $course->id) }}">{{ $course->title }}</a>
                                <div class="border-top mt-2 pt-2">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="m-0">Rs {{ $course->price }}</h5>
                                        <a href="{{ route('website.courses.show', $course->id) }}" class="btn btn-primary">
                                            <small>View</small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Category Start -->
@endsection
