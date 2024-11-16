@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Course</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Edit Course</h3>
                <a class="btn-info btn-sm mx-2" href="{{ route('admin.courses.index') }}">List</a>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Use PUT method for updating -->
                    <div class="row">
                        <!-- Title -->
                        <div class="col-12">
                            <div class="form-group">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control"
                                       value="{{ old('title', $course->title) }}" required>
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Price <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0" name="price" class="form-control"
                                       value="{{ old('price', $course->price) }}" required>
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Duration -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Duration (In minutes)<span class="text-danger">*</span></label>
                                <input type="number" name="duration" min="1" placeholder="12" class="form-control"
                                       value="{{ old('duration', $course->duration) }}" required>
                                @error('duration')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Level -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Level<span class="text-danger">*</span></label>
                                <select name="level" class="form-control">
                                    <option value="">Select Level</option>
                                    @foreach (config('dropdown.level') as $key => $item)
                                        <option value="{{ $key }}" {{ old('level', $course->level) == $key ? 'selected' : '' }}>
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('level')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Category<span class="text-danger">*</span></label>
                                <select name="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" {{ old('category_id', $course->category_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-12">
                            <label for="description">Description<span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control mb-2" id="description" cols="30">{{ old('description', $course->description) }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-info px-4">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $('#description').summernote({
                height: 300
            });
        });
    </script>
@endsection
