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
    Route::get('/home', 'HomeController@index');
    Route::get('/providers', 'HomeController@providers');
    Route::get('/used_products', 'HomeController@used_products');
    Route::get('/setting', 'SettingController@index');
    Route::group(['prefix' => '/user'], function () {
        Route::post('/', 'UserController@register');
        Route::post('/resend_code', 'UserController@resend_code');
        Route::post('/login', 'UserController@login');
        Route::post('/activate', 'UserController@activate')->middleware(CheckApiToken::class);
        Route::post('/update', 'UserController@update_profile')->middleware(CheckApiToken::class);
        Route::post('/update_password', 'UserController@update_password')->middleware(CheckApiToken::class);
        Route::post('/reset_password', 'UserController@reset_password')->middleware(CheckApiToken::class);
        Route::get('/{id}', 'UserController@show')->middleware(CheckApiToken::class);
    });
    Route::group(['prefix' => '/package','middleware'=>CheckApiToken::class], function () {
        Route::get('/', 'PackageController@index');
    });
    Route::get('/', 'ProductController@store');
    Route::group(['prefix' => '/product','middleware'=>CheckApiToken::class], function () {
        Route::post('/upload_images', 'ProductController@upload_multi_files');
        Route::post('/', 'ProductController@store');
        Route::post('/{id}', 'ProductController@update');
        Route::delete('/{id}', 'ProductController@destroy');
    });
    Route::group(['prefix' => '/order','middleware'=>CheckApiToken::class], function () {
        Route::post('/', 'OrderController@store');
        Route::get('/{type}', 'OrderController@order_tabs');
        Route::get('/{id}', 'OrderController@show');
        Route::post('/{id}', 'OrderController@update');
        Route::post('/{id}/cancel', 'OrderController@cancel');
        Route::post('/{id}/accept', 'OrderController@accept');
    });
    Route::group(['prefix' => '/notification','middleware'=>CheckApiToken::class], function () {
        Route::get('/', 'NotificationController@index');
    });
    
});
