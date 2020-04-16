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
                                    <li class="breadcrumb-item"><a href="#">Pre Exam Management</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Pre Exam</a>
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
                        <div class="col-6" style="margin: auto">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Create Pre Exam</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{route('pre_exam.store')}}" method="POST">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-label-group">
                                                                <select name="school_id" class="form-control">
                                                                    <option>-SELECT School-</option>

                                                                    @foreach($schools as $school)
                                                                        <option value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" placeholder="Exam Name" name="exam_name">
                                                            <label for="name">Exam Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <select name="class_id" class="form-control">
                                                                <option>-SELECT CLASS-</option>

                                                                @foreach($classes as $class)
                                                                    <option value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <input type="number" class="form-control" placeholder="Full Mark" name="full_mark">
                                                            <label for="name">Full Mark</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <select id="year" class="form-control" name="current_year" >
                                                                <option value="">Current Year</option>
                                                                {{ $year = date('Y') }}
                                                                @for ($year = 2020; $year <= 2030; $year++)
                                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                                @endfor
                                                            </select>
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
