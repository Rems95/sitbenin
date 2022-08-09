<?php

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


Route::group(['prefix' => 'admin'], function() {
    Auth::routes(['register' => false]);
});


Route::group([
    'middleware' => ['auth'],
    'prefix' => 'admin'
], function() {

    Route::resource('users', 'UsersController');
    Route::resource('roles', 'RolesController');
    Route::resource('subsector', 'SubsectorController');
    Route::get('adherant/delete/{id}', 'AdherantController@destroy')->name("adherant.delete");
    Route::post('adherant/update{id}', 'AdherantController@update')->name("adherant.update");
    Route::get('adherant/edit/{id}', 'AdherantController@edit')->name("adherant.edit");
    Route::get('adherant/index', 'AdherantController@index')->name("adherant.index");
    Route::get('adherant/show', 'AdherantController@show')->name("adherant.show");
    Route::post('adherant/store', 'AdherantController@store')->name("adherant.store");

    Route::get('payment/create', 'PaymentController@create')->name("payment.create");
    Route::post('payment/store', 'PaymentController@store')->name("payment.store");
    Route::get('payment/index', 'PaymentController@index')->name("payment.index");
    Route::get('payment/edit/{id}', 'PaymentController@edit')->name("payment.edit");
    Route::post('payment/update{id}', 'PaymentController@update')->name("payment.update");
    Route::get('payment/delete/{id}', 'PaymentController@destroy')->name("payment.delete");

    Route::get('password','ResetPasswordController@showPasswordResetFrom');
    Route::patch('password/change', 'ResetPasswordController@update')->name('password.change');

    Route::get('/home', 'HomeController@index')->name('admin.home');

    Route::get('event/create', 'EventController@create')->name("event.create");
    Route::post('event/store', 'EventController@store')->name("event.store");
    Route::get('event/index', 'EventController@index')->name("event.index");
    Route::get('event/edit/{id}', 'EventController@edit')->name("event.edit");
    Route::post('event/update{id}', 'EventController@update')->name("event.update");
    Route::get('event/delete/{id}', 'EventController@destroy')->name("event.delete");



});
Route::get('/adherant/list', 'AdherantController@getAdherants')->name('adherant.list');
Route::get('/subsector/list', 'SubsectorController@getSubsectors')->name('subsector.list');
Route::get('/event/list', 'EventController@getEvents')->name('event.list');

Route::get('/', 'IndexController@index')->name('site.home');
Route::get('/home', 'IndexController@index');
Route::get('/adhesion', 'AdhesionController@index')->name('site.adhesion');

Route::get('adherant/create', 'AdherantController@create')->name('adherant.create');



