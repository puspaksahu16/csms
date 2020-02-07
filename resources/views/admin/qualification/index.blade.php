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
                            <h2 class="content-header-title float-left mb-0">Create Class</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Create Class</a>
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
                            <div class="card-header">
                                <h4 class="card-title">Striped rows</h4>
                                <a class="btn btn-primary" href="{{url('/qualification/create')}}">Add</a>
                            </div>
                            <div class="card-content">

                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Qualification</th>
                                            <th scope="col">action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($qualification as $key => $qualification)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                <th>{{$qualification->qualification}}</th>
                                                <th>{{$qualification->created_at}}</th>
                                                <td><a href="{{route('qualification.edit', $qualification->id)}}" class="btn btn-primary">Edit</a></td>
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
