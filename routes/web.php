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

Route::get('/', function () {
    return redirect(route('admin.dashboard'));
});
Auth::routes();
Route::group(['prefix' => '/admin', 'namespace' => 'Auth'], function () {
    Route::get('/password/reset','AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email','AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::post('/password/reset','AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}','AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});
Route::group(['prefix' => '/admin', 'namespace' => 'Admin'], function () {
//auth
    Route::get('/login', 'AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'AdminLoginController@logout')->name('admin.logout');
//admin
    Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('/', 'AdminController@dashboard')->name('login');
    Route::resource('admin', 'AdminController');
//setting
    Route::get('setting', 'SettingController@get_setting')->name('setting.get_setting');
    Route::patch('setting/{id}', 'SettingController@update_setting')->name('setting.update_setting');
//user
    Route::resource('user', 'UserController');
//provider
    Route::get('provider/new', 'ProviderController@new_providers')->name('provider.new');
    Route::get('provider/approved', 'ProviderController@approved_providers')->name('provider.approved');
    Route::get('provider/blocked', 'ProviderController@blocked_providers')->name('provider.blocked');
    Route::resource('provider', 'ProviderController');
});
