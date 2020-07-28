@extends('admin.layouts.master')
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    @if(is_array(session()->get('success')))
                        <ul>
                            @foreach (session()->get('success') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @else
                        {{ session()->get('success') }}
                    @endif
                </div>
            @endif
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Time-Table</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Time-Table List</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body"><!-- Basic Horizontal form layout section start -->

                <div class="row" id="table-striped">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header table-card-header">
                                <h4 class="card-title">Time-Table</h4>
                                <a class="btn btn-primary" href="{{url('/timetable/create')}}">Add Time-Table</a>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table zero-configuration" id="">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">School</th>
                                            <th scope="col">Standard</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Section</th>
                                            <th scope="col">Day</th>
                                            <th scope="col">Period</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Teacher</th>
{{--                                            <th scope="col">Action</th>--}}
{{--                                            <th></th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($timetables as $key => $timetable)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                <td>{{$timetable->school->full_name}}</td>
                                                <td>{{$timetable->standard->name}}</td>
                                                <td>{{$timetable->class->create_class}}</td>
                                                <td>{{$timetable->section->section}}</td>
                                                <td>{{$timetable->day}}</td>
                                                <td>{{$timetable->period->period_name}}</td>
                                                <td>{{$timetable->subject->name}}</td>
                                                <td>{{$timetable->employee->first_name." ".$timetable->employee->last_name}}</td>
{{--                                                <td><a href="{{route('result.edit', $results->id)}}" class="btn btn-sm btn-primary">Edit</a></td>--}}
{{--                                                <td><a href="result_delete/{{$results->id}}" class="btn btn-sm btn-danger">Delete</a></td>--}}
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
