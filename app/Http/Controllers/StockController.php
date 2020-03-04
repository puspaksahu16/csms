<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Stock;
use App\ProductColor;
use App\ProductSize;
use App\ProductType;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::with(['products:id,name','colors:id,name','types:id,name','sizes:id,name'])
        ->get();
        // return$available_stock = $stocks->stock_in - $stocks->stock_out;
        return view('admin.stocks.index', compact(['stocks']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $colors = ProductColor::all();
        $sizes = ProductSize::all();
        $types = ProductType::all();
        return view('admin.stocks.create', compact(['products', 'colors', 'sizes', 'types']));
    }


    public function fetchProductDetails(Request $request)
    {
        // return $request;
        $selectedproduct = Product::find($request->product_id);
        $colors = '';
        $sizes = '';
        $types = '';
        $genders = '';

        if ($selectedproduct->color == 1) {
            $colors = ProductColor::all();
        }

        if ($selectedproduct->size == 1) {
            $sizes = ProductSize::all();
        }

        if ($selectedproduct->type == 1) {
            $types = ProductType::all();
        }

        if ($selectedproduct->gender == 1) {
            $genders = [['id' => 1, 'name' => 'boys'],['id' => 2, 'name' => 'girls']];
        }

        return response(['colors' => $colors, 'sizes' => $sizes, 'types' => $types, 'genders' => $genders]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->stock as $stock) {
            $stock['stock_in'] = $stock['quantity'];
            $availables = Stock::where('product_id', $stock['product_id'])
            ->where('color_id', $stock['color_id'])
            ->where('type_id', $stock['type_id'])
            ->where('gender_id', $stock['gender_id'])
            ->where('size_id', $stock['size_id'])
            ->get();

            if (count($availables) <= 0) {
                $createstock = new Stock();
                $createstock->create($stock);
            }else{
                $update = Stock::find($availables[0]['id']);
                $update->stock_in = $availables[0]['stock_in'] + $stock['quantity'];
                $update->update();
            }
        }
        return response(["success"]);
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
