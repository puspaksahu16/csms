<?php

namespace App\Http\Controllers;

use App\AssignTeacher;
use App\Createclass;
use App\Employee;
use App\School;
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
            $assign_teachers = AssignTeacher::all();
        }else{
            $schools = null;
            $classes = Createclass::where('school_id', auth()->user()->school->id)->get();
            $employees = Employee::where('school_id', auth()->user()->school->id)->get();
            $assign_teachers = AssignTeacher::where('school_id', auth()->user()->school->id)->get();
        }
        return view('admin.assign_teacher.index', compact(['schools','classes','employees','assign_teachers']));
    }

    public function getEmployee($id)
    {
//        return $id;
        $employee = Employee::where('school_id', $id)->pluck("first_name", 'id');

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



        $data = $request->all();
        $data['school_id'] = auth()->user()->role->name == "super_admin" ? $request->school_id : auth()->user()->school->id;
        AssignTeacher::create($data);

        return redirect('/assign_teacher')->with("success", "Teacher assigned successfully!");
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
            $schools = School::all();
            $classes = Createclass::all();
            $employees = Employee::all();
        }else{
            $schools = null;
            $classes = Createclass::where('school_id', auth()->user()->school->id)->get();
            $employees = Employee::where('school_id', auth()->user()->school->id)->get();
        }
        $assign_teacher = AssignTeacher::find($id);
        return view('admin.assign_teacher.edit', compact(['schools','classes','employees','assign_teacher']));

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
        $teacher = AssignTeacher::find($id)->update($request->all());
        return redirect('/assign_teacher')->with("success", "Assigned teacher updated successfully!");
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
