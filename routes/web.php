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

use TCG\Voyager\Facades\Voyager;

Route::get('/', function () {
    return view('welcome');})->name('start')->middleware('auth');


Route::get('/user','ResidentController@index')->middleware('auth')->name('user');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('invoices/download/{id}', 'InvoiceController@download');

Route::get('invoices/sendmail/{id}', 'MailController@sendMail');


