<?php

namespace App\Http\Controllers;

use App\SetStandard;
use Illuminate\Http\Request;

class SetStandardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $standards = SetStandard::all();
        return view("admin.set_standard.index", compact('standards'));
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
        $standard = SetStandard::create($request->all());
        return redirect('/set_standard')->with("success", "Standard Created successfully!");
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
        $standard = SetStandard::find($id);
        return view('admin.set_standard.edit', compact('standard'));
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
        $standard = SetStandard::find($id)->update($request->all());
        return redirect('/set_standard')->with("success", "Standard updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SetStandard::where('id',$id)->delete();
        return redirect('/set_standard')->with("success", "Standard deleted successfully!");
    }
}
