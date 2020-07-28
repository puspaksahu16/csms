<?php

namespace App\Http\Controllers;

use App\AdmissionFee;
use App\Book;
use App\BookStock;
use App\ExtraClass;
use App\GeneralFee;
use App\Installment;
use App\Payment;
use App\Stock;
use App\Student;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        foreach ($student_fees as $key => $sf)
        {
            $payment = Payment::where('student_id', $sf->student_id)->sum('amount');
            $sf->paid = $payment;
        }
//        return$student_fees = AdmissionFee::with('students:first_name,last_name,student_unique_id,id')->get();
//
//        $fee = 0;
//        foreach ($student_fees as $sf)
//        {
//            $all_general_fee = json_decode($sf->general);
//            foreach ($all_general_fee as $agf)
//            {
//                $general_fee = GeneralFee::find($agf);
//                if ($general_fee->type == 1)
//                {
//                    $fee += $general_fee->price;
//                }
//                elseif ($general_fee->type == 2)
//                {
//                    $fee += ($general_fee->price * 12);
//                }
//            }
//            $all_product_fee = json_decode($sf->product);
//            foreach ($all_product_fee as $apf)
//            {
//                $product_fee = Stock::find($apf);
//                $fee += $product_fee->price;
//            }
//            $all_ecc_fee = json_decode($sf->ecc);
//            foreach ($all_ecc_fee as $aef)
//            {
//                $ecc_fee = ExtraClass::find($aef);
//                if ($ecc_fee->type == 1)
//                {
//                    $fee += $ecc_fee->price;
//                }
//                elseif ($ecc_fee->type == 2)
//                {
//                    $fee += ($ecc_fee->price * 12);
//                }
//            }
//            $all_book_fee = json_decode($sf->book);
//            foreach ($all_book_fee as $abf)
//            {
//                $book_fee = Book::find($abf);
//                $fee += $book_fee->price;
//            }
//        }
//        return$student_fees;
        return view('admin.admission_fee.index', compact(['student_fees']));
    }

    public function updateInstallment(Request $request, $id)
    {
        $af = AdmissionFee::find($id);
        $af->installment = $request->installment;
        $af->update();

        $if = $af->fee / $af->installment;
        for ($i=1; $i <= $af->installment; $i++)
        {
            $installment = new Installment();
            $installment->student_id = $af->student_id;
            $installment->installment_fee = round($if);
            $installment->save();
        }

        return redirect()->to('admission_fee')->with('success', 'Installment Updated Successfully');
    }

    public function InstallmentFee($id)
    {
        $installments = Installment::where('student_id', $id)->get();
        return view('admin.admission_fee.installment', compact(['installments', 'id']));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function AdmissionFee($id)
    {
        $student = Student::find($id);
        $std_id = $student->class_id;
        $general_fees = GeneralFee::where('class_id', $std_id)->where('school_id', $student->school_id)->get();
//        $products = Stock::all();
        $extra_classes = ExtraClass::where('class_id', $std_id)->where('school_id', $student->school_id)->get();
//        $book = Book::with('stock')->where('class_id', $std_id)->get();

        return view('admin.new_admission.fee',compact(['id', 'general_fees', 'extra_classes']));
    }

//    public function StoreFee($id)
//    {
//        $student = Student::find($id);
//        $std_id = $student->class_id;
//        $products = Stock::where('school_id', $student->school_id)->get();
//        $book = Book::with('stock')->where('class_id', $std_id)->where('school_id', $student->school_id)->get();
//
//        return view('admin.new_admission.store_fee',compact(['id', 'products', 'book']));
//    }

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
//        return$id;
        $af = AdmissionFee::where('student_id', $id)->first();

        if (empty($af))
        {
            $fee = 0;

            $admission_fee = new AdmissionFee();
            $admission_fee->student_id = $id;
            $admission_fee->general = json_encode($request->general);
//            $products = [];
//            foreach ($request->product as $p)
//            {
//                if (!empty($p['id']))
//                {
//                    array_push($products, $p);
//                }
//            }
//            $admission_fee->product = json_encode($products);
            $admission_fee->ecc = json_encode($request->ecc);
//            $admission_fee->book = json_encode($request->book);
            $admission_fee->fee = $fee;
            $admission_fee->save();
            $sf = AdmissionFee::with('students:first_name,last_name,student_unique_id,id')->where('student_id', $id)->first();
//            foreach ($student_fees as $sf)
//            {
                $all_general_fee = json_decode($sf->general);
                if (!empty($all_general_fee)){
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
                }
//                $all_product_fee = json_decode($sf->product);
//                if (!empty($all_product_fee)){
//                    foreach ($all_product_fee as $apf)
//                    {
//                        $product_fee = Stock::find($apf->id);
//                        $pp = $apf->quantity * $product_fee->price;
//                        $fee += $pp;
//                    }
//                }
                $all_ecc_fee = json_decode($sf->ecc);
                if (!empty($all_ecc_fee)){
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
                }
//                $all_book_fee = json_decode($sf->book);
//                if (!empty($all_book_fee)){
//                    foreach ($all_book_fee as $abf)
//                    {
//                        $book_fee = Book::find($abf);
//                        $fee += $book_fee->price;
//                    }
//                }
//            }

            $sf->fee = $fee;
            $sf->update();
            return redirect()->route('new_admission.index')->with('success', 'Admission Fee Created Successfully');
        }else{
            return redirect()->route('new_admission.index')->with('error', 'Student have Registered Already');
        }
    }

//    public function StoreFeeStore($id, Request $request)
//    {
////        return$id;
//        $af = AdmissionFee::where('student_id', $id)->get('store_fee')->first();
//
//        if (empty($af))
//        {
//            $store_fee = 0;
//
//            $admission_fee = new AdmissionFee();
//            $admission_fee->student_id = $id;
//            $products = [];
//            foreach ($request->product as $p)
//            {
//                if (!empty($p['id']))
//                {
//                    array_push($products, $p);
//                }
//            }
//            $admission_fee->product = json_encode($products);
//            $admission_fee->book = json_encode($request->book);
//            $admission_fee->store_fee = $store_fee;
//            $admission_fee->save();
//            $sf = AdmissionFee::with('students:first_name,last_name,student_unique_id,id')->where('student_id', $id)->first();
////            foreach ($student_fees as $sf)
////            {
//            $all_product_fee = json_decode($sf->product);
//            if (!empty($all_product_fee)){
//                foreach ($all_product_fee as $apf)
//                {
//                    $product_fee = Stock::find($apf->id);
//                    $pp = $apf->quantity * $product_fee->price;
//                    $store_fee += $pp;
//                }
//            }
//
//            $all_book_fee = json_decode($sf->book);
//            if (!empty($all_book_fee)){
//                foreach ($all_book_fee as $abf)
//                {
//                    $book_fee = Book::find($abf);
//                    $store_fee += $book_fee->price;
//                }
//            }
////            }
//
//            $sf->store_fee = $store_fee;
//            $sf->update();
//            return redirect()->route('new_admission.index')->with('success', 'Store Fee Created Successfully');
//        }else{
//            return redirect()->route('new_admission.index')->with('error', 'Student have Registered Already');
//        }
//    }

    public function pay($id)
    {
        $installment =Installment::find($id);
        return view('admin.admission_fee.pay', compact(['installment', 'id']));
    }


    public function payment(Request $request, $id)
    {
        $installment = Installment::find($id);
        $student_id = $installment->student_id;
        $af = AdmissionFee::where('student_id', $student_id)->first();
        $pa = Payment::where('student_id', $student_id)->sum('amount');
        $data = $request->all();
        $data['reason'] = 'Admission Fee';
        $data['student_id'] = $student_id;



        $a = $pa + $request->amount;
        if ($a <= $af->fee)
        {
            $payment = Payment::create($data);
            $installment->status = "Paid";
            $installment->update();

            return redirect()->to('installment/'.$student_id)->with('success', 'Payment Successfully Done');
        }else{
            return redirect()->back()->with('error', 'Payment Amount is Grater than Total Amount');
        }

    }

    public function admissionFeeFine(Request $request, $id)
    {
        $installment = Installment::find($id);
        $installment->fine += $request->fine;
        $installment->installment_fee += $request->fine;
        $installment->update();
        return redirect()->to('installment/'.$installment->student_id)->with('success', 'Payment Successfully Done');
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
//        $products = Stock::all();
//        foreach ($products as $p) {
//            foreach ($selected_product as $sp) {
//                if ($p->id == $sp->id)
//                {
//                    $p->selected = true;
//                    $p->quantity = $sp->quantity;
//                }
//            }
//        }
//        return $products;
         $selected_general = json_decode($addmision_fee->general);
         $selected_classes = json_decode($addmision_fee->ecc);
//         $selected_books = json_decode($addmision_fee->book);
          $student = Student::find($addmision_fee->student_id);
         $std_id = $student->class_id;
        $general_fees = GeneralFee::where('class_id', $std_id)->where('school_id', $student->school_id)->get();

        $extra_classes = ExtraClass::where('class_id', $std_id)->where('school_id', $student->school_id)->get();
        $book = Book::with('stock')->where('class_id', $std_id)->get();

        return view('admin.new_admission.edit_fee',compact(['id', 'general_fees', 'extra_classes','addmision_fee','selected_general','selected_classes']));


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
        $fee = 0;
        $af = AdmissionFee::where('id', $id)->first();
        $af->general = json_encode($request->general);
//        $products = [];
//        foreach ($request->product as $p)
//        {
//            if (!empty($p['id']))
//            {
//                array_push($products, $p);
//            }
//        }
//        $af->product = $products;
        $af->ecc = json_encode($request->ecc);
//        $af->book = json_encode($request->book);
        $af->update();
        $sf = AdmissionFee::with('students:first_name,last_name,student_unique_id,id')->where('id', $id)->first();
//            foreach ($student_fees as $sf)
//            {
        $all_general_fee = json_decode($sf->general);
        if (!empty($all_general_fee)){
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
        }
//        $all_product_fee = json_decode($sf->product);
//        if (!empty($all_product_fee)){
//
//            foreach ($all_product_fee as $apf)
//            {
//                $product_fee = Stock::find($apf->id);
//                $pp = $apf->quantity * $product_fee->price;
//                $fee += $pp;
//            }
//        }
        $all_ecc_fee = json_decode($sf->ecc);
        if (!empty($all_ecc_fee)){
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
        }
//        $all_book_fee = json_decode($sf->book);
//        if (!empty($all_book_fee)){
//            foreach ($all_book_fee as $abf)
//            {
//                $book_fee = Book::find($abf);
//                $fee += $book_fee->price;
//            }
//        }
//            }

        $sf->fee = $fee;
        $sf->update();
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
