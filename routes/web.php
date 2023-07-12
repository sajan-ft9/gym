<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
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

    // members
    Route::resource('member', MemberController::class);

    // category
    Route::resource('category', CategoryController::class);
});
