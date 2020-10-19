<?php

namespace App\Http\Controllers;

use App\Address;
use App\Createclass;
use App\Employee;
use App\EmployeeRole;
use App\Idproof;
use App\Qualification;
use App\School;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $id_proof = Idproof::all();
        $classes = Createclass::all();
        $schools = School::all();
        $qualifications = Qualification::all();
        $employee_roles = EmployeeRole::all();
        return view('admin.employee.create',compact(['id_proof', 'classes','schools','qualifications', 'employee_roles']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $address = [];
        foreach ($request->addresses as $key => $add)
        {
            if ($request->is_same == 1) {
                $add['is_same'] = 1;
                $add['address_type'] = $key;
                if (empty($add['address'])){
                    $radd = $request->addresses['resident'];
                    $radd['is_same'] = 1;
                    $radd['address_type'] = $key;
                    array_push($address, $radd);
                }else{
                    array_push($address, $add);
                }
            } else {
                $add['is_same'] = 0;
                $add['address_type'] = $key;
                array_push($address, $add);
            }

        }

        $em = Employee::orderBy('id', 'DESC')->get('employee_unique_id');
        if (count($em) <= 0)
        {
            $em_id = 101;
        }else{
            $em_id = substr($em[0]["employee_unique_id"], 10) + 1;
        }
        $employee_id = date('Y').'CSMSEM'.$em_id;
        $employee = date('Y').$em_id;
        $email = User::where('email', $request->email)->first();

        if (empty($email)) {
            $user = new User();
            $user->name = $request->first_name . " " . $request->last_name;
            $user->email = $request->email;
            $user->role_id = $request->role_id;
            $user->password = Hash::make($employee_id);
            $user->save();
            if (!empty($user->id)) {
                $employees = New Employee();
                $employees->first_name = $request->first_name;
                $employees->last_name = $request->last_name;
                $employees->user_id = $user->id;
                $employees->dob = $request->dob;
                $employees->mobile = $request->mobile;
                $employees->email = $request->email;
                $employees->gender_id = $request->gender_id;
                $employees->id_proof = $request->id_proof;
                $employees->id_proof_no = $request->id_proof_no;

                if($file = $request->hasFile('photo')) {
                    $file = $request->file('photo');
                    $fileName = uniqid('file_').'.'.$file->getClientOriginalExtension();
                    $destinationPath = public_path('/images/employees');
                    $file->move($destinationPath, $fileName);
                     $employees->photo = $fileName;
                }
                $employees->experience = $request->experience;
                $employees->caste = $request->caste;
                $employees->employee_unique_id = $employee_id;
                $employees->employee_qualification = $request->employee_qualification;
                $employees->employee_department = $request->employee_department;
                $employees->employee_designation = $request->employee_designation;
                $employees->employee_salary = $request->employee_salary;
                $employees->school_id = auth()->user()->role->name == "super_admin" ? $request->school_id : auth()->user()->school->id;
                $employees->save();

                foreach ($address as $add) {
                    $adress = new Address();
                    $adress->user_id = $employees->id;
                    $adress->district = $add['district'];
                    $adress->address = $add['address'];
                    $adress->city = $add['city'];
                    $adress->state = $add['state'];
                    $adress->country = $add['country'];
                    $adress->zip = $add['zip'];
                    $adress->address_type = $add['address_type'];
                    $adress->is_same = $add['is_same'];
                    $adress->register_type = 'Employee';
                    $adress->save();
                }
            }
        }else{
            return redirect()->back()->with('error', 'Employee Email already exist');
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
        $r_address = Address::where('user_id', $id)->where('address_type', 'resident')->first();
        $employee = Employee::find($id);
        $id_proof = Idproof::all();
        $classes = Createclass::all();
        $schools = School::all();
        $qualifications = Qualification::all();
        return view('admin.employee.show',compact(['id_proof', 'classes','schools','qualifications','employee','r_address']));
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
        $id_proof = Idproof::all();
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
        $address = [];
        foreach ($request->addresses as $key => $add)
        {
            if ($request->is_same == 1) {
                $add['is_same'] = 1;
                $add['address_type'] = $key;
                if (empty($add['address'])){
                    $radd = $request->addresses['resident'];
                    $radd['is_same'] = 1;
                    $radd['address_type'] = $key;
                    array_push($address, $radd);
                }else{
                    array_push($address, $add);
                }
            } else {
                $add['is_same'] = 0;
                $add['address_type'] = $key;
                array_push($address, $add);
            }

        }
       $employee = Employee::find($id);
//       $employee->school_id = auth()->user()->role->name == "super_admin" ? $request->input('school_id') : auth()->user()->school->id;
       $employee->first_name = $request->first_name;
       $employee->last_name = $request->last_name;
        $employee->dob = $request->dob;
        $employee->mobile = $request->mobile;
        $employee->email = $request->email;
        $employee->gender_id = $request->gender_id;
        $employee->id_proof = $request->id_proof;

        if($file = $request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = uniqid('file_').'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/images/employees');
            $file->move($destinationPath, $fileName);
            $employee->photo = $fileName;
        }

        $employee->id_proof_no = $request->id_proof_no;
        $employee->employee_qualification = $request->employee_qualification;
        $employee->employee_department = $request->employee_department;
        $employee->employee_designation = $request->employee_designation;
        $employee->employee_salary = $request->employee_salary;
        $employee->experience = $request->experience;
        $employee->caste = $request->caste;
        $employee->update();

//        return $request->addresses;
//$a = [];
        foreach ($address as $add)
        {
            $adress = Address::where('user_id', $id)->where('address_type', $add['address_type'])->first();
            $adress->district = $add['district'];
            $adress->address = $add['address'];
            $adress->city = $add['city'];
            $adress->state = $add['state'];
            $adress->country = $add['country'];
            $adress->zip = $add['zip'];
            $adress->address_type = $add['address_type'];
            $adress->is_same = $add['is_same'];
            $adress->register_type = 'Employee';
            $adress->update();
        }
//        return $a;
        if (auth()->user()->role->name == 'admin' OR auth()->user()->role->name == 'super_admin'){
            return redirect()->route('employee.index')->with('success', 'Employee Updated Successfully');
        }else{
            return redirect()->back()->with('success', 'Profile Updated Successfully');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::where('id',$id)->delete();
        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully');
    }
}
