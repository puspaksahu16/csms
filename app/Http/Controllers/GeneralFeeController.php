<?php

namespace App\Http\Controllers;

use App\Createclass;
use App\GeneralFee;
use App\School;
use Illuminate\Http\Request;

class GeneralFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->name == "super_admin") {
            $general = GeneralFee::all();
            $schools = School::all();
            $classes = Createclass::all();
        }else{
            $general = GeneralFee::where('school_id', auth()->user()->school->id)->get();
            $classes = Createclass::where('school_id', auth()->user()->school->id)->get();
        }

        return view('admin.general.index' , compact(['general','schools','classes']));
    }

    public function fetchGeneralFeeClass( Request $request )
    {
        if (auth()->user()->role->name == "super_admin") {
            $general = GeneralFee::with('schools','classes')->where('school_id', $request->school_id)->where('class_id', $request->class_id)->get();
        }
        elseif (auth()->user()->role->name == "admin"){
            $general = GeneralFee::with('schools','classes')->where('school_id',auth()->user()->school->id)->where('class_id', $request->class_id)->get();
        }


        return response($general);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        return auth()->user()->school->id;
        if (auth()->user()->role->name == 'admin')
        {
            $classes = CreateClass::where('school_id', auth()->user()->school->id)->get();
        }
        $schools = School::all();
        return view('admin.general.create' , compact(['classes','schools']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'school_id' => 'required',
            'price' => 'required',
            'type' => 'required',
            'class_id' => 'required',
            'name' => 'unique:general_fees|required'
        ]);

        $data = $request->all();
        $data['school_id'] = auth()->user()->role->name == "super_admin" ? $request->school_id : auth()->user()->school->id;
        GeneralFee::create($data);
        return redirect()->route('general.index')->with('success', 'Fees created Successfully');
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
        $general = GeneralFee::find($id);
        $classes = CreateClass::all();
        return view('admin.general.edit',compact(['general','classes']));
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
        $general = GeneralFee::find($id)->update($request->all());
        return redirect('/general')->with("success", "General Fee updated successfully!");
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
