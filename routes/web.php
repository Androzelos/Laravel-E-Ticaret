<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index']);
Route::get('/home/{id}/{name}', [HomeController::class, 'test'])->where(['id' => '[0-9]+', 'name' => '[a-zA-Z]+']);
Route::view('/', 'home.index');

//Admin
Route::get('/admin', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('adminhome');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
