@extends('admin.layouts.master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
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
                        <form class="form" method="POST" action="{{route('pre_admissions.store')}}" enctype="multipart/form-data">
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
                                                        <div class="student_photo">
                                                            <img id="p1" height="150px" width="130px"  />
                                                        </div>
                                                        <br/>
                                                        Student photo :<input type="file" name='photo'  id="photo" onchange="pic(this);"/><p><br/></p>
                                                        <span style="color: red">{{ $errors->first('photo') }}</span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="family_photo">
                                                            <img id="p2" height="150px" width="130px"  />
                                                        </div>
                                                        <br/>
                                                        Family photo :<input type="file" name='family_photo'  id="family_photo" onchange="pic2(this);"/><p><br/></p>
                                                        <span style="color: red">{{ $errors->first('family_photo') }}</span>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <div class="col-md-6 col-12">
                                                            <select name="school_id" class="form-control">
                                                                <option value="">-SELECT School-</option>

                                                                @foreach($schools as $school)
                                                                    <option value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                @endforeach

                                                            </select>
                                                            <span style="color: red">{{ $errors->first('school_id') }}</span>
                                                        </div>
                                                    @endif
                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <select onchange="getExam(this.value)" name="class_id" id="class_id" class="form-control"></select>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-label-group">
                                                                <select onchange="getExam(this.value)" name="class_id" id="class_id" class="form-control">
                                                                    <option>-Select Class-</option>
                                                                    @foreach($classes as $class)
                                                                        <option value="{{ $class->id }}"  style="text-transform: uppercase">{{ $class->create_class }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <label>First Name</label>
                                                            <input type="text" id="first-name-column" value="{{ old('first_name') }}" class="form-control" placeholder="First Name" name="first_name">
                                                            <span style="color: red">{{ $errors->first('first_name') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="last-name-column" value="{{ old('last_name') }}" class="form-control" placeholder="Last Name" name="last_name">
                                                            <label for="last-name-column">Last Name</label>
                                                            <span style="color: red">{{ $errors->first('last_name') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="date" value="{{ old('dob') }}" class="form-control"  name="dob">
                                                            <label for="DOB">DOB</label>
                                                            <span style="color: red">{{ $errors->first('dob') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <select name="gender" class="form-control">
                                                                <option  value="">-Select Gender-</option>
                                                                <option {{ (old('gender') == 1 ? "selected" : '') }}  value="1">MALE</option>
                                                                <option {{ (old('gender') == 2 ? "selected" : '') }}  value="2">FEMALE</option>
                                                            </select>

                                                            <label for="country-floating">Gender</label>
                                                            <span style="color: red">{{ $errors->first('gender') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <select name="pre_exam_id" id="pre_exam_id" class="form-control">

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <tr>
                                                                <br/>
                                                                <td><input {{ (old('caste') == 4 ? "checked" : '') }} type="radio" name="caste" value="4">ST</td>
                                                                <td><input {{ (old('caste') == 3 ? "checked" : '') }} type="radio" name="caste" value="3">SC</td>
                                                                <td><input {{ (old('caste') == 2 ? "checked" : '') }} type="radio" name="caste" value="2">OBC</td>
                                                                <td><input {{ (old('caste') == 1 ? "checked" : '') }} type="radio" name="caste" value="1">GEN</td>
                                                            </tr>
                                                            <label for="email-id-column">Caste</label>
                                                            <span style="color: red">{{ $errors->first('caste') }}</span>
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
                                                                <input type="text"  class="form-control" placeholder="Mother's First Name"  value="{{ old('mother_first_name') }}" name="mother_first_name">
                                                                <label for="first-name-column">Mother's First Name</label>
                                                                <span style="color: red">{{ $errors->first('mother_first_name') }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" id="last-name-column" class="form-control" placeholder="Mother's Last Name" value="{{ old('mother_last_name') }}" name="mother_last_name">
                                                                <label for="last-name-column">Mother's Last Name</label>
                                                                <span style="color: red">{{ $errors->first('mother_last_name') }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text"  class="form-control" placeholder="Mother's Mobile" value="{{ old('mother_mobile') }}" name="mother_mobile">
                                                                <label for="Mother's Mobile">Mother's Mobile Number</label>
                                                                <span style="color: red">{{ $errors->first('mother_mobile') }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text"  class="form-control" placeholder="Mother Email Id" value="{{ old('mother_email') }}" name="mother_email">
                                                                <label for="Email Id">Mother Email Id</label>
                                                                <span style="color: red">{{ $errors->first('mother_email') }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" id="first-name-column" class="form-control" value="{{ old('father_first_name') }}" placeholder="Father's First Name" name="father_first_name">
                                                                <label for="first-name-column">Father's First Name</label>
                                                                <span style="color: red">{{ $errors->first('father_first_name') }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" id="last-name-column" class="form-control" placeholder="Father's Last Name" value="{{ old('father_last_name') }}" name="father_last_name">
                                                                <label for="last-name-column">Father's Last Name</label>
                                                                <span style="color: red">{{ $errors->first('father_last_name') }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text"  class="form-control" placeholder="Father's Mobile" value="{{ old('father_mobile') }}" name="father_mobile">
                                                                <label for="Mother's Mobile">Father's Mobile Number</label>
                                                                <span style="color: red">{{ $errors->first('father_mobile') }}</span>
                                                            </div>
                                                        </div>



                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text"  class="form-control" placeholder="Father Email Id" value="{{ old('father_email') }}" name="father_email">
                                                                <label for="Email Id">Father Email Id</label>
                                                                <span style="color: red">{{ $errors->first('father_email') }}</span>
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
                                                    <div class="form-body">

                                                        <div class="row">
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <textarea id="address" name="address" class="form-control">{{ old('address') }}</textarea>
                                                                    <label for="first-name-column">Residence Address</label>
                                                                    <span style="color: red">{{ $errors->first('address') }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input id="city" type="text" value="{{ old('city') }}"  class="form-control" placeholder="City" name="city">
                                                                    <label for="Post">City</label>
                                                                    <span style="color: red">{{ $errors->first('city') }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text" id="district"  class="form-control" value="{{ old('district') }}" placeholder="District" name="district">
                                                                    <label for="Dist">District</label>
                                                                    <span style="color: red">{{ $errors->first('district') }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text" id="zip" class="form-control" value="{{ old('zip') }}" placeholder="Zip Code" name="zip">
                                                                    <label for="Zip Code">Zip Code</label>
                                                                    <span style="color: red">{{ $errors->first('zip') }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text" id="state" value="{{ old('state') }}"  class="form-control" placeholder="State" name="state">
                                                                    <label for="State">State</label>
                                                                    <span style="color: red">{{ $errors->first('state') }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text" id="country"value="{{ old('country') }}"  class="form-control" placeholder="Country" name="country">
                                                                    <label for="State">Country</label>
                                                                    <span style="color: red">{{ $errors->first('country') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input onchange="permanent()" {{ (old('is_same') == 1 ? "checked" : '') }} type="checkbox" id="is_same" name="is_same" value="1"><label>Same as Permanent</label>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <textarea id="permanent_address" name="permanent_address" class="form-control">{{ old('permanent_address') }}</textarea>
                                                                    <label for="first-name-column">Permanent Address</label>
                                                                    <span style="color: red">{{ $errors->first('permanent_address') }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text" id="permanent_city" name="permanent_city"  value="{{ old('permanent_city') }}" class="form-control" placeholder="City">
                                                                    <label for="Post">City</label>
                                                                    <span style="color: red">{{ $errors->first('permanent_city') }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text" id="permanent_district" name="permanent_district"  value="{{ old('permanent_district') }}" class="form-control" placeholder="District">
                                                                    <label for="Dist">District</label>
                                                                    <span style="color: red">{{ $errors->first('permanent_district') }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text" id="permanent_zip" name="permanent_zip"  value="{{ old('permanent_zip') }}" class="form-control" placeholder="Zip Code">
                                                                    <label for="Zip Code">Zip Code</label>
                                                                    <span style="color: red">{{ $errors->first('permanent_zip') }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text" id="permanent_state" name="permanent_state"  value="{{ old('permanent_state') }}" class="form-control" placeholder="State">
                                                                    <label for="State">State</label>
                                                                    <span style="color: red">{{ $errors->first('permanent_state') }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text" id="permanent_country" name="permanent_country"  value="{{ old('permanent_country') }}" class="form-control" placeholder="Country">
                                                                    <label for="State">Country</label>
                                                                    <span style="color: red">{{ $errors->first('permanent_country') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-12">
                                                            <input type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" value="Submit">
                                                            <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
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
    <script type="text/javascript">
        jQuery(document).ready(function ()
        {
            jQuery('select[name="school_id"]').on('change',function(){
                var schoolID = jQuery(this).val();
                if(schoolID)
                {

                    jQuery.ajax({
                        url : 'getclass/' +schoolID,
                        type : "GET",
                        dataType : "json",
                        success:function(data)
                        {
                            console.log(data);
                            jQuery('select[name="class_id"]').empty();
                            if(data)
                            {
                                $('select[name="class_id"]').append('<option value=""  style="text-transform: uppercase">-Select Class-</option>');
                                $.each(data,function(key,value){
                                    $('select[name="class_id"]').append($("<option/>", {
                                        value: key,
                                        text: value
                                    }));
                                });
                            }

                        }
                    });
                }
                else
                {
                    $('select[name="class_id"]').empty();
                }
            });
        });

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
@endsection
