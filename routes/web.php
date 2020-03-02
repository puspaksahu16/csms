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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::resource('pre_admissions', 'PreAdmissionController');

Route::resource('classes', 'CreateClassController');

Route::resource('section','SectionController');

Route::resource('idproof', 'IdproofControler');

Route::resource('qualification', 'QualificationController');

Route::resource('products', 'ProductController');
Route::get('products/book', 'ProductController@book');

Route::resource('stocks', 'StockController');
Route::post('/fetchProductDetails','StockController@fetchProductDetails');

Route::resource('damages', 'DamageController');

Route::get('/stateSetting', function () {
    return view('admin.stateSetting');
});
Route::get('/distSetting', function () {
    return view('admin.distSetting');
});
Route::get('/citySetting', function () {
    return view('admin.citySetting');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
