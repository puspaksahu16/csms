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


            $request->validate([
                'photo' => 'required',
                'school_id' => auth()->user()->role->name == "super_admin" ? 'required' : '',
                'first_name' => 'required',
                'last_name' => 'required',
                'dob' => 'required',
                'mobile' => 'required|digits:10',
                'email' => 'required|email|unique:users,email',

                'gender_id' => 'required',
                'id_proof' => 'required',
                'id_proof_no' => 'required',
                'experience' => 'required',
                'caste' => 'required',
                'employee_qualification' => 'required',
                'employee_department' => 'required',
                'employee_designation' => 'required',
                'employee_salary' => 'required',
                'role_id' => 'required',
                'address' => 'required',
                'city' => 'required',
                'district' => 'required',
                'zip' => 'required',
                'state' => 'required',
                'country' => 'required',
                'permanent_address' => 'required',
                'permanent_city' => 'required',
                'permanent_district' => 'required',
                'permanent_zip' => 'required',
                'permanent_state' => 'required',
                'permanent_country' => 'required',

            ]);


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

                if ($request->is_same == 1){

                    $adress = new Address();
                    $adress->user_id = $employees->id;
                    $adress->district = $request->district;
                    $adress->address = $request->address;
                    $adress->city = $request->city;
                    $adress->state = $request->state;
                    $adress->country = $request->country;
                    $adress->zip = $request->zip;
                    $adress->is_same = $request->is_same;
                    $adress->register_type = 'Employee';
                    $adress->permanent_district = $request->permanent_district;
                    $adress->permanent_address = $request->permanent_address;
                    $adress->permanent_city = $request->permanent_city;
                    $adress->permanent_state = $request->permanent_state;
                    $adress->permanent_country = $request->permanent_country;
                    $adress->permanent_zip = $request->permanent_zip;

                    $adress->save();

                }else{

                    $adress = new Address();
                    $adress->user_id = $employees->id;
                    $adress->district = $request->district;
                    $adress->address = $request->address;
                    $adress->city = $request->city;
                    $adress->state = $request->state;
                    $adress->country = $request->country;
                    $adress->zip = $request->zip;
                    $adress->register_type = 'Employee';
                    $adress->permanent_district = $request->permanent_district;
                    $adress->permanent_address = $request->permanent_address;
                    $adress->permanent_city = $request->permanent_city;
                    $adress->permanent_state = $request->permanent_state;
                    $adress->permanent_country = $request->permanent_country;
                    $adress->permanent_zip = $request->permanent_zip;
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
        $r_address = Address::where('user_id',$id)->where('register_type', 'Employee')->first();
//        $r_address = Address::where('user_id', $id)->where('address_type', 'resident')->first();
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
        $address = Address::where('user_id',$id)->where('register_type', 'Employee')->first();
        $employee = Employee::find($id);
        $id_proof = Idproof::all();
        $classes = Createclass::all();
        $schools = School::all();
        $qualifications = Qualification::all();
        $employee_roles = EmployeeRole::all();
        return view('admin.employee.edit',compact(['id_proof', 'classes','schools','qualifications','employee','address', 'employee_roles']));
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
//       $employee->school_id = auth()->user()->role->name == "super_admin" ? $request->input('school_id') : auth()->user()->school->id;
       $employee->user->role_id = $request->role_id;
        $employee->user->save();
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


        $address = Address::find($id);
        $address = Address::where('user_id',$id)->where('register_type', 'Employee')->first();
        if ($address->is_same == 1 || $request->is_same == 1){
            $address->user_id = $employee->id;
            $address->district = $request->district;
            $address->address = $request->address;
            $address->city = $request->city;
            $address->state = $request->state;
            $address->country = $request->country;
            $address->zip = $request->zip;
            $address->is_same = $request->is_same;
            $address->register_type = 'Employee';
            $address->permanent_district = $request->permanent_district;
            $address->permanent_address = $request->permanent_address;
            $address->permanent_city = $request->permanent_city;
            $address->permanent_state = $request->permanent_state;
            $address->permanent_country = $request->permanent_country;
            $address->permanent_zip = $request->permanent_zip;
            $address->save();
        }else{
            $address->is_same = 0;
            $address->register_type = 'Employee';
            $address->user_id = $employee->id;
            $address->address = $request->input('address');
            $address->city = $request->input('city');
            $address->district = $request->input('district');
            $address->state = $request->input('state');
            $address->country = $request->input('country');
            $address->zip = $request->input('zip');
            $address->permanent_district = $request->permanent_district;
            $address->permanent_address = $request->permanent_address;
            $address->permanent_city = $request->permanent_city;
            $address->permanent_state = $request->permanent_state;
            $address->permanent_country = $request->permanent_country;
            $address->permanent_zip = $request->permanent_zip;
            $address->save();
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
