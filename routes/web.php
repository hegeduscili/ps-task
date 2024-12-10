<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {  #aki bevan jelentkezve nem éri el a belépés/reg. felületet
    Route::get('/register', function () {
        return view('register');
    })->name('register');

    Route::post('/register', [UserController::class, 'Register']);

    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/login', [UserController::class, 'Login']);
});


// Route::get('/', function(){
//     return view('home');
// })->middleware('auth')->name('home');   #nem tud belépni, aki nincs bejelentkezve

Route::middleware('auth')->group(function () {
    Route::get('/', function() {
        return view('home');
    })->name('home');
    Route::get('/profile', [UserController::class, 'Edit'])->name('profile.edit');
    Route::post('/profile', [UserController::class, 'Update'])->name('profile.update');
    Route::post('/logout', [UserController::class, 'Logout'])->name('logout');
});
