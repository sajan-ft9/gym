@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Lessons</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Add Lessons</h3>
                <a class="btn-info btn-sm mx-2" href="{{ route('admin.lessons.index') }}">List</a>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.lessons.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                                    required>
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>Video File <span class="text-danger">*</span></label>
                                <input type="file" name="video" class="form-control" accept="video/*" required>
                                @error('video')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Order <span class="text-danger">*</span></label>
                                <input type="number" min="1" name="order" class="form-control"
                                    value="{{ old('order') }}" required>
                                @error('order')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Course <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" disabled value="{{ $course->title }}">
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>Content (Optional)</label>
                                <textarea name="content" class="form-control mb-2" id="content" cols="30">{{ old('content') }}</textarea>
                                @error('content')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info px-4">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $('#content').summernote({
                height: 300
            });
        });
    </script>
@endsection
