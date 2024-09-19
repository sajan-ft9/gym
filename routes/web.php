<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes([
    'register' => false
]);

Route::middleware('auth')->group(function () {
    // admin
    Route::name('admin.')->controller(AdminController::class)->group(function () {
        Route::get('/home', 'index')->name('home');
        Route::get('/profile', 'profile')->name('profile');
        Route::patch('/update/{admin}', 'update')->name('update');
        Route::patch('/update_password/{admin}', 'updatePassword')->name('updatePassword');
    });
    // category
    Route::resource('category', CategoryController::class);
    Route::resource('courses', CourseController::class);

    Route::get('lessons/create/{course}', [LessonController::class, 'create'])->name('lessons.create');
    Route::resource('lessons', LessonController::class)->except(['create']);
});

Route::get('/', function () {
    return view('website.home');
});
Route::get('/about', function () {
    return view('website.about');
})->name('about');
Route::get('/contact', function () {
    return view('website.contact');
})->name('contact');
Route::get('/courses', function () {
    return view('website.courses');
})->name('courses');
