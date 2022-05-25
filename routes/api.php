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
    Route::put('update', [\App\Http\Controllers\RolController::class, 'update'])->name('update');
    Route::post('create', [\App\Http\Controllers\RolController::class, 'create'])->name('create');
    Route::put('toggleEnable', [\App\Http\Controllers\RolController::class, 'toggleEnable'])->name('toggleEnable');
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'permission'
], function ($router) {
    Route::get('getAll', [\App\Http\Controllers\PermissionController::class, 'getAll'])->name('getAll');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'permission'
], function ($router) {
    Route::put('update', [\App\Http\Controllers\RolPermissionController::class, 'update'])->name('update');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'acta'
], function ($router) {
    Route::get('getAll', [\App\Http\Controllers\ActaController::class, 'getAll'])->name('getAll');
    Route::get('getOne', [\App\Http\Controllers\ActaController::class, 'getOne'])->name('getOne');
    Route::put('update', [\App\Http\Controllers\ActaController::class, 'update'])->name('update');
    Route::post('create', [\App\Http\Controllers\ActaController::class, 'create'])->name('create');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'idea'
], function ($router) {
    Route::get('getAll', [\App\Http\Controllers\IdeaController::class, 'getAll'])->name('getAll');
    Route::get('getOne', [\App\Http\Controllers\IdeaController::class, 'getOne'])->name('getOne');
    Route::put('update', [\App\Http\Controllers\IdeaController::class, 'update'])->name('update');
    Route::post('create', [\App\Http\Controllers\IdeaController::class, 'create'])->name('create');
    Route::get('getModalidades', [\App\Http\Controllers\IdeaController::class, 'getModalidades'])->name('getModalidades');
    Route::get('getLineasInvestigacion', [\App\Http\Controllers\IdeaController::class, 'getLineasInvestigacion'])->name('getLineasInvestigacion');
    Route::get('getDirectores', [\App\Http\Controllers\IdeaController::class, 'getDirectores'])->name('getDirectores');
    Route::post('createArchivoIdeas', [\App\Http\Controllers\IdeaController::class, 'createArchivoIdeas'])->name('createArchivoIdeas');
    Route::post('createArchivoIdeasEvaluacion', [\App\Http\Controllers\IdeaController::class, 'createArchivoIdeasEvaluacion'])->name('createArchivoIdeasEvaluacion');
    Route::get('getArchivoIdeas', [\App\Http\Controllers\IdeaController::class, 'getArchivoIdeas'])->name('getArchivoIdeas');
    Route::post('createUsuariosIdeas', [\App\Http\Controllers\IdeaController::class, 'createUsuariosIdeas'])->name('createUsuariosIdeas');
    Route::get('getUsuariosIdeas', [\App\Http\Controllers\IdeaController::class, 'getUsuariosIdeas'])->name('getUsuariosIdeas');
    Route::get('getEstudiantes', [\App\Http\Controllers\IdeaController::class, 'getEstudiantes'])->name('getEstudiantes');
    Route::post('createEstudiantesIdeas', [\App\Http\Controllers\IdeaController::class, 'createEstudiantesIdeas'])->name('createEstudiantesIdeas');
    Route::post('createArrArchivoIdeas', [\App\Http\Controllers\IdeaController::class, 'createArrArchivoIdeas'])->name('createArrArchivoIdeas');
    Route::post('createArrArchivoIdeasEvaluacion', [\App\Http\Controllers\IdeaController::class, 'createArrArchivoIdeasEvaluacion'])->name('createArrArchivoIdeasEvaluacion');
    Route::get('getArrArchivoIdeas', [\App\Http\Controllers\IdeaController::class, 'getArrArchivoIdeas'])->name('getArrArchivoIdeas');
    Route::get('getIdeaUsuario', [\App\Http\Controllers\IdeaController::class, 'getIdeaUsuario'])->name('getIdeaUsuario');
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'files'
], function ($router) {
    Route::post('push', [\App\Http\Controllers\FileController::class, 'push'])->name('push');
    Route::post('pushLista', [\App\Http\Controllers\FileController::class, 'pushLista'])->name('pushLista');
    Route::get('{fileId}', [\App\Http\Controllers\FileController::class, 'getOne'])->name('getOne');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'listas'
], function ($router) {
    Route::get('getAll', [\App\Http\Controllers\ListaController::class, 'getAll'])->name('getAll');
    Route::get('getOne', [\App\Http\Controllers\ListaController::class, 'getOne'])->name('getOne');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'ideaEstado'
], function ($router) {
    Route::post('createIdeaEstado', [\App\Http\Controllers\IdeaController::class, 'createIdeaEstado'])->name('createIdeaEstado');
    Route::get('getIdeaEstado', [\App\Http\Controllers\IdeaController::class, 'getIdeaEstado'])->name('getIdeaEstado');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'notificacion'
], function ($router) {
    Route::get('getAll', [\App\Http\Controllers\NotificationController::class, 'getAll'])->name('getAll');
    Route::get('markAsReaded', [\App\Http\Controllers\NotificationController::class, 'markAsReaded'])->name('markAsReaded');
});
