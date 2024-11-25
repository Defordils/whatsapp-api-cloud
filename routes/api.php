<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatroomController;
use App\Http\Controllers\MessageController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('chatroom')->group(function () {
        Route::post('/create', [ChatroomController::class, 'create']);
        Route::get('/', [ChatroomController::class, 'list']);
        Route::post('/{id}/enter', [ChatroomController::class, 'enter']);
        Route::post('/{id}/leave', [ChatroomController::class, 'leave']);
    });

    Route::prefix('message')->group(function () {
        Route::post('/send', [MessageController::class, 'sendMessage']);
        Route::get('/chatroom/{id}/messages', [MessageController::class, 'listMessage']);
    });
});
