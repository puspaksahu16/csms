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
        }else{
            $extraclass = ExtraClass::where('school_id', auth()->user()->school->id)->get();
        }

        return view('admin.extraclasses.index', compact('extraclass'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Createclass::all();
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
        $extraclass = ExtraClass::find($id);
        $classes = Createclass::all();
        return view('admin.extraclasses.edit', compact(['extraclass','classes']));
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
