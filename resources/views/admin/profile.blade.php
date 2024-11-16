@extends('layouts.app')

@section('content')
    <section class="h-100 gradient-custom-2">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-10">
                    <div class="card">
                        <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
                            <div class="mx-4 mt-5 d-flex flex-column" style="width: 150px;">
                                <img src="{{ asset($user->image_path ?? 'defaults/default_man.png') }}"
                                    alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                                    style="width: 150px; z-index: 1">
                            </div>
                            <div class="mx-3" style="margin-top: 130px;">
                                <h5>{{ $user->name }}</h5>
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>

                        <div class="card-body p-4 text-black">
                            <div class="mb-5">
                                <p class="lead fw-normal mb-1">Update Profile</p>
                                <div class="p-4" style="background-color: #f8f9fa;">
                                    <form action="{{ route('admin.update', $user->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('patch')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Name:</label>
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{ $user->name }}" required>
                                                    @error('name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Email:</label>
                                                    <input type="email" class="form-control" name="email"
                                                        value="{{ $user->email }}" required>
                                                    @error('email')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Address:</label>
                                                    <input type="text" class="form-control" name="address"
                                                        value="{{ $user->address }}" required>
                                                    @error('address')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Gender<span class="text-danger">*</span></label>
                                                    <select name="level" class="form-control" id="">
                                                        <option value="">Select Gender</option>
                                                        @foreach (config('dropdown.gender') as $key => $ge)
                                                            <option value="{{ $key }}"
                                                                {{ old('gender') == $key ? 'selected' : '' }}>
                                                                {{ $ge }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('gender')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Education<span class="text-danger">*</span></label>
                                                    <select name="level" class="form-control" id="">
                                                        <option value="">Select Education</option>
                                                        @foreach (config('dropdown.education') as $key => $ed)
                                                            <option value="{{ $key }}"
                                                                {{ old('education') == $key ? 'selected' : '' }}>
                                                                {{ $ed }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('education')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Date of Birth:</label>
                                                    <input type="date" class="form-control" name="dob"
                                                        value="{{ $user->dob }}" required>
                                                    @error('dob')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Photo:</label>
                                                    <input type="file" class="form-control" name="image_path"
                                                        onchange="loadFile(event)" accept="image/*">
                                                    @error('image_path')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                    <img class="mt-2" id="output" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info px-4">Update</button>
                                    </form>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <p class="lead fw-normal mb-0">Update Password</p>
                            </div>
                            <div id="password" class="p-4" style="background-color: #f8f9fa;">
                                <form action="{{ route('admin.updatePassword', $user->id) }}" method="POST">

                                    @csrf
                                    @method('patch')
                                    <div class="form-group">
                                        <label for="">Old Password</label>
                                        <input type="password" name="old_password" class="form-control" id="">
                                        @error('old_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control" id="">
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password Confirmation</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            id="">
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <button class="btn btn-danger" type="submit">Update Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.height = "100"
            output.width = "100"
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
@endsection
