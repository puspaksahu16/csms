<?php

namespace App\Http\Controllers;

use App\SetClass;
use Illuminate\Http\Request;

class SetClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = SetClass::all();
        return view("admin.set_class.index", compact('classes'));
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
        $this->validate($request, [
            'name' => 'required|unique:set_classes'
        ]);

        $class = SetClass::create($request->all());
        return redirect('/set_class')->with("success", "Class Created successfully!");
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
        $class = SetClass::find($id);
        return view('admin.set_class.edit', compact('class'));
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
        $classes = SetClass::where('name',$request->name)->first();
        if (empty($classes) || $classes->id == $id){
            SetClass::find($id)->update($request->all());
            return redirect('/set_class')->with("success", "Class updated successfully!");
        }else{
            return redirect()->route('set_class.edit', $id)->with("error", "Duplicate Class Name!");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SetClass::where('id',$id)->delete();
        return redirect('/set_class')->with("success", "Class deleted successfully!");
    }
}
