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
                                    <li class="breadcrumb-item"><a href="#">Pre admission</a>
                                    </li>

                                    <li class="breadcrumb-item"><a href="#">Pre Exam</a>
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

                                    <table class="table zero-configuration" id="">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            @if(auth()->user()->role->name == "super_admin")
                                                <th scope="col">School Name</th>
                                            @endif
                                            <th scope="col">Exam Name</th>
                                            <th scope="col">Year</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Full Mark</th>
                                            <th scope="col">Exam Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($pre_exams as $key => $pre_exam)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <th>{{$pre_exam->schools->full_name}}</th>
                                                    @endif
                                                    <td>{{ $pre_exam->exam_name }}</td>
                                                    <td>{{ $pre_exam->current_year }}</td>
                                                    <td>{{ $pre_exam->classes->create_class }}</td>
                                                    <td>{{ $pre_exam->full_mark }}</td>
                                                    <td>{{ date('d F Y', strtotime($pre_exam->exam_date)) }}</td>

                                                    <td><a href="{{route('pre_exam.edit', $pre_exam->id)}}" class="btn btn-sm btn-primary">Edit</a></td>
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
