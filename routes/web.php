<?php

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

//default route /
Route::get('/', function () {
    return redirect(route('login'));
});
//route /
//Route::get('/', 'HomeController@userlogin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('auth/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');;
Route::post('auth/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('auth/login', '\App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('auth/login', '\App\Http\Controllers\Auth\LoginController@login');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/users', [
        'as' => 'user',
        'uses' => 'Admin\UserController@index'
    ]);

    Route::get('/users/create', [
        'as' => 'user.create',
        'uses' => 'Admin\UserController@create'
    ]);

    Route::post('/users/store', [
        'as' => 'user.store',
        'uses' => 'Admin\UserController@store'
    ]);

    Route::get('/users/edit/{id}', [
        'as' => 'user.edit',
        'uses' => 'Admin\UserController@create'
    ]);

    Route::delete('/users/destroy/{id}', [
        'as' => 'user.destroy',
        'uses' => 'Admin\UserController@destroy'
    ]);

    Route::get('/users/import', [
        'as' => 'user.import',
        'uses' => 'Admin\UserController@import'
    ]);

    Route::get('/users/get-data', [
        'as' => 'user.getdata',
        'uses' => 'Admin\UserController@getData'
    ]);

    Route::post('/users/get-row', [
        'as' => 'user.getrow',
        'uses' => 'Admin\UserController@getRow'
    ]);

    Route::get('/credential', [
        'as' => 'credential',
        'uses' => 'Admin\CredentialController@index'
    ]);

    Route::get('/credential/create', [
        'as' => 'credential.create',
        'uses' => 'Admin\CredentialController@create'
    ]);

    Route::get('/integration', [
        'as' => 'integration',
        'uses' => 'Admin\IntegrationController@index'
    ]);

    // Route::get('/custom', function(){
    //     return route('admin.custom');
    // });
});
