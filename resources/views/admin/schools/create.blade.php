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
                                    <li class="breadcrumb-item"><a href="#">Create School</a>
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
                                    <h4 class="card-title">Create School</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{route('schools.store')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">

                                                    <div class="col-md-4">
                                                        <div class="owner_photo">
                                                            <img id="p1" height="150px"  width="130px"  />
                                                        </div>
                                                        <br/>
                                                        Owner photo :<input type="file" name='owner_photo' id="owner_photo" onchange="pic(this);"/><p><br/></p>
                                                        <span style="color: red">{{ $errors->first('owner_photo') }}</span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="photo">
                                                            <img id="p2" height="150px" width="130px" />
                                                        </div>
                                                        <br/>
                                                        School photo :<input type="file" name='photo'  id="photo" onchange="pic2(this);"/><p><br/></p>
                                                        <span style="color: red">{{ $errors->first('photo') }}</span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="logo">
                                                            <img id="p3" height="150px" width="130px" />
                                                        </div>
                                                        <br/>
                                                        School logo :<input type="file" name='logo'  id="logo" onchange="pic3(this);"/><p><br/></p>
                                                        <span style="color: red">{{ $errors->first('logo') }}</span>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" value="{{ old('full_name') }}" class="form-control" placeholder="Full Name" name="full_name">
                                                            <label for="name">Full Name</label>
                                                            <span style="color: red">{{ $errors->first('full_name') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text"  value="{{ old('affliation_no') }}" class="form-control" placeholder="Affliation No" name="affliation_no">
                                                            <label for="name">Affliation No</label>
                                                            <span style="color: red">{{ $errors->first('affliation_no') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text"  value="{{ old('owner_name') }}" class="form-control" placeholder="Owner Name" name="owner_name">
                                                            <label for="name">Owner Name</label>
                                                            <span style="color: red">{{ $errors->first('owner_name') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" value="{{ old('owner_contact_no') }}" class="form-control" placeholder="Owner Contact No" name="owner_contact_no">
                                                            <label for="name">Owner Contact No</label>
                                                            <span style="color: red">{{ $errors->first('owner_contact_no') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" value="{{ old('contact_person') }}" class="form-control" placeholder="Contact Person Name" name="contact_person">
                                                            <label for="name">Contact Person Name</label>
                                                            <span style="color: red">{{ $errors->first('contact_person') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" value="{{ old('mobile') }}" class="form-control" placeholder="School Contact No" name="mobile">
                                                            <label for="name">School Contact No</label>
                                                            <span style="color: red">{{ $errors->first('mobile') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <select class="form-control" name="standard">
                                                                <option>SELECT STANDARD</option>
                                                                <option {{ (old('standard') == "Pre-Primary" ? "selected" : '') }} value="Pre-Primary">Pre-Primary</option>
                                                                <option {{ (old('standard') == "Primary" ? "selected" : '') }} value="Primary">Primary</option>
                                                                <option {{ (old('standard') == "Secondary" ? "selected" : '') }} value="Secondary">Secondary</option>
                                                                <option {{ (old('standard') == "Higher-Secondary" ? "selected" : '') }} value="Higher-Secondary">Higher-Secondary</option>
                                                            </select>
                                                            <span style="color: red">{{ $errors->first('standard') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <select class="form-control" value="{{ old('board') }}" name="board">
                                                                <option>SELECT BOARD</option>
                                                                <option {{ (old('board') == "CBSE" ? "selected" : '') }} value="CBSE">CBSE</option>
                                                                <option {{ (old('board') == "ICSE" ? "selected" : '') }} value="CBSE">ICSE</option>
                                                                <option {{ (old('board') == "ISE" ? "selected" : '') }} value="HSE">ISE</option>

                                                                <option {{ (old('board') == "ICSE + ISE" ? "selected" : '') }} value="ICSE + ISE">ICSE + ISE</option>
                                                                <option {{ (old('board') == "NCERT" ? "selected" : '') }} value="NCERT">NCERT</option>
                                                            </select>
                                                            <span style="color: red">{{ $errors->first('board') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" value="{{ old('classes') }}" placeholder="Classes" name="classes">
                                                            <label for="name">Classes</label>
                                                            <span style="color: red">{{ $errors->first('classes') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="email" class="form-control" value="{{ old('email') }}" placeholder=" Office Email" name="email">
                                                            <label for="name">Office Email</label>
                                                            <span style="color: red">{{ $errors->first('email') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="date" value="{{ old('starting_year') }}" class="form-control" placeholder="Year of starting" name="starting_year">
                                                            <label for="name">Year of starting</label>
                                                            <span style="color: red">{{ $errors->first('starting_year') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <select class="form-control" name="facility">
                                                                <option>-SELECT FACILITY-</option>
                                                                <option {{ (old('facility') == "Boarding" ? "selected" : '') }} value="Boarding">Boarding</option>
                                                                <option {{ (old('facility') == "Day-Cum-Boarding" ? "selected" : '') }}  value="Day-Cum-Boarding">Day-Cum-Boarding</option>
                                                                <option {{ (old('facility') == "No-Boarding" ? "selected" : '') }} value="No-Boarding">No-Boarding</option>
                                                            </select>
                                                            <span style="color: red">{{ $errors->first('facility') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-6">
                                                        <div class="form-label-group">
                                                    <textarea name="address"  class="form-control" placeholder="Address">{{ old('address') }}</textarea>
                                                            <span style="color: red">{{ $errors->first('address') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 pt-2">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
        function pic3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#p3')
                        .attr('src', e.target.result)
                        .width(130)
                        .height(150);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

