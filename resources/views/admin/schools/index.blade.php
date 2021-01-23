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
                                    <li class="breadcrumb-item"><a href="#">School</a>
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
                                <h4 class="card-title">School</h4>
                                <a class="btn btn-primary" href="{{url('/schools/create')}}">Add</a>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table zero-configuration" id="">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Registration No</th>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Mobile</th>
                                            <th scope="col">Total Strength</th>
                                            <th scope="col">Subscription Type</th>
                                            <th scope="col">Created Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
{{--                                            <th></th>--}}
                                        </tr>
                                        </thead>
                                            <tbody>
                                            @foreach($schools as $key => $school)
                                                <tr>
                                                    <th scope="row">{{$key+1}}</th>
                                                    <td><a href="{{route('schools.show', $school->id)}}">{{$school->registration_no}}</a></td>
                                                    <td>{{$school->full_name}}</td>
                                                    <td>{{$school->email}}</td>
                                                    <td>{{$school->mobile}}</td>
                                                    <td>{{$school->total_strength}}</td>
                                                    <td>@if($school->subscription_type == 0)
                                                            ----
                                                        @elseif($school->subscription_type == 1)
                                                            6 Month
                                                        @else
                                                            1 Year
                                                        @endif
                                                    </td>
                                                    <td>{{$school->created_at->format('d-M-y')}}</td>
                                                    <td>{{$school->is_active == 1 ? 'Active' : "Inactive"}}</td>
                                                    <td><a href="{{route('schools.edit', $school->id)}}" class="btn btn-sm btn-primary">Edit</a></td>
{{--                                                    <td><a href="schools_delete/{{$school->id}}" class="btn btn-sm btn-danger">Delete</a></td>--}}
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
