<?php

namespace App\Http\Controllers;

use App\Createclass;
use App\Idproof;
use App\PreAdmission;
use App\PreExam;
use App\Qualification;
use App\Result;
use App\School;
use App\StudentParent;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

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

    public function enroll($id)
    {
        $id_proof = Idproof::all();
        $schools = School::all();
        $qualifications = Qualification::all();
         $details = PreAdmission::find($id);
        if (auth()->user()->role->name == "super_admin") {
           $classes = Createclass::where('school_id', $details->school_id)->get();
        }else{
            $classes = Createclass::where('school_id', auth()->user()->school->id)->get();
        }
        $parent_details = StudentParent::where('student_id', $details->id)->where('parent_type', 'pre')->first();
        return view('admin.new_admission.create', compact(['id_proof', 'classes','schools','qualifications', 'details', 'parent_details']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role->name == "super_admin") {
            $rolls = PreAdmission::all();
            $classes = Createclass::all();
            $schools = School::all();
            $exams = PreExam::all();
        }else{
            $rolls = PreAdmission::all();
            $classes = Createclass::where('school_id', auth()->user()->school->id)->get();
            $exams = PreExam::all();
        }
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
        $this->validate($request, [
            'roll_no' => 'unique:results'
        ]);
        $roll = Result::where('roll_no',$request->roll_no)->first();
        if ($roll === null){
            $data = $request->all();
            $data['school_id'] = auth()->user()->role->name == "super_admin" ? $request->school_id : auth()->user()->school->id;
            Result::create($data);
            return redirect()->route('result.index')->with('success', 'Result created Successfully');
        }else{
            return redirect()->route('result.index')->with('success', 'Duplicate Roll No');
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
        Result::where('id',$id)->delete();
        return redirect()->route('result.index')->with('success', 'Result deleted successfully');
    }
}
