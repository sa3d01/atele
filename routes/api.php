<?php

use App\Http\Middleware\CheckApiToken;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'v1','namespace'=>'Api'], function () {
    Route::get('/setting', 'SettingController@index');
    Route::group(['prefix' => '/user'], function () {
        Route::post('/', 'UserController@register');
        Route::post('/login', 'UserController@login');
        Route::post('/resend_code', 'UserController@resend_code');
        Route::post('/activate', 'UserController@activate');
        Route::post('/update', 'UserController@update_profile')->middleware(CheckApiToken::class);
        Route::get('/{id}', 'UserController@show')->middleware(CheckApiToken::class);
    });
    Route::group(['prefix' => '/package'], function () {
        Route::get('/', 'PackageController@index');
        Route::post('/', 'PackageController@store');
    });
});
