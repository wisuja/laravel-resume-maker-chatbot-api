<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\CvsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 'Resume maker API is working!';
});

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::middleware(['jwt.verify'])->group(function () {
    Route::get('/profile/{user}', [ProfilesController::class, 'show']);
    Route::put('/profile/{user}', [ProfilesController::class, 'update']);
    
    Route::get('/chat', [ChatController::class, 'index']);
    Route::post('/chat', [ChatController::class, 'chat']);
    
    Route::get('/cv/{cv}', [CvsController::class, 'show'])->name('download-cv');
});
