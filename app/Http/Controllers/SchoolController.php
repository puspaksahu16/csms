<?php

namespace App\Http\Controllers;

use App\School;
use App\SubscriptionPlan;
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
        $schools = School::all()->where('is_active',1);
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
        $request->validate([
            'owner_photo' => 'required',
            'photo' => 'required',
            'logo' => 'required',
            'full_name' => 'required',
            'affliation_no' => 'required',
            'owner_name' => 'required',
            'owner_contact_no' => 'required|digits:10',
            'contact_person' => 'required',
            'mobile' => 'required|digits:10',
            'standard' => 'required',
            'board' => 'required',
            'classes' => 'required',
            'email' => 'required|email|unique:users,email',

            'starting_year' => 'required',
            'total_strength' => 'required',
            'subscription_type' => 'required',
            'facility' => 'required',
            'address' => 'required',
        ]);

        $data = $request->all();
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
            if($file = $request->hasFile('owner_photo')) {
                $file = $request->file('owner_photo');
                $fileName = uniqid('file_').'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path('/images/owner_photo');
                $file->move($destinationPath, $fileName);
                $data['owner_photo'] = $fileName;
            }
            if($file = $request->hasFile('photo')) {
                $file = $request->file('photo');
                $fileName = uniqid('file_').'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path('/images/school_photo');
                $file->move($destinationPath, $fileName);
                $data['photo'] = $fileName;
            }
            if($file = $request->hasFile('logo')) {
                $file = $request->file('logo');
                $fileName = uniqid('file_').'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path('/images/school_photo');
                $file->move($destinationPath, $fileName);
                $data['logo'] = $fileName;
            }
            if ($request->subscription_type == 1){
                $data['total_days'] = 30;
            }elseif ($request->subscription_type == 2){
                $data['total_days'] = 180;
            }else{
                $data['total_days'] = 360;
            }
            $school = School::create($data);
            if ($school->save()){
                $subscription_plan = new SubscriptionPlan();
                $subscription_plan->school_id = $school->id;
                $subscription_plan->subscription_type = $request->subscription_type;
                $subscription_plan->save();
            }


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
        $school = School::find($id);
        return view('admin.schools.show', compact('school'));
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

        $school = School::find($id);
        $school->full_name =$request->full_name;
        $school->address =$request->address;
        $school->affliation_no =$request->affliation_no;
        $school->owner_name =$request->owner_name;
        $school->owner_contact_no =$request->owner_contact_no;
        $school->total_strength =$request->total_strength;
        $school->subscription_type =$request->subscription_type;

        if($file = $request->hasFile('owner_photo')) {
            $file = $request->file('owner_photo');
            $fileName = uniqid('file_').'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/images/owner_photo');
            $file->move($destinationPath, $fileName);
             $school->owner_photo = $fileName;
        }
        $school->contact_person =$request->contact_person;

        if($file = $request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = uniqid('file_').'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/images/school_photo');
            $file->move($destinationPath, $fileName);
            $school->photo = $fileName;
        }
        if($file = $request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = uniqid('file_').'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('/images/school_photo');
            $file->move($destinationPath, $fileName);
            $school->logo = $fileName;
        }

        $school->standard =$request->standard;
        $school->board =$request->board;
        $school->classes =$request->classes;
        $school->starting_year =$request->starting_year;
        $school->facility =$request->facility;
        $school->email =$request->email;
        $school->mobile =$request->mobile;
        $school->update();

         $user =  User::find($school->user_id);
        $user->name = $request->full_name;
        $user->email = $request->email;

        $user->update();
        return redirect()->route('schools.index')->with('success', 'School updated successfully');
    }
    public function Update_status(Request $request, $id)
    {

        $school = School::find($id);
        $school->is_active = '0';
        $school->update();
        return redirect()->route('schools.index')->with('success', 'School deleted successfully');

    }

    public function schoolRenewal(Request $request, $id)
    {
        $school_renewal = School::find($id);
        $days = $school_renewal->total_days;
        $students = $school_renewal->total_strength;
        $school_renewal->total_strength = $students + $request->total_strength;
        $school_renewal->subscription_type = $request->subscription_type;
        if ($request->subscription_type == 1){
            $school_renewal->total_days = $days  + 30;
        }elseif ($request->subscription_type == 2){
            $school_renewal->total_days = $days  + 180;
        }elseif($request->subscription_type == 3){
            $school_renewal->total_days = $days  + 360;
        }else{
            $school_renewal->total_days = $days;
        }
        $school_renewal->update();
        if ($school_renewal->update()){
            $subscription_plan = new SubscriptionPlan();
            $subscription_plan->school_id = $school_renewal->id;
            $subscription_plan->subscription_type = $request->subscription_type;
            $subscription_plan->added_students = $request->total_strength;
            $subscription_plan->save();
        }
        return redirect()->route('schools.index')->with('success', 'Renewal added successfully');
    }

    public function subscriptionPlan()
    {
        $subscription_plans = SubscriptionPlan::all();
        return view('admin.subscription_history.index', compact('subscription_plans'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        School::where('id',$id)->delete();
//        return redirect('/schools')->with("success", "School data is deleted successfully!");
    }
}
