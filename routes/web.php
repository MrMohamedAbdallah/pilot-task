<?php

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

use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [UserController::class, 'show'])->middleware(['auth'])->name('dashboard');
Route::post('/dashboard', [UserController::class, 'update'])->middleware(['auth'])->name('dashboard.update');

require __DIR__.'/auth.php';
