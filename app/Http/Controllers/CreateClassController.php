<?php

namespace App\Http\Controllers;

use App\Createclass;
use App\Result;
use App\School;
use App\SetClass;
use App\Standard;
use Illuminate\Http\Request;

class CreateClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->name == "super_admin") {
            $classes = CreateClass::all();
            $standards = Standard::all();
            $set_classes = SetClass::all();
            $schools = School::all();
        }else{
            $schools = null;
            $classes = CreateClass::where('school_id', auth()->user()->school->id)->get();
            $standards = Standard::where('school_id', auth()->user()->school->id)->get();
            $set_classes = SetClass::all();
            $schools = null;

        }
        return view('admin.classes.index', compact(['classes','standards','schools','set_classes']));
    }

    public function getStandard($id)
    {
//        return $id;
        $standard = Standard::where('school_id', $id)->pluck("name", 'id');
        return response($standard);
    }

    public function getClass($id)
    {
//        return $id;
        $classes = Createclass::where('school_id', $id)->pluck("create_class", 'id');
        return response($classes);
    }

    public function fetchClassByStandard( Request $request )
    {
        $classes = CreateClass::with('school','standard')->where('school_id',$request->school_id)->where('standard_id',$request->standard_id)->get();
        return response($classes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::all();
        return view('admin.classes.index',compact(['schools']));
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
                'standard_id' => 'required',
                'create_class' => 'required'
            ]);



        $data = $request->all();
        $data['school_id'] = auth()->user()->role->name == "super_admin" ? $request->school_id : auth()->user()->school->id;
        CreateClass::create($data);

        return redirect('/classes')->with("success", "Class Created successfully!");
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
        $schools = School::all();
        $set_classes = SetClass::all();
       $classes = Createclass::find($id);
        $standards = Standard::all();
       return view('admin.classes.edit', compact(['classes','standards','schools','set_classes']));

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
        $classes = Createclass::find($id)->update($request->all());
        return redirect('/classes')->with("success", "class updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Createclass::where('id',$id)->delete();
        return redirect('/classes')->with("success", "class deleted successfully!");
    }
}
