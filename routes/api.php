<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GalleryController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/', [GalleryController::class, 'index'])->middleware('cors');
Route::post('/create', [GalleryController::class, 'store'])->middleware('auth:sanctum');
Route::get('/my-galleries', [GalleryController::class, 'myGalleries'])->middleware('auth:sanctum');
Route::get('/galleries/{id}', [GalleryController::class, 'show']);
Route::get('/authors/{id}', [GalleryController::class, 'authorGalleries']);
Route::post('/add-comment', [CommentController::class, 'store'])->middleware('auth:sanctum');