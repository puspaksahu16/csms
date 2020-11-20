<?php

namespace App\Http\Controllers;

use App\Period;
use App\School;
use App\Standard;
use Illuminate\Http\Request;

class PeriodController extends Controller
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
            $periods =  Period::get();
            $standards = Standard::all();
        }else{
            $standards = Standard::where('school_id', auth()->user()->school->id)->get();
            $periods =  Period::where('school_id', auth()->user()->school->id)->get();
        }

        return view('admin.period.index',compact(['periods','standards','schools']));
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
            'school_id' => 'required',
            'standard_id' => 'required',
            'period_name' => 'required',
            'time_from' => 'required',
            'time_to' => 'required'
        ]);

        if (auth()->user()->role->name == "super_admin") {
            $periods = Period::where('school_id', $request->school_id)
//                ->where('period_name', $request->period_name)
                ->where('standard_id', $request->standard_id)
                ->where('time_from', $request->time_from)
                ->where('time_to', $request->time_to)
                ->first();
        }else{
            $periods = Period::where('school_id', auth()->user()->school->id)
                ->where('standard_id', $request->standard_id)
//                ->where('period_name', $request->period_name)
                ->where('time_from', $request->time_from)
                ->where('time_to', $request->time_to)
                ->first();
        }

//        return $request->time_from;
//        return $periods;


        if (empty($periods)){
            $data = $request->all();
            $data['school_id'] = auth()->user()->role->name == "super_admin" ? $request->school_id : auth()->user()->school->id;
            Period::create($data);
            return redirect('/period')->with("success", "Period Created successfully!");
        }
        else{
        return redirect('/period')->with("error", "Duplicate Period!");
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

            $period =  Period::find($id);
            $schools = School::all();
            $standards = Standard::all();



        return view('admin.period.edit',compact(['period','standards','schools']));
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
        $periods = Period::where('period_name',$request->period_name)
            ->where('school_id',$request->school_id)
            ->where('standard_id',$request->standard_id)
            ->where('time_from',$request->time_from)
            ->where('time_to',$request->time_to)
            ->first();
        if (empty($periods) || $periods->id == $id){
            Period::find($id)->update($request->all());
            return redirect('/period')->with("success", "Period updated successfully!");
        }else{
            return redirect()->route('period.edit', $id)->with("error", "Duplicate Period!");
        }
//        Period::find($id)->update($request->all());
//        return redirect('/period')->with("success", "Period updated successfully!");
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
