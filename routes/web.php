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
Route::get('/product_price', 'StockController@productPriceIndex');
Route::post('/product_price_update', 'StockController@productPriceUpdate');
Route::get('/product_price_update', 'StockController@productPrice');

Route::resource('books', 'BookController');
Route::get('book_price', 'BookController@bookFee');
Route::get('book_price_update', 'BookController@bookFeeUpdate');
Route::post('update_price', 'BookController@updatePrice');

Route::post('/fetch_class', 'BookController@fetchClass');

Route::resource('publisher', 'PublisherController');

Route::resource('standard', 'StandardController');

Route::resource('subject', 'SubjectController');

Route::resource('general','GeneralFeeController');

Route::resource('extraclasses','ExtraClassController');

Route::resource('stocks', 'StockController');

Route::post('/fetchProductDetails','StockController@fetchProductDetails');

Route::resource('book_stocks', 'BookStockController');
Route::post('/fetch_sub','BookStockController@fetchSub');
Route::post('/fetch_book','BookStockController@fetchBook');
Route::post('/fetch_book_details','BookStockController@fetchBookDetails');

Route::resource('damages', 'DamageController');
Route::post('fetch_damage_product_details', 'DamageController@fetchDamageProductDetails');

Route::resource('pre_exam','PreExamController');
Route::get('lara_pre_exam','PreExamController@laraPreExam')->name('lara_pre_exam');

Route::resource('new_admission','NewAdmissionController');

Route::resource('result','ResultController');
Route::post('/get_roll','ResultController@getRoll');

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
