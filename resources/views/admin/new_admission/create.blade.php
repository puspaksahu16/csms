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
            <div class="content-body"><!-- Basic Horizontal form layout section start -->

                <!-- // Basic multiple Column Form section start -->
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
                                                                    <p>Step 1</p>
                                                                </div>
                                                                <div class="stepwizard-step">
                                                                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                                                    <p>Step 2</p>
                                                                </div>
                                                                <div class="stepwizard-step">
                                                                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                                                    <p>Step 3</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form class="form" method="POST" action="{{route('new_admission.store')}}">
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
                                                                                <select name="id_proof" class="form-control">
                                                                                    <option>-choose id proof-</option>

                                                                                    @foreach($id_proof as $id_proofs)
                                                                                        <option value="{{ $id_proofs->id }}">{{ $id_proofs->id_proof }}</option>
                                                                                    @endforeach

                                                                                </select>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text" id="id-number-column" class="form-control" placeholder="Id Number" name="id_number">
                                                                                <label for="last-name-column">Id Number</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <select class="form-control" onchange="yesnoCheck(this);">
                                                                                    <option>- select tc-</option>
                                                                                    <option value="yes">Yes</option>
                                                                                    <option value="no">No</option>
                                                                                </select>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12" id="ifYes"  style="display: none;">
                                                                            <div class="form-label-group">
                                                                                <input type="text" id="id-number-column" class="form-control" placeholder="Tc Number" name="tc_number">
                                                                                <label for="last-name-column">Tc Number</label>
                                                                            </div>
                                                                        </div>

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
                                                                    <h4 class="card-title">Parent's Details</h4>
                                                                </div>
                                                                <div class="col-xs-12">

                                                                    <div class="col-md-12">
                                                                        <br/><br/>
                                                                        <div class="row">

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    <input type="text"  class="form-control" placeholder="Mother's First Name" name="mother_first_name">
                                                                                    <label for="first-name-column">Mother's First Name</label>
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
                                                                                    <input type="text" id="last-name-column" class="form-control" placeholder="Mother's Last Name" name="mother_last_name">
                                                                                    <label for="last-name-column">Mother's Last Name</label>
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
                                                                                    <input type="text"  class="form-control" placeholder="Mother's Mobile"  name="mother_mobile">
                                                                                    <label for="Mother's Mobile">Mother's Mobile Number</label>
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
                                                                                    <input type="text"  class="form-control" placeholder="Mother Email Id"  name="mother_email">
                                                                                    <label for="Email Id">Mother Email Id</label>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    <input type="text"  class="form-control" placeholder="Father Email Id"  name="father_email">
                                                                                    <label for="Email Id">Father Email Id</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    <input type="text"  class="form-control" placeholder="Mother Occupation"  name="mother_occupation">
                                                                                    <label for="Occupation">Mother's Occupation</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    <input type="text"  class="form-control" placeholder="Father Occupation"  name="father_occupation">
                                                                                    <label for="Occupation">Father's Occupation</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    <input type="text"  class="form-control" placeholder="Mother Income"  name="mother_income">
                                                                                    <label for="Income">Mother's Income</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    <input type="text"  class="form-control" placeholder="Father Income"  name="father_income">
                                                                                    <label for="Income">Father's Income</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row setup-content" id="step-3">
                                                                <div class="card-header">
                                                                    <h4 class="card-title">Permanent Address</h4>
                                                                </div>
                                                                <div class="col-xs-12">
                                                                    <div class="col-md-12">
                                                                        <br/><br/>
                                                                        <div class="row">
                                                                            <div class="col-md-6 col-12">
                                                                                <div class="form-label-group">
                                                                                    <textarea name="address" class="form-control"></textarea>
                                                                                    <label for="first-name-column">Permanent Address</label>
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
                                                                        <input type="checkbox" value=""><label>Same as Permanent</label>
                                                                        <div class="card-header">
                                                                            <h4 class="card-title">Residence Address</h4>
                                                                        </div>
                                                                        <br/><br/><br/>
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
