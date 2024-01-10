<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Route::post('register',[AuthController::class,'register'])->name('register');
Route::post('login',[AuthController::class,'login'])->name('login');

Route::middleware('auth:sanctum')->group(function(){

Route::get('index',[PostController::class, 'index'])->name('index');
Route::post('store',[PostController::class, 'store'])->name('store');
Route::get('show/{id}',[PostController::class, 'show'])->name('show');
Route::put('update/{id}',[PostController::class, 'update'])->name('update');
Route::put('update/{id}',[PostController::class, 'update'])->name('update');
Route::delete('delete/{id}',[PostController::class, 'delete'])->name('delete');

Route::get('information',[UserController::class, 'information'])->name('information');
Route::put('updateInfo/{id}',[UserController::class, 'updateInfo'])->name('updateInfo');





});

