<?php

namespace App\Http\Controllers;

use App\AssignTeacher;
use App\Createclass;
use App\Employee;
use App\School;
use App\Section;
use App\SetSection;
use App\Standard;
use Illuminate\Http\Request;

class AssignTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->name == "super_admin") {
            $schools = School::all();
            $classes = Createclass::all();
            $employees = Employee::all();
            $assign_teachers = AssignTeacher::with('school','class','employee','section')->get();
        }else{
            $schools = null;
            $classes = Createclass::where('school_id', auth()->user()->school->id)->get();
            $employees = Employee::where('school_id', auth()->user()->school->id)->get();
            $assign_teachers = AssignTeacher::where('school_id', auth()->user()->school->id)->with('school','class','employee','section')->get();
        }
        return view('admin.assign_teacher.index', compact(['schools','classes','employees','assign_teachers']));
    }

    public function getEmployee($id)
    {
//        return $id;
        $employee = Employee::where('school_id', $id)->get();

        return response($employee);
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
            'school_id' => auth()->user()->role->name == "super_admin" ? 'required' : '',
            'class_id' => 'required',
            'employee_id' => 'required'
        ]);


        $check_emp =  AssignTeacher::where('employee_id', $request->employee_id)->first();
        if (empty($check_emp)){
            $data = $request->all();
            $data['school_id'] = auth()->user()->role->name == "super_admin" ? $request->school_id : auth()->user()->school->id;
            AssignTeacher::create($data);
            return redirect('/assign_teacher')->with("success", "Teacher assigned successfully!");
        }else{
            return redirect('/assign_teacher')->with("error", "Teacher already assigned!");
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
        $assign_teacher = AssignTeacher::find($id);
        if (auth()->user()->role->name == "super_admin") {
            $schools = School::all();
            $classes = Createclass::where('school_id', $assign_teacher->school_id)->get();
            $employees = Employee::where('school_id', $assign_teacher->school_id)->get();
            $sections = Section::where('school_id', $assign_teacher->school_id)->where('class_id', $assign_teacher->class_id)->get();
        }else{
            $schools = null;
            $classes = Createclass::where('school_id', auth()->user()->school->id)->get();
            $employees = Employee::where('school_id', auth()->user()->school->id)->get();
            $sections = Section::where('school_id', auth()->user()->school->id)->where('class_id', $assign_teacher->class_id)->get();
        }

        return view('admin.assign_teacher.edit', compact(['schools','classes','employees','assign_teacher','sections']));

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
        $check_emp =  AssignTeacher::where('employee_id', $request->employee_id)->first();
        if (empty($check_emp)){
            $teacher = AssignTeacher::find($id)->update($request->all());
            return redirect('/assign_teacher')->with("success", "Assigned teacher updated successfully!");
        }else{
            return redirect(route('assign_teacher.edit', $id))->with("error", "Assigned teacher already exist!");
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
        //
    }
}
