<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Http\Controllers\Controller;
use App\Student;
use App\TimeTable;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 1;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $timetable = TimeTable::find($id);
        $students = Student::where('school_id', $timetable->school_id)->where('class_id', $timetable->class_id)->where('section', $timetable->section_id)->get();
        return view('admin.attendance.create', compact(['students','timetable']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $timetable = TimeTable::find($id);
        foreach ($request->attendance as $key => $att)
        {
            foreach ($request->description as $dkey => $des)
            {
                if ($key === $dkey)
                {
                    $student = Student::find($dkey);
                    $attendance = Attendance::create([
                        'school_id' => $student->school_id,
                        'employee_id' => $timetable->employee_id,
                        'period_id' => $timetable->period_id,
                        'class_id' => $student->class_id,
                        'section_id' => $student->section,
                        'student_id' => $dkey,
                        'attendance' => $att[0],
                        'description' => $des[0],
                    ]);
                }
            }
        }
        return redirect()->to('attendances')->with("success", "Attendance Created successfully");
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
        //
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
        //
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
