<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentCourseController;
use App\Http\Controllers\StudentLoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes([
    'register' => false
]);

Route::middleware(['auth','admin'])->group(function () {
    // admin
    Route::name('admin.')->controller(AdminController::class)->group(function () {
        Route::get('/home', 'index')->name('home');
        Route::get('/profile', 'profile')->name('profile');
        Route::patch('/update/{admin}', 'update')->name('update');
        Route::patch('/update_password/{admin}', 'updatePassword')->name('updatePassword');
    });
    // category
    Route::name('admin.')->prefix('/admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

        Route::resource('category', CategoryController::class);
        Route::resource('courses', CourseController::class);

        Route::get('lessons/create/{course}', [LessonController::class, 'create'])->name('lessons.create');
        Route::resource('lessons', LessonController::class)->except(['create']);
    });
});

Route::name('website.')->group(function () {
    Route::get('/', [HomeController::class,'index'])->name('home');

    Route::get('/about', [HomeController::class, 'about'])->name('about');

    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

    Route::get('/category/{cat}', [HomeController::class, 'categoryShow'])->name('category.show');
    Route::get('/category', [HomeController::class, 'category'])->name('category.index');

    Route::get('/courses/{course}', [StudentCourseController::class, 'coursesShow'])->name('courses.show');
    Route::get('/courses', [StudentCourseController::class, 'courses'])->name('courses');

    Route::middleware(['student'])->group(function () {
        Route::get('/enrolled-courses', [StudentCourseController::class, 'enrolledCourses'])->name('enrolled.courses');

        Route::get('/lesson/{lesson}', [StudentCourseController::class, 'lesson'])->name('lesson.video');

        Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

        Route::get('/payment/failure', [PaymentController::class, 'paymentFailure'])->name('payment.failure');
    });

    Route::get('/registerform', [StudentLoginController::class,'registerForm'])->name('register');
    Route::post('/register-student', [StudentLoginController::class,'registerStudent'])->name('register.student');
    Route::get('/login-student', [StudentLoginController::class,'loginForm'])->name('login.form');
    Route::post('/login-student', [StudentLoginController::class,'loginStudent'])->name('login.student');
});
