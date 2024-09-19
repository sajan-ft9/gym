@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Course Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <a class="btn btn-info float-sm-right" href="{{ route('courses.index') }}">Back to List</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">{{ $course->title }}</h3>
                <div class="card-tools">
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this course?')">Delete</button>
                    </form>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Title:</strong> {{ $course->title }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Price:</strong> Rs. {{ number_format($course->price, 2) }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Duration:</strong> {{ $course->duration }} minutes</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Level:</strong> {{ config('dropdown.level')[$course->level] }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Category:</strong> {{ $course->category->name }}</p>
                    </div>
                    <div class="col-12">
                        <p><strong>Description:</strong></p>
                        <div>{!! $course->description !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
