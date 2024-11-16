@extends('website.layout')
@section('content')
<!-- Category Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-5">
                <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Categories</h5>
                <h1>Explore Top Categories</h1>
            </div>
            <div class="row">
                @foreach ($categories as $cat)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="cat-item position-relative overflow-hidden rounded mb-2">
                            <img class="img-fluid" src="/website/img/cat-1.jpg" alt="">
                            <a class="cat-overlay text-white text-decoration-none" href="">
                                <h4 class="text-white font-weight-medium">{{ $cat->name }}</h4>
                                <span>{{ $cat->courses->count() }}
                                    {{ $cat->courses->count() > 1 ? 'courses' : 'course' }}</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Category Start -->
@endsection
