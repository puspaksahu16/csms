<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Http\Controllers\Controller;
use App\Student;
use App\TimeTable;
use Carbon\Carbon;
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
        if (auth()->user()->role->name === 'teacher')
        {
            $attendances = Attendance::with(['classes', 'section'])->where('employee_id', auth()->user()->employee->id)->get();
            $class = [];
            $section = [];
            foreach ($attendances as $att_classes)
            {
                array_push($class, $att_classes->classes);
                array_push($section, $att_classes->section);
            }

            $sections = array_unique($section);
            $classes = array_unique($class);
//            return $attendances = Attendance::where('employee_id', auth()->user()->employee->id)->get()->groupBy(['class_id', 'section_id']);

//            foreach ($attendances as $att_classes)
//            {
//                foreach ($att_classes as $section)
//                {
//                    foreach ($section as $attendance)
//                    {
////                        return $attendance->created_at->format('m');
////                        return Carbon::parse($attendance->created_at)->daysInMonth;
//                    }
//                }
//            }
//            array_map(function ($a){
//                return $a->class_id
//            }$attendances);
        }
        return view('admin.attendance.attendance', compact(['classes', 'sections']));
    }

    public function getAttendance(Request $request)
    {
         $attendances = Attendance::with('student')
            ->where('employee_id', auth()->user()->employee->id)
            ->where('class_id', $request->class_id)
            ->where('section_id', $request->section_id)
            ->where('month', $request->month)
            ->get()->groupBy(['student_id']);

         $month_days = 0;


        foreach ($attendances as $att_classes)
        {
//           $total = 0;
            foreach ($att_classes as $attendance)
            {
                $month_days = Carbon::parse($attendance->created_at)->daysInMonth;
                $attendance->date = Carbon::parse($attendance->created_at)->format('d') + 0;
//                if ( $attendance->attendance == 1)
//                {
//                    $total += 1;
//                }
                $attendance->attendance = $attendance->attendance == 1 ? "P" : "A" ;
            }

        }

        return response(['attendances' => $attendances, 'days' => $month_days]);
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
//        return $request->attendance;
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
                        'attendance' => $att[0] === 'on' ? 1 : 0,
                        'month' =>  date('m'),
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
