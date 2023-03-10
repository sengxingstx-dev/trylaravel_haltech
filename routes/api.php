<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// jwt-auth routes
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    // Route::post('logout', 'AuthController@logout');
    Route::post('refresh', [AuthController::class], 'refresh');
    // Route::post('me', 'AuthController@me');

});


// api method = get, post, put, delete
Route::group([

    'middleware' => 'auth.jwt',

], function ($router) {
    
    Route::get('list-provinces', [ProvinceController::class, 'listProvinces']);
    Route::post('add-province', [ProvinceController::class, 'addProvince'])->name('add.province');
    Route::put('edit-province/{id}', [ProvinceController::class, 'editProvince'])->name('edit.province');
    Route::delete('delete-province/{id}', [ProvinceController::class, 'deleteProvince'])->name('delete.province');
    
    Route::get('list-districts', [DistrictController::class, 'listDistricts']);
    Route::post('add-district', [DistrictController::class, 'addDistrict'])->name('add.district');
    Route::put('edit-district/{id}', [DistrictController::class, 'editDistrict'])->name('edit.district');
    Route::delete('delete-district/{id}', [DistrictController::class, 'deleteDistrict'])->name('delete.district');

});

Route::get('list-user-profile', [UserProfileController::class, 'listUserProfile'])->name('list.user.profile');
Route::post('add-user-profile', [UserProfileController::class, 'addUserProfile'])->name('add.user.profile');

Route::post('send-mail', [MailController::class, 'sendMail']);

Route::post('check-data', [TestController::class, 'checkData']);
