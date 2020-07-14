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
                        <form class="form" method="POST" action="{{route('pre_admissions.store')}}">
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
                                                       Student photo :<input type="file" name='student_photo'  id="student_photo" onchange="pic(this);"/><p><br/></p>
                                                   </div>
                                                   <div class="col-md-4">
                                                       <div class="family_photo">
                                                           <img id="p2" height="150px" width="130px"  />
                                                       </div>
                                                       <br/>
                                                       Family photo :<input type="file" name='family_photo'  id="family_photo" onchange="pic2(this);"/><p><br/></p>
                                                   </div>
                                                </div>


                                                <div class="row">
                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <div class="col-md-6 col-12">
                                                            <select name="school_id" class="form-control">
                                                                <option>-SELECT School-</option>

                                                                @foreach($schools as $school)
                                                                    <option value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    @endif
                                                    <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <select onchange="getExam(this.value)" name="class_id" id="class_id" class="form-control">
                                                                </select>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <label>First Name</label>
                                                            <input type="text" id="first-name-column" class="form-control" placeholder="First Name" name="first_name">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="last-name-column" class="form-control" placeholder="Last Name" name="last_name">
                                                            <label for="last-name-column">Last Name</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="date"  class="form-control"  name="dob">
                                                            <label for="DOB">DOB</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <select name="gender" class="form-control">
                                                                <option disabled value="">-Select Gender-</option>
                                                                <option value="1">MALE</option>
                                                                <option value="2">FEMALE</option>
                                                            </select>

                                                            <label for="country-floating">Gender</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <select name="pre_exam_id" id="pre_exam_id" class="form-control">
                                                                <option>-SELECT EXAM-</option>
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

                                                    {{--                                                    <div class="col-md-6 col-12">--}}
                                                    {{--                                                        <div class="form-label-group">--}}
                                                    {{--                                                            <select class="form-control">--}}
                                                    {{--                                                                <option>-Student Type-</option>--}}
                                                    {{--                                                                <option>Anwesha</option>--}}
                                                    {{--                                                                <option>General</option>--}}
                                                    {{--                                                            </select>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                    </div>--}}
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
                                                                <input type="text"  class="form-control" placeholder="Mother's First Name" name="mother_first_name">
                                                                <label for="first-name-column">Mother's First Name</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" id="last-name-column" class="form-control" placeholder="Mother's Last Name" name="mother_last_name">
                                                                <label for="last-name-column">Mother's Last Name</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text"  class="form-control" placeholder="Mother's Mobile"  name="mother_mobile">
                                                                <label for="Mother's Mobile">Mother's Mobile Number</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text"  class="form-control" placeholder="Mother Email Id"  name="mother_email">
                                                                <label for="Email Id">Mother Email Id</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Father's First Name" name="father_first_name">
                                                                <label for="first-name-column">Father's First Name</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" id="last-name-column" class="form-control" placeholder="Father's Last Name" name="father_last_name">
                                                                <label for="last-name-column">Father's Last Name</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text"  class="form-control" placeholder="Father's Mobile"  name="father_mobile">
                                                                <label for="Mother's Mobile">Father's Mobile Number</label>
                                                            </div>
                                                        </div>



                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text"  class="form-control" placeholder="Father Email Id"  name="father_email">
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
                                                                    <textarea name="address" class="form-control"></textarea>
                                                                    <label for="first-name-column">Residence Address</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text"  class="form-control" placeholder="City" name="city">
                                                                    <label for="Post">City</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text"  class="form-control" placeholder="District" name="district">
                                                                    <label for="Dist">District</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text"  class="form-control" placeholder="Zip Code" name="zip">
                                                                    <label for="Zip Code">Zip Code</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text"  class="form-control" placeholder="State" name="state">
                                                                    <label for="State">State</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="text"  class="form-control" placeholder="Country" name="country">
                                                                    <label for="State">Country</label>
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
                                $('select[name="class_id"]').append('<option value="">-Select-</option>');
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
                url: "/get_exam",
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
