@extends('layouts.app')
@section('css')
    <style>
        .gradient-custom {
            /* fallback for old browsers */
            background: #f6d365;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
        }
    </style>
@endsection
@section('content')
    <section class="vh-100" style="background-color: #f4f5f7;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-8 mb-4 mb-lg-0">
                    <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center text-white"
                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <img src="{{ asset($member->image_path ?? 'defaults/default_man.png') }}" alt="Avatar"
                                    class="img-fluid my-5" style="width: 200px;" />
                                    <p>ID: {{ $member->id }}</p>
                                <h5>{{ $member->name }}</h5>
                                <h5>Expiring on: 26 days</h5>

                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h6>Information
                                        <span class="float-right">Join Date: {{ $member->join_date }} (AD)</span>
                                    </h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Email</h6>
                                            <p class="text-muted">{{ $member->email }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Phone</h6>
                                            <p class="text-muted">{{ $member->phone }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>DOB (BS)</h6>
                                            <p class="text-muted">{{ $member->dob }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Address</h6>
                                            <p class="text-muted">{{ $member->address }}</p>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <h6>Membership Categories</h6>
                                            @foreach ($member->categories as $cat)
                                                <span class="btn-sm btn-secondary">{{ $cat->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <h6>Membership Info</h6>
                                    <hr class="mt-0 mb-2">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Start Date (AD)</h6>
                                            <h6 class="">2020/03/23</h6>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>End Date (AD)</h6>
                                            <h6 class="text-danger">2020/04/23</h6>
                                        </div>
                                    </div>
                                    <h6>Action</h6>
                                    <hr class="mt-0 mb-2">
                                    <div class="d-flex justify-content-start">
                                        <a href="{{ route('member.edit',$member->id) }}" class="btn btn-warning mr-1"><i class="fas fa-edit"></i></a>
                                        <button class="btn btn-success">Make Payment</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
