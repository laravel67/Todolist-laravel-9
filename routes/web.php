<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthUserMiddleware;
use App\Http\Middleware\GuestMiddleware;
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
    return view('welcome');
})->name('home');

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'showForm')->name('showForm')->middleware([GuestMiddleware::class]);
    Route::post('/login', 'login')->name('authenticate')->middleware([GuestMiddleware::class]);
    Route::post('/logout', 'logout')->name('logout')->middleware([AuthUserMiddleware::class]);
});

Route::get('todolist', function () {
    return view('todolist.index', [
        'title' => 'Todolist'
    ]);
})->name('todolist')->middleware([AuthUserMiddleware::class]);
