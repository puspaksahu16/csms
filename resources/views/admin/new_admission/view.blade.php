@extends('admin.layouts.master')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div  class="col-md-11" align="right">
                    <a href="{{route('new_admission.edit', $students->id)}}" class="btn btn-sm btn-warning">Edit</a>
                    <a href="{{route('new_admission.index')}}" class="btn btn-sm btn-primary">Back</a>
                </div>
            </div>
            <br/>
            <div class="content-body"><!-- page users view start -->
                <section class="page-users-view">
                    <div class="row">
                        <!-- account start -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Student Details</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="users-view-image">
                                            <img src="{{asset('images/student_photo/'.$students->photo)}}"
                                                 class="users-avatar-shadow w-50 rounded mb-2 pr-2 ml-1" alt="Student">
                                        </div>
                                        <div class="col-12 col-sm-9 col-md-5 col-lg-4">
                                            <table>
                                                <tr>
                                                    <td class="font-weight-bold">Student ID</td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$students->student_unique_id}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Reference No</td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$students->ref_no}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Student Name</td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$students->first_name}} {{$students->last_name}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Class</td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $students->classes->create_class }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">DOB</td>
                                                    <td>&nbsp;         {{  date("d-m-Y",strtotime($students->dob))  }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Gender</td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;
                                                        @if($students->gender_id == 1)
                                                            Male
                                                            @else
                                                            Female
                                                            @endif
                                                        </td>

                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Id proof</td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $students->idproof->id_proof }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Id Proof No</td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$students->id_proof_no}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">TC No</td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$students->tc_no}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Caste</td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;
                                                        @if($students->caste  == 1)
                                                            GEN
                                                        @elseif($students->caste  == 2)
                                                            OBC
                                                        @elseif($students->caste  == 3)
                                                            SC
                                                        @else
                                                            ST
                                                        @endif
                                                    </td>
                                                </tr>

                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- account end -->
                        <!-- information start -->
                        <div class="col-md-6 col-12 ">
                            <div class="card">

                                <div class="card-body">
                                    <div class="card-header">
                                        <div class="card-title mb-2">Mother's Details</div>
                                    </div>
                                    <table>
                                        <tr>
                                            <td class="font-weight-bold">Name </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$studentparents->mother_first_name}} {{$studentparents->mother_last_name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Mobile no</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$studentparents->mother_mobile}}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Email</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$studentparents->mother_email}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Occupation</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$studentparents->mother_occupation}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Salary</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$studentparents->mother_salary}}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Qualification</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$studentparents->mqualification->qualification}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Adhar</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$studentparents->midproof->id_proof}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Id card no</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$studentparents->mother_id_no}}
                                            </td>
                                        </tr>


                                    </table>
                                    <div class="card-header">
                                        <div class="card-title mb-2">Father's Details</div>
                                    </div>
                                    <table>
                                        <tr>
                                            <td class="font-weight-bold">Name </td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$studentparents->father_first_name}} {{$studentparents->father_last_name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Mobile no</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$studentparents->father_mobile}}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Email</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$studentparents->father_email}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Occupation</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$studentparents->father_occupation}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Salary</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$studentparents->father_salary}}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Qualification</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$studentparents->fqualification->qualification}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Adhar</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$studentparents->fidproof->id_proof}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Id card no</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$studentparents->father_id_no}}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- information start -->
                        <!-- social links end -->
                        <div class="col-md-6 col-12 ">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title mb-2">Family Photo</div>
                                </div>
                                <div class="card-body">
                                    <div class="users-view-image">
                                        <img src="{{asset('images/family_photo/'.$students->family_photo)}}"
                                             class="users-avatar-shadow w-50 rounded mb-2 pr-2 ml-1" alt="Student">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- social links end -->
                        <!-- account start -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Address</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-12 col-sm-9 col-md-6 col-lg-6">
                                            <table>
                                                <tr>
                                                    <td class="font-weight-bold">Resident</td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$address->address}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">City</td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$address->city}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">District</td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$address->district}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Zip Code</td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$address->zip}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">State</td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;
                                                        {{$address->state}}
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Country</td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$address->country}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-6">


                                                <table class="ml-0 ml-sm-0 ml-lg-0">
                                                    <tr>
                                                        <td class="font-weight-bold">Permanent</td>
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$address->permanent_address}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">City</td>
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$address->permanent_city}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">District</td>
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$address->permanent_district}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Zip Code</td>
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$address->permanent_zip}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">State</td>
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;
                                                            {{$address->permanent_state}}
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Country</td>
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$address->permanent_country}}</td>
                                                    </tr>
                                                </table>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- page users view end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->


@endsection

