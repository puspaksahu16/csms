<?php

namespace App\Http\Controllers;

use App\Holiday;
use App\School;
use App\Student;
use App\StudentParent;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->name == "super_admin") {
            $holidays = Holiday::all();
            $schools = School::all();
        }elseif(auth()->user()->role->name == "admin"){
            $schools = null;
            $holidays = Holiday::where('school_id',auth()->user()->school->id)->get();
        }elseif(auth()->user()->role->name == "parent"){
              $student = StudentParent::with('students')->find(auth()->user()->parent->student_id);
            $schools = null;
             $holidays = Holiday::where('school_id',$student->students->school_id)->get();
        }
        return view('admin.holiday.index', compact(['holidays','schools']));
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
                'holiday_name' => 'required',
                'from_date' => 'required',
                'to_date' => 'required'
            ]);



        $data = $request->all();
        $data['school_id'] = auth()->user()->role->name == "super_admin" ? $request->school_id : auth()->user()->school->id;
        Holiday::create($data);
        return redirect()->route('holiday.index')->with('success', 'Holiday created Successfully');
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
