<?php

namespace App\Http\Controllers;

use App\SetSection;
use Illuminate\Http\Request;

class SetSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = SetSection::all();
        return view("admin.set_section.index", compact('sections'));
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
            'name' => 'required|unique:set_sections'
        ]);

        SetSection::create($request->all());
        return redirect('/set_section')->with("success", "Section Created successfully!");
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
        $section = SetSection::find($id);
        return view('admin.set_section.edit', compact('section'));
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

        $section = SetSection::where('name',$request->name)->first();

        if (empty($section) || $section->id == $id){
            SetSection::find($id)->update($request->all());
            return redirect('/set_class')->with("success", "Section updated successfully!");
        }else{
            return redirect()->route('set_section.edit', $id)->with("error", "Duplicate Section Name!");
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
        SetSection::where('id',$id)->delete();
        return redirect('/set_section')->with("success", "Section deleted successfully!");
    }
}
