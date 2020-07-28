<?php

namespace App\Http\Controllers;

use App\ProductColor;
use App\ProductSize;
use App\ProductType;
use App\School;
use App\Stock;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;
use App\Damage;
use App\Product;

class DamageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->name == "super_admin") {
            $damages = Damage::with('products:id,name','colors:id,name','types:id,name','sizes:id,name')
                ->get();
        }else{
            $damages = Damage::where('school_id', auth()->user()->school->id)->with('products:id,name','colors:id,name','types:id,name','sizes:id,name')
                ->get();
        }

        return view('admin.damages.index', compact('damages'));
    }

    public function laraDamages()
    {
        return Laratables::recordsOf(Damage::class);
    }

    public function fetchDamageProductDetails(Request $request)
    {
        // return $request;
        $product_id = $request->product_id;
        $selectedproduct = Product::find($product_id);
        $colors = '';
        $sizes = '';
        $types = '';
        $genders = '';

        if ($selectedproduct->color == 1) {
            $sc = Stock::where('product_id', $request->product_id)->distinct('color_id')->get('color_id');
            $colors = ProductColor::whereIn('id', $sc)->get();
        }

        if ($selectedproduct->size == 1) {
            $ss = Stock::where('product_id', $request->product_id)->distinct('size_id')->get('size_id');
            $sizes = ProductSize::whereIn('id', $ss)->get();
        }

        if ($selectedproduct->type == 1) {
            $st = Stock::where('product_id', $request->product_id)->distinct('type_id')->get('type_id');
            $types = ProductType::whereIn('id', $st)->get();
        }

        if ($selectedproduct->gender == 1) {
            $sg = Stock::where('product_id', $request->product_id)->distinct('gender_id')->get('gender_id');
//            return $sg;
            if (count($sg) == 2)
            {
                $genders = [['id' => 1, 'name' => 'boys'],['id' => 2, 'name' => 'girls']];
            }
            elseif (count($sg) == 1)
            {
                if ($sg[0]['gender_id'] == 1)
                {
                    $genders = [['id' => 1, 'name' => 'boys']];
                }
                elseif (count($sg) == 2)
                {
                    $genders = [['id' => 2, 'name' => 'girls']];
                }
            }

        }

        return response(['colors' => $colors, 'sizes' => $sizes, 'types' => $types, 'genders' => $genders]);
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
            $products = Product::where('school_id', auth()->user()->school->id)->get();
        }
        else{
            $sp = Stock::distinct('product_id')->get('product_id');
            $products = Product::whereIn('id', $sp)->get();
        }
        $schools = School::all();


        return view('admin.damages.create', compact(['products','schools']));
    }
    public function fetchschoolProductDamage(Request $request)
    {
        $products = Product::where('school_id', $request->school_id)->get();
        return response($products);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request->stock;
        foreach ($request->stock as $stock) {
            $stock['damage'] = $stock['quantity'];
            $stock['school_id'] = auth()->user()->role->name == "admin" ? auth()->user()->school->id : $request->school_id;
            $availables = Damage::where('product_id', $stock['product_id'])
            ->where('color_id', $stock['color_id'])
            ->where('type_id', $stock['type_id'])
            ->where('gender_id', $stock['gender_id'])
            ->where('size_id', $stock['size_id'])
            ->get();
            $stockavailables = Stock::where('product_id', $stock['product_id'])
                ->where('color_id', $stock['color_id'])
                ->where('type_id', $stock['type_id'])
                ->where('gender_id', $stock['gender_id'])
                ->where('size_id', $stock['size_id'])
                ->get();
            if (count($stockavailables) <= 0) {
                return response(["success", "Stock is not Available"]);
            }else{
                if (count($availables) <= 0) {
                    $createstock = new Damage();
                    $createstock->create($stock);
                }else{
                    $update = Damage::find($availables[0]['id']);
                    $update->damage = $availables[0]['damage'] + $stock['quantity'];
                    $update->update();
                }
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
