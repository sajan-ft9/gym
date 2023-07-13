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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="col col-lg-8 mb-4 mb-lg-0">
                    <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center text-white"
                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <img src="{{ asset($member->image_path ?? 'defaults/default_man.png') }}" alt="Avatar"
                                    class="img-fluid my-5" style="width: 200px;" />
                                <p>ID: {{ $member->id }}</p>
                                <h5>{{ $member->name }}</h5>
                                @if ($member->subscription)
                                    <h5>Expiring on:
                                        {{ getRemainingDays($member->subscription->start_date, $member->subscription->end_date) }}
                                        days
                                    </h5>
                                @else
                                    <button type="button" class="btn btn-success mb-2" data-toggle="modal"
                                        data-target="#staticBackdrop">
                                        Subscribe now
                                    </button>
                                @endif

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
                                            <h6 class="">{{ $member->subscription->start_date ?? '' }}</h6>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>End Date (AD)</h6>
                                            <h6 class="text-danger">{{ $member->subscription->end_date ?? '' }}</h6>
                                        </div>
                                        @if (count($member->payments) > 0)
                                            <div class="col-6 mb-3">
                                                <h6>Remaining Amount</h6>
                                                <h6 class="text-danger">Rs.
                                                    {{ number_format($member->payments->last()->remaining_amount, 2) }}
                                                </h6>

                                            </div>
                                            <div class="col-6 mb-3">
                                                <a class="btn-sm btn-info" href="#">See all payments</a>
                                            </div>
                                        @else
                                            <h6 class="text-info">No payments made yet</h6>
                                        @endif
                                    </div>
                                    <h6>Action</h6>
                                    <hr class="mt-0 mb-2">
                                    <div class="d-flex justify-content-start">
                                        <a href="{{ route('member.edit', $member->id) }}" class="btn btn-warning mr-1"><i
                                                class="fas fa-edit"></i></a>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#staticBackdrop">
                                            Make Payment
                                        </button>
                                    </div>


                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
                                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Payment of:
                                                        {{ $member->name }}, ID: {{ $member->id }}

                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('payment.store') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="member_id" value="{{ $member->id }}">
                                                        <div class="form-group">
                                                            <label for="">Paid Amount</label>
                                                            <input class="form-control" type="number" min="1"
                                                                name="paid_amount" required>
                                                        </div>
                                                        <div class="form-group">

                                                            <label for="">Remaining Amount</label>
                                                            <input class="form-control" type="number" min="1"
                                                                name="remaining_amount" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Subscription Start Date</label>
                                                            <input class="form-control" id="date"
                                                                onclick="this.showPicker()" type="date" name="start_date"
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Subscription End Date</label>
                                                            <input class="form-control" id="date"
                                                                onclick="this.showPicker()" type="date"
                                                                name="end_date" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Remarks</label>
                                                            <textarea class="form-control" name="remarks" id="Remarks" cols="30" rows="1" required></textarea>

                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Make Payment</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        var today = new Date().toISOString().split('T')[0];
        document.getElementById("date").setAttribute('min', today);
    </script>
@endsection
