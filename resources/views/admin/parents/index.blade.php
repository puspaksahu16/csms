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
                                    <li class="breadcrumb-item"><a href="#">Parents</a>
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
                                <h4 class="card-title">Parents List</h4>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table zero-configuration" id="">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Parent Id</th>
                                            <th scope="col">Mother Name</th>
                                            <th scope="col">Mother Email</th>
                                            <th scope="col">Mother Contact</th>
                                             <th scope="col">Student Class</th>
                                            <th scope="col">Student Name</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($parents as $key => $parent)
                                            <tr>
                                            <th scope="row">{{$key+1}}</th>
                                                <td><a href="{{route('new_admission.view', $parent->student_id)}}">{{$parent->parent_id}}</a></td>
                                            <td>{{$parent->mother_first_name." ".$parent->mother_last_name}}</td>
                                            <td>{{$parent->mother_email}}</td>
                                            <td>{{$parent->mother_mobile}}</td>
                                            <td>{{$parent->students->classes->create_class}}</td>
                                            <td>{{$parent->students->first_name." ".$parent->students->last_name}}</td>
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
