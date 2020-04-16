<?php

namespace App\Http\Controllers;

use App\School;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::all();
        return view('admin.schools.index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.schools.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data =$request->all();
        $s = School::orderBy('id', 'DESC')->get('registration_no');
        if (count($s) <= 0 )
        {
            $s_id = 1001;
        }else{
            $s_id = $s[0]["registration_no"] + 1;
        }
        $data['registration_no'] = $s_id;

        $user = new User();
        $user->name = $request->full_name;
        $user->email = $request->email;
        $user->role_id = 2;
        $user->password = Hash::make($s_id);
        if ($user->save())
        {
            $data['user_id'] = $user->id;
            $school = School::create($data);
            return redirect()->route('schools.index')->with('success', 'School created successfully');
        }else{
            return redirect()->back()->with('error', 'Something Went Wrong');
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
        $school = School::find($id);
        return view('admin.schools.edit', compact('school'));
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
        $school = School::find($id)->update($request->all());
        return redirect()->route('schools.index')->with('success', 'School created successfully');
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
