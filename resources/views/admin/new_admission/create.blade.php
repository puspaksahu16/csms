@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/plugins/forms/wizard.min.css') }}">
    <script src="{{ asset('admin_assets/js/scripts/forms/wizard-steps.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
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
                            <h2 class="content-header-title float-left mb-0">New Admission</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">New Admission</a>
                                    </li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif


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
                                                        @if (session()->has('errors'))
                                                            <span style="color: red">Please check! All mandatory fields need to fill up correctly.</span>
                                                        @endif
                                                        <form class="form" method="POST" action="{{route('new_admission.store')}}" enctype="multipart/form-data">
                                                            @csrf

                                                            <div class="row setup-content" id="step-1">
                                                                <div class="card-header">
                                                                    <h4 class="card-title">Student Details</h4>
                                                                </div>

                                                                <div class="container">
                                                                    <br/><br/>
                                                                <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="student_photo">
                                                                                <img id="p1" height="150px" width="130px"  />
                                                                            </div>
                                                                            <br/>
                                                                            Student photo <span style="color: red">*</span>:<input type="file" name='photo' id="photo" onchange="pic(this);"/>
                                                                            <p><br/><span style="color: red">{{ $errors->first('photo') }}</span></p>

                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="family_photo">
                                                                                <img id="p2" height="150px" width="130px"  />
                                                                            </div>
                                                                            <br/>
                                                                            Family photo <span style="color: red">*</span>:<input type="file" name='family_photo'  id="family_photo" onchange="pic2(this);"/>
                                                                            <p><br/> <span style="color: red">{{ $errors->first('family_photo') }}</span></p>

                                                                        </div>
                                                                </div>
                                                                    <div class="row">
                                                                        @if(auth()->user()->role->name == "super_admin")
                                                                            <div class="col-md-6 col-12">
                                                                                School<span style="color: red">*</span>:
                                                                                <select onchange="getClass()" id="school_id" name="school_id" class="form-control">
                                                                                    <option>-SELECT School-</option>

                                                                                    @foreach($schools as $school)
                                                                                        <option {{ !empty($details->school_id) ? ($details->school_id == $school->id ? "selected" : '') : ''}} value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                                    @endforeach

                                                                                </select>
                                                                                <span style="color: red">{{ $errors->first('school_id') }}</span>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    Reference No:
                                                                                    <input value="{{ !empty($details->ref_no) ? $details->ref_no : ''}}{{ old('ref_no') }}"  type="text" class="form-control" placeholder="Reference No" name="ref_no">
                                                                                    <span style="color: red">{{ $errors->first('ref_no') }}</span>
                                                                                </div>
                                                                            </div>
                                                                            @else
                                                                            <div class="col-md-12 col-12">
                                                                                <div class="form-label-group">
                                                                                    Reference No:
                                                                                    <input value="{{ !empty($details->ref_no) ? $details->ref_no : ''}}{{ old('ref_no') }}" type="text" class="form-control" placeholder="Reference No" name="ref_no">
                                                                                </div>
                                                                            </div>
                                                                        @endif



                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                First Name<span style="color: red">*</span>:
                                                                                <input value="{{ !empty($details->first_name) ? $details->first_name : ''}}{{ old('first_name') }}" type="text" class="form-control" placeholder="First Name" name="first_name">

                                                                                <span style="color: red">{{ $errors->first('first_name') }}</span>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                Last Name<span style="color: red">*</span>:
                                                                                <input value="{{ !empty($details->last_name) ? $details->last_name : ''}}{{ old('last_name') }}" type="text" class="form-control" placeholder="Last Name" name="last_name">
                                                                                <span style="color: red">{{ $errors->first('last_name') }}</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                DOB<span style="color: red">*</span>:
                                                                                <input value="{{ !empty($details->dob) ? $details->dob : ''}}{{ old('dob') }}" type="date"  class="form-control" name="dob">

                                                                                <span style="color: red">{{ $errors->first('dob') }}</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                Gender<span style="color: red">*</span>:
                                                                                <select name="gender_id" class="form-control">
                                                                                    <option  value="">-Select Gender-</option>
                                                                                    <option {{ (old('gender_id') == 1 ? "selected" : '') }} {{ !empty($details->gender_id) ? ($details->gender_id == 1 ? "selected" : '') : ''}} value="1">MALE</option>
                                                                                    <option {{ (old('gender_id') == 2 ? "selected" : '') }} {{ !empty($details->gender_id) ? ($details->gender_id == 2 ? "selected" : '') : ''}} value="2">FEMALE</option>
                                                                                </select>
                                                                                <span style="color: red">{{ $errors->first('gender_id') }}</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                Id Proof:
                                                                                <select name="id_proof" class="form-control">
                                                                                    <option value="">-choose id proof-</option>
                                                                                    @foreach($id_proof as $id_proofs)
                                                                                        <option @if (old('id_proof') == $id_proofs->id) selected="selected" @endif {{ !empty($details->id_proof) ? ($details->id_proof == $id_proofs->id ? "selected" : '') : ''}} value="{{ $id_proofs->id }}">{{ $id_proofs->id_proof }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                {{--<span style="color: red">{{ $errors->first('id_proof') }}</span>--}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                Id Proof Number:
                                                                                <input value="{{ old('id_proof_no') }}" type="text" class="form-control" placeholder="Id Proof Number" name="id_proof_no">

                                                                                {{--<span style="color: red">{{ $errors->first('id_proof_no') }}</span>--}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                TC<span style="color: red">*</span>:
                                                                                <select class="form-control" name="tc" onchange="yesnoCheck(this);">
                                                                                    <option value="">-Select TC-</option>
                                                                                    <option {{ (old('id_proof') == "yes" ? "selected" : '') }} value="{{ empty(old('id_proof')) ? 'yes' :  old('id_proof')}}">Yes</option>
                                                                                    <option {{ (old('id_proof') == "no" ? "selected" : '') }} value="{{ empty(old('id_proof')) ? 'no' :  old('id_proof')}}">No</option>
                                                                                </select>

                                                                                <span style="color: red">{{ $errors->first('tc') }}</span>
                                                                            </div>
                                                                        </div>
                                                                            @if(auth()->user()->role->name == "super_admin")
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                Class <span style="color: red">*</span>
                                                                                <select class="form-control" id="class" name="class_id">
                                                                                    @if(!empty($details->class_id))
                                                                                        @foreach($classes as $class)
                                                                                            <option  {{ !empty($details->class_id) ? ($details->class_id == $class->id ? 'selected' : "") : ''}} value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>

                                                                                <span style="color: #fff;font-size: 10px">Tips: Please slect school to choose class</span>
                                                                                <span style="color: red">{{ $errors->first('class_id') }}</span>
                                                                            </div>
                                                                        </div>
                                                                            @else
                                                                                <div class="col-md-6 col-12">
                                                                                    <div class="form-label-group">
                                                                                        Class <span style="color: red">*</span>
                                                                                        <select  class="form-control" id="class" name="class_id">
                                                                                            <option value="">-Select class-</option>
                                                                                            @foreach($classes as $class)
                                                                                                <option {{ (old('class_id') == $class->id  ? "selected" : '') }} {{ !empty($details->class_id) ? ($details->class_id == $class->id ? 'selected' : "") : ''}} value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        <span style="color: red">{{ $errors->first('class_id') }}</span>
                                                                                    </div>
                                                                                </div>

                                                                                @endif
                                                                            <div class="col-md-6 col-12" id="ifYes"  style="display: none;">
                                                                                <div class="form-label-group">
                                                                                    TC No<span style="color: red">*</span>:
                                                                                    <input  type="text" id="id-number-column" value="{{ old('tc_no') }}" class="form-control" placeholder="Tc Number" name="tc_no">
                                                                                    <label for="last-name-column">Tc Number</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    Category<span style="color: red">*</span>:
                                                                                   <select class="form-control" id="category" name="category">
                                                                                       <option>Select Category</option>
                                                                                       <option value="General">General</option>
                                                                                       <option value="Saisha">Saisha</option>
                                                                                   </select>
                                                                                    <span style="color: red">{{ $errors->first('category') }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    Blood Group<span style="color: red">*</span>:
                                                                                    <select name="blood_group" class="form-control">
                                                                                        <option value="">Select Blood Group</option>
                                                                                        <option value="A+">A+</option>
                                                                                        <option value="O+">O+</option>
                                                                                        <option value="B+">B+</option>
                                                                                        <option value="AB+">AB+</option>
                                                                                        <option value="A-">A-</option>
                                                                                        <option value="O-">O-</option>
                                                                                        <option value="B-">B-</option>
                                                                                        <option value="AB-">AB-</option>

                                                                                    </select>
                                                                                    <span style="color: red">{{ $errors->first('blood_group') }}</span>
                                                                                </div>
                                                                            </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                Caste<span style="color: red">*</span>:
                                                                                <tr>
                                                                                    <br/>
                                                                                    <td><input {{ (old('caste') == 4  ? "checked" : '') }} {{ !empty($details->class_id) ? ($details->caste == 4 ? "checked" : '') : '' }} type="radio" name="caste" value="4">ST</td>
                                                                                    <td><input {{ (old('caste') == 3  ? "checked" : '') }} {{ !empty($details->class_id) ? ($details->caste == 3 ? "checked" : '') : ''}} type="radio" name="caste" value="3">SC</td>
                                                                                    <td><input {{ (old('caste') == 2  ? "checked" : '') }} {{ !empty($details->class_id) ? ($details->caste == 2 ? "checked" : '') : ''}} type="radio" name="caste" value="2">OBC</td>
                                                                                    <td><input {{ (old('caste') == 1  ? "checked" : '') }} {{ !empty($details->class_id) ? ($details->caste == 1 ? "checked" : '') : ''}} type="radio" name="caste" value="1">GEN</td>
                                                                                </tr>
                                                                                <span style="color: red">{{ $errors->first('caste') }}</span>
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
                                                                                    First Name<span style="color: red">*</span>:
                                                                                    <input type="text" value="{{ !empty($parent_details->mother_first_name) ? $parent_details->mother_first_name : '' }}{{ old('mother_first_name') }}"  class="form-control" placeholder="First Name" name="mother_first_name">

                                                                                    <span style="color: red">{{ $errors->first('mother_first_name') }}</span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    Last Name<span style="color: red">*</span>:
                                                                                    <input value="{{ !empty($parent_details->mother_last_name) ? $parent_details->mother_last_name : '' }}{{ old('mother_last_name') }}" type="text" id="last-name-column" class="form-control" placeholder=" Last Name" name="mother_last_name">

                                                                                    <span style="color: red">{{ $errors->first('mother_last_name') }}</span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    Mobile Number<span style="color: red">*</span>:
                                                                                    <input value="{{ !empty($parent_details->mother_mobile) ? $parent_details->mother_mobile : '' }}{{ old('mother_mobile') }}" type="text"  class="form-control" placeholder=" Mobile"  name="mother_mobile">

                                                                                    <span style="color: red">{{ $errors->first('mother_mobile') }}</span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    Mother Email Id<span style="color: red">*</span>:
                                                                                    <input value="{{ !empty($parent_details->mother_email) ? $parent_details->mother_email : '' }}{{ old('mother_email') }}" type="text"  class="form-control" placeholder="Mother Email Id"  name="mother_email">

                                                                                    <span style="color: red">{{ $errors->first('mother_email') }}</span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    Occupation<span style="color: red">*</span>:
                                                                                    <input value="{{ old('mother_occupation') }}" type="text"  class="form-control" placeholder="Mother Occupation"  name="mother_occupation">

                                                                                    <span style="color: red">{{ $errors->first('mother_occupation') }}</span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    Salary<span style="color: red">*</span>:
                                                                                    <input value="{{ old('mother_salary') }}" type="text"  class="form-control" placeholder="Mother Salary"  name="mother_salary">

                                                                                    <span style="color: red">{{ $errors->first('mother_salary') }}</span>
                                                                                </div>
                                                                            </div>



                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    id proof<span style="color: red">*</span>:
                                                                                    <select name="mother_id_type" class="form-control">
                                                                                        <option value="">-choose id proof-</option>
                                                                                        @foreach($id_proof as $id_proofs)
                                                                                            <option {{ (old('mother_id_type') == $id_proofs->id ? "selected" : '') }} {{ !empty($details->id_proof) ? ($details->id_proof == $id_proofs->id ? "selected" : '') : ''}} value="{{ $id_proofs->id }}">{{ $id_proofs->id_proof }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    <span style="color: red">{{ $errors->first('mother_id_type') }}</span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    id proof number<span style="color: red">*</span>:
                                                                                    <input type="text" value="{{ old('mother_id_no') }}" class="form-control" placeholder="Id Proof Number" name="mother_id_no">

                                                                                    <span style="color: red">{{ $errors->first('mother_id_no') }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    Qualification<span style="color: red">*</span>:
                                                                                    <select name="mother_qualification" class="form-control">
                                                                                        <option value="">-choose  Qualification-</option>
                                                                                        @foreach($qualifications as $qualification)
                                                                                            <option {{ (old('mother_qualification') == $qualification->id ? "selected" : '') }} value="{{ $qualification->id }}">{{ $qualification->qualification }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    <span style="color: red">{{ $errors->first('mother_qualification') }}</span>
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
                                                                                    First Name<span style="color: red">*</span>:
                                                                                    <input value="{{ !empty($parent_details->father_first_name) ? $parent_details->father_first_name : '' }}{{ old('father_first_name') }}" type="text" id="first-name-column" class="form-control" placeholder=" First Name" name="father_first_name">

                                                                                    <span style="color: red"> {{ $errors->first('father_first_name') }}</span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    Last Name<span style="color: red">*</span>:
                                                                                    <input value="{{ !empty($parent_details->father_last_name) ? $parent_details->father_last_name : '' }}{{ old('father_last_name') }}" type="text" id="last-name-column" class="form-control" placeholder=" Last Name" name="father_last_name">

                                                                                    <span style="color: red">{{ $errors->first('father_last_name') }}</span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    Mobile Number<span style="color: red">*</span>:
                                                                                    <input value="{{ !empty($parent_details->father_mobile) ? $parent_details->father_mobile : '' }}{{ old('father_mobile') }}" type="text"  class="form-control" placeholder=" Mobile"  name="father_mobile">

                                                                                    <span style="color: red">{{ $errors->first('father_mobile') }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    Email Id<span style="color: red">*</span>:
                                                                                    <input value="{{ !empty($parent_details->father_email) ? $parent_details->father_email : '' }}{{ old('father_email') }}" type="text"  class="form-control" placeholder=" Email Id"  name="father_email">

                                                                                    <span style="color: red">{{ $errors->first('father_email') }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    Occupation<span style="color: red">*</span>:
                                                                                    <input  type="text" value="{{ old('father_occupation') }}"  class="form-control" placeholder=" Occupation"  name="father_occupation">

                                                                                    <span style="color: red">{{ $errors->first('father_occupation') }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    Salary<span style="color: red">*</span>:
                                                                                    <input type="text" value="{{ old('father_salary') }}"  class="form-control" placeholder=" Salary"  name="father_salary">

                                                                                    <span style="color: red">{{ $errors->first('father_salary') }}</span>
                                                                                </div>
                                                                            </div>


                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    Id Proof<span style="color: red">*</span>:
                                                                                    <select name="father_id_type" class="form-control">
                                                                                        <option value="">-choose id proof-</option>
                                                                                        @foreach($id_proof as $id_proofs)
                                                                                            <option {{ (old('father_id_type') == $id_proofs->id ? "selected" : '') }} value="{{ $id_proofs->id }}">{{ $id_proofs->id_proof }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    <span style="color: red">{{ $errors->first('father_id_type') }}</span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    Id Proof Number<span style="color: red">*</span>:
                                                                                    <input type="text" value="{{ old('father_id_no') }}" class="form-control" placeholder="Id Proof Number" name="father_id_no">

                                                                                    <span style="color: red"> {{ $errors->first('father_id_no') }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    Qualification<span style="color: red">*</span>:
                                                                                    <select name="father_qualification" class="form-control">
                                                                                        <option value="">-choose  Qualification-</option>
                                                                                        @foreach($qualifications as $qualification)
                                                                                            <option {{ (old('father_qualification') == $qualification->id ? "selected" : '') }} value="{{ $qualification->id }}">{{ $qualification->qualification }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    <span style="color: red">{{ $errors->first('father_qualification') }}</span>
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
{{--                                                                                    <textarea name="addresses[resident][address]" class="form-control">{{old('addresses[resident][address]')}}</textarea>--}}
                                                                                    <textarea id="address" name="address" class="form-control"></textarea>
                                                                                    <label for="first-name-column">Resident Address</label>
                                                                                    <span style="color: red">{{ $errors->first('address') }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
{{--                                                                                    <input value="{{old('addresses[resident][city]')}}" type="text"  class="form-control" placeholder="City" name="addresses[resident][city]">--}}
                                                                                    <input id="city" type="text"  class="form-control" placeholder="City" name="city">
                                                                                    <label for="Post">City</label>
                                                                                    <span style="color: red">{{ $errors->first('city') }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
{{--                                                                                    <input value="{{old('addresses[resident][district]')}}" type="text"  class="form-control" placeholder="District" name="addresses[resident][district]">--}}
                                                                                    <input type="text" id="district"  class="form-control" placeholder="District" name="district">
                                                                                    <label for="Dist">District</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
{{--                                                                                    <input value="{{old('addresses[resident][zip]')}}" type="text"  class="form-control" placeholder="Zip Code" name="addresses[resident][zip]">--}}
                                                                                    <input type="text" id="zip" class="form-control" placeholder="Zip Code" name="zip">
                                                                                    <label for="Zip Code">Zip Code</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
{{--                                                                                    <input value="{{old('addresses[resident][state]')}}" type="text"  class="form-control" placeholder="State" name="addresses[resident][state]">--}}
                                                                                    <input type="text" id="state"  class="form-control" placeholder="State" name="state">
                                                                                    <label for="State">State</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
{{--                                                                                    <input value="{{old('addresses[resident][country]')}}" type="text"  class="form-control" placeholder="Country" name="addresses[resident][country]">--}}
                                                                                    <input type="text" id="country" class="form-control" placeholder="Country" name="country">
                                                                                    <label for="State">Country</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <input onchange="permanent()" type="checkbox" id="is_same" name="is_same" value="1"><label>Same as Permanent</label>
{{--                                                                        <input onchange="permanent()" type="checkbox" id="is_same" name="is_same" checked value="1"><label>Same as Permanent</label>--}}
                                                                        <div id="permanent" >
                                                                            <div class="card-header">
                                                                                <h4 class="card-title">Permanent Address</h4>
                                                                            </div>
                                                                            <br/><br/><br/>
                                                                            <div class="row">
                                                                                <div class="col-md-6 col-12">
                                                                                    <div class="form-label-group">
{{--                                                                                        <textarea name="addresses[permanent][address]" class="form-control">{{old('addresses[permanent][address]')}}</textarea>--}}
                                                                                        <textarea id="permanent_address" name="permanent_address" class="form-control"></textarea>
                                                                                        <label for="first-name-column">Permanent Address</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6 col-12">
                                                                                    <div class="form-label-group">
{{--                                                                                        <input value="{{old('addresses[permanent][city]')}}" type="text"  class="form-control" placeholder="City" name="addresses[permanent][city]">--}}
                                                                                        <input type="text" id="permanent_city" name="permanent_city" class="form-control" placeholder="City">
                                                                                        <label for="Post">City</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6 col-12">
                                                                                    <div class="form-label-group">
{{--                                                                                        <input value="{{old('addresses[permanent][district]')}}" type="text"  class="form-control" placeholder="District" name="addresses[permanent][district]">--}}
                                                                                        <input type="text" id="permanent_district" name="permanent_district" class="form-control" placeholder="District">
                                                                                        <label for="Dist">District</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6 col-12">
                                                                                    <div class="form-label-group">
{{--                                                                                        <input value="{{old('addresses[permanent][zip]')}}" type="text"  class="form-control" placeholder="Zip Code" name="addresses[permanent][zip]">--}}
                                                                                        <input type="text" id="permanent_zip" name="permanent_zip" class="form-control" placeholder="Zip Code">
                                                                                        <label for="Zip Code">Zip Code</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6 col-12">
                                                                                    <div class="form-label-group">
{{--                                                                                        <input value="{{old('addresses[permanent][state]')}}" type="text"  class="form-control" placeholder="State" name="addresses[permanent][state]">--}}
                                                                                        <input type="text" id="permanent_state" name="permanent_state" class="form-control" placeholder="State">
                                                                                        <label for="State">State</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6 col-12">
                                                                                    <div class="form-label-group">
{{--                                                                                        <input value="{{old('addresses[permanent][country]')}}" type="text"  class="form-control" placeholder="Country" name="addresses[permanent][country]">--}}
                                                                                        <input type="text" id="permanent_country" name="permanent_country" class="form-control" placeholder="Country">
                                                                                        <label for="State">Country</label>
                                                                                    </div>
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
        function permanent() {
            var a = $('#is_same').is(':checked') ? 1 : 0;
            if  (a === 1)
            {
                $('#permanent_address').val($('#address').val());
                $('#permanent_city').val($('#city').val());
                $('#permanent_district').val($('#district').val());
                $('#permanent_country').val($('#country').val());
                $('#permanent_zip').val($('#zip').val());
                $('#permanent_state').val($('#state').val());
            }
            else if (a == 0)
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
    <script>
        function yesnoCheck(that) {
            if (that.value == "yes") {
                // alert("check");
                document.getElementById("ifYes").style.display = "block";
            } else {
                document.getElementById("ifYes").style.display = "none";
            }
        }

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
    </script>
    <script src="{{ asset('admin_assets/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
@endpush
