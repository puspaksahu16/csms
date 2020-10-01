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

            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
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
                                    <li class="breadcrumb-item"><a href="#">Employee</a>
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
                                <h4 class="card-title">Employee List</h4>
                                <a class="btn btn-primary" href="{{url('/employee/create')}}">Add</a>
                            </div>
                            <div class="card-content">

                                <div class="table-responsive">
                                    <table class="table zero-configuration table-striped" id="">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            @if(auth()->user()->role->name == "super_admin")
                                                <th>School</th>
                                            @endif
                                            <th scope="col">EMP ID</th>
                                            <th scope="col">EMP Name</th>
                                            <th scope="col">Department</th>
                                            <th scope="col">Designation</th>
                                            <th scope="col">Contact No</th>
                                            <th scope="col">Email ID</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($employees as $key => $employee)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                @if(auth()->user()->role->name == "super_admin")
                                                    <th>{{$employee->school->full_name}}</th>
                                                @endif
                                                <td>{{$employee->employee_unique_id}}</td>
                                                <td>{{$employee->first_name." ".$employee->last_name}}</td>
                                                <td>{{$employee->employee_department}}</td>
                                                <td>{{$employee->employee_designation}}</td>
                                                <td>{{$employee->mobile}}</td>
                                                <td>{{$employee->email}}</td>
                                                <td><a href="{{route('employee.edit', $employee->id)}}" class="btn btn-sm btn-primary">Edit</a></td>
{{--                                                <td><a href="employees_delete/{{$employee->id}}" class="btn btn-sm btn-danger">Delete</a></td>--}}
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
