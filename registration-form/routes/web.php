<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [PagesController::class, 'index'])->name('homepage');
Route::get('/home', [PagesController::class, 'home'])->name('home')->middleware('auth');

Route::get('/Register', [PagesController::class, 'register'])->name('register')->middleware('guest');
Route::post('/Register', [PagesController::class, 'addUser'])->middleware('guest');

Route::get('/activate-user', [MailController::class, 'verify'])->name('verifyEmail');

Route::get('/activate-resend', [MailController::class, 'showResend'])->name('resend');
Route::get('/activate-resendB', [MailController::class, 'resend'])->name('resendB');

Route::get('/login', [PagesController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [PagesController::class, 'loginAuth'])->middleware('guest');
Route::get('/logout', [PagesController::class, 'logOut'])->name('log-out');
