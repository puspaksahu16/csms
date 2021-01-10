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
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Time-Table</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Time-Table List</a>
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
                                <h4 class="card-title">Time-Table</h4>
                                <a class="btn btn-primary" href="{{url('/timetable/create')}}">Add Time-Table</a>
                            </div>
                            <div class="container">
                                <form class="form" action="{{url('/fetch_class_table')}}" method="get">
                                    @csrf
                                    <div class="row">
                                        @if(auth()->user()->role->name == "super_admin")
                                        <div class="col-md-4">
                                            <select name="school_id" onclick="getClass()" id="school_id" class="form-control">
                                                <option value="">-SELECT School-</option>

                                                @foreach($schools as $school)
                                                    <option value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        @endif
                                        <div class="col-md-4">
                                            <select onchange="classFiler(this.value)" name="class_id" id="class" class="form-control">
                                                <option value="">-SELECT CLASS-</option>
                                                @if(auth()->user()->role->name == "admin")
                                                    @foreach($classes as $class)
                                                        <option value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                        </div>

                                    </div>
                                </form>
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
                                            <th scope="col">Standard</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Section</th>
                                            <th scope="col">Day</th>
                                            <th scope="col">Period</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Teacher</th>
{{--                                            <th scope="col">Action</th>--}}
{{--                                            <th></th>--}}
                                        </tr>
                                        </thead>
                                        <tbody id="class_filter">
                                        @foreach($timetables as $key => $timetable)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                @if(auth()->user()->role->name == "super_admin")
                                                <td>{{$timetable->school->full_name}}</td>
                                                @endif
                                                <td>{{$timetable->standard->name}}</td>
                                                <td>{{$timetable->class->create_class}}</td>
                                                <td>{{$timetable->section->section}}</td>
                                                <td>{{$timetable->day}}</td>
                                                <td>{{$timetable->period->period_name}}</td>
                                                <td>{{$timetable->subject->name}}</td>
                                                <td>{{$timetable->employee->first_name." ".$timetable->employee->last_name}}</td>
{{--                                                <td><a href="{{route('result.edit', $results->id)}}" class="btn btn-sm btn-primary">Edit</a></td>--}}
{{--                                                <td><a href="result_delete/{{$results->id}}" class="btn btn-sm btn-danger">Delete</a></td>--}}
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
@endsection
        @push('scripts')
            <script>
                function getClass() {
                    var school_id = $('#school_id').val();
                    // alert(csrf);
                    $.ajax({
                        url : "/get_class/"+school_id,
                        type:'get',
                        success: function(response) {
                            console.log(response);
                            $("#class").attr('disabled', false);
                            $("#class").empty();
                            $("#class").append('<option value="">-Select Class-</option>');
                            $.each(response,function(key, value)
                            {
                                $("#class").append('<option value=' + key + '>' + value + '</option>');
                            });
                        }
                    });
                }
                function classFiler() {
                    var school_id = $('#school_id').val();
                    var class_id = $('#class').val();
                    // alert(class_id);
                    $.ajax({
                        type: "get",
                        url: "/fetch_timetable_class",
                        data:{school_id: school_id, class_id: class_id},

                        success: function(data){
                            console.log(data);
                            $("#class_filter").empty();
                            $.each(data, function(key, value)
                            {
                                @if(auth()->user()->role->name == "super_admin")
                                $("#class_filter").append('<tr>' +
                                    '<td scope="row">' + (key + 1) + '</td>'+
                                    '<td>' + value.school.full_name + '</td>'+
                                    '<td>' + value.standard.name + '</td>'+
                                    '<td>' + value.class.create_class + '</td>'+
                                    '<td>' + value.section.section + '</td>'+
                                    '<td>' + value.day + '</td>'+
                                    '<td>' + value.period.period_name + '</td>'+
                                    '<td>' + value.subject.name + '</td>'+
                                    '<td>' + value.employee.first_name +" "+ value.employee.last_name + '</td>'+
                                    '</tr>');
                                @else
                                $("#class_filter").append('<tr>' +
                                    '<td scope="row">' + (key + 1) + '</td>'+
                                    '<td>' + value.standard.name + '</td>'+
                                    '<td>' + value.class.create_class + '</td>'+
                                    '<td>' + value.section.section + '</td>'+
                                    '<td>' + value.day + '</td>'+
                                    '<td>' + value.period.period_name + '</td>'+
                                    '<td>' + value.subject.name + '</td>'+
                                    '<td>' + value.employee.first_name +" "+ value.employee.last_name + '</td>'+
                                    '</tr>');
                                @endif

                            });
                        }
                    });
                }
            </script>

    @endpush
