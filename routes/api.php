<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\PassWordResetController;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\MediaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
    Route::get('signup/activate/{token}', [AuthController::class, 'signupActivate']);

    Route::group([
        'middleware' => 'auth:api',
    ], function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });

});

Route::group([
    'namespace' => 'Auth',
    'middleware' => 'api',
    'prefix' => 'password',
], function () {
    Route::post('create', [PassWordResetController::class, 'create']);
    Route::get('find/{token}', [PasswordResetController::class, 'find']);
    Route::post('reset', [PasswordResetController::class, 'reset']);
});



Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    Route::Resource('post', PostController::class);
    Route::Resource('category', CategoryController::class);
    Route::Resource('user', UserController::class);
    Route::Resource('media', MediaController::class);
});
