@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add courses</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Add courses</h3>
                <a class="btn-info btn-sm mx-2" href="{{ route('courses.index') }}">List</a>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Price <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0" name="price" class="form-control"
                                    value="{{ old('price') }}" required>
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Duration (In minutes)<span class="text-danger">*</span></label>
                                <input type="number" name="duration" min="1" placeholder="12" class="form-control"
                                    value="{{ old('duration') }}" required>
                                @error('duration')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Level<span class="text-danger">*</span></label>
                                <select name="level" class="form-control" id="">
                                    <option value="">Select Level</option>
                                    @foreach (config('dropdown.level') as $key => $item)
                                        <option value="{{ $key }}" {{ old('level') == $key ? 'selected' : '' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('level')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Category<span class="text-danger">*</span></label>
                                <select name="category_id" class="form-control" id="">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" {{ old('category_id') == $item->id  ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="">Description<span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control mb-2" id="description" cols="30">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
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
            $('#description').summernote({
                height: 300
            })
        })
    </script>
@endsection
