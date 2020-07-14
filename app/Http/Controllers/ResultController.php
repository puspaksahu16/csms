<?php

namespace App\Http\Controllers;

use App\Createclass;
use App\PreAdmission;
use App\PreExam;
use App\Result;
use App\School;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->name == "super_admin") {
            $result = Result::all();
        }else{
            $result = Result::where('school_id', auth()->user()->school->id)->get();
        }
        return view('admin.result.index', compact('result'));
    }

    public function laraResult()
    {
        return Laratables::recordsOf(Result::class);
    }

    public function getRoll(Request $request)
    {
        return $rolls = PreAdmission::where('class_id', $request->class_id)->pluck('roll_no', 'id');
    }
    public function getMarks(Request $request)
    {
        return $marks = PreExam::where('id', $request->exam_id)->pluck('full_mark');
    }
    public function getExam(Request $request)
    {
        return $rolls = PreExam::where('class_id', $request->class_id)->pluck('exam_name', 'id');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rolls = PreAdmission::all();
        $classes = Createclass::all();
        $schools = School::all();
        $exams = PreExam::all();
        return view('admin.result.create',compact(['classes', 'rolls','schools','exams']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['school_id'] = auth()->user()->role->name == "super_admin" ? $request->school_id : auth()->user()->school->id;
        Result::create($data);
        return redirect()->route('result.index')->with('success', 'Result created Successfully');
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
       $result = Result::find($id);
        $classes = Createclass::all();
        $rolls = PreAdmission::get();
       return view('admin.result.edit',compact(['result','classes','rolls']));
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
       $result = Result::find($id)->update($request->all());
        return redirect('/result')->with("success", "Result updated successfully!");
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
