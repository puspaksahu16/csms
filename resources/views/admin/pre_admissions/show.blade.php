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
                            <h2 class="content-header-title float-left mb-0">Pre Admission</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Pre Admission</a>
                                    </li>

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
                        <form class="form">
                            @csrf
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Student Details</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">

                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="photo">
                                                            <img id="p1" height="150px"  src="{{asset('images/student_photo/'.$pre_admission->photo)}}" width="130px"  />
                                                        </div>
                                                        <br/>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="family_photo">
                                                            <img id="p2" height="150px" src="{{asset('images/family_photo/'.$pre_admission->family_photo)}}" width="130px"  />
                                                        </div>
                                                        <br/>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <div class="col-md-6 col-12">
                                                            <label for="email-id-column">School</label>
                                                            <div class="form-label-group">
                                                            <select name="school_id" class="form-control" disabled>
                                                                <option>-SELECT School-</option>

                                                                @foreach($schools as $school)
                                                                    <option  {{ $pre_admission->school_id == $school->id ? "selected" : " " }} value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                @endforeach

                                                            </select>
                                                            </div>

                                                        </div>
                                                    @endif
                                                        <div class="col-md-6 col-12">
                                                            <label for="email-id-column">Class</label>
                                                            <div class="form-label-group">

                                                                <select name="class_id" class="form-control" disabled>
                                                                    <option>-SELECT CLASS-</option>

                                                                    @foreach($classes as $class)
                                                                        <option {{ $class->id == $pre_admission->class_id ? "selected" : " "  }} value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                                    @endforeach

                                                                </select>

                                                            </div>
                                                        </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="first-name-column" class="form-control" placeholder="First Name" name="first_name" value="{{$pre_admission->first_name}}" disabled>
                                                            <label for="first-name-column">First Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="last-name-column" class="form-control" placeholder="Last Name" name="last_name" value="{{$pre_admission->last_name}}" disabled>
                                                            <label for="last-name-column">Last Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="date"  class="form-control"  name="dob" value="{{$pre_admission->dob}}" disabled>
                                                            <label for="DOB">DOB</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <select name="gender" class="form-control" disabled>
                                                                <option  value="">-Select Gender-</option>
                                                                <option {{1 == $pre_admission->gender ? "selected" : " " }} value="1">MALE</option>
                                                                <option {{2 == $pre_admission->gender ? "selected" : " " }} value="2">FEMALE</option>
                                                            </select>

                                                            <label for="country-floating">Gender</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <select name="pre_exam_id" class="form-control" disabled>
                                                                <option>-SELECT EXAM-</option>
                                                                @foreach($pre_exams as $pre_exam)
                                                                    <option {{ $pre_exam->id == $pre_admission->pre_exam_id ? "selected" : " "  }} value="{{ $pre_exam->id }}">{{ $pre_exam->exam_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <label for="email-id-column">Exam</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <select class="form-control" disabled>
                                                                <option>-SELECT CAST-</option>
                                                                <option {{4 == $pre_admission->caste ? "selected" : " " }}>ST</option>
                                                                <option {{3 == $pre_admission->caste ? "selected" : " " }}>SC</option>
                                                                <option {{2 == $pre_admission->caste ? "selected" : " " }}>OBC</option>
                                                                <option {{1 == $pre_admission->caste ? "selected" : " " }}>GEN</option>
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
                                            <h4 class="card-title">Parent's Details</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text"  class="form-control" placeholder="Mother's First Name" name="mother_first_name" value="{{$parents->mother_first_name}}" disabled>
                                                                <label for="first-name-column">Mother's First Name</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Father's First Name" name="father_first_name" value="{{$parents->father_first_name}}" disabled>
                                                                <label for="first-name-column">Father's First Name</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" id="last-name-column" class="form-control" placeholder="Mother's Last Name" name="mother_last_name" value="{{$parents->mother_last_name}}" disabled>
                                                                <label for="last-name-column">Mother's Last Name</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" id="last-name-column" class="form-control" placeholder="Father's Last Name" name="father_last_name" value="{{$parents->father_last_name}}" disabled>
                                                                <label for="last-name-column">Father's Last Name</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text"  class="form-control" placeholder="Mother's Mobile"  name="mother_mobile" value="{{$parents->mother_mobile}}" disabled>
                                                                <label for="Mother's Mobile">Mother's Mobile Number</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text"  class="form-control" placeholder="Father's Mobile"  name="father_mobile" value="{{$parents->father_mobile}}" disabled>
                                                                <label for="Mother's Mobile">Father's Mobile Number</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text"  class="form-control" placeholder="Mother Email Id"  name="mother_email" value="{{$parents->mother_email}}" disabled>
                                                                <label for="Email Id">Mother Email Id</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text"  class="form-control" placeholder="Father Email Id"  name="father_email" value="{{$parents->father_email}}" disabled>
                                                                <label for="Email Id">Father Email Id</label>
                                                            </div>
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
                                            <h4 class="card-title"></h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form class="form">
                                                    <div class="form-body">

                                                        <div class="row">
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <textarea name="address" class="form-control" disabled>{{$address->address}}</textarea>
                                                                    <label for="first-name-column">Residence Address</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text"  class="form-control" placeholder="City" name="city" value="{{$address->city}}" disabled>
                                                                    <label for="Post">City</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text"  class="form-control" placeholder="District" name="district" value="{{$address->district}}" disabled>
                                                                    <label for="Dist">District</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text"  class="form-control" placeholder="Zip Code" name="zip" value="{{$address->zip}}" disabled>
                                                                    <label for="Zip Code">Zip Code</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text"  class="form-control" placeholder="State" name="state" value="{{$address->state}}" disabled>
                                                                    <label for="State">State</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text"  class="form-control" placeholder="Country" name="country" value="{{$address->country}}" disabled>
                                                                    <label for="State">Country</label>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-12" align="right">
                                                            <a href="{{url('/pre_admissions')}}" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Back</a>

                                                        </div>

                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
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
