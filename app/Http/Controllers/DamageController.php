<?php

namespace App\Http\Controllers;

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
       $damages = Damage::with('products:id,name','colors:id,name','types:id,name','sizes:id,name')
        ->get();
        return view('admin.damages.index', compact('damages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.damages.create', compact(['products']));
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
            $stock['damage'] = $stock['quantity'];
            $availables = Damage::where('product_id', $stock['product_id'])
            ->where('color_id', $stock['color_id'])
            ->where('type_id', $stock['type_id'])
            ->where('gender_id', $stock['gender_id'])
            ->where('size_id', $stock['size_id'])
            ->get();

            if (count($availables) <= 0) {
                $createstock = new Damage();
                $createstock->create($stock);
            }else{
                $update = Damage::find($availables[0]['id']);
                $update->damage = $availables[0]['damage'] + $stock['quantity'];
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
