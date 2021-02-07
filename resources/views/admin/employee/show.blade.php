@extends('admin.layouts.master')
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Employee</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Employee</a>
                                    </li>
                                    <li  class="breadcrumb-item"><a href="{{route('employee.index')}}" class="btn btn-sm btn-primary">Back</a></li>
                                </ol>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body"><!-- Basic Horizontal form layout section start -->

                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Employee Details</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">

                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="photo">
                                                            <img id="p1" height="150px"  src="{{asset('images/employees/'.$employee->photo)}}" width="130px"  />
                                                        </div>
                                                        <br/>
                                                    </div>

                                                </div>


                                                <div class="row">
                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <div class="col-md-12 col-12">
                                                            <select name="school_id" class="form-control" disabled>
                                                                <option>-SELECT School-</option>

                                                                @foreach($schools as $school)
                                                                    <option {{ $school->id == $employee->school_id ? "selected" : " " }} value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                @endforeach

                                                            </select>
                                                            <label for="first-name-column"></label>
                                                        </div>
                                                    @endif
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" disabled class="form-control" placeholder="First Name" value="{{$employee->first_name}}" name="first_name">
                                                                <label for="first-name-column">First Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" disabled class="form-control" placeholder="Last Name" value="{{$employee->last_name}}" name="last_name">
                                                                <label for="last-name-column">Last Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="date" disabled  class="form-control" name="dob" value="{{$employee->dob}}">
                                                                <label for="DOB">DOB</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" disabled class="form-control" placeholder="Mobile Number" name="mobile" value="{{$employee->mobile}}">
                                                                <label for="last-name-column">Mobile</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="email" disabled class="form-control" placeholder="Email Id" name="email" value="{{$employee->email}}">
                                                                <label for="last-name-column">Email Id</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <select name="gender_id" class="form-control" disabled>
                                                                    <option disabled value="">-Select Gender-</option>
                                                                    <option {{ 1 == $employee->gender_id ? "selected" : " " }} value="1">MALE</option>
                                                                    <option {{ 2 == $employee->gender_id ? "selected" : " " }} value="2">FEMALE</option>
                                                                </select>
                                                                <label for="country-floating">Gender</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <select name="id_proof" class="form-control" disabled>
                                                                    <option value="">-choose id proof-</option>
                                                                    @foreach($id_proof as $id_proofs)
                                                                        <option {{ $id_proofs->id == $employee->id_proof ? "selected" : " " }} value="{{ $id_proofs->id }}">{{ $id_proofs->id_proof }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" disabled class="form-control" placeholder="Id Proof Number" name="id_proof_no" value="{{$employee->id_proof_no}}">
                                                                <label for="last-name-column">Id Proof Number</label>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <select name="employee_qualification" class="form-control" disabled>
                                                                    <option value="">-choose  Qualification-</option>
                                                                    @foreach($qualifications as $qualification)
                                                                        <option {{ $qualification->id == $employee->employee_qualification ? "selected" : " " }} value="{{ $qualification->id }}">{{ $qualification->qualification }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" disabled class="form-control" placeholder="Designation"  value="{{$employee->employee_department}}" name="employee_department">
                                                                <label for="last-name-column">Department</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" disabled class="form-control" placeholder="Designation"  value="{{$employee->employee_designation}}" name="employee_designation">
                                                                <label for="last-name-column">Designation</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" disabled  class="form-control" placeholder="Employee Salary"  name="employee_salary" value="{{$employee->employee_salary}}">
                                                                <label for="Income"> Salary</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" disabled  class="form-control" placeholder="Experience"  name="experience"  value="{{$employee->experience}}">
                                                                <label for="Experience"> Experience</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <select class="form-control" disabled>
                                                                    <option>-SELECT CAST-</option>
                                                                    <option {{4 == $employee->caste ? "selected" : " " }}>ST</option>
                                                                    <option {{3 == $employee->caste ? "selected" : " " }}>SC</option>
                                                                    <option {{2 == $employee->caste ? "selected" : " " }}>OBC</option>
                                                                    <option {{1 == $employee->caste ? "selected" : " " }}>GEN</option>
                                                                </select>
                                                                <label for="email-id-column">Caste</label>
                                                            </div>
                                                        </div>


                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Resident Address</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <textarea disabled name="addresses[resident][address]" class="form-control">{{$r_address->address}}</textarea>
                                                                <label for="first-name-column">Resident Address</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input disabled type="text"  class="form-control" placeholder="City" name="addresses[resident][city]" value="{{$r_address->city}}">
                                                                <label for="Post">City</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input disabled type="text"  class="form-control" placeholder="District" name="addresses[resident][district]" value="{{$r_address->district}}">
                                                                <label for="Dist">District</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input  disabled type="text"  class="form-control" placeholder="Zip Code" name="addresses[resident][zip]" value="{{$r_address->zip}}">
                                                                <label for="Zip Code">Zip Code</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input disabled type="text"  class="form-control" placeholder="State" name="addresses[resident][state]" value="{{$r_address->state}}">
                                                                <label for="State">State</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input disabled type="text"  class="form-control" placeholder="Country" name="addresses[resident][country]" value="{{$r_address->country}}">
                                                                <label for="State">Country</label>
                                                            </div>
                                                        </div>
                                                    </div>
{{--                                                    <input onchange="permanent()" type="checkbox" id="is_same" name="is_same" {{$r_address->is_same == 1 ? 'checked' : ''}} value="1"><label>Same as Resident</label>--}}

                                                    <div id="permanent" >
                                                        <div class="card-header">
                                                            <h4 class="card-title">Permanent Address</h4>
                                                        </div>
                                                        <br/><br/><br/>
                                                        <div class="row">
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <textarea disabled name="addresses[permanent][address]" class="form-control">{{$r_address->permanent_address}}</textarea>
                                                                    <label for="first-name-column">Permanent Address</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input disabled type="text"  class="form-control" placeholder="City" name="addresses[permanent][city]" value="{{$r_address->permanent_city}}">
                                                                    <label for="Post">City</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input disabled type="text"  class="form-control" placeholder="District" name="addresses[permanent][district]"  value="{{$r_address->permanent_district}}">
                                                                    <label for="Dist">District</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text" disabled  class="form-control" placeholder="Zip Code" name="addresses[permanent][zip]" value="{{$r_address->permanent_zip}}">
                                                                    <label for="Zip Code">Zip Code</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text" disabled class="form-control" placeholder="State" name="addresses[permanent][state]" value="{{$r_address->permanent_state}}">
                                                                    <label for="State">State</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text" disabled class="form-control" placeholder="Country" name="addresses[permanent][country]" value="{{$r_address->permanent_country}}">
                                                                    <label for="State">Country</label>
                                                                </div>
                                                            </div>
                                                    </div>

                                                </div>
                                            </div>

                                                <div align="right">
                                                    <a href="{{route('employee.index')}}" class="btn btn-sm btn-primary">Back</a>
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
    <script>
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
@endsection
