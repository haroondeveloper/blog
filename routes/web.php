<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\CustomersController;

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


Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

//customers
Route::resource('customers', CustomersController::class)->middleware(['auth']);

//roles
Route::resource('/roles', RolesController::class)->middleware('auth');

//permession
Route::resource('/permissions', PermissionsController::class)->middleware('auth');

Auth::routes();
