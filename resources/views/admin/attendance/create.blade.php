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
                                    <li class="breadcrumb-item"><a href="#">Attendance</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">create</a>
                                    </li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <div class="content-body"><!-- Basic Horizontal form layout section start -->

                <div class="row" id="table-striped">
                    <div class="col-12">
                        <form action="{{ url('attendance/store/'.$timetable->id) }}" method="post">
                            @csrf
                        <div class="card">
                            <div class="card-header table-card-header">
                                <h4 class="card-title">Create Attendance of {{$timetable->period->period_name}} Period in {{ $timetable->class->create_class }} {{ !empty($timetable->section->section) ? "(".$timetable->section->section.")" : "" }}</h4>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Student name</th>
                                            <th scope="col">Student Id</th>
                                            <th scope="col">Attendance</th>
                                            <th scope="col">Description</th>
                                            {{--                                            <th scope="col">Action</th>--}}
                                            {{--                                            <th></th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $key => $student)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                <td>{{$student->first_name}}</td>
                                                <td>{{$student->student_unique_id}}</td>
                                                <td>
                                                    <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                        {{--<p class="mb-0">Success</p>--}}
                                                        <input type="checkbox" name="attendance[{{ $student->id }}][attendance][]" class="custom-control-input" id="customSwitch11{{ $student->id }}">
                                                        <label class="custom-control-label" for="customSwitch11{{ $student->id }}">
                                                            {{--<span class="switch-icon-left"><i class="feather icon-check"></i></span>--}}
                                                            {{--<span class="switch-icon-right"><i class="feather icon-crosshair"></i></span>--}}
                                                            <span class="switch-icon-left">P</span>
                                                            <span class="switch-icon-right">A</span>
                                                        </label>
                                                    </div>
                                                    {{--<select name="attendance[{{ $student->id }}][]" class="form-control" style="background-color: aliceblue; color: #000">--}}
                                                        {{--<option value="0">Absent</option>--}}
                                                        {{--<option value="1">Present</option>--}}
                                                    {{--</select>--}}
                                                </td>
                                                <td>
                                                    <textarea name="attendance[{{ $student->id }}][description][]" class="form-control" style="background-color: aliceblue; color: #000" cols="2" rows="1"></textarea>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="pull-right btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{asset('admin_assets/vendors/js/vendors.min.js') }}"></script>
@endpush
