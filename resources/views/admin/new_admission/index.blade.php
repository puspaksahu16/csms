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
                                    <li class="breadcrumb-item"><a href="#">New Admission</a>
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
                                <h4 class="card-title">New Admission</h4>
                                <a class="btn btn-primary" href="{{url('/new_admission/create')}}">Add</a>
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
                                            <th scope="col">Student ID</th>
                                            <th scope="col">Reference No</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Admission Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $key => $student)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                @if(auth()->user()->role->name == "super_admin")
                                                <td>{{$student->school['full_name']}}</td>
                                                @endif
                                                <td>{{$student->student_unique_id}}</td>
                                                <td>{{$student->ref_no}}</td>
                                                <td>{{$student->first_name." ".$student->last_name}}</td>
                                                <td>{{$student->classes->create_class}}</td>
                                                <td>{{$student->created_at->format('d F Y')}}</td>
                                                <td>
                                                    <a href="{{route('new_admission.view', $student->id)}}" class="btn btn-sm btn-primary">View</a>
                                                    <a href="{{route('new_admission.edit', $student->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="#" data-toggle="modal" data-target="#myModal{{$student->id}}" class="btn btn-sm btn-primary">Assign Section</a>
                                                    <div class="modal" id="myModal{{$student->id}}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">

                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Assign Section</h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>

                                                                <!-- Modal body -->
                                                                <div class="modal-body">
                                                                    <form class="form" method="POST" action="{{ url('/assign_section/'.$student->id) }}">
                                                                        @csrf
                                                                        <div class="form-label-group">
                                                                            <select name="section" class="form-control">
                                                                                <option>-SELECT Section-</option>
                                                                                @foreach($sections as $section)
                                                                                    <option value="{{ $section->name }}">{{ $section->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <label for="first-name-column">Create Section</label>
                                                                        </div>
                                                                        <button class="btn btn-success btn-sm pull-right" type="submit">Submit</button>
                                                                    </form>
                                                                </div>

                                                                <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(empty($student->fee->fee))
                                                        <a href="{{url('/admission_fee_create/'. $student->id)}}" class="btn btn-sm btn-success">Admission Fee</a>
                                                    @else
                                                        <a href="{{url('/admission_fee_edit/'. $student->fee->id)}}" class="btn btn-sm btn-warning">Edit Admission Fee</a>
                                                    @endif

                                                    {{--@if(empty($student->fee->store_fee))--}}
                                                        {{--<a href="{{url('/store_fee_create/'. $student->id)}}" class="btn btn-sm btn-success">Store Fee</a>--}}
                                                    {{--@else--}}
                                                        {{--<a href="{{url('/admission_fee_edit/'. $student->fee->id)}}" class="btn btn-sm btn-warning">Edit Store Fee</a>--}}
                                                    {{--@endif--}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <!-- The Modal -->

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
