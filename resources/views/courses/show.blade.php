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
                        <a class="btn btn-info float-sm-right" href="{{ route('admin.lessons.index') }}">Back to List</a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">{{ $course->title }}</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.lessons.create', $course->id) }}" class="btn btn-info btn-sm">Add Lesson</a>
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
                <div class="row">
                    <div>
                        <h5>Lessons</h5>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lessons as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td class="py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.lessons.show', $item->id) }}" class="btn btn-info mx-1"><i
                                                    class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.lessons.edit', $item->id) }}"
                                                class="btn btn-warning mx-1"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('admin.lessons.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete?')"
                                                    class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
