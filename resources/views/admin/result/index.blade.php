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
                            {{--                            <h2 class="content-header-title float-left mb-0">Pre Admission</h2>--}}
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Result</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Result List</a>
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
                                <h4 class="card-title">Result</h4>
                                <a class="btn btn-primary" href="{{url('/result/create')}}">Add Result</a>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Class Name</th>
                                            <th scope="col">Roll No</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Result</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($result as $key => $results)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                <td>{{$results->classes->create_class}}</td>
                                                <td>{{$results->roll_no}}</td>
                                                <td>{{$results->students->first_name." ".$results->students->last_name}}</td>
                                                <td>{{$results->percentage}}%</td>
                                                <td><a href="{{route('result.edit', $results->id)}}" class="btn btn-primary">Edit</a></td>
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
