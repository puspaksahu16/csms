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
                            <h2 class="content-header-title float-left mb-0">Employee</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Employee</a>
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
                                                                <p>Employee Details</p>
                                                            </div>
                                                            <div class="stepwizard-step">
                                                                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                                                <p>Address</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form class="form" method="POST" action="{{route('employee.store')}}" enctype="multipart/form-data">
                                                        @csrf

                                                        <div class="row setup-content" id="step-1">
                                                            <div class="card-header">
                                                                <h4 class="card-title">Employee Details</h4>
                                                            </div>

                                                            <div class="container">
                                                                <br/><br/>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="photo">
                                                                            <img id="p1" height="150px" width="130px"  />
                                                                        </div>
                                                                        <br/>
                                                                        Employee photo :<input type="file" name='photo'  id="photo" onchange="pic(this);"/><p><br/></p>
                                                                    </div>
                                                                    <div class="col-md-4">


                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    @if(auth()->user()->role->name == "super_admin")
                                                                        <div class="col-md-12 col-12">
                                                                            <select name="school_id" class="form-control">
                                                                                <option>-SELECT School-</option>

                                                                                @foreach($schools as $school)
                                                                                    <option value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                                @endforeach

                                                                            </select>
                                                                            <label for="first-name-column"></label>
                                                                        </div>
                                                                    @endif

                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-label-group">
                                                                            <input type="text" class="form-control" placeholder="First Name" name="first_name">
                                                                            <label for="first-name-column">First Name</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-label-group">
                                                                            <input type="text" class="form-control" placeholder="Last Name" name="last_name">
                                                                            <label for="last-name-column">Last Name</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-label-group">
                                                                            <input type="date"  class="form-control" name="dob">
                                                                            <label for="DOB">DOB</label>
                                                                        </div>
                                                                    </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text" class="form-control" placeholder="Mobile Number" name="mobile">
                                                                                <label for="last-name-column">Mobile</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="email" class="form-control" placeholder="Email Id" name="email">
                                                                                <label for="last-name-column">Email Id</label>
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
                                                                                    <option value="{{ $id_proofs->id }}">{{ $id_proofs->id_proof }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-label-group">
                                                                            <input type="text" class="form-control" placeholder="Id Proof Number" name="id_proof_no">
                                                                            <label for="last-name-column">Id Proof Number</label>
                                                                        </div>
                                                                    </div>


                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <select name="employee_qualification" class="form-control">
                                                                                    <option value="">-choose  Qualification-</option>
                                                                                    @foreach($qualifications as $qualification)
                                                                                        <option value="{{ $qualification->id }}">{{ $qualification->qualification }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text" class="form-control" placeholder="Department" name="employee_department">
                                                                                <label for="last-name-column">Department</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text" class="form-control" placeholder="Designation" name="employee_designation">
                                                                                <label for="last-name-column">Designation</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text"  class="form-control" placeholder="Employee Salary"  name="employee_salary">
                                                                                <label for="Income"> Salary</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text"  class="form-control" placeholder="Experience"  name="experience">
                                                                                <label for="Experience"> Experience</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <select name="role_id" class="form-control">
                                                                                    <option value="">-choose Role-</option>
                                                                                    @foreach($employee_roles as $employee_role)
                                                                                        <option value="{{ $employee_role->role_id }}">{{ $employee_role->role_name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <tr>
                                                                                    <br/>
                                                                                    <td><input type="radio" name="caste" value="4">ST</td>
                                                                                    <td><input type="radio" name="caste" value="3">SC</td>
                                                                                    <td><input type="radio" name="caste" value="2">OBC</td>
                                                                                    <td><input type="radio" name="caste" value="1">GEN</td>
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
    </script>
    <script src="{{ asset('admin_assets/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
@endpush
