<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\employeeController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\registerController;
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

Route::get('/register',[registerController::class,'index'])->name('register');
Route::post('/register',[registerController::class,'store'])->name('register.store');
Route::get('/login',[loginController::class,'index'])->name('login');
Route::post('/login',[loginController::class,'process_login'])->name('login');
Route::post('/logout',[loginController::class,'logout'])->name('logout');


Route::get('/employee',[employeeController::class,'index'])->name('employee');

Route::group(['middleware' => ['auth','authadmin']], function(){
    Route::get('/admin/dashboard',[AdminDashboardController::class,'index'])->name('admin.dashboard');
});



