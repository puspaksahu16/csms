<?php

namespace App\Http\Controllers;

use App\Book;
use App\Payment;
use App\Stock;
use App\StoreFee;
use App\Student;
use Illuminate\Http\Request;

class StoreFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with('school')->get();

        return view('admin.store_fee.index', compact('students'));
    }

    public function StoreFee($id)
    {
        $student = Student::find($id);
        $std_id = $student->class_id;
        $products = Stock::where('school_id', $student->school_id)->where('price', '!=', 'null')->where('price', '!=', 0)->get();
        $book = Book::with('stock')
            ->where('class_id', $std_id)
            ->where('price', '!=', 'null')
            ->where('price', '!=', 0)
            ->where('school_id', $student->school_id)
            ->get();
        return view('admin.store_fee.store_fee', compact(['id', 'products', 'book']));
    }


    public function StoreFeeStore(Request $request, $id)
    {
        if ($request->book != null || $request->product != null )
        {
            $fee = 0;

            $store_fee = new StoreFee();
            $store_fee->student_id = $id;
            $products = [];
            foreach ($request->product as $p)
            {
                if (!empty($p['id']))
                {
                    array_push($products, $p);
                }
            }
            $store_fee->product = json_encode($products);
            $store_fee->book = json_encode($request->book);
            $store_fee->store_fee = $fee;
            $store_fee->save();
            $sf = StoreFee::with('students:first_name,last_name,student_unique_id,id')->find($store_fee->id);
//            foreach ($student_fees as $sf)
//            {
            $all_product_fee = json_decode($sf->product);
            if (!empty($all_product_fee)){
                foreach ($all_product_fee as $apf)
                {
                    $product_fee = Stock::find($apf->id);
                    $pp = $apf->quantity * $product_fee->price;
                    $fee += $pp;
                    $product_fee->stock_out += $apf->quantity;
                    $product_fee->update();
                }
            }

            $all_book_fee = json_decode($sf->book);
            if (!empty($all_book_fee)){
                foreach ($all_book_fee as $abf)
                {
                    $book_fee = Book::find($abf);
                    $fee += $book_fee->price;
                    $book_fee->stock_out += 1 ;
                    $book_fee->update();
                }
            }
//            }

            $sf->store_fee = $fee;
            $sf->update();
//            return $sf->id;

//            return view('admin.store_fee.pay', compact(['fee', 'id']));

            return redirect()->to('store_fees_pay/'.$sf->id);
        }else{
            return back()->with('error', 'Please Select some item');
        }
        
    }

    public function pay($id)
    {
        $fee = StoreFee::find($id);
        return view('admin.store_fee.pay', ['fee' => $fee->store_fee, 'id' => $fee->id ]);
    }


    public function payment(Request $request, $id)
    {
        $sf = StoreFee::find($id);
        $data = $request->all();
        $data['reason'] = 'Store_Fee';
        $data['student_id'] = $sf->student_id;

        if ($request->amount == $sf['store_fee'])
        {
            $payment = Payment::create($data);
            return redirect()->route('store_fees.index')->with('success', 'Payment Successfully Done');
        }else{
            return redirect()->back()->with('error', 'Payment Amount is not same');
        }
    }


    public function paymentHistory($id)
    {
        $payment = Payment::where('student_id', $id)->where('reason', 'Store_Fee')->get();
        return view('admin.store_fee.history', compact('payment'));
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
        //
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
        //
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
