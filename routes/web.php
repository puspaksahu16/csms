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
    Route::get('get_school','PreAdmissionController@getSchools');
    Route::get('pre_admissions/getclass/{id}','PreAdmissionController@getClasses');
    Route::get('lara_pre_admission','PreAdmissionController@laraPreAdmission')->name('lara_pre_admission');


    Route::resource('classes', 'CreateClassController');
    Route::get('/get_standard/{id}', 'CreateClassController@getStandard');

    Route::resource('section','SectionController');

    Route::resource('idproof', 'IdproofControler');

    Route::resource('qualification', 'QualificationController');

    Route::resource('products', 'ProductController');
    Route::get('/product_price', 'StockController@productPriceIndex');
    Route::post('/product_price_update', 'StockController@productPriceUpdate');
    Route::post('/fetch_school_productprice','StockController@fetchschoolProductPrice');
    Route::get('/product_price_update', 'StockController@productPrice');
    Route::get('lara_product','ProductController@laraProduct')->name('lara_product');

    Route::resource('books', 'BookController');
    Route::get('book_price', 'BookController@bookFee');
    Route::get('book_price_update', 'BookController@bookFeeUpdate');
    Route::post('update_price', 'BookController@updatePrice');
    Route::post('/fetch_school_books','BookController@fetchschoolBook');
    Route::post('/fetch_school_bookprice','BookController@fetchschoolBookPrice');
    Route::get('lara_books','BookController@laraBooks')->name('lara_books');

    Route::post('/fetch_class', 'BookController@fetchClass');
    Route::get('/get_class/{id}', 'CreateClassController@getClass');

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
    Route::post('/fetch_school_bookstock','BookStockController@fetchschoolBookstock');
    Route::post('/fetch_book_details','BookStockController@fetchBookDetails');
    Route::get('lara_book_stock','BookStockController@laraBookStock')->name('lara_book_stock');

    Route::resource('damages', 'DamageController');
    Route::post('fetch_damage_product_details', 'DamageController@fetchDamageProductDetails');
    Route::post('/fetch_school_dproducts','DamageController@fetchschoolProductDamage');
    Route::get('lara_damages','DamageController@laraDamages')->name('lara_damages');

    Route::resource('pre_exam','PreExamController');
    Route::get('get_school','PreExamController@getSchools');
    Route::get('pre_exam/getclass/{id}','PreExamController@getClasses');
    Route::get('lara_pre_exam','PreExamController@laraPreExam')->name('lara_pre_exam');

    Route::resource('new_admission','NewAdmissionController');
    Route::get('lara_new_admission','NewAdmissionController@laraNewAdmission')->name('lara_new_admission');
    Route::get('new_admission/{id}/view','NewAdmissionController@show')->name('new_admission.view');
    Route::get('parents','NewAdmissionController@parentsIndex')->name('parents.index');
    Route::get('get_school','NewAdmissionController@getSchools');
    Route::get('new_admission/getclass/{id}','NewAdmissionController@getClasses');


    Route::resource('admission_fee','AdmissionFeeController');
    Route::get('/admission_fee_create/{id}','AdmissionFeeController@AdmissionFee');
    Route::post('/update_installment/{id}','AdmissionFeeController@updateInstallment');

    //product fee create
    Route::get('/store_fee_create/{id}','AdmissionFeeController@StoreFee');

    // insert to database
    Route::post('/admission_fee_store/{id}','AdmissionFeeController@AdmissionFeeStore');
    Route::get('/admission_fee_edit/{id}','AdmissionFeeController@edit');
    Route::post('/admission_fee','AdmissionFeeController@update');


    Route::get('/installment','AdmissionFeeController@update');


    Route::resource('/store_fees','StoreFeeController');
    Route::get('/store_fee/{id}','StoreFeeController@StoreFee');
    Route::post('/store_fee_store/{id}','StoreFeeController@StoreFeeStore');
    Route::get('/store_payment_history/{id}','StoreFeeController@paymentHistory');
    Route::post('/payment_store/{id}','StoreFeeController@payment');
    Route::get('/store_fees_pay/{id}','StoreFeeController@pay');


    Route::get('/edit_profile/{id}','NewAdmissionController@edit_profile');
    Route::patch('/parents_update/{id}','NewAdmissionController@parentUpdate');

    Route::get('/pay/{id}','AdmissionFeeController@pay');
    Route::post('/payment/{id}','AdmissionFeeController@payment');

    Route::get('/payment_history/{id}','PaymentController@index');
    Route::get('/receive/{id}','PaymentController@receive');

    Route::resource('result','ResultController');
    Route::post('/get_roll','ResultController@getRoll');
    Route::get('lara_result','ResultController@laraResult')->name('lara_result');

    Route::resource('employee','EmployeeController');

    Route::get('/stateSetting', function () {
        return view('admin.stateSetting');
    });
    Route::get('/distSetting', function () {
        return view('admin.distSetting');
    });
    Route::get('/citySetting', function () {
        return view('admin.citySetting');
    });

    Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
    Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

    Route::get('login/google', 'Auth\LoginController@redirectToProviderGoogle');
    Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallbackGoogle');
});

