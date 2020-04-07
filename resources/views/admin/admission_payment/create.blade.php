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
                            <h2 class="content-header-title float-left mb-0">Payment Details</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">New Admission Fee</a>
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
                                                    <div class="stepwizard">
                                                        <div class="stepwizard-row setup-panel">
                                                            <div class="stepwizard-step">
                                                                <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                                                <p>Payment Details</p>
                                                            </div>
                                                            <div class="stepwizard-step">
                                                                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                                                <p>Stock</p>
                                                            </div>
                                                            <div class="stepwizard-step">
                                                                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                                                <p>Extra Activities</p>
                                                            </div>
                                                            <div class="stepwizard-step">
                                                                <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                                                                <p>Books Fee</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form class="form" method="POST" action="{{route('new_admission.store')}}">
                                                        @csrf

                                                        <div class="row setup-content" id="step-1">
                                                            <div class="card-header">
                                                                <h4 class="card-title">Payment Details</h4>
                                                            </div>

                                                            <div class="container">

                                                                <div class="row">
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-label-group">
                                                                            <select class="form-control" name="class_id">
                                                                                <option value="">-Select Student-</option>
                                                                                @foreach($students as $student)
                                                                                    <option value="{{ $student->student_unique_id }}">{{$student->first_name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <label for="last-name-column">Class</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6 col-12">
                                                                        <div class="form-label-group">
                                                                            <select class="form-control" name="class_id">
                                                                                <option value="">-Select class-</option>
                                                                                @foreach($classes as $class)
                                                                                    <option value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <label for="last-name-column">Class</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12 col-12">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped mb-0">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th scope="col">#</th>
                                                                                    <th scope="col">Name</th>
                                                                                    <th scope="col">Price</th>
                                                                                    <th scope="col">Type</th>


                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td><input type="checkbox"></td>
                                                                                    <td>admissions</td>
                                                                                    <td>250</td>
                                                                                    <td>Monthly</td>

                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                                                            </div>
                                                        </div>
                                                        <div class="row setup-content" id="step-2">
                                                            <div class="card-header">
                                                                <h4 class="card-title">Stock</h4>
                                                            </div>

                                                            <div class="col-xs-12">
                                                                <div class="col-md-12">
                                                                    <br/><br/>
                                                                    <div class="row">
{{--                                                                        <div class="col-md-6 col-12">--}}
{{--                                                                            <div class="form-label-group">--}}
{{--                                                                                <input type="text" id="first-name-column" class="form-control" placeholder="Father's First Name" name="father_first_name">--}}
{{--                                                                                <label for="first-name-column">Father's First Name</label>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}

{{--                                                                        <div class="col-md-6 col-12">--}}
{{--                                                                            <div class="form-label-group">--}}
{{--                                                                                <input type="text" id="last-name-column" class="form-control" placeholder="Father's Last Name" name="father_last_name">--}}
{{--                                                                                <label for="last-name-column">Father's Last Name</label>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}

{{--                                                                        <div class="col-md-6 col-12">--}}
{{--                                                                            <div class="form-label-group">--}}
{{--                                                                                <input type="text"  class="form-control" placeholder="Father's Mobile"  name="father_mobile">--}}
{{--                                                                                <label for="Mother's Mobile">Father's Mobile Number</label>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                        <div class="col-md-6 col-12">--}}
{{--                                                                            <div class="form-label-group">--}}
{{--                                                                                <input type="text"  class="form-control" placeholder="Father Email Id"  name="father_email">--}}
{{--                                                                                <label for="Email Id">Father Email Id</label>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                        <div class="col-md-6 col-12">--}}
{{--                                                                            <div class="form-label-group">--}}
{{--                                                                                <input type="text"  class="form-control" placeholder="Father Occupation"  name="father_occupation">--}}
{{--                                                                                <label for="Occupation">Father's Occupation</label>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                        <div class="col-md-6 col-12">--}}
{{--                                                                            <div class="form-label-group">--}}
{{--                                                                                <input type="text"  class="form-control" placeholder="Father Salary"  name="father_salary">--}}
{{--                                                                                <label for="Income">Father's Salary</label>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                        <div class="col-md-6 col-12">--}}
{{--                                                                            <div class="form-label-group">--}}
{{--                                                                                <input type="text"  class="form-control" placeholder="Father Qualification"  name="father_qualification">--}}
{{--                                                                                <label for="Income">Father's Qualification</label>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}



{{--                                                                        <div class="col-md-6 col-12">--}}
{{--                                                                            <div class="form-label-group">--}}
{{--                                                                                <input type="text" class="form-control" placeholder="Id Proof Number" name="father_id_no">--}}
{{--                                                                                <label for="last-name-column">Id Proof Number</label>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
                                                                    </div>
                                                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row setup-content" id="step-3">
                                                            <div class="card-header">
                                                                <h4 class="card-title">Extra Activities</h4>
                                                            </div>
                                                            <div class="container">

                                                                    <br/><br/>
                                                                    <div class="row">

                                                                        <div class="col-md-12 col-12">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-striped mb-0">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th scope="col">#</th>
                                                                                        <th scope="col">Name</th>
                                                                                        <th scope="col">Price</th>
                                                                                        <th scope="col">Type</th>


                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    <tr>
                                                                                        <td><input type="checkbox"></td>
                                                                                        <td>admissions</td>
                                                                                        <td>250</td>
                                                                                        <td>Monthly</td>

                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>

                                                            </div>
                                                        </div>
                                                        <div class="row setup-content" id="step-4">
                                                            <div class="card-header">
                                                                <h4 class="card-title">Books Fee</h4>
                                                            </div>
                                                            <div class="container">

                                                                <br/><br/>
                                                                <div class="row">

                                                                    <div class="col-md-12 col-12">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped mb-0">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th scope="col">#</th>
                                                                                    <th scope="col">Subject</th>
                                                                                    <th scope="col">Books</th>
                                                                                    <th scope="col">Publisher</th>
                                                                                    <th scope="col">Price</th>

                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td><input type="checkbox"></td>
                                                                                    <td>musics</td>
                                                                                    <td>Rich and poor</td>
                                                                                    <td>Something</td>
                                                                                    <td>250</td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <button class="btn btn-success btn-lg pull-right" type="submit">Finish!</button>

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
    <script src="{{ asset('admin_assets/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
@endpush
