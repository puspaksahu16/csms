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
{{--                                                @if(auth()->user()->role->name == "admin")--}}
                                                    @foreach($classes as $class)
                                                        <option value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                    @endforeach
{{--                                                @endif--}}

                                            </select>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table zero-configuration table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            @if(auth()->user()->role->name == "super_admin")
                                            <th scope="col">School</th>
                                            @endif
                                            <th scope="col">Class Name</th>
                                            <th scope="col">Roll No</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Result</th>
                                            <th scope="col">Action</th>
{{--                                            <th></th>--}}
                                        </tr>
                                        </thead>
                                        <tbody id="class_filter">
                                        @foreach($result as $key => $results)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                @if(auth()->user()->role->name == "super_admin")
                                                <td>{{$results->school->full_name}}</td>
                                                @endif
                                                <td>{{$results->classes->create_class}}</td>
                                                <td>{{$results->students->roll_no}}</td>
                                                <td>{{$results->students->first_name." ".$results->students->last_name}}</td>
                                                <td>{{$results->percentage}}%</td>
{{--                                                <td><a href="{{route('result.edit', $results->id)}}" class="btn btn-sm btn-primary">Edit</a></td>--}}
{{--                                                <td><a href="result_delete/{{$results->id}}" class="btn btn-sm btn-danger">Delete</a></td>--}}
                                                <td><a href="enroll/{{$results->id}}" class="btn btn-warning">Enroll</a></td>
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
                url: "/fetch_class_table",
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
                        '<td>' + value.classes.create_class + '</td>'+
                        '<td>' + value.students.roll_no + '</td>'+
                        '<td>' + value.students.first_name +" "+ value.students.last_name + '</td>'+
                        '<td>' + value.percentage + '</td>'+

                        '<td><a href="enroll/'+ value.id + '" class="btn btn-warning">Enroll</a></td>'+
                            '</tr>');
                        @else
                        $("#class_filter").append('<tr>' +
                            '<td scope="row">' + (key + 1) + '</td>'+
                            '<td>' + value.classes.create_class + '</td>'+
                            '<td>' + value.students.roll_no + '</td>'+
                            '<td>' + value.students.first_name +" "+ value.students.last_name + '</td>'+
                            '<td>' + value.percentage + '</td>'+

                            '<td><a href="enroll/'+ value.id + '" class="btn btn-warning">Enroll</a></td>'+
                            '</tr>');
                        @endif
                    });
                }
            });
        }
    </script>

        <script src="{{asset('admin_assets/vendors/js/vendors.min.js') }}"></script>

@endpush
