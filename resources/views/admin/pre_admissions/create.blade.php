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
                                                <div class="profilephoto1">
                                                    <img id="blahid" height="150px" width="130px"  />
                                                </div>
                                                <br/>
                                                scan photo:* <input type="file" name='photo'  id="profilephoto1" onchange="readURL1(this);"/><p><br/></p>
                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="first-name-column" class="form-control" placeholder="First Name" name="first_name">
                                                            <label for="first-name-column">First Name</label>
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
                                                            <select name="class_id" class="form-control">
                                                                <option disabled value="">-Select Class-</option>
                                                                <option value="1">Class 1</option>
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

{{--                                <div class="col-12">--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="card-header">--}}
{{--                                            <h4 class="card-title">Mother's Details</h4>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-content">--}}
{{--                                            <div class="card-body">--}}
{{--                                                <form class="form">--}}
{{--                                                    <div class="form-body">--}}

{{--                                                        <div class="row">--}}
{{--                                                            <div class="col-md-6 col-12">--}}
{{--                                                                <div class="form-label-group">--}}
{{--                                                                    <input type="text" id="first-name-column" class="form-control" placeholder="Mother's First Name" name="fname-column">--}}
{{--                                                                    <label for="first-name-column">Mother's First Name</label>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-md-6 col-12">--}}
{{--                                                                <div class="form-label-group">--}}
{{--                                                                    <input type="text" id="last-name-column" class="form-control" placeholder="Mother's Last Name" name="lname-column">--}}
{{--                                                                    <label for="last-name-column">Mother's Last Name</label>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-md-6 col-12">--}}
{{--                                                                <div class="form-label-group">--}}
{{--                                                                    <input type="text"  class="form-control" placeholder="Mother's Qualification"  name="">--}}
{{--                                                                    <label for="Qualification">Qualification</label>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-md-6 col-12">--}}
{{--                                                                <div class="form-label-group">--}}
{{--                                                                    <input type="text"  class="form-control" placeholder="Mother's Occupation"  name="">--}}
{{--                                                                    <label for="Occupation">Occupation</label>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-md-6 col-12">--}}
{{--                                                                <div class="form-label-group">--}}
{{--                                                                    <input type="text"  class="form-control" placeholder="Mother's Mobile"  name="">--}}
{{--                                                                    <label for="Mother's Mobile">Mother's Mobile Number</label>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-md-6 col-12">--}}
{{--                                                                <div class="form-label-group">--}}
{{--                                                                    <select  class="form-control">--}}
{{--                                                                        <option>-Select Salary-</option>--}}
{{--                                                                        <option> > 1 Lakh</option>--}}
{{--                                                                        <option> < 1 Lakh</option>--}}
{{--                                                                    </select>--}}
{{--                                                                    <label for="Mother's Mobile">Mother's Anual Salary</label>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}

{{--                                                            <div class="col-md-6 col-12">--}}
{{--                                                                <div class="form-label-group">--}}
{{--                                                                    <select class="form-control">--}}
{{--                                                                        <option>-Id Proof-</option>--}}
{{--                                                                        <option>Adhar</option>--}}
{{--                                                                        <option>Pan Card</option>--}}
{{--                                                                        <option>Vote Card</option>--}}
{{--                                                                        <option>Passport</option>--}}
{{--                                                                    </select>--}}

{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-md-6 col-12">--}}
{{--                                                                <div class="form-label-group">--}}
{{--                                                                    <input type="text"  class="form-control" placeholder="Id Number"  name="">--}}
{{--                                                                    <label for="Id Number">Id Number</label>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}

{{--                                                            <div class="col-md-6 col-12">--}}
{{--                                                                <div class="form-label-group">--}}
{{--                                                                    <input type="text"  class="form-control" placeholder="Email Id"  name="">--}}
{{--                                                                    <label for="Email Id">Email Id</label>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}



{{--                                                    </div>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="col-12">--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="card-header">--}}
{{--                                            <h4 class="card-title">Father's Details</h4>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-content">--}}
{{--                                            <div class="card-body">--}}

{{--                                                <div class="form-body">--}}

{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-md-6 col-12">--}}
{{--                                                            <div class="form-label-group">--}}
{{--                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Father's First Name" name="fname-column">--}}
{{--                                                                <label for="first-name-column">Father's First Name</label>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-md-6 col-12">--}}
{{--                                                            <div class="form-label-group">--}}
{{--                                                                <input type="text" id="last-name-column" class="form-control" placeholder="Father's Last Name" name="lname-column">--}}
{{--                                                                <label for="last-name-column">Father's Last Name</label>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-md-6 col-12">--}}
{{--                                                            <div class="form-label-group">--}}
{{--                                                                <input type="text"  class="form-control" placeholder="Father's Qualification"  name="">--}}
{{--                                                                <label for="Qualification">Qualification</label>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-md-6 col-12">--}}
{{--                                                            <div class="form-label-group">--}}
{{--                                                                <input type="text"  class="form-control" placeholder="Father's Occupation"  name="">--}}
{{--                                                                <label for="Occupation">Occupation</label>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-md-6 col-12">--}}
{{--                                                            <div class="form-label-group">--}}
{{--                                                                <input type="text"  class="form-control" placeholder="Father's Mobile"  name="">--}}
{{--                                                                <label for="Mother's Mobile">Father's Mobile Number</label>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-md-6 col-12">--}}
{{--                                                            <div class="form-label-group">--}}
{{--                                                                <select  class="form-control">--}}
{{--                                                                    <option>-Select Salary-</option>--}}
{{--                                                                    <option> > 1 Lakh</option>--}}
{{--                                                                    <option> < 1 Lakh</option>--}}
{{--                                                                </select>--}}
{{--                                                                <label for="Mother's Mobile">Father's Anual Salary</label>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}

{{--                                                        <div class="col-md-6 col-12">--}}
{{--                                                            <div class="form-label-group">--}}
{{--                                                                <select class="form-control">--}}
{{--                                                                    <option>-Id Proof-</option>--}}
{{--                                                                    <option>Adhar</option>--}}
{{--                                                                    <option>Pan Card</option>--}}
{{--                                                                    <option>Vote Card</option>--}}
{{--                                                                    <option>Passport</option>--}}
{{--                                                                </select>--}}

{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-md-6 col-12">--}}
{{--                                                            <div class="form-label-group">--}}
{{--                                                                <input type="text"  class="form-control" placeholder="Id Number"  name="">--}}
{{--                                                                <label for="Id Number">Id Number</label>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="col-md-6 col-12">--}}
{{--                                                            <div class="form-label-group">--}}
{{--                                                                <input type="text"  class="form-control" placeholder="Email Id"  name="">--}}
{{--                                                                <label for="Email Id">Email Id</label>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}

{{--                                                    </div>--}}


{{--                                                </div>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title"></h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form class="form">
                                                    <div class="form-body">

{{--                                                        <div class="row">--}}
{{--                                                            <div class="col-md-6 col-12">--}}
{{--                                                                <div class="form-label-group">--}}
{{--                                                                    <textarea class="form-control"></textarea>--}}
{{--                                                                    <label for="first-name-column">Resedence Address</label>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-md-6 col-12">--}}
{{--                                                                <div class="form-label-group">--}}
{{--                                                                    <input type="text" id="Post" class="form-control" placeholder="Post" name="lname-column">--}}
{{--                                                                    <label for="Post">Post</label>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-md-6 col-12">--}}
{{--                                                                <div class="form-label-group">--}}
{{--                                                                    <input type="text" id="Dist" class="form-control" placeholder="Dist" name="Dist">--}}
{{--                                                                    <label for="Dist">Dist</label>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-md-6 col-12">--}}
{{--                                                                <div class="form-label-group">--}}
{{--                                                                    <input type="text" id="Zip Code" class="form-control" placeholder="Zip Code" name="Zip Code">--}}
{{--                                                                    <label for="Zip Code">Zip Code</label>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-md-6 col-12">--}}
{{--                                                                <div class="form-label-group">--}}
{{--                                                                    <input type="text" id="State" class="form-control" placeholder="State" name="State">--}}
{{--                                                                    <label for="State">State</label>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}


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
        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blahid')
                        .attr('src', e.target.result)
                        .width(130)
                        .height(150);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
