<?php

use Illuminate\Http\Request;
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

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login');
    Route::post('logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');
    Route::post('refresh', [\App\Http\Controllers\Auth\AuthController::class, 'refresh'])->name('refresh');
    Route::post('me', [\App\Http\Controllers\Auth\AuthController::class, 'me'])->name('me');
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'user'
], function ($router) {
    Route::get('getAll', [\App\Http\Controllers\UserController::class, 'getAll'])->name('getAll');
    Route::get('getOne', [\App\Http\Controllers\UserController::class, 'getOne'])->name('getOne');
    Route::post('create', [\App\Http\Controllers\UserController::class, 'create'])->name('create');
    Route::post('changePassword', [\App\Http\Controllers\UserController::class, 'changePassword'])->name('changePassword');
    Route::put('update', [\App\Http\Controllers\UserController::class, 'update'])->name('update');
    Route::put('toggleEnable', [\App\Http\Controllers\UserController::class, 'toggleEnable'])->name('toggleEnable');
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'rol'
], function ($router) {
    Route::get('getAll', [\App\Http\Controllers\RolController::class, 'getAll'])->name('getAll');
    Route::get('getOne', [\App\Http\Controllers\RolController::class, 'getOne'])->name('getOne');
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'roluser'
], function ($router) {
    Route::get('getRolUser', [\App\Http\Controllers\RolUserController::class, 'getRolUser'])->name('getRolUser');
    Route::put('toggleEnable', [\App\Http\Controllers\RolUserController::class, 'toggleEnable'])->name('toggleEnable');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'rol'
], function ($router) {
    Route::get('getAll', [\App\Http\Controllers\RolController::class, 'getAll'])->name('getAll');
    Route::put('toggleEnable', [\App\Http\Controllers\RolController::class, 'toggleEnable'])->name('toggleEnable');
});
