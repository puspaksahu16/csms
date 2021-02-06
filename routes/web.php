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
    Route::get('schools_delete/{id}','SchoolController@Update_status');



    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });


    Route::resource('pre_admissions', 'PreAdmissionController');
    Route::get('get_school','PreAdmissionController@getSchools');
    Route::post('/get_pre_exam','PreAdmissionController@getPreExam');
    Route::get('pre_admissions/getclass/{id}','PreAdmissionController@getClasses');
    Route::get('lara_pre_admission','PreAdmissionController@laraPreAdmission')->name('lara_pre_admission');
    Route::get('pre_admissions_delete/{id}','PreAdmissionController@Update_status');



    Route::resource('classes', 'CreateClassController');
    Route::get('/get_standard/{id}', 'CreateClassController@getStandard');
    Route::get('classes_delete/{id}', 'CreateClassController@destroy');


    Route::resource('assign_teacher', 'AssignTeacherController');
    Route::get('/get_assign_employee/{id}', 'AssignTeacherController@getEmployee');


    Route::resource('section','SectionController');
    Route::get('section/get_class/{id}','SectionController@getClasses');
    Route::get('section_delete/{id}', 'SectionController@destroy');

    Route::resource('idproof', 'IdproofControler');
    Route::get('idproof_delete/{id}', 'IdproofControler@destroy');


    Route::resource('qualification', 'QualificationController');
    Route::get('qualification_delete/{id}', 'QualificationController@destroy');


    Route::resource('set_standard', 'SetStandardController');
    Route::get('Setstandard_delete/{id}', 'SetStandardController@destroy');

    Route::resource('set_class', 'SetClassController');
    Route::get('set_class_delete/{id}', 'SetClassController@destroy');
    Route::put('set_class_delete/{id}', 'SetClassController@destroy');


    Route::resource('set_section', 'SetSectionController');
    Route::get('set_section_delete/{id}', 'SetSectionController@destroy');

    Route::resource('products', 'ProductController');
    Route::get('/product_price', 'StockController@productPriceIndex');
    Route::post('/product_price_update', 'StockController@productPriceUpdate');
    Route::post('/fetch_school_productprice','StockController@fetchschoolProductPrice');
    Route::get('/product_price_update', 'StockController@productPrice');
    Route::get('lara_product','ProductController@laraProduct')->name('lara_product');
    Route::post('fetch_size_from_gender','ProductController@fetchSizeGender');
    Route::post('fetch_gender_from_color','ProductController@fetchGenderColor');

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
    Route::get('publisher_delete/{id}', 'PublisherController@destroy');

    Route::resource('standard', 'StandardController');
    Route::get('standard_delete/{id}', 'StandardController@destroy');


    Route::resource('subject', 'SubjectController');
    Route::get('subject_delete/{id}', 'SubjectController@destroy');

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
    Route::post('/assign_section/{id}','NewAdmissionController@section_assign');
    Route::get('/fetch_new_admission_class', 'NewAdmissionController@fetchNewAdmissionByClass');

    Route::resource('admission_fee','AdmissionFeeController');
    Route::get('/admission_fee_create/{id}','AdmissionFeeController@AdmissionFee');
    Route::post('/update_installment/{id}','AdmissionFeeController@updateInstallment');


    Route::get('/monthly_fees','AdmissionFeeController@MonthlyFee');
    Route::post('/total_month/{id}','AdmissionFeeController@TotalMonth');
    Route::get('/monthly_fee_history/{id}','AdmissionFeeController@monthlyFeeHistory');
    Route::post('/monthly_fee_fine/{id}','AdmissionFeeController@monthlyFeeFine');

    //product fee create
    Route::get('/store_fee_create/{id}','AdmissionFeeController@StoreFee');

    // insert to database
    Route::post('/admission_fee_store/{id}','AdmissionFeeController@AdmissionFeeStore');
    Route::get('/admission_fee_edit/{id}','AdmissionFeeController@edit');
    Route::post('/admission_fee','AdmissionFeeController@update');


    Route::get('/installment','AdmissionFeeController@update');
    Route::get('/installment/{id}','AdmissionFeeController@InstallmentFee');
    Route::get('/receive/{id}','AdmissionFeeController@receive')->name('admission-fee');



    Route::resource('/store_fees','StoreFeeController');
    Route::get('/store_fee/{id}','StoreFeeController@StoreFee');
    Route::post('/store_fee_store/{id}','StoreFeeController@StoreFeeStore');
    Route::get('/store_payment_history/{id}','StoreFeeController@paymentHistory');
    Route::post('/payment_store/{id}','StoreFeeController@payment');
    Route::get('/store_fees_pay/{id}','StoreFeeController@pay');

    //for parent panel

    Route::get('/my-profile/{id}/edit','NewAdmissionController@edit');
    Route::get('/my-admission-fee','AdmissionFeeController@index');
    Route::get('/my-store-fees/{id}','StoreFeeController@paymentHistory');
    Route::get('/view-timetable', 'TimetableController@viewTimetable');





    ///////

    //Teacher ///////////
    Route::get('/edit-my-profile/{id}','EmployeeController@edit');
    Route::get('/create-attendance/{id}','AttendanceController@create');
    Route::post('/attendance/store/{id}','AttendanceController@store');
    Route::get('/attendances','AttendanceController@index');
    Route::post('/get_attendance','AttendanceController@getAttendance');



    ///////////

    Route::get('/edit_profile/{id}','NewAdmissionController@edit_profile');
    Route::patch('/parents_update/{id}','NewAdmissionController@parentUpdate');

    Route::get('/pay/{id}','AdmissionFeeController@pay');
    Route::get('/monthly_pay/{id}','AdmissionFeeController@monthlyPay');
    Route::post('/payment/{id}','AdmissionFeeController@payment');
    Route::post('/monthly_payment/{id}','AdmissionFeeController@monthlyPayment');
    Route::post('/admission_fee_fine/{id}','AdmissionFeeController@admissionFeeFine');
    Route::post('/admission_due_date/{id}','AdmissionFeeController@admissionDueDate');
    Route::post('/monthly_due_date/{id}','AdmissionFeeController@monthlyDueDate');

    Route::get('/payment_history/{id}','PaymentController@index');

    Route::get('/receive_store/{id}','PaymentController@Storereceive');

    Route::resource('result','ResultController');
    Route::post('/get_roll','ResultController@getRoll');
    Route::post('/get_exam','ResultController@getExam');
    Route::post('/get_mark','ResultController@getMarks');
    Route::get('lara_result','ResultController@laraResult')->name('lara_result');
    Route::get('result_delete/{id}','ResultController@destroy');
    Route::get('enroll/{id}','ResultController@enroll');

    Route::resource('employee','EmployeeController');
    Route::get('employees_delete/{id}','EmployeeController@destroy');
    Route::get('employee/{id}/show','EmployeeController@show')->name('employee.show');

    Route::get('/stateSetting', function () {
        return view('admin.stateSetting');
    });
    Route::get('/distSetting', function () {
        return view('admin.distSetting');
    });
    Route::get('/citySetting', function () {
        return view('admin.citySetting');
    });

    Route::resource('period','PeriodController');

    Route::resource('timetable','TimetableController');
    Route::get('/get_standard/{id}', 'TimetableController@getStandard');
    Route::get('/get_subject/{id}', 'TimetableController@getSubject');
    Route::get('/get_employee/{id}', 'TimetableController@getEmployee');
    Route::post('/get_period','TimetableController@getPeriod');
    Route::post('/get_classes','TimetableController@getClass');
    Route::post('/get_section','TimetableController@getSection');



    Route::resource('holiday','HolidayController');


    Route::resource('library','LibraryController');
    Route::resource('issue_book','IssueBookController');
    Route::get('/get_students/{id}', 'IssueBookController@getStudent');
    Route::get('/get_books/{id}', 'IssueBookController@getBooks');
    Route::post('/return_book/{id}','IssueBookController@returnBook');
    Route::get('return_book', 'IssueBookController@return');


    Route::resource('chat','ChatController');
    Route::post('/replay/{parent_id}/{school_id}/','ChatController@replay');
    Route::get('/get_parents/{id}', 'ChatController@getParent');
    Route::get('/chat/{parent_id}/{school_id}', 'ChatController@show');
    Route::post('/send_mail','ChatController@store');


    Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
    Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

    Route::get('login/google', 'Auth\LoginController@redirectToProviderGoogle');
    Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallbackGoogle');


    Route::get('/fetch_class_table', 'ResultController@classFiler');
    Route::get('/fetch_book_class', 'BookController@fetchBookClass');
    Route::get('/fetch_bookstock_class', 'BookStockController@fetchBookStockClass');
    Route::get('/fetch_generalfee_class', 'GeneralFeeController@fetchGeneralFeeClass');
    Route::get('/fetch_extra_class', 'ExtraClassController@fetchExtraClass');
    Route::get('/fetch_bookfee_class', 'BookController@fetchBookPriceByClass');
    Route::get('/fetch_timetable_class', 'TimetableController@fetchTimetableByClass');
    Route::get('/fetch_classby_standard', 'CreateClassController@fetchClassByStandard');
    Route::get('/fetch_periodby_standard', 'PeriodController@fetchPeriodByStandard');
});

