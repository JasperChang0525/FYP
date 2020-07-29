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


/*
Route::get('/hello', function () {
    //return view('welcome');
    return '<h1>Hello World</h1>';
});
*/

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
Route::resource('/posts','PostsController');
Route::get('/alert', 'AdminController@policealert');
Route::post('/alert/{id}', 'AdminController@solvesos');
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('users/logout','Auth\AdminLoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function(){
Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/', 'AdminController@index')->name('admin.home');
Route::get('/logout','Auth\AdminLoginController@logout')->name('admin.logout');


Route::get('/register','Auth\AdminRegisterController@showRegistrationForm');
Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register');
// Password reset routes
Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');


Route::get('/report','AdminController@reportlist');
Route::get('report/{id}', 'AdminController@policereport');
route::get('{id}/{zonlist_id}', 'AdminController@policeschedule');

});

Route::get('/shift', 'PatrolController@setuser');
Route::post('/shift','PatrolController@saveshift');
Route::get('/shiftlist', 'PatrolController@displayshift');


Route::get('/zon/{id}/{zonlist_id}/{police_id}', 'PatrolController@zon');

Route::post('/zon/{id}/{zonlist_id}/{police_id}', 'PatrolController@checkin');

Route::get('/sos', 'PatrolController@sos');
Route::post('/sos', 'PatrolController@savesos');

Route::get('/zonlist', 'ZonController@index');
Route::post('/zonlist', 'ZonController@createzonlist');
Route::get('/zonlist/{zonlist_id}/{zon_ukm}', 'ZonController@show');
Route::post('/zonlist/{zonlist_id}/{zon_ukm}/{id}', 'ZonController@destroy');
Route::get('/zonlist/addcheckpoint', 'ZonController@addcheckpoint');
Route::post('/zonlist/addcheckpoint','ZonController@addcheckpointlist');


