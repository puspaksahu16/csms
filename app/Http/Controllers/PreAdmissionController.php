<?php

namespace App\Http\Controllers;


use App\Address;
use App\Createclass;
use App\PreAdmission;
use App\StudentParent;
use Illuminate\Http\Request;

class PreAdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pre_admissions = PreAdmission::all();
        return view('admin.pre_admissions.index', compact('pre_admissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = CreateClass::all();
        return view ('admin.pre_admissions.create', compact('classes'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request;
        $pre_admission = new PreAdmission();
        $pre_admission->first_name = $request->first_name;
        $pre_admission->last_name = $request->last_name;
        $pre_admission->dob = $request->dob;
        $pre_admission->gender = $request->gender;
        $pre_admission->class_id = $request->class_id;
        $pre_admission->caste = $request->caste;
        $pre_admission->photo = $request->photo;
        $pre_admission->save();

        $parent = new StudentParent();
        $parent->student_id = $pre_admission->id;
        $parent->father_first_name = $request->father_first_name;
        $parent->father_last_name = $request->father_last_name;
        $parent->father_mobile = $request->father_mobile;
        $parent->father_email = $request->father_email;
        $parent->mother_first_name = $request->mother_first_name;
        $parent->mother_last_name = $request->mother_last_name;
        $parent->mother_mobile = $request->mother_mobile;
        $parent->mother_email = $request->mother_email;
        $parent->save();

        $adress = new Address();
        $adress->user_id = $pre_admission->id;
        $adress->district = $request->district;
        $adress->address = $request->address;
        $adress->city = $request->city;
        $adress->state = $request->state;
        $adress->country = $request->country;
        $adress->zip = $request->zip;
        $adress->save();

        return redirect('/pre_admissions')->with("success", "Pre admission Created successfully!");
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
        $pre_admission = PreAdmission::find($id);
        return view('admin.pre_admissions.edit', compact('pre_admission'));
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
        $pre_admission = PreAdmission::find($id)->update($request->all());

        return redirect('/pre_admissions')->with("success", "Pre admission Created successfully!");
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
