@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/plugins/forms/wizard.min.css') }}">
    <script src="{{ asset('admin_assets/js/scripts/forms/wizard-steps.min.js') }}"></script>
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
            <div class="content-body"><!-- Basic Horizontal form layout section start -->

                <!-- // Basic multiple Column Form section start -->
                <section id="number-tabs">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Form wizard with number tabs</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <p>Create neat and clean form wizard using <code>.wizard-circle</code> class.</p>
                                        <form action="#" class="number-tab-steps wizard-circle">

                                            <!-- Step 1 -->
                                            <h6>Step 1</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="firstName1">First Name </label>
                                                            <input type="text" class="form-control" id="firstName1">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="lastName1">Last Name</label>
                                                            <input type="text" class="form-control" id="lastName1">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="emailAddress1">Email</label>
                                                            <input type="email" class="form-control" id="emailAddress1">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="location1">City</label>
                                                            <select class="custom-select form-control" id="location1" name="location">
                                                                <option value="new-york">New York</option>
                                                                <option value="chicago">Chicago</option>
                                                                <option value="san-francisco">San Francisco</option>
                                                                <option value="boston">Boston</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <!-- Step 2 -->
                                            <h6>Step 2</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="proposalTitle1">Proposal Title</label>
                                                            <input type="text" class="form-control" id="proposalTitle1">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jobtitle">Job Title</label>
                                                            <input type="text" class="form-control" id="jobtitle">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="shortDescription1">Short Description :</label>
                                                            <textarea name="shortDescription" id="shortDescription1" rows="5" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <!-- Step 3 -->
                                            <h6>Step 3</h6>
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="eventName1">Event Name :</label>
                                                            <input type="text" class="form-control" id="eventName1">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="eventType1">Event Status :</label>
                                                            <select class="custom-select form-control" id="eventType1"
                                                                    data-placeholder="Type to search cities" name="eventType1">
                                                                <option value="Banquet">Planning</option>
                                                                <option value="Fund Raiser">In Process</option>
                                                                <option value="Dinner Party">Finished</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="eventLocation1">Event Location :</label>
                                                            <select class="custom-select form-control" id="eventLocation1" name="location">
                                                                <option value="new-york">New York</option>
                                                                <option value="chicago">Chicago</option>
                                                                <option value="san-francisco">San Francisco</option>
                                                                <option value="boston">Boston</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group d-flex align-items-center pt-md-2">
                                                            <label class="mr-2">Requirements :</label>
                                                            <div class="c-inputs-stacked">
                                                                <div class="d-inline-block mr-2">
                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                        <input type="checkbox" value="false">
                                                                        <span class="vs-checkbox">
                              <span class="vs-checkbox--check">
                                <i class="vs-icon feather icon-check"></i>
                              </span>
                            </span>
                                                                        <span class="">Staffing</span>
                                                                    </div>
                                                                </div>
                                                                <div class="d-inline-block">
                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                        <input type="checkbox" value="false">
                                                                        <span class="vs-checkbox">
                              <span class="vs-checkbox--check">
                                <i class="vs-icon feather icon-check"></i>
                              </span>
                            </span>
                                                                        <span class="">Catering</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <form class="form" method="POST" action="{{route('new_admission.store')}}">
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
{{--                                                    <div class="col-md-4">--}}
{{--                                                        <div class="family_photo">--}}
{{--                                                            <img id="p2" height="150px" width="130px"  />--}}
{{--                                                        </div>--}}
{{--                                                        <br/>--}}
{{--                                                        Family photo :<input type="file" name='family_photo'  id="family_photo" onchange="pic2(this);"/><p><br/></p>--}}
{{--                                                    </div>--}}
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

@endsection
@push('scripts')
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
    </script>

    <script src="{{ asset('admin_assets/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
@endpush
