<?php

namespace App\Http\Controllers;

use App\Idproof;
use Illuminate\Http\Request;

class IdproofControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Idproofs = Idproof::all();
        return view('admin.idproof.index', compact('Idproofs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.idproof.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Idproof = Idproof::create($request->all());
        return redirect('/idproof')->with("success", "Id Proof Created successfully!");
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
        $Idproofs = Idproof::find($id);
        return view('admin.idproof.edit', compact('Idproofs'));
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
        $Idproof = Idproof::find($id)->update($request->all());
        return redirect('/idproof')->with("success", "id proof updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Idproof::where('id',$id)->delete();
        return redirect()->route('idproof.index')->with('success', 'Id proof deleted successfully');
    }
}
