<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KampusController;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->group( function() {
    $controller = UserController::class;
    Route::get('/', [$controller, 'dataUser']);
    Route::post('/register', [$controller, 'register']);
    Route::post('/login', [$controller, 'login']);
});

Route::prefix('kampus')->group( function() {
    $controller = KampusController::class;
    Route::get('/', [$controller, 'getAll']);
    Route::post('/create', [$controller, 'addKampus']);
});



