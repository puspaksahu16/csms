<?php

namespace App\Http\Controllers;

use App\Createclass;
use App\Employee;
use App\Period;
use App\School;
use App\Section;
use App\Standard;
use App\Student;
use App\Subject;
use App\TimeTable;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->name == "super_admin") {
            $timetables = TimeTable::all();
        }
        elseif (auth()->user()->role->name == "admin"){
            $timetables = TimeTable::where('school_id', auth()->user()->school->id)->get();
        }

        return view('admin.timetable.index',compact(['timetables']));
    }

    public function viewTimetable()
    {
        if (auth()->user()->role->name == "parent"){
            $student = Student::find(auth()->user()->parent->student_id);
            $timetables = TimeTable::where('school_id', $student->school_id)->where('class_id', $student->class_id)->where('section_id', $student->section)->get();
        }

        return view('admin.timetable.timetable',compact(['timetables']));
    }

    public function getPeriod(Request $request)
    {
        return $periods = Period::where('standard_id', $request->standard_id)->pluck('period_name', 'id');
    }
    public function getClass(Request $request)
    {
        return $classes = Createclass::where('standard_id', $request->standard_id)->pluck('create_class', 'id');
    }
    public function getSection(Request $request)
    {
        return $section = Section::where('class_id', $request->class_id)->pluck('section', 'id');
    }
    public function getStandard($id)
    {
//        return $id;
        $standard = Standard::where('school_id', $id)->pluck("name", 'id');
        return response($standard);
    }

    public function getSubject($id)
    {
//        return $id;
        $subjects = Subject::where('school_id', $id)->pluck("name", 'id');
        return response($subjects);
    }
    public function getEmployee(Request $request, $id)
    {
        $employees = Employee::where('school_id', $id)->pluck("first_name", 'id');

//        $avalable_emp =[];
//        foreach ($employees as $employee)
//        {
//            $emp = TimeTable::where('school_id',$request->school_id)
//                ->where('standard_id',$request->standard_id)
//                ->where('class_id',$request->class_id)
//                ->where('section_id',$request->section_id)
//                ->where('day',$request->day)
//                ->where('period_id',$request->period_id)
//                ->where('employee_id',$employee->id)
//                ->first();
//            if (empty($emp))
//            {
//                array_push($avalable_emp, $employee);
//            }
//        }

        return response($employees);
//        return response($avalable_emp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role->name == "super_admin") {
            $classes = Createclass::all();
            $schools = School::all();
            $periods = Period::all();

        }else{
            $standards = Standard::where('school_id', auth()->user()->school->id)->get();
            $subjects = Subject::where('school_id', auth()->user()->school->id)->get();
            $employees = Employee::where('school_id', auth()->user()->school->id)->get();
        }
        return view('admin.timetable.create', compact(['classes','schools','periods','standards','sections','subjects','employees']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $periods = TimeTable::where('school_id',$request->school_id)
              ->where('standard_id',$request->standard_id)
              ->where('class_id',$request->class_id)
              ->where('section_id',$request->section_id)
              ->where('day',$request->day)
              ->where('period_id',$request->period_id)
              ->first();

        $emp = TimeTable::

            where('day',$request->day)
            ->where('period_id',$request->period_id)
            ->where('employee_id',$request->employee_id)
            ->first();

//            return $periods;

//        $class = TimeTable::where('class_id',$request->class_id)->first();
//        $section = TimeTable::where('section_id',$request->section_id)->first();
//        $employee = TimeTable::where('employee_id',$request->employee_id)->first();
//        $subject = TimeTable::where('subject_id',$request->subject_id)->first();
//        $days = TimeTable::where('day',$request->day)->first();
//        $time_from = Period::where('id',$request->period_id)->first('time_from');
//        $time_to = Period::where('id',$request->period_id)->first('time_to');

        if (empty($periods) AND empty($emp)){
            $timetable = new TimeTable();
            $timetable->school_id = auth()->user()->role->name == "super_admin" ? $request->school_id:auth()->user()->school->id;
            $timetable->standard_id = $request->standard_id;
            $timetable->class_id = $request->class_id;
            $timetable->section_id = $request->section_id;
            $timetable->subject_id = $request->subject_id;
            $timetable->employee_id = $request->employee_id;
            $timetable->day = $request->day;
            $timetable->period_id = $request->period_id;
            $timetable->save();
            return redirect()->route('timetable.index')->with('success', 'Time-Table created Successfully');
        }elseif (!empty($emp)){
            return redirect()->route('timetable.create')->with('error', 'Teacher Duplicate Entry');
        }
        else{
            return redirect()->route('timetable.create')->with('error', 'Period Duplicate Entry');
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
