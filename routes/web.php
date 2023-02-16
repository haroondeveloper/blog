<?php

use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/register', [RegistrationController::class, 'create'])->name('register');
//Route::post('/register', [RegistrationController::class, 'store']);
//
//Route::get('/login', [LoginController::class, 'create'])->name('login');
//Route::post('/login', [LoginController::class, 'store']);

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/roles', [RolesController::class, 'index'])->name('roles.index');
Route::get('/roles/create', [RolesController::class, 'create'])->name('roles.create');
Route::post('/roles', [RolesController::class, 'store'])->name('roles.store');
Route::get('/roles/{id}/edit', [RolesController::class, 'edit'])->name('roles.edit');
Route::put('/roles/{id}', [RolesController::class, 'update'])->name('roles.update');
Route::delete('/roles/{id}', [RolesController::class, 'destroy'])->name('roles.destroy');

Route::get('/permissions', [PermissionsController::class, 'index'])->name('permissions.index');
Route::get('/permissions/create', [PermissionsController::class, 'create'])->name('permissions.create');
Route::post('/permissions', [PermissionsController::class, 'store'])->name('permissions.store');
Route::get('/permissions/{id}/edit', [PermissionsController::class, 'edit'])->name('permissions.edit');
Route::put('/permissions/{id}', [PermissionsController::class, 'update'])->name('permissions.update');
Route::delete('/permissions/{id}', [PermissionsController::class, 'destroy'])->name('permissions.destroy');
