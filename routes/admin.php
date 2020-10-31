<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;



Route::get('signup', [AuthController::class, 'getSignUp']);
Route::post('signup', [AuthController::class, 'signup'])->name('signup');
Route::get('login', [AuthController::class, 'getLogin']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('signup/activate/{token}', [AuthController::class, 'signupActivate']);




Route::resource('setting',  SettingController::class);
Route::resource('dashboard',  DashboardController::class);

Route::resource('users',  UserController::class);
Route::group(['prefix' => 'users', 'as' => 'users'], function () {
    Route::get('fetch/data', [UserController::class,'fetch_data']);
    Route::get('fetch/search', [UserController::class,'search']);

});

Route::resource('posts', PostController::class);
Route::group(['prefix' => 'posts', 'as' => 'posts'], function () {
    Route::get('fetch/data', [PostController::class,'fetch_data']);
    Route::get('fetch/filter', [PostController::class,'filter']);
    Route::get('fetch/search', [PostController::class,'search']);

});



Route::resource('media', MediaController::class);
Route::group(['prefix' => 'media', 'as' => 'media'], function () {
    Route::get('fetch/data', [MediaController::class,'fetch_data']);

});


Route::resource('categories', CategoryController::class);
Route::group(['prefix' => 'categories', 'as' => 'categories'], function () {
    Route::get('fetch/data', [CategoryController::class,'fetch_data']);
    Route::get('fetch/search', [CategoryController::class,'search']);

});

Route::resource('comments', CommentController::class);
Route::group(['prefix' => 'comments', 'as' => 'comments'], function () {
    Route::get('fetch/data', [CommentController::class,'fetch_data']);
    Route::get('fetch/search', [CommentController::class,'search']);

});
