<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="/website/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/website/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/website/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="content-wrapper">
        <div class="col-sm-8 col-lg-6 col-md-6" style="position:fixed;bottom:10px; right:20px; z-index:999">
            <x-alert />
        </div>
    </div>
    <!-- Topbar Start -->
    <div class="container-fluid d-none d-lg-block">
        <div class="row align-items-center py-4 px-xl-5">
            <div class="col-lg-3">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0">
                        <img src="{{ asset('defaults/lmslogo.png') }}" height="55px" alt="">
                    </h1>
                    {{-- <h1 class="m-0"><span class="text-primary">E</span>COURSES</h1> --}}
                </a>
            </div>
            <div class="col-lg-3 text-right">
                <div class="d-inline-flex align-items-center">
                    <i class="fa fa-2x fa-map-marker-alt text-primary mr-3"></i>
                    <div class="text-left">
                        <h6 class="font-weight-semi-bold mb-1">Our Office</h6>
                        <small>Chuchepati, Kathmandu</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 text-right">
                <div class="d-inline-flex align-items-center">
                    <i class="fa fa-2x fa-envelope text-primary mr-3"></i>
                    <div class="text-left">
                        <h6 class="font-weight-semi-bold mb-1">Email Us</h6>
                        <small>info@lms.com</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 text-right">
                <div class="d-inline-flex align-items-center">
                    <i class="fa fa-2x fa-phone text-primary mr-3"></i>
                    <div class="text-left">
                        <h6 class="font-weight-semi-bold mb-1">Call Us</h6>
                        <small>+977 9860923620</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="d-flex align-items-center justify-content-between bg-secondary w-100 text-decoration-none"
                    data-toggle="collapse" href="#navbar-vertical" style="height: 67px; padding: 0 30px;">
                    <h5 class="text-primary m-0"><i class="fa fa-book-open mr-2"></i>Categories</h5>
                    <i class="fa fa-angle-down text-primary"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light"
                id="navbar-vertical" style="width: calc(100% - 30px); z-index: 9;">
                <div class="navbar-nav w-100">
                    @foreach ($categories as $category)
                        <div class="nav-item dropdown">
                            <!-- Parent Category Link -->
                            <a href="{{ route('website.category.show', $category->id) }}" class="nav-link">
                                {{ $category->name }}
                                @if ($category->children->count() > 0)
                                    <!-- Icon for Dropdown -->
                                    <i class="fa fa-angle-down float-right mt-1" data-toggle="dropdown-icon" aria-hidden="true"></i>
                                @endif
                            </a>

                            <!-- Dropdown Menu for Child Categories -->
                            @if ($category->children->count() > 0)
                                <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                    @foreach ($category->children as $child)
                                        <a href="{{ route('website.category.show', $child->id) }}" class="dropdown-item">{{ $child->name }}</a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </nav>

            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0">
                            <img src="{{ asset('defaults/lmslogo.png') }}" height="55px" alt="">
                        </h1>
                        {{-- <h1 class="m-0"><span class="text-primary">E</span>COURSES</h1> --}}
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav py-0">
                            <a href="/" class="nav-item nav-link active">Home</a>
                            <a href="{{ route('website.about') }}" class="nav-item nav-link">About</a>
                            <a href="{{ route('website.courses') }}" class="nav-item nav-link">Courses</a>
                            @auth
                            <a href="{{ route('website.enrolled.courses') }}" class="nav-item nav-link">My Courses</a>
                            @endauth
                        </div>
                        @auth
                            <span class="py-2 px-4 ml-auto d-none d-lg-block">{{ auth()->user()->name }}</span>
                            <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <button onclick="document.getElementById('logoutform').submit();"
                                class="btn btn-danger py-2 px-4 ml-4 d-none d-lg-block">
                                Logout
                            </button>
                        @else
                            <a class="btn btn-primary py-2 px-4 ml-auto d-none d-lg-block"
                                href="{{ route('website.login.form') }}">Login</a>
                            <a class="btn btn-outline-primary py-2 px-4 ml-4 d-none d-lg-block"
                                href="{{ route('website.register') }}">Register</a>
                        @endauth
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white py-5 px-sm-3 px-lg-5" style="margin-top: 90px;">
        <div class="row pt-5">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <img src="{{ asset('defaults/lmslogo.png') }}" height="100px" alt="">
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-primary text-uppercase mb-4" style="letter-spacing: 5px;">Get In Touch</h5>
                        <p><i class="fa fa-map-marker-alt mr-2"></i>Chuchepati, Kathmandu, Nepal</p>
                        <p><i class="fa fa-phone-alt mr-2"></i>+977 9860923620</p>
                        <p><i class="fa fa-envelope mr-2"></i>info@lms.com</p>
                        <div class="d-flex justify-content-start mt-4">
                            <a class="btn btn-outline-light btn-square mr-2" href="#"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-square mr-2" href="#"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-square mr-2" href="#"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-outline-light btn-square" href="#"><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-primary text-uppercase mb-4" style="letter-spacing: 5px;">Our Courses</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Web
                                Design</a>
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Apps
                                Design</a>
                            <a class="text-white mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Marketing</a>
                            <a class="text-white mb-2" href="#"><i
                                    class="fa fa-angle-right mr-2"></i>Research</a>
                            <a class="text-white" href="#"><i class="fa fa-angle-right mr-2"></i>SEO</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5"
        style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white">&copy; <a href="#">lms.com</a>. All Rights Reserved. Designed by
                    <a href="">LMS</a>
                </p>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i
            class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="/website/lib/easing/easing.min.js"></script>
    <script src="/website/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="/website/mail/jqBootstrapValidation.min.js"></script>
    <script src="/website/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="/website/js/main.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Select all icons with data-toggle="dropdown-icon"
            const dropdownIcons = document.querySelectorAll('[data-toggle="dropdown-icon"]');

            dropdownIcons.forEach(function (icon) {
                icon.addEventListener('click', function (e) {
                    e.preventDefault(); // Prevent the link from triggering navigation

                    const dropdownMenu = icon.closest('.nav-item').querySelector('.dropdown-menu');

                    // Toggle the visibility of the dropdown menu
                    dropdownMenu.classList.toggle('show'); // This toggles the dropdown
                });
            });
        });
    </script>

</body>

</html>
