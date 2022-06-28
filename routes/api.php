<?php

use Illuminate\Http\Request;
use App\User;
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

//default route /user
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//route /user
//Route::middleware('auth:api')->get('/user', 'UserController@AuthRouteAPI');

//get profile user
Route::middleware('auth:api')->get('/user/get', 'UserController@get');

//default route /user/detail
Route::get('/user/detail', function (Request $request){
    return User::find($request->user()->id);
})->middleware('auth:api');

//route user/detail
//Route::get('/user/detail', 'UserController@userDetail')->middleware('auth.api');

// Public Route
Route::post('/login','AuthenticationController@login')->name('login');


// Private Route
Route::middleware('auth:api')->group(function () {
    Route::get('/logout','AuthenticationController@logout')->name('logout');
});
