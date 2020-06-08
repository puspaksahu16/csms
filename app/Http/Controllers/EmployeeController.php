<?php

namespace App\Http\Controllers;

use App\Address;
use App\Createclass;
use App\Employee;
use App\idproof;
use App\Qualification;
use App\School;
use Illuminate\Http\Request;

class EmployeeController extends Controller
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
            $employees = Employee::all();
        }else{
            $employees = Employee::where('school_id', auth()->user()->school->id)->get();
        }
        return view('admin.employee.index', compact(['employees']));
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
        return view('admin.employee.create',compact(['id_proof', 'classes','schools','qualifications']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $em = Employee::orderBy('id', 'DESC')->get('employee_unique_id');
        if (count($em) <= 0)
        {
            $em_id = 101;
        }else{
            $em_id = substr($em[0]["employee_unique_id"], 10) + 1;
        }
        $employee_id = date('Y').'CSMSEM'.$em_id;

        $employees = New Employee();
        $employees->first_name = $request->first_name;
        $employees->last_name = $request->last_name;
        $employees->dob = $request->dob;
        $employees->mobile = $request->mobile;
        $employees->email = $request->email;
        $employees->gender_id = $request->gender_id;
        $employees->id_proof = $request->id_proof;
        $employees->id_proof_no = $request->id_proof_no;
        $employees->experience = $request->experience;
        $employees->caste = $request->caste;
        $employees->employee_unique_id = $employee_id;
        $employees->employee_qualification = $request->employee_qualification;
        $employees->employee_designation = $request->employee_designation;
        $employees->employee_salary = $request->employee_salary;
        $employees->school_id = auth()->user()->role->name == "super_admin" ? $request->school_id:auth()->user()->school->id;
        $employees->save();

        foreach ($request->addresses as $key => $add)
        {
            if ($request->is_same == 1)
            {
                $adress = new Address();
                $adress->user_id = $employees->id;
                $adress->district = $add['district'];
                $adress->address = $add['address'];
                $adress->city = $add['city'];
                $adress->state = $add['state'];
                $adress->country = $add['country'];
                $adress->zip = $add['zip'];
                $adress->address_type = $key;
                $adress->is_same = 1;
                $adress->register_type = 'Employee';
                $adress->save();
                break;
            }else{
                $adress = new Address();
                $adress->user_id = $employees->id;
                $adress->district = $add['district'];
                $adress->address = $add['address'];
                $adress->city = $add['city'];
                $adress->state = $add['state'];
                $adress->country = $add['country'];
                $adress->zip = $add['zip'];
                $adress->address_type = $key;
                $adress->is_same = 0;
                $adress->register_type = 'Employee';
                $adress->save();
            }


        }
        return redirect()->route('employee.index')->with('success', 'Employee created Successfully');
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
        $r_address = Address::where('user_id', $id)->where('address_type', 'resident')->first();
        $employee = Employee::find($id);
        $id_proof = idproof::all();
        $classes = Createclass::all();
        $schools = School::all();
        $qualifications = Qualification::all();
        return view('admin.employee.edit',compact(['id_proof', 'classes','schools','qualifications','employee','r_address']));
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
       $employee = Employee::find($id);
       $employee->school_id = $request->school_id;
       $employee->first_name = $request->first_name;
       $employee->last_name = $request->last_name;
        $employee->dob = $request->dob;
        $employee->mobile = $request->mobile;
        $employee->email = $request->email;
        $employee->gender_id = $request->gender_id;
        $employee->id_proof = $request->id_proof;
        $employee->id_proof_no = $request->id_proof_no;
        $employee->employee_qualification = $request->employee_qualification;
        $employee->employee_designation = $request->employee_designation;
        $employee->employee_salary = $request->employee_salary;
        $employee->experience = $request->experience;
        $employee->caste = $request->caste;
        $employee->update();

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
                $adress->user_id = $employee->id;
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
        return redirect()->route('employee.index')->with('success', 'Employee Updated Successfully');
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
