@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/plugins/forms/wizard.min.css') }}">
    <script src="{{ asset('admin_assets/js/scripts/forms/wizard-steps.min.js') }}"></script>
    <style>
        .btn{
            color: #fffdfd;
            background-color: #7b7b7d;
            border: 2px solid #7367f0;
        }
    </style>
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
                            <h2 class="content-header-title float-left mb-0">Edit Profile</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Edit Profile</a>
                                    </li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body"><!-- Basic Horizontal form layout section start -->

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
                                                    <form class="form" method="POST" action="{{url('parents_update', $parents->user_id)}}">
                                                        @csrf
                                                        @method('patch')
                                                            <div class="card-header">
                                                                <h4 class="card-title">Mother's Details</h4>
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <div class="col-md-12">
                                                                    <br/><br/>
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text"  class="form-control" placeholder="Mother's First Name" name="mother_first_name" value="{{$parents->mother_first_name}}">
                                                                                <label for="first-name-column">Mother's First Name</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text" id="last-name-column" class="form-control" placeholder="Mother's Last Name" name="mother_last_name" value="{{$parents->mother_last_name}}">
                                                                                <label for="last-name-column">Mother's Last Name</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text"  class="form-control" placeholder="Mother's Mobile"  name="mother_mobile" value="{{$parents->mother_mobile}}">
                                                                                <label for="Mother's Mobile">Mother's Mobile Number</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text"  class="form-control" placeholder="Mother Email Id"  name="mother_email" value="{{$parents->mother_email}}">
                                                                                <label for="Email Id">Mother Email Id</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text"  class="form-control" placeholder="Mother Occupation"  name="mother_occupation" value="{{$parents->mother_occupation}}">
                                                                                <label for="Occupation">Mother's Occupation</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text"  class="form-control" placeholder="Mother Salary"  name="mother_salary" value="{{$parents->mother_salary}}">
                                                                                <label for="Income">Mother's Salary</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <select name="mother_qualification" class="form-control">
                                                                                    <option value="">-choose Mother's Qualification-</option>
                                                                                    @foreach($qualifications as $qualification)
                                                                                        <option {{ $qualification->id == $parents->mother_qualification ? "selected" : " " }} value="{{ $qualification->id }}">{{ $qualification->qualification }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <select name="mother_id_type" class="form-control">
                                                                                    <option value="">-choose id proof-</option>
                                                                                    @foreach($id_proof as $id_proofs)
                                                                                        <option  {{ $id_proofs->id == $parents->mother_id_type ? "selected" : " " }}  value="{{ $id_proofs->id }}">{{ $id_proofs->id_proof }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text" class="form-control" placeholder="Id Proof Number" name="mother_id_no"  value="{{$parents->mother_id_no}}">
                                                                                <label for="last-name-column">Id Proof Number</label>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="card-header">
                                                                <h4 class="card-title">Father's Details</h4>
                                                            </div>

                                                            <div class="col-xs-12">
                                                                <div class="col-md-12">
                                                                    <br/><br/>
                                                                    <div class="row">
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Father's First Name" name="father_first_name" value="{{$parents->father_first_name}}">
                                                                                <label for="first-name-column">Father's First Name</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text" id="last-name-column" class="form-control" placeholder="Father's Last Name" name="father_last_name" value="{{$parents->father_last_name}}">
                                                                                <label for="last-name-column">Father's Last Name</label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text"  class="form-control" placeholder="Father's Mobile"  name="father_mobile" value="{{$parents->father_mobile}}">
                                                                                <label for="Mother's Mobile">Father's Mobile Number</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text"  class="form-control" placeholder="Father Email Id"  name="father_email" value="{{$parents->father_email}}">
                                                                                <label for="Email Id">Father Email Id</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text"  class="form-control" placeholder="Father Occupation"  name="father_occupation" value="{{$parents->father_occupation}}">
                                                                                <label for="Occupation">Father's Occupation</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text"  class="form-control" placeholder="Father Salary"  name="father_salary" value="{{$parents->father_salary}}">
                                                                                <label for="Income">Father's Salary</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <select name="father_qualification" class="form-control">
                                                                                    <option value="">-choose Father's Qualification-</option>
                                                                                    @foreach($qualifications as $qualification)
                                                                                        <option {{ $qualification->id == $parents->father_qualification ? "selected" : " " }} value="{{ $qualification->id }}">{{ $qualification->qualification }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <select name="father_id_type" class="form-control">
                                                                                    <option value="">-choose id proof-</option>
                                                                                    @foreach($id_proof as $id_proofs)
                                                                                        <option   {{ $id_proofs->id == $parents->father_id_type ? "selected" : " " }}  value="{{ $id_proofs->id }}">{{ $id_proofs->id_proof }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6 col-12">
                                                                            <div class="form-label-group">
                                                                                <input type="text" class="form-control" placeholder="Id Proof Number" name="father_id_no" value="{{$parents->father_id_no}}">
                                                                                <label for="last-name-column">Id Proof Number</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 pt-2" align="right">
                                                                        <button type="submit" class="btn btn-primary mr-1 mb-1">Update</button>
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

@endsection
@push('scripts')
    <script>
        // $(document).ready(function () {
        //     var a = $('#is_same').is(':checked') ? 1 : 0;
        //     alert(a);
        //     if (a == 0)
        //     {
        //         $('#permanent').css('display', 'block');
        //     }
        //     else
        //     {
        //         $('#permanent').css('display', 'none');
        //     }
        // });
        function permanent() {
            var a = $('#is_same').is(':checked') ? 1 : 0;
            if (a == 0)
            {
                $('#permanent').css('display', 'block');
            }
            else
            {
                $('#permanent').css('display', 'none');
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

    <script src="{{ asset('admin_assets/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>

        <script src="{{asset('admin_assets/vendors/js/vendors.min.js') }}"></script>

@endpush
