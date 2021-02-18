<?php

namespace App\Http\Controllers;

use App\Createclass;
use App\School;
use App\Section;
use App\SetSection;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->name == "super_admin") {
            $section = Section::all();
            $classes = CreateClass::all();
            $schools = School::all();
            $set_sections = SetSection::all();
        }else{
            $schools = null;
            $section = Section::where('school_id', auth()->user()->school->id)->get();
            $classes = CreateClass::where('school_id', auth()->user()->school->id)->get();
            $set_sections = SetSection::all();
        }
        return view("admin.section.index" , compact(['section','classes','schools','set_sections']));
    }
    public function getClasses($id)
    {
        $classes = Createclass::where("school_id",$id)->pluck("create_class","id");
        return json_encode($classes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $schools = School::all();
        return view('admin.section.index',compact(['schools']));
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
            'section' => 'required',
            'class_id' => 'required'
        ]);

        if (auth()->user()->role->name == "super_admin") {
            $sections = Section::where('school_id',$request->school_id)
                ->where('class_id',$request->class_id)
                ->where('section',$request->section)->first();
            if (empty($sections)){
                $data = $request->all();
                $data['school_id'] = auth()->user()->role->name == "super_admin" ? $request->school_id : auth()->user()->school->id;
                Section::create($data);
                return redirect('/section')->with('success', "Section Created successfully!");
            }else{
                return redirect()->route('section.index')->with('error', 'Section Duplicate Entry');
            }
        }else{
            $sections = Section::where('class_id',$request->class_id)
                ->where('section',$request->section)->first();
            if (empty($sections)){
                $data = $request->all();
                $data['school_id'] = auth()->user()->role->name == "super_admin" ? $request->school_id : auth()->user()->school->id;
                Section::create($data);
                return redirect('/section')->with('success', "Section Created successfully!");
            }else{
                return redirect()->route('section.index')->with('error', 'Section Duplicate Entry');
            }
        }


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
        $section = Section::find($id);
        if (auth()->user()->role->name == "super_admin") {
            $schools = School::all();
            $classes = CreateClass::where('school_id',$section->school_id )->get();
            $set_sections = SetSection::all();

        }elseif(auth()->user()->role->name == "admin"){
            $schools = null;
            $classes = CreateClass::where('school_id', auth()->user()->school->id)->get();
            $set_sections = SetSection::all();
        }
        return view('admin.section.edit',compact(['section','classes','schools','set_sections']));
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
        if (auth()->user()->role->name == "super_admin") {
            $sections = Section::where('school_id',$request->school_id)
                ->where('class_id',$request->class_id)
                ->where('section',$request->section)->first();
            if (empty($sections)){
                $section = Section::find($id)->update($request->all());
                return redirect('/section')->with("success", "Section updated successfully!");
            }else{
                return redirect()->route('section.index')->with('error', 'Section Duplicate Entry');
            }
        }elseif (auth()->user()->role->name == "admin"){
            $sections = Section::where('class_id',$request->class_id)
                ->where('section',$request->section)->first();
            if (empty($sections)){
                $section = Section::find($id)->update($request->all());
                return redirect('/section')->with("success", "Section updated successfully!");
            }else{
                return redirect()->route('section.index')->with('error', 'Section Duplicate Entry');
            }
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
        Section::where('id',$id)->delete();
        return redirect('/section')->with("success", "Section deleted successfully!");
    }
}
