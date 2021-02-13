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
                                    <li class="breadcrumb-item"><a href="#">Pre Admission</a>
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
                                <h4 class="card-title">Pre Admission</h4>
                                <a class="btn btn-primary" href="{{url('/pre_admissions/create')}}">Add</a>
                            </div>
                            <div class="card-content">

                                <div class="table-responsive">
                                    <table class="table zero-configuration table-striped" id="">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            @if(auth()->user()->role->name == "super_admin")
                                            <th scope="col">School Name</th>
                                            @endif
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Temp Roll No</th>
                                            <th scope="col">Year</th>
                                            <th scope="col">Action</th>
                                            <th></th>
{{--                                            <th></th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pre_admissions as $key => $pre_admission)
                                         <tr>
                                            <th scope="row">{{$key+1}}</th>
                                             @if(auth()->user()->role->name == "super_admin")
                                             <th>{{$pre_admission->schools->full_name}}</th>
                                             @endif
                                            <td>{{$pre_admission->first_name." ".$pre_admission->last_name}}</td>
                                            <td>{{$pre_admission->classes->create_class}}</td>
                                            <td>{{$pre_admission->roll_no}}</td>
                                            <td>{{$pre_admission->year->current_year}}</td>
                                            <td><a href="{{route('pre_admissions.show', $pre_admission->id)}}" class="btn btn-sm btn-success">view</a></td>
                                            <td><a href="{{route('pre_admissions.edit', $pre_admission->id)}}" class="btn btn-sm btn-primary">Edit</a></td>
{{--                                             <td><a href="pre_admissions_delete/{{$pre_admission->id}}" class="btn btn-sm btn-danger">Delete</a></td>--}}
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
@push('scripts')
    <script src="{{asset('admin_assets/vendors/js/vendors.min.js') }}"></script>
@endpush
