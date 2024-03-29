<?php

namespace App\Http\Controllers;

use App\Createclass;
use App\Employee;
use App\PreExam;
use App\School;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;

class PreExamController extends Controller
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
            $pre_exams = PreExam::all();
        }
        elseif (auth()->user()->role->name == "admin"){
            $pre_exams = PreExam::where('school_id', auth()->user()->school->id)->get();
        }
        else{
            $emp_id = Employee::where('user_id',auth()->user()->id)->first();
            $pre_exams = PreExam::where('school_id', $emp_id->school_id)->get();
        }

        return view('admin.pre_exam.index', compact('pre_exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role->name == "super_admin")
        {
            $classes = Createclass::all();
            $schools = School::all();
        }elseif (auth()->user()->role->name == "admin"){
            $schools = null;
            $classes = Createclass::where('school_id', auth()->user()->school->id)->get();
        }
        else{
            $emp_id = Employee::where('user_id',auth()->user()->id)->first();
            $schools = null;
            $classes = Createclass::where('school_id', $emp_id->school_id)->get();
        }

        return  view('admin.pre_exam.create', compact(['classes', 'schools']));
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

        if (auth()->user()->role->name == 'super_admin')
        {
            $request->validate([
                'school_id' => 'required',
                'class_id' => 'required',
                'exam_name' => 'required',
                'full_mark' => 'required',
                'current_year' => 'required',

            ]);
        }elseif (auth()->user()->role->name == 'admin'){
            $request->validate([
                'class_id' => 'required',
                'exam_name' => 'required',
                'full_mark' => 'required',
                'current_year' => 'required',

            ]);
        }

        $data = $request->all();
        $data['school_id'] = auth()->user()->role->name == "super_admin" ? $request->school_id : auth()->user()->school->id;
        PreExam::create($data);
        return redirect()->route('pre_exam.index')->with('success', 'Exam created Successfully');
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
        if (auth()->user()->role->name == "super_admin") {
            $pre_exam = PreExam::find($id);
            $classes = Createclass::where('school_id', $pre_exam->school_id)->get();
            $schools = School::all();
        }
        elseif (auth()->user()->role->name == "admin"){
                $schools = null;
                $pre_exam = PreExam::find($id);
                $classes = Createclass::where('school_id', auth()->user()->school->id)->get();
        }else{
                $emp_id = Employee::where('user_id',auth()->user()->id)->first();
                $schools = null;
                $pre_exam = PreExam::find($id);
                $classes = Createclass::where('school_id', $emp_id->school_id)->get();
        }
        return view('admin.pre_exam.edit', compact(['pre_exam','classes','schools']));

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
        $pre_exam = PreExam::find($id)->update($request->all());
        return redirect('/pre_exam')->with("success", "Pre Exam updated successfully!");
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
