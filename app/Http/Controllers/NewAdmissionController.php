<?php

namespace App\Http\Controllers;

use App\Address;
use App\AdmissionFee;
use App\Book;
use App\BookStock;
use App\Createclass;
use App\ExtraClass;
use App\GeneralFee;
use App\idproof;
use App\Qualification;
use App\School;
use App\Stock;
use App\Student;
use App\StudentParent;
use App\Subject;
use App\User;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NewAdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->name == "super_admin")
        {
        $students = Student::with('fee')->get();
        }else{
            $students = Student::where('school_id', auth()->user()->school->id)->get();
        }
       return view('admin.new_admission.index', compact('students'));
    }

    public function laraNewAdmission()
    {
        return Laratables::recordsOf(Student::class);
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
        $schools = School::all();
        $qualifications = Qualification::all();
        return view('admin.new_admission.create',compact(['id_proof', 'classes','schools','qualifications']));
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
            $s_id = substr($s[0]["student_unique_id"], 8) + 1;
        }
        $student_id = date('Y').'CSMS'.$s_id;
        $parent_id = date('Y').$s_id;

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
        $students->school_id = auth()->user()->role->name == "super_admin" ? $request->school_id:auth()->user()->school->id;
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

        $parents->parent_id = $parent_id;

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

        $user = new User();
        $user->name = $request->mother_first_name." ".$request->mother_last_name;
        $user->email = $request->mother_email;
        $user->role_id = 4;
        $user->password = Hash::make($parent_id);
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
                $adress->address_type = $key;
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
        $id_proof = idproof::all();
        $classes = Createclass::all();
        $students = Student::find($id);
        $qualifications = Qualification::all();
        $studentparents = StudentParent::where('student_id', $id)->first();
        $r_address = Address::where('user_id', $id)->where('address_type', 'resident')->first();
        if ($r_address->is_same == 1)
        {
            $p_address = [];
        }
        else
        {
            $p_address = Address::where('user_id', $id)->where('address_type', 'permanent')->first();
        }

       return view('admin.new_admission.edit', compact(['id_proof','classes','students','studentparents','r_address', 'p_address','qualifications']));
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
        $students = Student::find($id);
        $students->first_name = $request->first_name;
        $students->last_name = $request->last_name;
        $students->dob = $request->dob;
        $students->gender_id = $request->gender_id;
        $students->id_proof = $request->id_proof;
        $students->id_proof_no = $request->id_proof_no;
        $students->tc_no = $request->tc_no;
        $students->class_id = $request->class_id;
        $students->caste = $request->caste;
        $students->update();

        $parents =  StudentParent::where('student_id', $id)->first();
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
        $parents->update();

        foreach ($request->addresses as $key => $add)
        {
//            return $request->is_same;
            if ($request->is_same == 1)
            {
                $adress = Address::where('user_id', $id)->first();
                $adress->district = $add['district'];
                $adress->address = $add['address'];
                $adress->city = $add['city'];
                $adress->state = $add['state'];
                $adress->country = $add['country'];
                $adress->zip = $add['zip'];
                $adress->address_type = $key;
                $adress->is_same = 1;
                $adress->register_type = 'new';
                $adress->update();
                break;
            }else{
                $adress = Address::where('user_id', $id)->where('address_type', $key)->first();
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
                $adress->update();
            }

        }
        return redirect()->route('new_admission.index')->with('success', 'Student Updated Successfully');
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
