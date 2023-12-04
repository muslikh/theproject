<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\ApiAuthController;
// use App\Http\Controllers\Auth\ApiAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/',function(){
    $response = ['message' =>  'Data Not Found'];
return response($response, 200);
});

Route::middleware(['cors', 'json.response', 'auth:api'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['cors', 'json.response']], function () {
    
    Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
   
    Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
    
});

Route::middleware('auth:api')->group(function () {
    
    // Company
    Route::resource('companyApi',Api\CompanyApiController::class);
    // Employees
    Route::resource('employeesApi',Api\EmployeesApiController::class);

});