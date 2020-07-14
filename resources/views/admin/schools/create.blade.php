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
                                        <form class="form" action="{{route('schools.store')}}" method="POST">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">

                                                        <div class="col-md-4">
                                                            <div class="owner_photo">
                                                                <img id="p1" height="150px" width="130px"  />
                                                            </div>
                                                            <br/>
                                                            Owner photo :<input type="file" name='owner_photo'  id="owner_photo" onchange="pic(this);"/><p><br/></p>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="photo">
                                                                <img id="p2" height="150px" width="130px"  />
                                                            </div>
                                                            <br/>
                                                            School photo :<input type="file" name='photo'  id="photo" onchange="pic2(this);"/><p><br/></p>
                                                        </div>

                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" placeholder="Full Name" name="full_name">
                                                            <label for="name">Full Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" placeholder="Affliation No" name="affliation_no">
                                                            <label for="name">Affliation No</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" placeholder="Owner Name" name="owner_name">
                                                            <label for="name">Owner Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" placeholder="Owner Contact No" name="owner_contact_no">
                                                            <label for="name">Owner Contact No</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" placeholder="Contact Person Name" name="contact_person">
                                                            <label for="name">Contact Person Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" placeholder="School Contact No" name="mobile">
                                                            <label for="name">School Contact No</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <select class="form-control" name="standard">
                                                                <option value="Pre-Primary">Pre-Primary</option>
                                                                <option value="Primary">Primary</option>
                                                                <option value="Secondary">Secondary</option>
                                                                <option value="Higher-Secondary">Higher-Secondary</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" placeholder="Standard Upto" name="standard_upto">
                                                            <label for="name">Standard Upto</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" placeholder="Classes" name="classes">
                                                            <label for="name">Classes</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="email" class="form-control" placeholder=" Office Email" name="email">
                                                            <label for="name">Office Email</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <input type="date" class="form-control" placeholder="Year of starting" name="starting_year">
                                                            <label for="name">Year of starting</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6">
                                                        <div class="form-label-group">
                                                            <select class="form-control" name="facility">
                                                                <option value="Boarding">Boarding</option>
                                                                <option value="Day-Cum-Boarding">Day-Cum-Boarding</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-6">
                                                        <div class="form-label-group">
                                                    <textarea name="address" class="form-control" placeholder="Address"></textarea>
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
@push('script')
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
@endpush
