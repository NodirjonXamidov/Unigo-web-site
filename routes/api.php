<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ScholarshipsWonController;
use App\Http\Controllers\SuccsessStudentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\password;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// // Route::post('register',[AuthController::class,'register'])->name('register');
Route::post('login',[AuthController::class,'login'])->name('login');
// // Route::delete('deleteinfo/{id}',[AuthController::class,'deleteinfo'])->name('deleteinfo');

Route::middleware('auth:sanctum')->group(function(){

Route::get('index',[PostController::class, 'index'])->name('index');
Route::post('store',[PostController::class, 'store'])->name('store');
Route::get('show/{id}',[PostController::class, 'show'])->name('show');
Route::put('update/{id}',[PostController::class, 'update'])->name('update');
Route::delete('delete/{id}',[PostController::class, 'delete'])->name('delete');

Route::get('information',[UserController::class, 'information'])->name('information');
Route::put('updateInfo/{id}',[UserController::class, 'updateInfo'])->name('updateInfo')->middleware('confirm.password');

Route::get('indexComment',[CommentsController::class, 'indexComment'])->name('indexComment');
Route::post('createComment',[CommentsController::class, 'createComment'])->name('createComment');
Route::put('updateComment/{id}',[CommentsController::class, 'updateComment'])->name('updateComment');
Route::delete('deleteComment/{id}',[CommentsController::class, 'deleteComment'])->name('deleteComment');

Route::post('confirm',[CommentsController::class, 'passwordConfirm'])->name('password.confirm');

Route::get('indexStudent',[SuccsessStudentController::class,'indexStudent'])->name('indexStudent');
Route::post('createStudent',[SuccsessStudentController::class,'createStudent'])->name('createStudent');
Route::put('joining/{id}',[SuccsessStudentController::class,'joining'])->name('joining');

Route::get('indexScholarships', [ScholarshipsWonController::class,'indexScholarships']);
Route::post('createScholarship',[ScholarshipsWonController::class,'createScholarship']);
Route::put('joiningScholarship',[ScholarshipsWonController::class,'joiningScholarship']);

});

