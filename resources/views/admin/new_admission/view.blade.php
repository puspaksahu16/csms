@extends('admin.layouts.master')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
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
                                            <img src="../../../app-assets/images/portrait/small/avatar-s-12.jpg"
                                                 class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" alt="avatar">
                                        </div>
                                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                                            <table>
                                                <tr>
                                                    <td class="font-weight-bold">Student ID</td>
                                                    <td>{{$students->student_unique_id}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Student Name</td>
                                                    <td>{{$students->first_name}} {{$students->last_name}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Class</td>
                                                    <td>{{ $students->classes->create_class }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">DOB</td>
                                                    <td>{{ $students->dob }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Gender</td>
                                                    <td>
                                                        @if($students->gender_id == 1)
                                                            Male
                                                            @else
                                                            Female
                                                            @endif
                                                        </td>

                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-5">
                                            <table class="ml-0 ml-sm-0 ml-lg-0">
                                                <tr>
                                                    <td class="font-weight-bold">Id proof</td>
                                                    <td>{{ $students->idproof->id_proof }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Id Proof No</td>
                                                    <td>{{$students->id_proof_no}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">TC No</td>
                                                    <td>{{$students->tc_no}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Caste</td>
                                                    <td>
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
                                <div class="card-header">
                                    <div class="card-title mb-2">Mother's Details</div>
                                </div>
                                <div class="card-body">
                                    <table>
                                        <tr>
                                            <td class="font-weight-bold">Name </td>
                                            <td>{{$studentparents->mother_first_name}} {{$studentparents->mother_last_name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Mobile no</td>
                                            <td>{{$studentparents->mother_mobile}}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Email</td>
                                            <td>{{$studentparents->mother_email}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Occupation</td>
                                            <td>{{$studentparents->mother_occupation}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Salary</td>
                                            <td>{{$studentparents->mother_salary}}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Qualification</td>
                                            <td>{{$studentparents->mqualification->qualification}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Adhar</td>
                                            <td>{{$studentparents->midproof->id_proof}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Id card no</td>
                                            <td>{{$studentparents->mother_id_no}}
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
                                    <div class="card-title mb-2">Father's Details</div>
                                </div>
                                <div class="card-body">
                                    <table>
                                        <tr>
                                            <td class="font-weight-bold">Name </td>
                                            <td>{{$studentparents->father_first_name}} {{$studentparents->father_last_name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Mobile no</td>
                                            <td>{{$studentparents->father_mobile}}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Email</td>
                                            <td>{{$studentparents->father_email}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Occupation</td>
                                            <td>{{$studentparents->father_occupation}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Salary</td>
                                            <td>{{$studentparents->father_salary}}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Qualification</td>
                                            <td>{{$studentparents->fqualification->qualification}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Adhar</td>
                                            <td>{{$studentparents->fidproof->id_proof}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Id card no</td>
                                            <td>{{$studentparents->father_id_no}}
                                            </td>
                                        </tr>
                                    </table>
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
                                                    <td>{{$r_address->address}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">City</td>
                                                    <td>{{$r_address->city}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">District</td>
                                                    <td>{{$r_address->district}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Zip Code</td>
                                                    <td>{{$r_address->zip}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">State</td>
                                                    <td>
                                                        {{$r_address->state}}
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Country</td>
                                                    <td>{{$r_address->country}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-6">

                                                @if($r_address->is_same == 1)
                                                    Same As Resident Address
                                                @else
                                                <table class="ml-0 ml-sm-0 ml-lg-0">
                                                    <tr>
                                                        <td class="font-weight-bold">Premanent</td>
                                                        <td>{{$p_address->address}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">City</td>
                                                        <td>{{$p_address->city}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">District</td>
                                                        <td>{{$p_address->district}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Zip Code</td>
                                                        <td>{{$p_address->zip}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">State</td>
                                                        <td>
                                                            {{$p_address->state}}
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">Country</td>
                                                        <td>{{$p_address->country}}</td>
                                                    </tr>
                                            </table>
                                                    @endif

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

