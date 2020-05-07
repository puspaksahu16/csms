<?php

namespace App\Http\Controllers;

use App\AdmissionFee;
use App\Book;
use App\BookStock;
use App\ExtraClass;
use App\GeneralFee;
use App\Stock;
use App\Student;
use Illuminate\Http\Request;

class AdmissionFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student_fees = AdmissionFee::with('students:first_name,last_name,student_unique_id,id')->get();
//        return$student_fees = AdmissionFee::with('students:first_name,last_name,student_unique_id,id')->get();

        $fee = 0;
        foreach ($student_fees as $sf)
        {
            $all_general_fee = json_decode($sf->general);
            foreach ($all_general_fee as $agf)
            {
                $general_fee = GeneralFee::find($agf);
                if ($general_fee->type == 1)
                {
                    $fee += $general_fee->price;
                }
                elseif ($general_fee->type == 2)
                {
                    $fee += ($general_fee->price * 12);
                }
            }
            $all_product_fee = json_decode($sf->product);
            foreach ($all_product_fee as $apf)
            {
                $product_fee = Stock::find($apf);
                $fee += $product_fee->price;
            }
            $all_ecc_fee = json_decode($sf->ecc);
            foreach ($all_ecc_fee as $aef)
            {
                $ecc_fee = ExtraClass::find($aef);
                if ($ecc_fee->type == 1)
                {
                    $fee += $ecc_fee->price;
                }
                elseif ($ecc_fee->type == 2)
                {
                    $fee += ($ecc_fee->price * 12);
                }
            }
            $all_book_fee = json_decode($sf->book);
            foreach ($all_book_fee as $abf)
            {
                $book_fee = Book::find($abf);
                $fee += $book_fee->price;
            }
        }
        return view('admin.admission_fee.index', compact(['student_fees', 'fee']));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function AdmissionFee($id)
    {
        $student = Student::find($id);
        $std_id = $student->class_id;
        $general_fees = GeneralFee::where('class_id', $std_id)->get();
        $products = Stock::all();
        $extra_classes = ExtraClass::where('class_id', $std_id)->get();
        $book = Book::with('stock')->where('class_id', $std_id)->get();

        return view('admin.new_admission.fee',compact(['id', 'general_fees', 'products', 'extra_classes', 'book']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function AdmissionFeeStore($id, Request $request)
    {
        $af = AdmissionFee::where('student_id', $id)->first();
        if (empty($af))
        {
            $admission_fee = new AdmissionFee();
            $admission_fee->student_id = $id;
            $admission_fee->general = json_encode($request->general);
            $admission_fee->product = json_encode($request->product);
            $admission_fee->ecc = json_encode($request->ecc);
            $admission_fee->book = json_encode($request->book);
            $admission_fee->save();
            return redirect()->route('new_admission.index')->with('success', 'Admission Fee Created Successfully');
        }else{
            return redirect()->route('new_admission.index')->with('error', 'Student have Registered Already');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $addmision_fee = AdmissionFee::find($id);
         $selected_product = json_decode($addmision_fee->product);
         $selected_general = json_decode($addmision_fee->general);
         $selected_classes = json_decode($addmision_fee->ecc);
         $selected_books = json_decode($addmision_fee->book);
          $student = Student::find($addmision_fee->student_id);
         $std_id = $student->class_id;
        $general_fees = GeneralFee::where('class_id', $std_id)->get();
        $products = Stock::all();
        $extra_classes = ExtraClass::where('class_id', $std_id)->get();
        $book = Book::with('stock')->where('class_id', $std_id)->get();

        return view('admin.new_admission.edit_fee',compact(['id', 'general_fees', 'products', 'extra_classes', 'book','selected_product','addmision_fee','selected_general','selected_classes','selected_books']));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $af = AdmissionFee::where('id', $id)->first();
        $af->general = json_encode($request->general);
        $af->product = json_encode($request->product);
        $af->ecc = json_encode($request->ecc);
        $af->book = json_encode($request->book);
        $af->update();
            return redirect()->route('new_admission.index')->with('success', 'Admission Fee updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
