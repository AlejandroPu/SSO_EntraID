<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'redirectToProvider'])
    ->name('login')
    ->middleware('guest');

Route::get('/login/microsoft/callback', [LoginController::class, 'handleProviderCallback']);

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
