<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeesController;

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
    return view('auth.login');
});

// Auth::routes();

Route::get('/login',[AuthController::class,'index'])->name('login');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');

Route::post('/login',[AuthController::class,'proses_login'])->name('proses.login');
Route::post('/register',[AuthController::class,'proses_register'])->name('proses.register');


// Route::group(['prefix'=>'admin','middleware' => ['auth']], function () {
Route::group(['middleware' => ['auth']], function () {
    // Company
    Route::resource('company',CompanyController::class); 
    
    // Employees
    Route::resource('employees',EmployeesController::class);
      
   
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

});
