<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index']);
Route::get('/home/{id}/{name}', [HomeController::class, 'test'])->where(['id' => '[0-9]+', 'name' => '[a-zA-Z]+']);
Route::redirect('/login','/admin/login');
//Route::view('/', 'home.index');

//Admin
Route::get('/admin', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('adminhome')->middleware('auth');
Route::get('/admin/login', [HomeController::class, 'login']);
Route::post('admin/logincheck', [HomeController::class, 'logincheck'])->name('admin_logincheck');
Route::get('admin/logout', [HomeController::class, 'logout'])->name('admin_logout');

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin_category');
    Route::get('category/add', [App\Http\Controllers\Admin\CategoryController::class, 'add'])->name('admin_category_add');
    Route::get('category/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin_category_create');
    Route::post('category/update', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin_category_update');
    Route::get('category/delete', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('admin_category_delete');
    Route::get('category/show', [App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('admin_category_show');

});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
