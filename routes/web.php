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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function(){

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Dashboard
Route::get('/dashboard', [App\Http\Controllers\dashboard\DashboardController::class, 'index'])->name('dashboard');

//Users
Route::get('/dashboard/users', [App\Http\Controllers\dashboard\UserController::class, 'index'])->name('dashboard.user');
Route::get('/dashboard/user/create', [App\Http\Controllers\dashboard\UserController::class, 'create'])->name('dashboard.user.create');
Route::post('/dashboard/user', [App\Http\Controllers\dashboard\UserController::class, 'store'])->name('dashboard.user.store');
Route::get('/dashboard/user/edit/{user}', [App\Http\Controllers\Dashboard\UserController::class, 'edit'])->name('dashboard.user.edit');
Route::put('/dashboard/user/update/{user}', [App\Http\Controllers\Dashboard\UserController::class, 'update'])->name('dashboard.user.update');
Route::delete('/dashboard/user/delete/{user}', [App\Http\Controllers\dashboard\UserController::class, 'destroy'])->name('dashboard.user.delete');

//Siswa
Route::get('/dashboard/siswa', [App\Http\Controllers\dashboard\SiswaController::class, 'index'])->name('dashboard.siswa');
Route::get('/dashboard/siswa/create', [App\Http\Controllers\dashboard\SiswaController::class, 'create'])->name('dashboard.siswa.create');
Route::get('/dashboard/siswa/edit/{siswa}', [App\Http\Controllers\dashboard\SiswaController::class, 'edit'])->name('dashboard.siswa.edit');
Route::put('/dashboard/siswa/edit/{siswa}', [App\Http\Controllers\dashboard\SiswaController::class, 'update'])->name('dashboard.siswa.update');
Route::post('/dashboard/siswa', [App\Http\Controllers\dashboard\SiswaController::class, 'store'])->name('dashboard.siswa.store');
Route::delete('/dashboard/siswa/delete/{siswa}', [App\Http\Controllers\dashboard\SiswaController::class, 'destroy'])->name('dashboard.siswa.delete');
Route::get('/dashboard/siswa/show/{siswa}', [App\Http\Controllers\dashboard\SiswaController::class, 'show'])->name('dashboard.siswa.show');

});