<?php

namespace App\Http\Controllers;

use App\Createclass;
use App\PreExam;
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
        $pre_exam = PreExam::all();
        return view('admin.pre_exam.index', compact('pre_exam'));
    }

    public function laraPreExam()
    {
        return Laratables::recordsOf(PreExam::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Createclass::all();
        return  view('admin.pre_exam.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        PreExam::create($request->all());
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
        $pre_exam = PreExam::find($id);
        $classes = Createclass::all();
        return view('admin.pre_exam.edit', compact(['pre_exam','classes']));

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
