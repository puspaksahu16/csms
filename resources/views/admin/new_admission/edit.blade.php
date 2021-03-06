@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/plugins/forms/wizard.min.css') }}">
    <script src="{{ asset('admin_assets/js/scripts/forms/wizard-steps.min.js') }}"></script>
    <style>
        .btn{
            color: #fffdfd;
            background-color: #7b7b7d;
            border: 2px solid #7367f0;
        }
    </style>
@endpush
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Edit Details</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">New Details</a>
                                    </li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body"><!-- Basic Horizontal form layout section start -->

                <section id="multiple-column-form">
                    <div class="row match-height">

                        <div class="col-12">
                            <div class="card">

                                <div class="card-content">
                                    <div class="card-body">

                                        <div class="form-body">
                                            <div class="row">

                                                {{--                                                    Wizard start                      --}}

                                                <div class="container">
                                                    <div class="stepwizard">
                                                        <div class="stepwizard-row setup-panel">
                                                            <div class="stepwizard-step">
                                                                <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                                                <p>Student Details</p>
                                                            </div>
                                                            <div class="stepwizard-step">
                                                                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                                                <p>Parent Details</p>
                                                            </div>
                                                            <div class="stepwizard-step">
                                                                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                                                <p>Address</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form class="form" method="POST" action="{{route('new_admission.update', $students->id)}}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row setup-content" id="step-1">
                                                            <div class="card-header">
                                                                <h4 class="card-title">Edit Student Details</h4>
                                                            </div>

                                                            <div class="container">
                                                                <br/><br/>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="student_photo">
                                                                            <img id="p1" height="150px"  src="{{asset('images/student_photo/'.$students->photo)}}" width="130px"  />
                                                                        </div>
                                                                        <br/>
                                                                        Student photo :<input type="file" name='photo'  id="student_photo" onchange="pic(this);"/><p><br/></p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="family_photo">
                                                                            <img id="p2" height="150px" src="{{asset('images/family_photo/'.$students->family_photo)}}" width="130px"  />
                                                                        </div>
                                                                        <br/>
                                                                        Family photo :<input type="file" name='family_photo'  id="family_photo" onchange="pic2(this);"/><p><br/></p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">

                                                                    @if(auth()->user()->role->name == "super_admin")
                                                                        <div class="col-md-6 col-12">
                                                                            <select  onchange="getClass()" id="school_id" name="school_id" class="form-control">
                                                                                <option>-SELECT School-</option>

                                                                                @foreach($schools as $school)
                                                                                    <option  {{ $students->school_id == $school->id ? "selected" : " " }} value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                                @endforeach

                                                                            </select>
                                                                            <label for="first-name-column"></label>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text" class="form-control" placeholder="Reference No" name="ref_no" value="{{$students->ref_no}}">
                                                                                <label for="ref-no-column">Reference No</label>
                                                                            </div>
                                                                        </div>
                                                                        @else
                                                                        <div class="col-md-12 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text" class="form-control" placeholder="Reference No" name="ref_no" value="{{$students->ref_no}}">
                                                                                <label for="ref-no-column">Reference No</label>
                                                                            </div>
                                                                        </div>
                                                                    @endif



                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-label-group">
                                                                            <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{$students->first_name}}">
                                                                            <label for="first-name-column">First Name</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-label-group">
                                                                            <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{$students->last_name}}">
                                                                            <label for="last-name-column">Last Name</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-label-group">
                                                                            <input type="date"  class="form-control" name="dob" value="{{$students->dob}}">
                                                                            <label for="DOB">DOB</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-label-group">
                                                                            <select name="gender_id" class="form-control">
                                                                                <option disabled value="">-Select Gender-</option>
                                                                                <option value="1">MALE</option>
                                                                                <option value="2">FEMALE</option>
                                                                            </select>
                                                                            <label for="country-floating">Gender</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-label-group">
                                                                            <select name="id_proof" class="form-control">
                                                                                <option value="">-choose id proof-</option>
                                                                                @foreach($id_proof as $id_proofs)
                                                                                    <option {{ $id_proofs->id == $students->id_proof ? "selected" : " " }} value="{{ $id_proofs->id }}">{{ $id_proofs->id_proof }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-label-group">
                                                                            <input type="text" class="form-control" placeholder="Id Proof Number" name="id_proof_no" value="{{$students->id_proof_no}}">
                                                                            <label for="last-name-column">Id Proof Number</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-label-group">
                                                                            <input type="text" id="id-number-column" class="form-control" placeholder="Tc Number" name="tc_no" value="{{$students->tc_no}}">
                                                                            <label for="last-name-column">Tc Number</label>
                                                                        </div>
                                                                    </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                Category<span style="color: red">*</span>:
                                                                                <select class="form-control" id="category" name="category">
                                                                                    <option>Select Category</option>
                                                                                    <option {{ $students->category == "General" ? "selected" : "" }} value="General">General</option>
                                                                                    <option {{ $students->category == "Other" ? "selected" : "" }} value="Other">Other</option>
                                                                                </select>
                                                                                <span style="color: red">{{ $errors->first('category') }}</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                Blood Group<span style="color: red">*</span>:
                                                                                <select name="blood_group" class="form-control">
                                                                                    <option value="">Select Blood Group</option>
                                                                                    <option {{ $students->blood_group == "A+" ? "selected" : "" }} value="A+">A+</option>
                                                                                    <option {{ $students->blood_group == "O+" ? "selected" : "" }} value="O+">O+</option>
                                                                                    <option {{ $students->blood_group == "B+" ? "selected" : "" }} value="B+">B+</option>
                                                                                    <option {{ $students->blood_group == "AB+" ? "selected" : "" }} value="AB+">AB+</option>
                                                                                    <option {{ $students->blood_group == "A-" ? "selected" : "" }} value="A-">A-</option>
                                                                                    <option {{ $students->blood_group == "O-" ? "selected" : "" }} value="O-">O-</option>
                                                                                    <option {{ $students->blood_group == "B-" ? "selected" : "" }} value="B-">B-</option>
                                                                                    <option {{ $students->blood_group == "AB-" ? "selected" : "" }} value="AB-">AB-</option>

                                                                                </select>
                                                                                <span style="color: red">{{ $errors->first('blood_group') }}</span>
                                                                            </div>
                                                                        </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-label-group">
                                                                            <select id="class" class="form-control" name="class_id">
                                                                                <option value="">-Select class-</option>
                                                                                @foreach($classes as $class)
                                                                                    <option {{ $class->id == $students->class_id ? "selected" : " " }}  value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <label for="last-name-column">Class</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-label-group">
                                                                            <tr>
                                                                                <br/>
                                                                                <td><input {{ 4 == $students->caste ? "checked" : " " }} type="radio" name="caste" value="4">ST</td>
                                                                                <td><input  {{ 3 == $students->caste ? "checked" : " " }}  type="radio" name="caste" value="3">SC</td>
                                                                                <td><input  {{ 2 == $students->caste ? "checked" : " " }}  type="radio" name="caste" value="2">OBC</td>
                                                                                <td><input  {{ 1 == $students->caste ? "checked" : " " }}  type="radio" name="caste" value="1">GEN</td>
                                                                            </tr>
                                                                            <label for="email-id-column">Caste</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                                                            </div>
                                                        </div>
                                                        <div class="row setup-content" id="step-2">
                                                            <div class="card-header">
                                                                <h4 class="card-title">Mother's Details</h4>
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <div class="col-md-12">
                                                                    <br/><br/>
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text"  class="form-control" placeholder="Mother's First Name" name="mother_first_name" value="{{$studentparents->mother_first_name}}">
                                                                                <label for="first-name-column">Mother's First Name</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text" id="last-name-column" class="form-control" placeholder="Mother's Last Name" name="mother_last_name" value="{{$studentparents->mother_last_name}}">
                                                                                <label for="last-name-column">Mother's Last Name</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text"  class="form-control" placeholder="Mother's Mobile"  name="mother_mobile" value="{{$studentparents->mother_mobile}}">
                                                                                <label for="Mother's Mobile">Mother's Mobile Number</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text"  class="form-control" placeholder="Mother Email Id"  name="mother_email" value="{{$studentparents->mother_email}}">
                                                                                <label for="Email Id">Mother Email Id</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text"  class="form-control" placeholder="Mother Occupation"  name="mother_occupation" value="{{$studentparents->mother_occupation}}">
                                                                                <label for="Occupation">Mother's Occupation</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text"  class="form-control" placeholder="Mother Salary"  name="mother_salary" value="{{$studentparents->mother_salary}}">
                                                                                <label for="Income">Mother's Salary</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <select name="mother_id_type" class="form-control">
                                                                                    <option value="">-choose id proof-</option>
                                                                                    @foreach($id_proof as $id_proofs)
                                                                                        <option  {{ $id_proofs->id == $studentparents->mother_id_type ? "selected" : " " }}  value="{{ $id_proofs->id }}">{{ $id_proofs->id_proof }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text" class="form-control" placeholder="Id Proof Number" name="mother_id_no"  value="{{$studentparents->mother_id_no}}">
                                                                                <label for="last-name-column">Id Proof Number</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <select name="mother_qualification" class="form-control">
                                                                                    <option value="">-choose Mother's Qualification-</option>
                                                                                    @foreach($qualifications as $qualification)
                                                                                        <option {{ $qualification->id == $studentparents->mother_qualification ? "selected" : " " }} value="{{ $qualification->id }}">{{ $qualification->qualification }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="card-header">
                                                                <h4 class="card-title">Father's Details</h4>
                                                            </div>

                                                            <div class="col-xs-12">
                                                                <div class="col-md-12">
                                                                    <br/><br/>
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Father's First Name" name="father_first_name" value="{{$studentparents->father_first_name}}">
                                                                                <label for="first-name-column">Father's First Name</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text" id="last-name-column" class="form-control" placeholder="Father's Last Name" name="father_last_name" value="{{$studentparents->father_last_name}}">
                                                                                <label for="last-name-column">Father's Last Name</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text"  class="form-control" placeholder="Father's Mobile"  name="father_mobile" value="{{$studentparents->father_mobile}}">
                                                                                <label for="Mother's Mobile">Father's Mobile Number</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text"  class="form-control" placeholder="Father Email Id"  name="father_email" value="{{$studentparents->father_email}}">
                                                                                <label for="Email Id">Father Email Id</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text"  class="form-control" placeholder="Father Occupation"  name="father_occupation" value="{{$studentparents->father_occupation}}">
                                                                                <label for="Occupation">Father's Occupation</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text"  class="form-control" placeholder="Father Salary"  name="father_salary" value="{{$studentparents->father_salary}}">
                                                                                <label for="Income">Father's Salary</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <select name="father_id_type" class="form-control">
                                                                                    <option value="">-choose id proof-</option>
                                                                                    @foreach($id_proof as $id_proofs)
                                                                                        <option   {{ $id_proofs->id == $studentparents->father_id_type ? "selected" : " " }}  value="{{ $id_proofs->id }}">{{ $id_proofs->id_proof }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text" class="form-control" placeholder="Id Proof Number" name="father_id_no" value="{{$studentparents->father_id_no}}">
                                                                                <label for="last-name-column">Id Proof Number</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <select name="father_qualification" class="form-control">
                                                                                    <option value="">-choose Father's Qualification-</option>
                                                                                    @foreach($qualifications as $qualification)
                                                                                        <option {{ $qualification->id == $studentparents->father_qualification ? "selected" : " " }} value="{{ $qualification->id }}">{{ $qualification->qualification }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row setup-content" id="step-3">
                                                            <div class="card-header">
                                                                <h4 class="card-title">Resident Address</h4>
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <div class="col-md-12">
                                                                    <br/><br/>
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
{{--                                                                                <textarea name="addresses[resident][address]" class="form-control">{{$r_address->address}}</textarea>--}}
                                                                                <textarea name="address" id="address" class="form-control">{{$address->address}}</textarea>
                                                                                <label for="first-name-column">Resident Address</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
{{--                                                                                <input type="text"  class="form-control" placeholder="City" name="addresses[resident][city]" value="{{$r_address->city}}">--}}
                                                                                <input type="text"  id="city" class="form-control" placeholder="City" name="city" value="{{$address->city}}">
                                                                                <label for="Post">City</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
{{--                                                                                <input type="text"  class="form-control" placeholder="District" name="addresses[resident][district]" value="{{$r_address->district}}">--}}
                                                                                <input type="text"  id="district" class="form-control" placeholder="District" name="district" value="{{$address->district}}">
                                                                                <label for="Dist">District</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
{{--                                                                                <input type="text"  class="form-control" placeholder="Zip Code" name="addresses[resident][zip]" value="{{$r_address->zip}}">--}}
                                                                                <input type="text"  id="zip" class="form-control" placeholder="Zip Code" name="zip" value="{{$address->zip}}">
                                                                                <label for="Zip Code">Zip Code</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
{{--                                                                                <input type="text"  class="form-control" placeholder="State" name="addresses[resident][state]" value="{{$r_address->state}}">--}}
                                                                                <input type="text"  id="state" class="form-control" placeholder="State" name="state" value="{{$address->state}}">
                                                                                <label for="State">State</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
{{--                                                                                <input type="text"  class="form-control" placeholder="Country" name="addresses[resident][country]" value="{{$r_address->country}}">--}}
                                                                                <input type="text"  id="country" class="form-control" placeholder="Country" name="country" value="{{$address->country}}">
                                                                                <label for="State">Country</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input onchange="permanent()" type="checkbox" id="is_same" {{$address->is_same == 1 ? 'checked' : ''}} name="is_same" value="1"><label>Same as Permanent</label>
                                                                    <br/>
                                                                    <br/>
                                                                    <br/>
                                                                    <br/>

                                                                        <div class="row">
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    <textarea name="permanent_address" class="form-control">{{$address->permanent_address}}</textarea>
                                                                                    <label for="first-name-column">Permanent Address</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    <input type="text"  class="form-control" placeholder="City" name="permanent_city" value="{{$address->permanent_city}}">
                                                                                    <label for="Post">Permanent City</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    <input type="text"  class="form-control" placeholder="District" name="permanent_district" value="{{$address->permanent_district}}">
                                                                                    <label for="Dist">District</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    <input type="text"  class="form-control" placeholder="Zip Code" name="permanent_zip" value="{{$address->permanent_zip}}">
                                                                                    <label for="Zip Code">Permanent Zip Code</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    <input type="text"  class="form-control" placeholder="State" name="permanent_state" value="{{$address->permanent_state}}">
                                                                                    <label for="State">Permanent State</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    <input type="text"  class="form-control" placeholder="Country" name="permanent_country" value="{{$address->permanent_country}}">
                                                                                    <label for="State">Permanent Country</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>



                                                                    <button class="btn btn-success btn-lg pull-right" type="submit">Finish!</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                {{--                                                    Wizard end                       --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic Floating Label Form section end -->

            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        function getClass() {
            var school_id = $('#school_id').val();
            // alert(school_id);
            $.ajax({
                url : "/get_class/"+school_id,
                type:'get',
                success: function(response) {
                    console.log(response);
                    $("#class").attr('disabled', false);
                    $("#class").empty();
                    $("#class").append('<option value="">-Select Class-</option>');
                    $.each(response,function(key, value)
                    {
                        $("#class").append('<option value=' + key + '>' + value + '</option>');
                    });
                }
            });
        }
        function permanent() {
            var a = $('#is_same').is(':checked') ? 1 : 0;
            if (a === 1)
            {
                $('#permanent_address').val($('#address').val());
                $('#permanent_city').val($('#city').val());
                $('#permanent_district').val($('#district').val());
                $('#permanent_country').val($('#country').val());
                $('#permanent_zip').val($('#zip').val());
                $('#permanent_state').val($('#state').val());
            }
            else if (a === 0)
            {
                $('#permanent_address').val(null);
                $('#permanent_city').val(null);
                $('#permanent_district').val(null);
                $('#permanent_country').val(null);
                $('#permanent_zip').val(null);
                $('#permanent_state').val(null);
            }
            // alert(a);
        }
        function pic(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#p1')
                        .attr('src', e.target.result)
                        .width(130)
                        .height(150);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        function pic2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#p2')
                        .attr('src', e.target.result)
                        .width(130)
                        .height(150);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script src="{{ asset('admin_assets/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>

        <script src="{{asset('admin_assets/vendors/js/vendors.min.js') }}"></script>

@endpush
