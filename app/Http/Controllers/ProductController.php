<?php

namespace App\Http\Controllers;

use App\Product;
use App\School;
use App\Stock;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->name == "super_admin") {
            $products = Product::all();
        }
        else{
            $products = Product::where('school_id', auth()->user()->school->id)->get();
        }
        return view('admin.products.index', compact('products'));
    }

    public function laraProduct()
    {
        return Laratables::recordsOf(Product::class);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::all();
        return view('admin.products.create', compact(['schools']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['school_id'] = auth()->user()->role->name == "super_admin" ? $request->school_id : auth()->user()->school->id;
        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Product created Successfully');
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
        $product = Product::find($id);
        return view('admin.products.edit',compact('product'));
    }

    public function fetchSizeGender(Request $request)
    {
//        return $request->gender_id;
        $school_id = auth()->user()->role->name == "super_admin" ? $request->school_id : auth()->user()->school->id;
        if (!empty($request->color_id)){
            $products = Stock::with('sizes')
                ->where('school_id', $school_id)
                ->where('product_id', $request->product_id)
                ->where('color_id', $request->color_id)
                ->where('gender_id', $request->gender_id)
                ->get();
        }else{
            $products = Stock::with('sizes')
                ->where('school_id', $school_id)
                ->where('product_id', $request->product_id)
                ->where('gender_id', $request->gender_id)
                ->get();
        }

        $size = [];
        foreach ($products as $product)
        {
            array_push($size, $product->sizes);
        }
        return response($size);
    }


    public function fetchGenderColor(Request $request)
    {
//        return $request->gender_id;
        $school_id = auth()->user()->role->name == "super_admin" ? $request->school_id : auth()->user()->school->id;
        $products = Stock::where('school_id', $school_id)->where('product_id', $request->product_id)->where('color_id', $request->color_id)->get(['gender_id']);
        $g = [];
        foreach ($products as $product)
        {
            array_push($g, $product->gender_id);
        }
        $genders = [];
        foreach (array_unique($g) as $p)
        {
            if ($p == 1)
            {
                array_push($genders, ["id" => 1, 'name' => "Boys"]);
            }elseif ($p == 2){
                array_push($genders, ["id" => 2, 'name' => "Girls"]);
            }
        }
        return response($genders);
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
        $product = Product::find($id);
        $product->name = $request->name;
        $product->unit = $request->unit;
        $product->type = $request->type;
        $product->color = $request->color;
        $product->size = $request->size;
        $product->gender = $request->gender;
        $product->save();
        return redirect('/products')->with('message', 'Status changed!');
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
