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
                            {{--                            <h2 class="content-header-title float-left mb-0"></h2>--}}
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Edit School</a>
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
                    <div class="row match-height ">
                        <div class="col-12" style="margin: auto">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit School</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                            <div class="form-body">
                                                <div class="row">

                                                    <div class="col-md-4">
                                                        <div class="owner_photo">
                                                            <a href="{{asset('images/owner_photo/'.$school->owner_photo)}}" target="_blank">
                                                            <img id="p1" height="150px" src="{{asset('images/owner_photo/'.$school->owner_photo)}}" width="130px"  />
                                                            </a>
                                                        </div>
                                                        <br/>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="photo">
                                                            <a href="{{asset('images/school_photo/'.$school->photo)}}" target="_blank">
                                                            <img id="p2" height="150px" src="{{asset('images/school_photo/'.$school->photo)}}" width="130px"  />
                                                            </a>
                                                        </div>
                                                        <br/>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="logo">
                                                            <a href="{{asset('images/school_photo/'.$school->logo)}}" target="_blank">
                                                                <img id="p2" height="80%" src="{{asset('images/school_photo/'.$school->logo)}}" width="80%"  />
                                                            </a>
                                                        </div>
                                                        <br/>
                                                    </div>

                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" disabled value="{{$school->full_name}}" placeholder="Full Name" name="full_name">
                                                            <label for="name">Full Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" disabled value="{{$school->affliation_no}}" placeholder="Affliation No" name="affliation_no">
                                                            <label for="name">Affliation No</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" disabled placeholder="Owner Name" value="{{$school->owner_name}}" name="owner_name">
                                                            <label for="name">Owner Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" disabled placeholder="Owner Contact No" value="{{$school->owner_contact_no}}" name="owner_contact_no">
                                                            <label for="name">Owner Contact No</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" disabled placeholder="Owner Contact No"  value="{{$school->total_strength}}" name="total_strength">
                                                            <label for="name">Total Strength</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" disabled placeholder="Owner Contact No" value="@if($school->subscription_type == 0) --- @elseif($school->subscription_type == 1) 180 Days @elseif($school->subscription_type == 2) 360 Days @else 30 Days @endif" name="subscription_type">
                                                            <label for="name">Subscription Type</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" disabled placeholder="Contact Person Name" value="{{$school->contact_person}}" name="contact_person">
                                                            <label for="name">Contact Person Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" disabled placeholder="School Contact No" value="{{$school->mobile}}" name="mobile">
                                                            <label for="name">School Contact No</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <select class="form-control" name="standard" disabled>
                                                                <option {{ $school->standard == 'Pre-Primary' ? "selected" : " " }} value="Pre-Primary">Pre-Primary</option>
                                                                <option  {{ $school->standard == 'Primary' ? "selected" : " " }} value="Primary">Primary</option>
                                                                <option  {{ $school->standard == 'Secondary' ? "selected" : " " }} value="Secondary">Secondary</option>
                                                                <option {{ $school->standard == 'Higher-Secondary' ? "selected" : " " }} value="Higher-Secondary">Higher-Secondary</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <select class="form-control" name="standard" disabled>
                                                                <option {{ $school->board == 'ICSE' ? "selected" : " " }} value="ICSE">ICSE</option>
                                                                <option  {{ $school->board == 'CBSE' ? "selected" : " " }} value="CBSE">CBSE</option>
                                                                <option  {{ $school->board == 'HSE' ? "selected" : " " }} value="HSE">HSE</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" disabled placeholder="Classes" value="{{$school->classes}}" name="classes">
                                                            <label for="name">Classes</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="email" class="form-control" disabled placeholder=" Office Email" value="{{$school->email}}" name="email">
                                                            <label for="name">Office Email</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="date" class="form-control" disabled placeholder="Year of starting" value="{{$school->starting_year}}" name="starting_year">
                                                            <label for="name">Year of starting</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <select class="form-control" name="facility" disabled>
                                                                <option {{ $school->facility == 'Boarding' ? "selected" : " " }} value="Boarding">Boarding</option>
                                                                <option {{ $school->facility == 'Day-Cum-Boarding' ? "selected" : " " }} value="Day-Cum-Boarding">Day-Cum-Boarding</option>
                                                                <option {{ $school->facility == 'No-Boarding' ? "selected" : " " }} value="No-Boarding">No-Boarding</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <textarea name="address" disabled class="form-control">{{$school->address}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 pt-2">
                                                        <a href="{{url('\schools')}}"> <button class="btn btn-primary mr-1 mb-1">Back</button></a>
                                                    </div>
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
