<?php

namespace App\Http\Controllers;

use App\Book;
use App\Payment;
use App\Product;
use App\StoreFee;
use App\StudentParent;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $payment = Payment::where('student_id', $id)->get();
        return view('admin.payments.index', compact('payment'));
    }

    public function receive($id)
    {

         $payment = Payment::where('id', $id)->first();

//          $products = StoreFee::where('id',$payment->product_id)->get('product');
//          $books = StoreFee::where('id',$payment->product_id)->get('book');
//
//
//
//          foreach ($products as $pr){
//             $item =  $pr->product;
//          }
//
//        foreach ($books as $book){
//            $book_id =  $book->book;
//        }
//
//         $json_toArray = json_decode($item,true);
//         $array_ids = array_column($json_toArray, 'id');
//
//         $result = Product::whereIn('id', $array_ids)->get('name');
//
//          $result_toArray = json_decode($result,true);
//         $array_name = array_column($result_toArray, 'name');
//
//
//         $items = $array_name;


        return view('admin.payments.receive', compact(['payment']));
//        return view('admin.payments.receive', compact(['payment','items']));
    }
    public function Storereceive($id)
    {
        $payment = Payment::where('id', $id)->first();

        $products = StoreFee::where('id',$payment->product_id)->get('product');
        $books = StoreFee::where('id',$payment->product_id)->get('book');



        foreach ($products as $pr){
             $item =  $pr->product;

        }

         $json_toArray = json_decode($item,true);
       $array_ids = array_column($json_toArray, 'id');

       $array_qty = array_column($json_toArray, 'quantity');


          $results = Product::whereIn('id', $array_ids)->get(['size','name']);

//        $result_toArray = json_decode($results,true);
//        return $array_name = array_column($result_toArray,'name');


//        $items = $array_name;


//        return view('admin.payments.receive', compact(['payment']));
        return view('admin.payments.receive_store', compact(['payment','results', 'json_toArray']));
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
