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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {

    Route::get('/test', function () {
        return auth()->user()->role;
    });

    Route::middleware('auth')->group(function () {
        Route::resource('schools', 'SchoolController');
    });


    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::resource('pre_admissions', 'PreAdmissionController');
    Route::get('lara_pre_admission','PreAdmissionController@laraPreAdmission')->name('lara_pre_admission');


    Route::resource('classes', 'CreateClassController');

    Route::resource('section','SectionController');

    Route::resource('idproof', 'IdproofControler');

    Route::resource('qualification', 'QualificationController');

    Route::resource('products', 'ProductController');
    Route::get('/product_price', 'StockController@productPriceIndex');
    Route::post('/product_price_update', 'StockController@productPriceUpdate');
    Route::get('/product_price_update', 'StockController@productPrice');
    Route::get('lara_product','ProductController@laraProduct')->name('lara_product');

    Route::resource('books', 'BookController');
    Route::get('book_price', 'BookController@bookFee');
    Route::get('book_price_update', 'BookController@bookFeeUpdate');
    Route::post('update_price', 'BookController@updatePrice');
    Route::get('lara_books','BookController@laraBooks')->name('lara_books');

    Route::post('/fetch_class', 'BookController@fetchClass');

    Route::resource('publisher', 'PublisherController');

    Route::resource('standard', 'StandardController');

    Route::resource('subject', 'SubjectController');

    Route::resource('general','GeneralFeeController');

    Route::resource('extraclasses','ExtraClassController');

    Route::resource('stocks', 'StockController');
    Route::get('lara_stocks','StockController@laraStock')->name('lara_stocks');
    Route::post('/fetch_school_products','StockController@fetchschoolProduct');

    Route::post('/fetchProductDetails','StockController@fetchProductDetails');

    Route::resource('book_stocks', 'BookStockController');
    Route::post('/fetch_sub','BookStockController@fetchSub');
    Route::post('/fetch_book','BookStockController@fetchBook');
    Route::post('/fetch_book_details','BookStockController@fetchBookDetails');
    Route::get('lara_book_stock','BookStockController@laraBookStock')->name('lara_book_stock');

    Route::resource('damages', 'DamageController');
    Route::post('fetch_damage_product_details', 'DamageController@fetchDamageProductDetails');
    Route::get('lara_damages','DamageController@laraDamages')->name('lara_damages');

    Route::resource('pre_exam','PreExamController');
    Route::get('lara_pre_exam','PreExamController@laraPreExam')->name('lara_pre_exam');

    Route::resource('new_admission','NewAdmissionController');
    Route::get('lara_new_admission','NewAdmissionController@laraNewAdmission')->name('lara_new_admission');


    Route::resource('admission_fee','AdmissionFeeController');
    Route::get('/admission_fee_create/{id}','AdmissionFeeController@AdmissionFee');
    Route::post('/admission_fee_store/{id}','AdmissionFeeController@AdmissionFeeStore');

    Route::resource('result','ResultController');
    Route::post('/get_roll','ResultController@getRoll');
    Route::get('lara_result','ResultController@laraResult')->name('lara_result');

    Route::get('/stateSetting', function () {
        return view('admin.stateSetting');
    });
    Route::get('/distSetting', function () {
        return view('admin.distSetting');
    });
    Route::get('/citySetting', function () {
        return view('admin.citySetting');
    });
});

