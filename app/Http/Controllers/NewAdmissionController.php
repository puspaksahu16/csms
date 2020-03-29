<?php

namespace App\Http\Controllers;

use App\Address;
use App\Createclass;
use App\idproof;
use App\Student;
use App\StudentParent;
use App\Subject;
use Illuminate\Http\Request;

class NewAdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
       return view('admin.new_admission.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id_proof = idproof::all();
        $classes = Createclass::all();
        return view('admin.new_admission.create',compact(['id_proof', 'classes']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $s = Student::orderBy('id', 'DESC')->get('student_unique_id');
        if (count($s) <= 0)
        {
            $s_id = 101;
        }else{
            $s_id = substr($s[0]["student_unique_id"], 6) + 1;
        }
        $student_id = '1000'.ucfirst($request->first_name[0]).ucfirst($request->last_name[0]).$s_id;

        $students = new Student();
        $students->first_name = $request->first_name;
        $students->last_name = $request->last_name;
        $students->dob = $request->dob;
        $students->gender_id = $request->gender_id;
        $students->id_proof = $request->id_proof;
        $students->id_proof_no = $request->id_proof_no;
        $students->tc_no = $request->tc_no;
        $students->class_id = $request->class_id;
        $students->caste = $request->caste;
        $students->student_unique_id = $student_id;
        $students->save();

        $parents = new StudentParent();
        $parents->student_id = $students->id;
        $parents->mother_first_name = $request->mother_first_name;
        $parents->mother_last_name = $request->mother_last_name;
        $parents->mother_mobile = $request->mother_mobile;
        $parents->mother_email = $request->mother_email;
        $parents->mother_occupation = $request->mother_occupation;
        $parents->mother_salary = $request->mother_salary;
        $parents->mother_qualification = $request->mother_qualification;
        $parents->mother_id_type = $request->mother_id_type;
        $parents->mother_id_no = $request->mother_id_no;

        $parents->father_first_name = $request->father_first_name;
        $parents->father_last_name = $request->father_last_name;
        $parents->father_mobile = $request->father_mobile;
        $parents->father_email = $request->father_email;
        $parents->father_occupation = $request->father_occupation;
        $parents->father_salary = $request->father_salary;
        $parents->father_qualification = $request->father_qualification;
        $parents->father_id_type = $request->father_id_type;
        $parents->father_id_no = $request->father_id_no;
        $parents->parent_type = 'new';
        $parents->save();

        foreach ($request->addresses as $key => $add)
        {
            if ($request->is_same == 1)
            {
                $adress = new Address();
                $adress->user_id = $students->id;
                $adress->district = $add['district'];
                $adress->address = $add['address'];
                $adress->city = $add['city'];
                $adress->state = $add['state'];
                $adress->country = $add['country'];
                $adress->zip = $add['zip'];
                $adress->address_type = 'same';
                $adress->is_same = 1;
                $adress->register_type = 'new';
                $adress->save();
                break;
            }else{
                $adress = new Address();
                $adress->user_id = $students->id;
                $adress->district = $add['district'];
                $adress->address = $add['address'];
                $adress->city = $add['city'];
                $adress->state = $add['state'];
                $adress->country = $add['country'];
                $adress->zip = $add['zip'];
                $adress->address_type = $key;
                $adress->is_same = 0;
                $adress->register_type = 'new';
                $adress->save();
            }

        }
        return redirect()->route('new_admission.index')->with('success', 'Student created Successfully');
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
