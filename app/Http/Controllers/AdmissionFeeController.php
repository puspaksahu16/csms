<?php

namespace App\Http\Controllers;

use App\AdmissionFee;
use App\Book;
use App\BookStock;
use App\ExtraClass;
use App\GeneralFee;
use App\Installment;
use App\MonthlyFee;
use App\MonthlyFeeHistory;
use App\Payment;
use App\Stock;
use App\Student;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function Sodium\compare;

class AdmissionFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->name == "parent")
        {
            $student_fees = AdmissionFee::with('students')->where('student_id', auth()->user()->parent->student_id)->get();
        }elseif (auth()->user()->role->name == "admin"){
//            return  auth()->user()->school->id;
//             $student_fees = AdmissionFee::with('students')->where('school_id', auth()->user()->school->id)->get();
             $students = AdmissionFee::with(['students' => function ($q){
                return $q->where('school_id', auth()->user()->school->id)->get();
            }])->get();
            $student_fees = [];
             foreach ($students as $s)
             {
                 if ($s->students !== null)
                 {
                     array_push($student_fees, $s);
                 }
             }
        }else{
            $student_fees = AdmissionFee::with('students')->get();
        }

        foreach ($student_fees as $key => $sf)
        {
            $payment = Payment::where('student_id', $sf->student_id)->where('reason', "Admission Fee")->sum('amount');
            $fine = Installment::where('student_id', $sf->student_id)->sum('fine');
            $sf->paid = $payment;
            $sf->fine = $fine;
            $sf->due = $sf->fee - ($sf->paid - $fine);
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
            $installment->installment_no = $i;
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
    public function receive($id)
    {
         $payment = Payment::find($id);
         return view('admin.payments.receive' , compact(['payment']));
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
//        return$request;

        $monthly_fee = 0;
        $monthly_genera_fee = [];
        $annual_general_fee = [];
        $request_general_fee = $request->general;
        if (!empty($request_general_fee)){
            foreach ($request_general_fee as $gf)
            {
                $general_fee = GeneralFee::find($gf);
                if ($general_fee->type == 2)
                {
                    $monthly_fee += $general_fee->price;
                    array_push($monthly_genera_fee, $general_fee->id);
                }elseif ($general_fee->type == 1){
                    array_push($annual_general_fee, $general_fee->id);
                }
            }
        }

        $monthly_cca_fee = [];
        $annual_cca_fee = [];

        $request_ecc_fee = $request->ecc;
        if (!empty($request_ecc_fee)){
            foreach ($request_ecc_fee as $ref)
            {
                $ecc_fee = ExtraClass::find($ref);
                if ($ecc_fee->type == 2)
                {
                    $monthly_fee += $ecc_fee->price;
                    array_push($monthly_cca_fee, $ecc_fee->id);
                }elseif ($ecc_fee->type == 1){
                    array_push($annual_cca_fee, $ecc_fee->id);
                }
            }
        }

        $af = AdmissionFee::where('student_id', $id)->first();

        if (empty($af))
        {
//            $student = Student::find($id);
            $fee = 0;

            $admission_fee = new AdmissionFee();
            $admission_fee->student_id = $id;
//            $admission_fee->school_id = $student->school_id;
            $admission_fee->discount_type = $request->discount_type;
            $admission_fee->discount = $request->discount;
            $admission_fee->general = json_encode($annual_general_fee);

            $admission_fee->ecc = json_encode($annual_cca_fee);
            $admission_fee->fee = $fee;
            $admission_fee->save();

            if (count($monthly_genera_fee) > 0 AND count($monthly_cca_fee) > 0)
            {
                $month_fee = new MonthlyFee();
                $month_fee->student_id = $id;
                $month_fee->general_fee_id = json_encode($monthly_genera_fee);
                $month_fee->ecc_fee_id = json_encode($monthly_cca_fee);
                $month_fee->fee = $monthly_fee;
                $month_fee->fine = 0;
                $month_fee->due = 0;
                $month_fee->paid = 0;

                $month_fee->save();
            }elseif (count($monthly_genera_fee) > 0){
                $month_fee = new MonthlyFee();
                $month_fee->student_id = $id;
                $month_fee->general_fee_id = json_encode($monthly_genera_fee);
                $month_fee->ecc_fee_id = json_encode($monthly_cca_fee);
                $month_fee->fee = $monthly_fee;
                $month_fee->fine = 0;
                $month_fee->due = 0;
                $month_fee->paid = 0;

                $month_fee->save();
            }elseif (count($monthly_cca_fee) > 0){
                $month_fee = new MonthlyFee();
                $month_fee->student_id = $id;
                $month_fee->general_fee_id = json_encode($monthly_genera_fee);
                $month_fee->ecc_fee_id = json_encode($monthly_cca_fee);
                $month_fee->fee = $monthly_fee;
                $month_fee->fine = 0;
                $month_fee->due = 0;
                $month_fee->paid = 0;

                $month_fee->save();
            }

            $sf = AdmissionFee::with('students:first_name,last_name,student_unique_id,id')->where('student_id', $id)->first();

                $all_general_fee = json_decode($sf->general);
                if (!empty($all_general_fee)){
                    foreach ($all_general_fee as $agf)
                    {
                        $general_fee = GeneralFee::find($agf);
                        if ($general_fee->type == 1)
                        {
                            $fee += $general_fee->price;
                        }
                    }
                }

                $all_ecc_fee = json_decode($sf->ecc);
                if (!empty($all_ecc_fee)){
                    foreach ($all_ecc_fee as $aef)
                    {
                        $ecc_fee = ExtraClass::find($aef);
                        if ($ecc_fee->type == 1)
                        {
                            $fee += $ecc_fee->price;
                        }
                    }
                }

            if ($request->discount_type == 'percentage')
            {
                $fee = $fee - ($fee * ($request->discount / 100));
            }elseif ($request->discount_type == 'amount'){
                $fee = $fee - $request->discount;
            }
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
        $installment = Installment::find($id);
        return view('admin.admission_fee.pay', compact(['installment', 'id']));
    }


    public function payment(Request $request, $id)
    {
        $installment = Installment::find($id);
        $student_id = $installment->student_id;
//        $af = AdmissionFee::where('student_id', $student_id)->first();
        $pa = Payment::where('student_id', $student_id)->sum('amount');
        $data = $request->all();
        $data['reason'] = 'Admission Fee';
        $data['student_id'] = $student_id;
        $student = Student::find($student_id);
        $in_sf = Payment::where('school_id', $student->school_id)->orderBy('invoice_no','DESC')->first();
        if (!empty($in_sf)){
            $invoice = $in_sf->invoice_no + 1;
        }else{
            $invoice = 1;
        }
        $data['school_id'] = $student->school_id;
        $data['invoice_no'] = $invoice;


        if ($request->amount <= $installment->installment_fee)
        {
            $payment = Payment::create($data);
            $installment->status = "Paid";
            $installment->paid = $request->amount;
            $installment->payment_id = $payment->id;
            $installment->student_id = $student_id;


            $installment->update();
            $due = $installment->installment_fee - $request->amount;
            $installment_due = Installment::where('student_id', $student_id)->where('installment_no', $installment->installment_no + 1)->first();
            if (!empty($installment_due)){
                $installment_due->due = $due;
                $installment_due->installment_fee = $installment_due->installment_fee + $due;
                $installment_due->update();
            }else{
//                return $installment->due;
                if ($due != 0)
                {
                    $new_installment = new Installment();
                    $new_installment->student_id = $student_id;
                    $new_installment->installment_no = $installment->installment_no + 1;
                    $new_installment->installment_fee = $due;
                    $new_installment->due = $due;
                    $new_installment->save();
                }
            }

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
    public function admissionDueDate(Request $request, $id)
    {
        date_default_timezone_set('Asia/Calcutta');

        $due_date = Installment::find($id);
        $next = Installment::where('installment_no', ($due_date->installment_no + 1))->where('student_id', $due_date->student_id)->get();
        if ($next[0]['status'] == 'Pending'){
            if ($request->due_date > date('Y-m-d H:i:s'))
            {
            $a = $id+1;
            $due = Installment::find($a);
            $due->due_date = $request->due_date;
            $due->update();
            return redirect()->to('installment/'.$due_date->student_id)->with('success', 'Due Date Successfully Added');
        }else{
                return redirect()->to('installment/'.$due_date->student_id)->with('error', 'Due Date Must be greater then today');
            }
        }else{
            return redirect()->to('installment/'.$due_date->student_id)->with('error', 'Next Payment is already Paid');
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

         $monthly_fee = MonthlyFee::where('student_id', $addmision_fee->student_id)->first();

        if (!empty($monthly_fee))
        {
            $selected_general_monthly = json_decode($monthly_fee->general_fee_id);
            $selected_ecc_monthly = json_decode($addmision_fee->ecc_fee_id);
        }else{
            $selected_general_monthly = [];
            $selected_ecc_monthly = [];
        }

//         $selected_books = json_decode($addmision_fee->book);
          $student = Student::find($addmision_fee->student_id);

         $std_id = $student->class_id;
        $general_fees = GeneralFee::where('class_id', $std_id)->where('school_id', $student->school_id)->get();

        $extra_classes = ExtraClass::where('class_id', $std_id)->where('school_id', $student->school_id)->get();
        $book = Book::with('stock')->where('class_id', $std_id)->get();

        return view('admin.new_admission.edit_fee',compact(['id', 'selected_general_monthly', 'selected_ecc_monthly', 'general_fees', 'extra_classes','addmision_fee','selected_general','selected_classes']));


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
//        return 1;
        $monthly_fee = 0;
        $monthly_genera_fee = [];
        $annual_general_fee = [];
        $request_general_fee = $request->general;
        if (!empty($request_general_fee)){
            foreach ($request_general_fee as $gf)
            {
                $general_fee = GeneralFee::find($gf);
                if ($general_fee->type == 2)
                {
                    $monthly_fee += $general_fee->price;
                    array_push($monthly_genera_fee, $general_fee->id);
                }elseif ($general_fee->type == 1){
                    array_push($annual_general_fee, $general_fee->id);
                }
            }
        }

        $monthly_cca_fee = [];
        $annual_cca_fee = [];

        $request_ecc_fee = $request->ecc;
        if (!empty($request_ecc_fee)){
            foreach ($request_ecc_fee as $ref)
            {
                $ecc_fee = ExtraClass::find($ref);
                if ($ecc_fee->type == 2)
                {
                    $monthly_fee += $ecc_fee->price;
                    array_push($monthly_cca_fee, $ecc_fee->id);
                }elseif ($ecc_fee->type == 1){
                    array_push($annual_cca_fee, $ecc_fee->id);
                }
            }
        }




        $fee = 0;
        $af = AdmissionFee::where('id', $id)->first();
        $af->general = json_encode($annual_general_fee);
        $af->ecc = json_encode($annual_cca_fee);
        $af->discount_type = $request->discount_type;
        $af->discount = $request->discount;
        $af->update();

        $mf = MonthlyFee::where('student_id', $af->student_id)->first();
        $mf->ecc_fee_id = json_encode($monthly_genera_fee);
        $mf->general_fee_id = json_encode($monthly_cca_fee);
        $mf->fee = $monthly_fee;
        $mf->update();

        $sf = AdmissionFee::with('students:first_name,last_name,student_unique_id,id')->where('id', $id)->first();

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

        if (!empty($sf->installment))
        {
            $paid_price = 0;
            $installment = Installment::where('student_id', $sf->student_id)->where('status', 'Paid')->get();
            foreach ($installment as $inst){
                $paid_price += $inst->installment_fee - $inst->fine - $inst->due;
//                $paid_price += $inst->paid + $inst->fine + $inst->due;
//                $paid_price += $inst->installment_fee + $inst->fine + $inst->due;
            }
//            return $paid_price;
            $pending_installment = Installment::where('student_id', $sf->student_id)->where('status', 'Pending')->get();
            $pending_price = $fee - $paid_price;
            $new_pending_installment = $pending_price / count($pending_installment);
            foreach ($pending_installment as $pi)
            {
                $pi->installment_fee = round($new_pending_installment) + $pi->fine + $pi->due;
                $pi->update();
            }
        }

        $sf->fee = $fee;
        $sf->update();


            return redirect()->route('new_admission.index')->with('success', 'Admission Fee updated Successfully');

    }


    public function MonthlyFee()
    {
        if (auth()->user()->role->name == "super_admin")
        {
           $monthly_fees = Student::with('monthly_fee')->get();
        }
        elseif(auth()->user()->role->name == "admin")
        {
            $monthly_fees = Student::with('monthly_fee.history')->where('school_id', auth()->user()->school->id)->get();
//            return $monthly_fees;
        }
        $students = [];
        foreach ($monthly_fees as $mf)
        {
            if (!empty($mf->monthly_fee))
            {
                array_push($students, $mf);
            }
        }

//        return $students;
        return view('admin.monthly_fee.index', compact('students'));
    }

    public function TotalMonth(Request $request, $id)
    {
        $monthly_fee = MonthlyFee::find($id);

        $monthly_fee->total_month = $request->total_month;
        $monthly_fee->update();



        $monthly_fee_history = MonthlyFeeHistory::where('student_id', $monthly_fee->student_id)->get();

        if (count($monthly_fee_history) > 0)
        {
            foreach($monthly_fee_history as $history)
            {
                $history->delete();
            }
        }
        for ($i=1; $i <= $monthly_fee->total_month; $i++)
        {
            $mfh = new MonthlyFeeHistory();
            $mfh->student_id = $monthly_fee->student_id;
            $mfh->installment_no = $i;
            $mfh->monthly_fee = $monthly_fee->fee;
            $mfh->monthly_fee_id = $monthly_fee->id;
            $mfh->save();
        }

        return redirect()->back()->with("success", 'Total month updated Successfully');
    }

    public function monthlyFeeHistory($id)
    {
        $monthly_fee_history = MonthlyFeeHistory::where('monthly_fee_id', $id)->get();

        return view('admin.monthly_fee.installment',['installments' => $monthly_fee_history]);

    }

    public function monthlyFeeFine(Request $request, $id)
    {
        $installment = MonthlyFeeHistory::find($id);
        $installment->fine += $request->fine;
        $installment->monthly_fee += $request->fine;
        $installment->update();

        $monthly_fee = MonthlyFee::find($installment->monthly_fee_id);
        $monthly_fee->fine += $request->fine;
        $monthly_fee->update();
        return redirect()->to('monthly_fee_history/'.$installment->monthly_fee_id)->with('success', 'Fine Added Successfully');
    }

    public function monthlyPay($id)
    {
        $installment = MonthlyFeeHistory::find($id);
        return view('admin.monthly_fee.pay', compact(['installment', 'id']));
    }

    public function monthlyPayment(Request $request, $id)
    {
        $installment = MonthlyFeeHistory::find($id);
        $student_id = $installment->student_id;
//        $af = AdmissionFee::where('student_id', $student_id)->first();
//        $pa = Payment::where('student_id', $student_id)->sum('amount');
        $data = $request->all();
        $data['reason'] = 'Monthly Fee';
        $data['student_id'] = $student_id;
        $student = Student::find($student_id);
        $in_sf = Payment::where('school_id', $student->school_id)->orderBy('invoice_no','DESC')->first();
        if (!empty($in_sf)){
            $invoice = $in_sf->invoice_no + 1;
        }else{
            $invoice = 1;
        }
        $data['school_id'] = $student->school_id;
        $data['invoice_no'] = $invoice;


        if ($request->amount <= $installment->monthly_fee)
        {
            $payment = Payment::create($data);
            $installment->status = "Paid";
            $installment->paid = $request->amount;
            $installment->payment_id = $payment->id;
            $installment->student_id = $student_id;


            $installment->update();
            $due = $installment->monthly_fee - $request->amount;
            $installment_due = MonthlyFeeHistory::where('monthly_fee_id', $installment->monthly_fee_id)->where('installment_no', $installment->installment_no + 1)->first();
            $monthly_fee = MonthlyFee::where('student_id', $student_id)->first();
            if (!empty($installment_due)){
                $installment_due->due = $due;
                $installment_due->monthly_fee = $installment_due->monthly_fee + $due;
                $installment_due->update();
                $monthly_fee->paid += $installment->paid;
                $monthly_fee->due = ($monthly_fee->fine + ($monthly_fee->fee * $monthly_fee->total_month)) - $monthly_fee->paid;
                $monthly_fee->update();
            }else{
//                return $installment->due;
                if ($due != 0)
                {
                    $new_installment = new MonthlyFeeHistory();
                    $new_installment->student_id = $student_id;
                    $new_installment->installment_no = $installment->installment_no + 1;
                    $new_installment->monthly_fee = $due;
                    $new_installment->due = $due;
                    $new_installment->save();
                }
            }

            return redirect()->to('monthly_fee_history/'.$installment->monthly_fee_id)->with('success', 'Payment Successfully Done');
        }else{
            return redirect()->back()->with('error', 'Payment Amount is Grater than Total Amount');
        }

    }
    public function monthlyDueDate(Request $request, $id)
    {
        date_default_timezone_set('Asia/Calcutta');

        $due_date = MonthlyFeeHistory::find($id);
        $next = MonthlyFeeHistory::where('installment_no', ($due_date->installment_no + 1))->where('student_id', $due_date->student_id)->get();
        if ($next[0]['status'] == 'Pending'){
            if ($request->due_date > date('Y-m-d H:i:s'))
            {
                $a = $id+1;
                $due = MonthlyFeeHistory::find($a);
                $due->due_date = $request->due_date;
                $due->update();
                return redirect()->to('monthly_fee_history/'.$due_date->monthly_fee_id)->with('success', 'Due Date Successfully Added');
            }else{
                return redirect()->to('monthly_fee_history/'.$due_date->monthly_fee_id)->with('error', 'Due Date Must be greater then today');
            }
        }else{
            return redirect()->to('monthly_fee_history/'.$due_date->monthly_fee_id)->with('error', 'Next Payment is already Paid');
        }

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
