<?php

use App\Http\Controllers\FurparentController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/messages/send', [MessageController::class, 'sendMessage']);
Route::middleware('auth:sanctum')->get('/messages/thread/{talkToID}/find', [MessageController::class, 'getThread']);
Route::middleware('auth:sanctum')->get('/messages/get/{threadID}', [MessageController::class, 'getMessages']);


Route::middleware('auth:sanctum')->get('/furparent/get/{id}', [FurparentController::class, 'getDetails']);