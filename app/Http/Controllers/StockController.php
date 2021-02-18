<?php

namespace App\Http\Controllers;

use App\School;
use Freshbitsweb\Laratables\Laratables;
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
        if (auth()->user()->role->name == "super_admin") {

              $stocks = Stock::with(['products:id,name', 'colors:id,name', 'types:id,name', 'sizes:id,name'])->with('schools')
                ->get();

        }else{
            $stocks = Stock::where('school_id', auth()->user()->school->id)->with(['products:id,name', 'colors:id,name', 'types:id,name', 'sizes:id,name'])->with('schools')->get();
        }
        // return$available_stock = $stocks->stock_in - $stocks->stock_out;
        return view('admin.stocks.index', compact(['stocks']));
    }

    public function laraStock()
    {
        return Laratables::recordsOf(Stock::class);
    }

    /**
     * Product price index return view
     */
    public function productPriceIndex()
    {
        if (auth()->user()->role->name == "super_admin") {
            $stocks = Stock::with(['products:id,name','colors:id,name','types:id,name','sizes:id,name'])
                ->get();
        }else{
            $stocks = Stock::where('school_id', auth()->user()->school->id)->with(['products:id,name','colors:id,name','types:id,name','sizes:id,name'])
                ->get();
        }

        return view('admin.stocks.product_price', compact(['stocks']));
    }

    public function productPrice()
    {
        if (auth()->user()->role->name == "admin")
        {
            $products = Product::where('school_id', auth()->user()->school->id)->get();
        }else{
            $products = Product::all();
        }
        $schools = School::all();

        $colors = ProductColor::all();
        $sizes = ProductSize::all();
        $types = ProductType::all();
        return view('admin.stocks.product_price_update', compact(['products', 'colors', 'sizes', 'types','schools']));
    }

    public function productPriceUpdate(Request $request)
    {
//        return $request->all();
        foreach ($request->stock as $stock) {
            if (auth()->user()->role->name == "admin") {
                $stockavailables = Stock::where('school_id', auth()->user()->school->id)
                    ->where('product_id', $stock['product_id'])
                    ->where('color_id', $stock['color_id'])
                    ->where('type_id', $stock['type_id'])
                    ->where('gender_id', $stock['gender_id'])
                    ->where('size_id', $stock['size_id'])
                    ->get();
            }else{
                $stockavailables = Stock::where('school_id', $request->school_id)
                    ->where('product_id', $stock['product_id'])
                    ->where('color_id', $stock['color_id'])
                    ->where('type_id', $stock['type_id'])
                    ->where('gender_id', $stock['gender_id'])
                    ->where('size_id', $stock['size_id'])
                    ->get();
            }
            if (count($stockavailables) <= 0) {
                return response(["success", "Stock is not Available"]);
            }else{
//                foreach ($stockavailables as $sa)
//                {
//
//                }
                $stockavailables[0]->price =  $stock['price'];
                $stockavailables[0]->update();
            }
        }
        return response(["success"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role->name == "admin")
        {
//            return auth()->user()->school->id;
            $products = Product::where('school_id', auth()->user()->school->id)->get();
        }else{
            $products = [];
        }

        $schools = School::all();
        $colors = ProductColor::all();
        $sizes = ProductSize::all();
        $types = ProductType::all();
        return view('admin.stocks.create', compact([ 'products', 'colors', 'sizes', 'types', 'schools']));
    }

    /**
     * fetch products of selected schools..
     */
    public function fetchschoolProduct(Request $request)
    {
        $products = Product::where('school_id', $request->school_id)->get();
        return response($products);
    }

    public function fetchschoolProductPrice(Request $request)
    {
        $products = Product::where('school_id', $request->school_id)->get();
        return response($products);
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
            $genders = [['id' => 1, 'name' => 'Boys'],['id' => 2, 'name' => 'Girls']];
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
        if (!empty($request->stock)){
            foreach ($request->stock as $stock) {
                $stock['stock_in'] = $stock['quantity'];
                $stock['last_in'] = $stock['quantity'];
                $stock['school_id'] = auth()->user()->role->name == "admin" ? auth()->user()->school->id : $request->school_id ;

                $availables = Stock::where('product_id', $stock['product_id'])
                    ->where('color_id', $stock['color_id'])
                    ->where('type_id', $stock['type_id'])
                    ->where('gender_id', $stock['gender_id'])
                    ->where('size_id', $stock['size_id'])
                    ->where('school_id', $stock['school_id'])
                    ->get();


                if (count($availables) <= 0) {
                    $createstock = new Stock();
                    $createstock->create($stock);
                }else{
                    $update = Stock::find($availables[0]['id']);
                    $update->stock_in = $availables[0]['stock_in'] + $stock['quantity'];
                    $update->last_in = $stock['quantity'];
                    $update->update();
                }
            }
            return response(["success"]);
        }
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
        $stocks = Stock::find($id);
        return view('admin.stocks.edit', compact('stocks'));
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
        $update = Stock::find($id);
        $update->description = $request->description;
        $update->stock_in = $update->stock_in - $update->last_in;
        $update->last_in = 0;
        $update->update();
        return redirect()->route('stocks.index')->with('success', 'last stock removed Successfully');
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
