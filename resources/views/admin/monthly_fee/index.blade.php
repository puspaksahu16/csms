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
                                    <li class="breadcrumb-item"><a href="#">Monthly Fee</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>w

            </div>
            <div class="content-body"><!-- Basic Horizontal form layout section start -->

                <div class="row" id="table-striped">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header table-card-header">
                                <h4 class="card-title">Monthly Fee</h4>
                                {{--<a class="btn btn-primary" href="{{url('/pre_admissions/create')}}">Add</a>--}}
                            </div>
                            <div class="card-content">

                                <div class="table-responsive">
                                    <table class="table zero-configuration" id="">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            @if(auth()->user()->role->name == "super_admin")
                                            <th scope="col">School</th>
                                            @endif
                                            <th scope="col">Student ID</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Section</th>
                                            <th scope="col">Due</th>
                                            <th scope="col">Total Fine</th>
                                            <th scope="col">Paid</th>
                                            <th scope="col">Monthly Fee</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $key => $mf)
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            @if(auth()->user()->role->name == "super_admin")
                                            <td>{{$mf->school->full_name}}</td>
                                            @endif
                                            <td>{{$mf->student_unique_id}}</td>
                                            <td>{{$mf->first_name." ".$mf->last_name}}</td>
                                            <td>{{$mf->classes->create_class}}</td>
                                            <td>{{!empty($mf->section_data->section) ? $mf->section_data->section : "Not Assign"}}</td>
                                            <td>{{ $mf->monthly_fee->due }}</td>
                                            <td>{{ $mf->monthly_fee->fine }}</td>
                                            <td>{{ $mf->monthly_fee->paid }}</td>
                                            <td>{{ $mf->monthly_fee->fee }}</td>
                                            {{--<td>--}}
                                                {{--@if($sf->installment > 0)--}}
                                                    {{--@if(auth()->user()->role->name == "parent")--}}
                                                        {{--<a href="{{url('/installment/'.$mf->student_id)}}" class="btn btn-sm btn-primary">View Installment</a>--}}
                                                    {{--@else--}}
                                                        {{--<a href="{{url('/installment/'.$mf->student_id)}}" class="btn btn-sm btn-primary">Pay Installment</a>--}}
                                                    {{--@endif--}}
                                                {{--@else--}}
                                                    {{--Trigger the modal with a button--}}
                                                    {{--<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal{{ $sf->id }}">Installment</button>--}}
                                                    {{--Modal--}}
                                                    {{--<div class="modal fade" id="myModal{{ $sf->id }}" role="dialog">--}}
                                                        {{--<div class="modal-dialog">--}}

                                                            {{--<!-- Modal content-->--}}
                                                            {{--<div class="modal-content">--}}
                                                                {{--<div class="modal-header">--}}
                                                                    {{--<h4 class="modal-title">Add Installment Term</h4>--}}
                                                                    {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                                                                {{--</div>--}}
                                                                {{--<div class="modal-body">--}}
                                                                    {{--<form action="{{ url('/update_installment/'.$sf->id) }}" method="POST">--}}
                                                                        {{--@csrf--}}
                                                                        {{--<select class="form-control" name="installment">--}}
                                                                            {{--<option value="">-Select Installment Term-</option>--}}
                                                                            {{--<option value="1">1 Time</option>--}}
                                                                            {{--<option value="2">2 Times</option>--}}
                                                                            {{--<option value="4">4 Times</option>--}}
                                                                            {{--<option value="10">10 Times</option>--}}
                                                                            {{--<option value="12">12 Times</option>--}}
                                                                        {{--</select>--}}
                                                                        {{--<br>--}}
                                                                        {{--<button type="submit" class="btn btn-success">Submit</button>--}}
                                                                    {{--</form>--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}

                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--@endif--}}




{{--                                                <a href="{{url('/payment_history/'.$sf->student_id)}}" class="btn btn-sm btn-success">Payment History</a>--}}
                                            {{--</td>--}}
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
