<?php

use App\Http\Controllers\Api\SubscribeController;
use App\Http\Controllers\Api\TopicController;
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

Route::prefix('v1')->group(function () {
    Route::post('topic', [TopicController::class,'store'])->name('create.topic');
    Route::post('subscribe/{uuid}', [SubscribeController::class,'subscribe']);
    Route::post('publish/{uuid}', [TopicController::class,'publish']);
});
