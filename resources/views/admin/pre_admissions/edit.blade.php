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
                        <form class="form" method="POST" action="{{route('pre_admissions.update',$pre_admission->id)}}" enctype="multipart/form-data">
                            @method('PUT')
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
                                                        Student photo :<input type="file" name='photo' id="photo" onchange="pic(this);"/><p><br/></p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="family_photo">
                                                            <img id="p2" height="150px" src="{{asset('images/family_photo/'.$pre_admission->family_photo)}}" width="130px"  />
                                                        </div>
                                                        <br/>
                                                        Family photo :<input type="file" name='family_photo' id="family_photo" onchange="pic2(this);"/><p><br/></p>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    @if(auth()->user()->role->name == "super_admin")

                                                        <div class="col-md-12 col-12">
                                                            <select onchange="get_class(this.value)" name="school_id" class="form-control">
                                                                <option>-SELECT School-</option>

                                                                @foreach($schools as $school)
                                                                    <option  {{ $pre_admission->school_id == $school->id ? "selected" : " " }} value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                @endforeach

                                                            </select>
                                                            <label for="first-name-column"></label>
                                                        </div>

                                                    @endif
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="first-name-column" class="form-control" placeholder="First Name" name="first_name" value="{{$pre_admission->first_name}}">
                                                            <label for="first-name-column">First Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="last-name-column" class="form-control" placeholder="Last Name" name="last_name" value="{{$pre_admission->last_name}}">
                                                            <label for="last-name-column">Last Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="date"  class="form-control"  name="dob" value="{{$pre_admission->dob}}">
                                                            <label for="DOB">DOB</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <select name="gender" class="form-control">
                                                                <option  value="">-Select Gender-</option>
                                                                <option {{1 == $pre_admission->gender ? "selected" : " " }} value="1">MALE</option>
                                                                <option {{2 == $pre_admission->gender ? "selected" : " " }} value="2">FEMALE</option>
                                                            </select>

                                                            <label for="country-floating">Gender</label>
                                                        </div>
                                                    </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <select  onchange="getExam(this.value)" name="class_id" id="class_id" class="form-control">
                                                                    <option>-SELECT CLASS-</option>

                                                                    @foreach($classes as $class)
                                                                        <option {{ $class->id == $pre_admission->class_id ? "selected" : " "  }} value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                                    @endforeach

                                                                </select>

                                                            </div>
                                                        </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <select name="pre_exam_id" id="pre_exam_id" class="form-control">
                                                                <option>-SELECT EXAM-</option>
                                                                @foreach($pre_exams as $pre_exam)
                                                                    <option {{ $pre_exam->id == $pre_admission->pre_exam_id ? "selected" : " "  }} value="{{ $pre_exam->id }}">{{ $pre_exam->exam_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <tr>
                                                                <br/>
                                                                <td><input {{4 == $pre_admission->caste ? "checked" : " " }}  type="radio" name="caste" value="4">ST</td>
                                                                <td><input {{3 == $pre_admission->caste ? "checked" : " " }}  type="radio" name="caste" value="3">SC</td>
                                                                <td><input {{2 == $pre_admission->caste ? "checked" : " " }}  type="radio" name="caste" value="2">OBC</td>
                                                                <td><input {{1 == $pre_admission->caste ? "checked" : " " }}  type="radio" name="caste" value="1">GEN</td>
                                                            </tr>
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
                                                                <input type="text"  class="form-control" placeholder="Mother's First Name" name="mother_first_name" value="{{$parents->mother_first_name}}">
                                                                <label for="first-name-column">Mother's First Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" id="last-name-column" class="form-control" placeholder="Mother's Last Name" name="mother_last_name" value="{{$parents->mother_last_name}}">
                                                                <label for="last-name-column">Mother's Last Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text"  class="form-control" placeholder="Mother's Mobile"  name="mother_mobile" value="{{$parents->mother_mobile}}">
                                                                <label for="Mother's Mobile">Mother's Mobile Number</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text"  class="form-control" placeholder="Mother Email Id"  name="mother_email" value="{{$parents->mother_email}}">
                                                                <label for="Email Id">Mother Email Id</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Father's First Name" name="father_first_name" value="{{$parents->father_first_name}}">
                                                                <label for="first-name-column">Father's First Name</label>
                                                            </div>
                                                        </div>



                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" id="last-name-column" class="form-control" placeholder="Father's Last Name" name="father_last_name" value="{{$parents->father_last_name}}">
                                                                <label for="last-name-column">Father's Last Name</label>
                                                            </div>
                                                        </div>



                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text"  class="form-control" placeholder="Father's Mobile"  name="father_mobile" value="{{$parents->father_mobile}}">
                                                                <label for="Mother's Mobile">Father's Mobile Number</label>
                                                            </div>
                                                        </div>



                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text"  class="form-control" placeholder="Father Email Id"  name="father_email" value="{{$parents->father_email}}">
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
                                                                    <textarea name="address" id="address" class="form-control">{{$address->address}}</textarea>
                                                                    <label for="first-name-column">Residence Address</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text"  id="city" class="form-control" placeholder="City" name="city" value="{{$address->city}}">
                                                                    <label for="Post">City</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text"  id="district" class="form-control" placeholder="District" name="district" value="{{$address->district}}">
                                                                    <label for="Dist">District</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text"  id="zip" class="form-control" placeholder="Zip Code" name="zip" value="{{$address->zip}}">
                                                                    <label for="Zip Code">Zip Code</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text"  id="state" class="form-control" placeholder="State" name="state" value="{{$address->state}}">
                                                                    <label for="State">State</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text"  id="country" class="form-control" placeholder="Country" name="country" value="{{$address->country}}">
                                                                    <label for="State">Country</label>
                                                                </div>
                                                            </div>
                                                        </div>
{{--                                                        <input onchange="permanent()" type="checkbox" id="is_same" {{$address->is_same == 1 ? 'checked' : ''}} name="is_same" value="1"><label>Same as Permanent</label>--}}

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



                                                        <div class="col-12">
                                                            <input type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" value="Submit">
                                                            <a href="{{url('/pre_admissions')}}" class="btn btn-outline-success mr-1 mb-1">Back</a>
{{--                                                            <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>--}}
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
@endsection
@push('scripts')
    <script type="text/javascript">
        function get_class(value) {
            // alert(value);
            $('#class_show').hide();
            jQuery.ajax({
                url : '/get_class/' +value,
                type : "GET",
                dataType : "json",
                success:function(data)
                {
                    console.log(data);
                    $('#class_id').empty();
                    $('#class_id').append('<option value="">Select Class</option>');
                    jQuery.each(data, function(key,value){
                        $('#class_id').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                }
            });
        }
        function getExam(id) {
            // alert(id);
            $.ajax({
                url: "/get_pre_exam",
                type: "post",
                data:{
                    "_token": "{{ csrf_token() }}",
                    class_id: id
                },
                success: function(result){
                    console.log(result);
                    $('#pre_exam_id').empty();
                    if(result)
                    {
                        $('#pre_exam_id').append('<option value="">-Select-</option>');
                        $.each(result,function(key,value){
                            $('#pre_exam_id').append($("<option/>", {
                                value: key,
                                text: value
                            }));
                        });
                    }
                    // $("#div1").html(result);
                }});
        }
    </script>
    <script src="{{asset('admin_assets/vendors/js/vendors.min.js') }}"></script>
@endpush
