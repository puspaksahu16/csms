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
                                    <li class="breadcrumb-item"><a href="#">Pre Exam</a>
                                    </li>

                                    <li class="breadcrumb-item"><a href="#">Pre Exam List</a>
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
                                <h4 class="card-title">Pre Exam</h4>

                                <a class="btn btn-primary" href="{{url('/pre_exam/create')}}">Add Exam</a>
                            </div>
                            <div class="card-content">

                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Exam Name</th>
                                            <th scope="col">Full Mark</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Year</th>
                                            <th scope="col">action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pre_exam as $key => $pre_exams)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                <td>{{$pre_exams->exam_name}}</td>
                                                <td>{{$pre_exams->full_mark}}</td>
                                                <td>{{$pre_exams->classes->create_class}}</td>
                                                <td>{{$pre_exams->current_year}}</td>
                                                <td><a href="{{route('pre_exam.edit', $pre_exams->id)}}" class="btn btn-primary">Edit</a></td>
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
