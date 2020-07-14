<?php

namespace App\Http\Controllers;



use App\School;
use App\SetStandard;
use App\Standard;
use Illuminate\Http\Request;

class StandardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->name == "super_admin") {
            $standards = Standard::all();
            $set_standards = SetStandard::all();
            $schools = School::all();
        }else{
            $standards = Standard::where('school_id', auth()->user()->school->id)->get();
            $set_standards = SetStandard::all();
        }
        return view('admin.standard.index', compact(['standards','schools','set_standards']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::all();
        $set_standards = SetStandard::all();
        return view('admin.standard.index',compact(['schools','set_standards']));
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
        Standard::create($data);
        return redirect()->route('standard.index')->with('success', 'standard created Successfully');
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
        $standard = Standard::find($id);
        $set_standards = SetStandard::all();
        return view('admin.standard.edit', compact(['standard','set_standards']));
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
        $standard = Standard::find($id)->update($request->all());
        return redirect('/standard')->with("success", "Standard updated successfully!");
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
