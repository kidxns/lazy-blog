<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route > Post
Route::get('/', [PostController::class, 'index'])->name('index');
Route::resource('post', PostController::class);
Route::group(['prefix' => 'posts', 'as' => 'posts'], function () {
    Route::get('/', [PostController::class,'all'])->name('.all');
    Route::get('fetch/data', [PostController::class,'fetch_data']);
    Route::get('fetch/search', [PostController::class,'search']);
    Route::get('fetch/filter', [PostController::class,'filter']);

});



//Route > Comment
Route::resource('comment', CommentController::class);
Route::group(['prefix' => 'comment', 'as' => 'comments'], function () {
    Route::get('fetch/data', [CommentController::class,'fetch_data']);

});

