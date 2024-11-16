@extends('website.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('website.register.student')}}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }} <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Image (Optional) -->
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Profile Image') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <!-- District -->
                        <div class="form-group row">
                            <label for="district" class="col-md-4 col-form-label text-md-right">{{ __('District') }}<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select id="district" class="form-control @error('district') is-invalid @enderror" name="district" required>
                                    <option value="" disabled selected>{{ __('Select District') }}</option>
                                    @foreach (config('dropdown.districts') as $key => $district)
                                        <option value="{{ $key }}" {{ old('district') == $key ? 'selected' : '' }}>{{ $district }}</option>
                                    @endforeach
                                </select>

                                @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" rows="3">{{ old('address') }}</textarea>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Age -->
                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}">

                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                                    <option value="" disabled selected>{{ __('Select Gender') }}</option>
                                    @foreach (config('dropdown.gender') as $key => $gender)
                                        <option value="{{ $key }}" {{ old('gender') == $key ? 'selected' : '' }}>{{ $gender }}</option>
                                    @endforeach
                                </select>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Education -->
                        <div class="form-group row">
                            <label for="education" class="col-md-4 col-form-label text-md-right">{{ __('Education Level') }}<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select id="education" class="form-control @error('education') is-invalid @enderror" name="education" required>
                                    <option value="" disabled selected>{{ __('Select Education Level') }}</option>
                                    @foreach (config('dropdown.education') as $key => $education)
                                        <option value="{{ $key }}" {{ old('education') == $key ? 'selected' : '' }}>{{ $education }}</option>
                                    @endforeach
                                </select>

                                @error('education')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
