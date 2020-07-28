<?php

namespace App\Http\Controllers;


use App\Address;
use App\Createclass;
use App\PreAdmission;
use App\PreExam;
use App\Qualification;
use App\School;
use App\StudentParent;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;
use DB;

class PreAdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->name == "super_admin")
        {
            $pre_admissions = PreAdmission::all()->where('is_active',1);
        }else{
            $pre_admissions = PreAdmission::where('school_id', auth()->user()->school->id && 'is_active',1)->get();
        }

        return view('admin.pre_admissions.index', compact(['pre_admissions']));
    }

    public function getExam(Request $request)
    {
        return $rolls = PreExam::where('class_id', $request->class_id)->pluck('exam_name', 'id');
    }

    public function laraPreAdmission()
    {
        return Laratables::recordsOf(PreAdmission::class);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role->name == "super_admin") {
            $classes = CreateClass::all();
            $pre_exams = PreExam::all();
            $schools = School::all();
        }else{
            $classes = CreateClass::where('school_id', auth()->user()->school->id)->get();
            $pre_exams = PreExam::where('school_id', auth()->user()->school->id)->get();
        }
        return view ('admin.pre_admissions.create', compact(['classes', 'pre_exams','schools']));

    }
    public function getSchools()
    {
        $school = School::pluck("full_name","id");
        return view('get_school',compact('school'));
    }
    public function getClasses($id)
    {
        $classes = Createclass::where("school_id",$id)->pluck("create_class","id");
        return json_encode($classes);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $r = PreAdmission::orderBy('id', 'DESC')->get('roll_no');
        if (count($r) <= 0)
        {
            $roll_no = 101;
        }else{
            $roll_no = $r[0]["roll_no"] + 1;
        }

//        return $request;
        $pre_admission = new PreAdmission();
        $pre_admission->first_name = $request->first_name;
        $pre_admission->last_name = $request->last_name;
        $pre_admission->dob = $request->dob;
        $pre_admission->gender = $request->gender;
        $pre_admission->class_id = $request->class_id;
        $pre_admission->pre_exam_id = $request->pre_exam_id;
        $pre_admission->caste = $request->caste;
        $pre_admission->photo = $request->photo;
        $pre_admission->family_photo = $request->family_photo;
        $pre_admission->roll_no = $roll_no;
        $pre_admission->school_id = auth()->user()->role->name == "super_admin" ? $request->school_id:auth()->user()->school->id;
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
        $parent->parent_type = 'pre';
        $parent->save();

        $adress = new Address();
        $adress->user_id = $pre_admission->id;
        $adress->district = $request->district;
        $adress->address = $request->address;
        $adress->city = $request->city;
        $adress->state = $request->state;
        $adress->country = $request->country;
        $adress->zip = $request->zip;
        $adress->register_type = 'pre';
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
        $classes = Createclass::all();
        $pre_exams = PreExam::all();
        $schools = School::all();
        $parents = StudentParent::where('student_id',$id)->first();
        $address = Address::where('user_id',$id)->first();
        return view('admin.pre_admissions.edit', compact(['pre_admission','schools','classes','pre_exams','parents','address','qualifications']));
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

        $pre_admission = PreAdmission::find($id);
        $pre_admission = PreAdmission::where('id', $id)->first();
        $pre_admission->first_name = $request->input('first_name');
        $pre_admission->last_name = $request->input('last_name');
        $pre_admission->dob = $request->input('dob');
        $pre_admission->gender = $request->input('gender');
        $pre_admission->class_id = $request->input('class_id');
        $pre_admission->pre_exam_id = $request->input('pre_exam_id');
        $pre_admission->caste = $request->input('caste');
        $pre_admission->school_id = auth()->user()->role->name == "super_admin" ? $request->input('school_id'):auth()->user()->school->id;
        $pre_admission->save();

        $parents = StudentParent::find($id);
        $parents = StudentParent::where('student_id', $id)->first();
        $parents->mother_first_name = $request->input('mother_first_name');
        $parents->father_first_name = $request->input('father_first_name');
        $parents->mother_last_name = $request->input('mother_last_name');
        $parents->father_last_name = $request->input('father_last_name');
        $parents->mother_mobile = $request->input('mother_mobile');
        $parents->father_mobile = $request->input('father_mobile');
        $parents->mother_email = $request->input('mother_email');
        $parents->father_email = $request->input('father_email');
        $parents->save();


        $address = Address::find($id);
        $address = Address::where('user_id',$id)->first();
        $address->address = $request->input('address');
        $address->city = $request->input('city');
        $address->district = $request->input('district');
        $address->state = $request->input('state');
        $address->country = $request->input('country');
        $address->zip = $request->input('zip');
        $address->save();



        return redirect('/pre_admissions')->with("success", "Pre admission Created successfully!");
    }

    public function Update_status(Request $request, $id)
    {

        $pre_admission = PreAdmission::find($id);
        $pre_admission->is_active = '0';
        $pre_admission->update();
        return redirect('/pre_admissions')->with('success', 'School deleted successfully');

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
