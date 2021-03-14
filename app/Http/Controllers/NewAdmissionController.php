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
use App\Section;
use App\SetSection;
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
         $students = Student::with('fee','school','section_data')->with(['classes' => function($query){
             return $query->with('section')->get();
         }])->get();
//         return $students[0]->classes->section;
            $schools = School::all();
            $classes = Createclass::all();
        }else{
            $students = Student::where('school_id', auth()->user()->school->id)->with(['classes' => function($query){
                return $query->with('section')->get();
            }])->get();
            $schools = null;
            $classes =  Createclass::where('school_id', auth()->user()->school->id)->get();
//            $sections = SetSection::all();
        }
       return view('admin.new_admission.index', compact(['students','schools','classes']));
    }

    public function fetchNewAdmissionByClass( Request $request )
    {
        if (auth()->user()->role->name == "super_admin") {
            $student = Student::with('school','classes','section_data','fee')->where('school_id',$request->school_id)->where('class_id',$request->class_id)->get();
        }elseif(auth()->user()->role->name == "admin"){
            $student = Student::with('school','classes','section_data','fee')->where('school_id',auth()->user()->school->id)->where('class_id',$request->class_id)->get();
        }

       return response($student);
    }

    public function section_assign(Request $request, $id)
    {

        $student = Student::find($id);
        $student->section = $request->section;
        $student->update();
        return redirect()->route('new_admission.index')->with('success', 'Section Assign Successfully');
    }

    public function parentsIndex()
    {
        if (auth()->user()->role->name == "super_admin")
        {
            $parents = StudentParent::where('parent_type','new')->get();

        }else{
             $students = Student::with('parent')->where('school_id',auth()->user()->school->id)->get();
            $parents = [];
             foreach ($students as $key => $st){
                 if ($st->parent->parent_type == 'new'){
                     array_push($parents,$st->parent);
                 }

             }

//            return $parents = StudentParent::with(['students' => function($query){
//                return $query->with('school')->get();
//            }])->get();
        }
//        return $parents;

        return view('admin.parents.index', compact('parents'));

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


        if (auth()->user()->role->name == "super_admin") {
            $classes = Createclass::all();
            $schools = School::all();
        }elseif (auth()->user()->role->name == "admin"){
            $schools = null;
            $school = School::with('students')->find(auth()->user()->school->id);
            if ( count($school->students) < $school->total_strength){
                $classes = Createclass::where('school_id', auth()->user()->school->id)->get();
            }else{
                return redirect()->route('new_admission.index')->with('error', 'Total Strength limit has cross, please contact to admin');
            }

        }
        $id_proof = Idproof::all();
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
            $request->validate([
                'photo' => 'required',
                'family_photo' => 'required',
                'school_id' => auth()->user()->role->name == "super_admin" ? 'required' : '',
                'first_name' => 'required',
                'last_name' => 'required',
                'dob' => 'required',
                'gender_id' => 'required',
                'caste' => 'required',
                'class_id' => 'required',
                'tc' => 'required',
                'category' => 'required',
                'blood_group' => 'required',

                'mother_first_name' => 'required',
                'mother_last_name' => 'required',
                'mother_mobile' => 'required|digits:10',
                'mother_email' => 'required|email|unique:users,email',
                'mother_occupation' => 'required',
                'mother_id_no' => 'required',
                'mother_id_type' => 'required',
                'mother_qualification' => 'required',
                'mother_salary' => 'required',

                'father_first_name' => 'required',
                'father_last_name' => 'required',
                'father_mobile' => 'required|digits:10',
                'father_email' => 'required|email',
                'father_id_type' => 'required',
                'father_id_no' => 'required',
                'father_occupation' => 'required',
                'father_qualification' => 'required',
                'father_salary' => 'required',

                'district' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'country' => 'required',
                'zip' => 'required',

                'permanent_district' => 'required',
                'permanent_address' => 'required',
                'permanent_city' => 'required',
                'permanent_state' => 'required',
                'permanent_country' => 'required',
                'permanent_zip' => 'required',

            ]);



        $school_id = auth()->user()->role->name == "super_admin" ? $request->school_id : auth()->user()->school->id;
        $school = School::find($school_id);
        $s = Student::where('school_id', $school_id)->orderBy('id', 'DESC')->get('student_unique_id')->first();
        if (empty($s["student_unique_id"]))
        {
            $s_id = 101;
        }else{
            $sexplode = explode('-',$s["student_unique_id"]);
            $s_id = $sexplode[1] + 1;
        }

        $explode = explode(' ',$school->full_name);
        $school_code = [];
        foreach ($explode as $ex)
        {
            array_push($school_code, $ex[0]);
        }

        $student_id = $school->registration_no.implode('', $school_code).'-'.$s_id;

        $parent_id = date('Y').$s_id;


        $user = new User();
        $user->name = $request->mother_first_name." ".$request->mother_last_name;
        $user->email = $request->mother_email;
        $user->role_id = 4;
        $user->password = Hash::make($parent_id);
        $user->save();

        $students = new Student();
        $students->first_name = $request->first_name;
        $students->last_name = $request->last_name;
        $students->dob = $request->dob;
        $students->gender_id = $request->gender_id;
        $students->id_proof = $request->id_proof;
        $students->category = $request->category;
        $students->blood_group = $request->blood_group;

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

        $students->ref_no = $request->ref_no;
        $students->id_proof_no = $request->id_proof_no;
        $students->tc_no = $request->tc_no;
        $students->class_id = $request->class_id;
        $students->caste = $request->caste;
        $students->student_unique_id = $student_id;
        $students->school_id = $school_id;
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


        if ($request->is_same == 1){

            $adress = new Address();
            $adress->user_id = $students->id;
            $adress->district = $request->district;
            $adress->address = $request->address;
            $adress->city = $request->city;
            $adress->state = $request->state;
            $adress->country = $request->country;
            $adress->zip = $request->zip;
            $adress->is_same = $request->is_same;
            $adress->register_type = 'new';
            $adress->permanent_district = $request->permanent_district;
            $adress->permanent_address = $request->permanent_address;
            $adress->permanent_city = $request->permanent_city;
            $adress->permanent_state = $request->permanent_state;
            $adress->permanent_country = $request->permanent_country;
            $adress->permanent_zip = $request->permanent_zip;

            $adress->save();

        }else{

            $adress = new Address();
            $adress->user_id = $students->id;
            $adress->district = $request->district;
            $adress->address = $request->address;
            $adress->city = $request->city;
            $adress->state = $request->state;
            $adress->country = $request->country;
            $adress->zip = $request->zip;
            $adress->register_type = 'new';
            $adress->permanent_district = $request->permanent_district;
            $adress->permanent_address = $request->permanent_address;
            $adress->permanent_city = $request->permanent_city;
            $adress->permanent_state = $request->permanent_state;
            $adress->permanent_country = $request->permanent_country;
            $adress->permanent_zip = $request->permanent_zip;
            $adress->save();
        }

//        $client = new \GuzzleHttp\Client();
//        $response = $client->request('GET', 'http://sms.crunchymedia.in/api/mt/SendSMS?user=AUMSHREECOMMUNICATION&password=Mkmishr@&senderid=CSMPRO&channel=Trans&DCS=0&flashsms=0&number='.$request->mother_mobile.'&text=Student ID:'.$student_id.'Parent Login ID:'.$request->mother_email.' Parent ID/Password:'.$parent_id.'&route=02');


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
        $studentparents = StudentParent::where('student_id', $id)->where('parent_type', 'new')->first();
        $address = Address::where('user_id',$id)->where('register_type', 'new')->first();
        return view('admin.new_admission.view', compact(['id_proof','classes','students','studentparents','address','qualifications']));
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

            $students = Student::find($id);
            $schools = School::all();
            $classes = Createclass::where('school_id', $students->school_id)->get();
            $qualifications = Qualification::all();
            $studentparents = StudentParent::where('student_id', $id)->where('parent_type', 'new')->first();
            $address = Address::where('user_id',$id)->where('register_type', 'new')->first();
        }elseif(auth()->user()->role->name == "admin"){
            $schools = null;
            $classes = Createclass::where('school_id', auth()->user()->school->id)->get();
            $students = Student::find($id);
            $qualifications = Qualification::all();
            $studentparents = StudentParent::where('student_id', $id)->where('parent_type', 'new')->first();
            $address = Address::where('user_id',$id)->where('register_type', 'new')->first();
        }elseif(auth()->user()->role->name == "parent"){
            $schools = null;
            $students = Student::find($id);
            $classes = Createclass::where('school_id', $students->school_id)->get();
            $qualifications = Qualification::all();
            $studentparents = StudentParent::where('student_id', $id)->where('parent_type', 'new')->first();
            $address = Address::where('user_id',$id)->where('register_type', 'new')->first();
        }
       return view('admin.new_admission.edit', compact(['id_proof','schools','classes','students','studentparents','address','qualifications']));
    }

    public function edit_profile($id)
    {
        $id_proof = Idproof::all();
        $classes = Createclass::all();
        $qualifications = Qualification::all();
        $parents = StudentParent::where('user_id', $id)->where('parent_type', 'new')->first();
        return view('admin.new_admission.edit_parents',compact(['id_proof','classes','qualifications','parents']));
    }

    public function parentUpdate(Request $request, $id)
    {
        $parents =  StudentParent::where('user_id', $id)->where('parent_type', 'new')->first();
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
        $students = Student::find($id);
        $students->first_name = $request->first_name;
        $students->last_name = $request->last_name;
        $students->ref_no = $request->ref_no;
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

        $parents =  StudentParent::where('student_id', $id)->where('parent_type', 'new')->first();
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


        $address = Address::find($id);
        $address = Address::where('user_id',$id)->where('register_type', 'new')->first();
        if ($address->is_same == 1 || $request->is_same == 1){
            $address->user_id = $students->id;
            $address->district = $request->district;
            $address->address = $request->address;
            $address->city = $request->city;
            $address->state = $request->state;
            $address->country = $request->country;
            $address->zip = $request->zip;
            $address->is_same = $request->is_same;
            $address->register_type = 'new';
            $address->permanent_district = $request->permanent_district;
            $address->permanent_address = $request->permanent_address;
            $address->permanent_city = $request->permanent_city;
            $address->permanent_state = $request->permanent_state;
            $address->permanent_country = $request->permanent_country;
            $address->permanent_zip = $request->permanent_zip;
            $address->save();
        }else{
            $address->is_same = 0;
            $address->register_type = 'new';
            $address->user_id = $students->id;
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
