<?php

namespace App\Http\Controllers;

use App\Createclass;
use App\ExtraClass;
use App\School;
use Illuminate\Http\Request;

class ExtraClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->name == "super_admin") {
            $extraclass = ExtraClass::all();
            $schools = School::all();
            $classes = Createclass::all();
        }else{
            $schools = null;
            $extraclass = ExtraClass::where('school_id', auth()->user()->school->id)->get();
            $classes = Createclass::where('school_id', auth()->user()->school->id)->get();
            $schools = null;
        }

        return view('admin.extraclasses.index', compact(['extraclass','schools','classes']));
    }

    public function fetchExtraClass( Request $request )
    {
        if (auth()->user()->role->name == "super_admin") {
            $extraclass = ExtraClass::with('schools','classes')->where('school_id', $request->school_id)->where('class_id', $request->class_id)->get();
        }elseif (auth()->user()->role->name == "admin"){
            $extraclass = ExtraClass::with('schools','classes')->where('school_id', auth()->user()->school->id)->where('class_id', $request->class_id)->get();
        }



        return response($extraclass);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role->name == 'admin')
        {
            $classes = CreateClass::where('school_id', auth()->user()->school->id)->get();
        }else{
            $classes = null;
        }
        $schools = School::all();
        return view('admin.extraclasses.create',compact(['classes','schools']));
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
                'school_id' => auth()->user()->role->name == "super_admin" ? 'required' : '',
                'price' => 'required',
                'type' => 'required',
                'class_id' => 'required',
                'name' => 'required'
            ]);


        $data = $request->all();
        $data['school_id'] = auth()->user()->role->name == "super_admin" ? $request->school_id : auth()->user()->school->id;
        ExtraClass::create($data);
        return redirect()->route('extraclasses.index')->with('success', 'Fees created Successfully');
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

        if (auth()->user()->role->name == 'admin')
        {
            $extraclass = ExtraClass::find($id);
            $classes = CreateClass::where('school_id', auth()->user()->school->id)->get();
        }elseif (auth()->user()->role->name == 'super_admin'){
            $extraclass = ExtraClass::find($id);
            $schools = School::all();
            $classes = Createclass::all();
        }

        return view('admin.extraclasses.edit', compact(['extraclass','classes','schools']));
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
        $extraclass = ExtraClass::find($id)->update($request->all());
        return redirect('/extraclasses')->with("success", "Extra Classes updated successfully!");
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
