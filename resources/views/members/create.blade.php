@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Member</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Add Members</h3>
                <a class="btn-info btn-sm mx-2" href="{{ route('member.index') }}">List</a>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('member.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone <span class="text-danger">*</span></label>
                                <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control" required>
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span></label>
                                <input type="text" name="address" value="{{ old('address') }}" class="form-control" required>
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>DOB (BS) <span class="text-danger">*</span></label>
                                <input type="text" name="dob" id="nepali-datepicker" value="{{ old('dob') }}" placeholder="Select Nepali Date"
                                    class="ndp-nepali-calendar form-control" autocomplete="off" readonly required>
                                @error('dob')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Join Date (AD) <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" value="{{ old('join_date') }}" name="join_date" onclick="this.showPicker()"
                                    required>
                                @error('join_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Membership Type <span class="text-danger">*</span></label>
                                <select name="category_id[]" class="form-control js-example-basic-multiple" required
                                    multiple>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select> @error('category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Photo</label>
                                <input type="file" name="simage_path" class="form-control" accept="image/*"
                                    onchange="loadFile(event)">
                                <img src="" id="output" class="mt-1" alt="">
                                @error('image_path')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info px-4">Add Member</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            var mainInput = document.getElementById("nepali-datepicker");
            mainInput.nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 100,
                disableDaysAfter: 0
            });
        };
    </script>
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
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
