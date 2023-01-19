<?php

use App\Http\Controllers\AuthController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::prefix('jobboard')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/signup-employeer', [AuthController::class, 'signup_employeer']);
    Route::post('/register-user', [AuthController::class, 'register']);
    Route::post('/user/reset-pass', [AuthController::class, 'resetPassword']);
    Route::post('/user/update-pass', [AuthController::class, 'updateResettingPassword']);
    Route::get('/verified-email/{user?}', [AuthController::class, 'verified'])->name('verify');
    Route::get('/verified/account/{email}/{code}', [AuthController::class, 'verifiyAccount']);
//});