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
{{--                            <h2 class="content-header-title float-left mb-0">Pre Admission</h2>--}}
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Store Fee</a>
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
                                <h4 class="card-title">Store Fee</h4>
                                {{--<a class="btn btn-primary" href="{{url('/pre_admissions/create')}}">Add</a>--}}
                            </div>
                            <div class="card-content">

                                <div class="table-responsive">
                                    <table class="table zero-configuration" id="">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">School</th>
                                            <th scope="col">Student ID</th>
                                            <th scope="col">Name</th>
                                            <th>Class</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $key => $student)
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td>{{$student->school['full_name']}}</td>
                                            <td>{{$student->student_unique_id}}</td>
                                            <td>{{$student->first_name." ".$student->last_name}}</td>
                                            <td>{{$student->classes->create_class}}</td>
                                            <td>
                                                <a href="{{url('/store_fee/'.$student->id)}}" class="btn btn-sm btn-primary">Store fee</a>
                                                <a href="{{url('/store_payment_history/'.$student->id)}}" class="btn btn-sm btn-success">Payment History</a>
                                            </td>
                                        </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
