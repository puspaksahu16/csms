<?php

namespace App\Http\Controllers;

use App\Address;
use App\AdmissionFee;
use App\Book;
use App\BookStock;
use App\Createclass;
use App\ExtraClass;
use App\GeneralFee;
use App\Idproof;
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
         $students = Student::with('fee','school')->get();
//         return $students;
        }else{
            $students = Student::where('school_id', auth()->user()->school->id)->get();
        }
       return view('admin.new_admission.index', compact('students'));
    }

    public function parentsIndex()
    {
        $parents = StudentParent::all()->where('user_id',!null);
        return view('admin.parents.index', compact(['parents']));
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
        $id_proof = Idproof::all();
        if (auth()->user()->role->name == "super_admin") {
            $classes = Createclass::all();
        }else{
            $classes = Createclass::where('school_id', auth()->user()->school->id)->get();
        }
        $schools = School::all();
        $qualifications = Qualification::all();
        return view('admin.new_admission.create',compact(['id_proof', 'classes','schools','qualifications']));
    }
    public function getSchools()
    {
        $school = School::pluck("full_name","id");
        return view('get_school',compact('school'));
    }
    public function getClasses($id)
    {
        $classes = Createclass::where("school_id",$id)->pluck("create_class","id");
        return json_encode($classes);
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
        $s = Student::orderBy('id', 'DESC')->get('student_unique_id');
        if (count($s) <= 0)
        {
            $s_id = 101;
        }else{
            $s_id = substr($s[0]["student_unique_id"], 8) + 1;
        }
        $student_id = date('Y').'CSMS'.$s_id;
        $parent_id = date('Y').$s_id;

        $email = User::where('email', $request->mother_email)->first();
//return $request;
        if (empty($email))
        {
            $user = new User();
            $user->name = $request->mother_first_name." ".$request->mother_last_name;
            $user->email = $request->mother_email;
            $user->role_id = 4;
            $user->password = Hash::make($parent_id);
            $user->save();

            if (!empty($user->id))
            {
                $students = new Student();
                $students->first_name = $request->first_name;
                $students->last_name = $request->last_name;
                $students->dob = $request->dob;
                $students->gender_id = $request->gender_id;
                $students->id_proof = $request->id_proof;

                if($file = $request->hasFile('photo')) {
                    $file = $request->file('photo');
                    $fileName = uniqid('file_').'.'.$file->getClientOriginalExtension();
                    $destinationPath = public_path('/images/student_photo');
                    $file->move($destinationPath, $fileName);
                    $students->photo = $fileName;
                }

                if($file = $request->hasFile('family_photo')) {
                    $file = $request->file('family_photo');
                    $fileName = uniqid('file_').'.'.$file->getClientOriginalExtension();
                    $destinationPath = public_path('/images/family_photo');
                    $file->move($destinationPath, $fileName);
                    $students->family_photo = $fileName;
                }

                $students->id_proof_no = $request->id_proof_no;
                $students->tc_no = $request->tc_no;
                $students->class_id = $request->class_id;
                $students->caste = $request->caste;
                $students->student_unique_id = $student_id;
                $students->school_id = auth()->user()->role->name == "super_admin" ? $request->school_id:auth()->user()->school->id;
                $students->save();

                if (!empty($students->id))
                {
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
                    $parents->user_id = $user->id;

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

                    foreach ($address as $add) {
                        $adress = new Address();
                        $adress->user_id = $students->id;
                        $adress->district = $add['district'];
                        $adress->address = $add['address'];
                        $adress->city = $add['city'];
                        $adress->state = $add['state'];
                        $adress->country = $add['country'];
                        $adress->zip = $add['zip'];
                        $adress->address_type = $add['address_type'];
                        $adress->is_same = $add['is_same'];
                        $adress->register_type = 'new';
                        $adress->save();
                    }

                    if (empty($parents->id))
                    {
                        $user = User::find($user->id);
                        $user->delete();
                        $student = Student::find($students->id);
                        $student->delete();
                        $student = Student::find($parents->id);
                        $student->delete();
                        return redirect()->back()->with('error', 'Student created Successfully');
                    }
                }
            }
        }else{
            return redirect()->back()->with('error', 'Mother Email already exist');
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
        $id_proof = Idproof::all();
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
        return view('admin.new_admission.view', compact(['id_proof','classes','students','studentparents','r_address', 'p_address','qualifications']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id_proof = Idproof::all();
        if (auth()->user()->role->name == "super_admin") {
            $classes = Createclass::all();
            $students = Student::find($id);
            $schools = School::all();
            $qualifications = Qualification::all();
            $studentparents = StudentParent::where('student_id', $id)->first();
            $r_address = Address::where('user_id', $id)->where('address_type', 'resident')->first();
            if ($r_address->is_same == 1) {
                $p_address = [];
            } else {
                $p_address = Address::where('user_id', $id)->where('address_type', 'permanent')->first();
            }
        }else{
            $classes = Createclass::where('school_id', auth()->user()->school->id)->get();
            $students = Student::find($id);
            $qualifications = Qualification::all();
            $studentparents = StudentParent::where('student_id', $id)->first();
            $r_address = Address::where('user_id', $id)->where('address_type', 'resident')->first();
            if ($r_address->is_same == 1) {
                $p_address = [];
            } else {
                $p_address = Address::where('user_id', $id)->where('address_type', 'permanent')->first();
            }
        }
       return view('admin.new_admission.edit', compact(['id_proof','schools','classes','students','studentparents','r_address', 'p_address','qualifications']));
    }

    public function edit_profile($id)
    {
        $id_proof = Idproof::all();
        $classes = Createclass::all();
        $qualifications = Qualification::all();
        $parents = StudentParent::where('user_id', $id)->first();
        return view('admin.new_admission.edit_parents',compact(['id_proof','classes','qualifications','parents']));
    }

    public function parentUpdate(Request $request, $id)
    {
        $parents =  StudentParent::where('user_id', $id)->first();
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

        $user =  User::find($id);

        $user->name = $request->mother_first_name." ".$request->mother_last_name;
        $user->email = $request->mother_email;
        $user->update();
        return redirect()->back()->with('success', 'Parent Updated Successfully');
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
        $students = Student::find($id);
        $students->first_name = $request->first_name;
        $students->last_name = $request->last_name;
        $students->dob = $request->dob;
        $students->gender_id = $request->gender_id;
        $students->id_proof = $request->id_proof;

        if($file = $request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = uniqid('file_').'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/images/student_photo');
            $file->move($destinationPath, $fileName);
            $students->photo = $fileName;
        }

        if($file = $request->hasFile('family_photo')) {
            $file = $request->file('family_photo');
            $fileName = uniqid('file_').'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/images/family_photo');
            $file->move($destinationPath, $fileName);
            $students->family_photo = $fileName;
        }

        $students->id_proof_no = $request->id_proof_no;
        $students->tc_no = $request->tc_no;
        $students->class_id = $request->class_id;
        $students->caste = $request->caste;
        $students->school_id = auth()->user()->role->name == "super_admin" ? $request->input('school_id'):auth()->user()->school->id;
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
            $adress->register_type = 'new';
            $adress->update();
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
