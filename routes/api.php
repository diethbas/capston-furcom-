<?php

use App\Http\Controllers\AdminController;
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

use App\Http\Controllers\FurbabiesController;

Route::get('/admin/furbabies/fetch', [AdminController::class, 'fetchFurbabies']);
Route::post('/admin/furbabies/add', [AdminController::class, 'addFurbaby']);
Route::put('/admin/furbabies/edit/{id}', [AdminController::class, 'editFurbaby']);
Route::delete('/admin/furbabies/delete/{id}', [AdminController::class, 'deleteFurbaby']);


Route::get('/admin/furparents/fetch', [AdminController::class, 'fetchFurparents']);
Route::post('/admin/furparents/add', [AdminController::class, 'addFurparent']);
Route::put('/admin/furparents/edit/{id}', [AdminController::class, 'editFurparent']);
Route::delete('/admin/furparents/delete/{id}', [AdminController::class, 'deleteFurparent']);
