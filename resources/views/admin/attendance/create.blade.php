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
                            {{--                            <h2 class="content-header-title float-left mb-0"></h2>--}}
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Attendance</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">create</a>
                                    </li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <div class="content-body"><!-- Basic Horizontal form layout section start -->

                <div class="row" id="table-striped">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header table-card-header">
                                <h4 class="card-title">Create Attendance of {{ $students[0]['classes']['create_class'] }} ({{ $students[0]['student_section']['section'] }})</h4>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Student name</th>
                                            <th scope="col">Student Id</th>
                                            <th scope="col">Attendance</th>
                                            <th scope="col">Description</th>
                                            {{--                                            <th scope="col">Action</th>--}}
                                            {{--                                            <th></th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $key => $student)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                <td>{{$student->first_name}}</td>
                                                <td>{{$student->student_unique_id}}</td>
                                                <td>
                                                    <select class="form-control" style="background-color: aliceblue; color: #000">
                                                        {{--<option value="">Select</option>--}}
                                                        <option value="0">Absent</option>
                                                        <option value="1">Present</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <textarea class="form-control" style="background-color: aliceblue; color: #000" cols="2" rows="1"></textarea>
                                                </td>
                                                {{--                                                <td><a href="{{route('result.edit', $results->id)}}" class="btn btn-sm btn-primary">Edit</a></td>--}}
                                                {{--                                                <td><a href="result_delete/{{$results->id}}" class="btn btn-sm btn-danger">Delete</a></td>--}}
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="pull-right btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        function getPeriod(id) {
            // alert(id);
            $.ajax({
                url: "/get_period",
                type: "post",
                data:{
                    "_token": "{{ csrf_token() }}",
                    standard_id: id
                },
                success: function(result){
                    console.log(result);
                    $('#period').empty();
                    if(result)
                    {
                        $('#period').append('<option value="">-Select Period-</option>');
                        $.each(result,function(key,value){
                            $('#period').append($("<option/>", {
                                value: key,
                                text: value
                            }));
                        });
                    }
                }});
        }
        function getClass(id) {
            // alert(id);
            $.ajax({
                url: "/get_classes",
                type: "post",
                data:{
                    "_token": "{{ csrf_token() }}",
                    standard_id: id
                },
                success: function(result){
                    console.log(result);
                    $('#class').empty();
                    if(result)
                    {
                        $('#class').append('<option value="">-Select Class-</option>');
                        $.each(result,function(key,value){
                            $('#class').append($("<option/>", {
                                value: key,
                                text: value
                            }));
                        });
                    }
                }});
        }
        function getSection(id) {
            // alert(id);
            $.ajax({
                url: "/get_section",
                type: "post",
                data:{
                    "_token": "{{ csrf_token() }}",
                    class_id: id
                },
                success: function(result){
                    console.log(result);
                    $('#section').empty();
                    if(result)
                    {
                        $('#section').append('<option value="">-Select Section-</option>');
                        $.each(result,function(key,value){
                            $('#section').append($("<option/>", {
                                value: key,
                                text: value
                            }));
                        });
                    }
                }});
        }

        function getStandard() {
            var school_id = $('#school_id').val();
            // alert(csrf);
            $.ajax({
                url : "/get_standard/"+school_id,
                type:'get',
                success: function(response) {
                    console.log(response);
                    $("#standard").attr('disabled', false);
                    $("#standard").empty();
                    $("#standard").append('<option value="">-Select Standard-</option>');
                    $.each(response,function(key, value)
                    {
                        $("#standard").append('<option value=' + key + '>' + value + '</option>');
                    });
                }
            });
        }

        function getSubject() {
            var school_id = $('#school_id').val();
            // alert(csrf);
            $.ajax({
                url : "/get_subject/"+school_id,
                type:'get',
                success: function(response) {
                    console.log(response);
                    $("#subject").attr('disabled', false);
                    $("#subject").empty();
                    $("#subject").append('<option value="">-Select Subject-</option>');
                    $.each(response,function(key, value)
                    {
                        $("#subject").append('<option value=' + key + '>' + value + '</option>');
                    });
                }
            });
        }
        function getEmployee(id) {
           // alert(id);
            // var schools = $('#school_id').val();
            // var standards = $('#standard').val();
            // var classes = $('#class').val();
            // var sections = $('#section').val();
            // var days = $('#day').val();
            // var periods = $('#period').val();

            $.ajax({
                url : "/get_employee/"+id,
                type:'get',
                {{--data:{--}}
                {{--    "_token": "{{ csrf_token() }}",--}}
                {{--    school_id: id,--}}
                {{--    standard_id: standards,--}}
                {{--    class_id : classes,--}}
                {{--    section_id: sections,--}}
                {{--    day: days,--}}
                {{--    period_id: periods,--}}

                {{--},--}}
                success: function(response) {
                    console.log(response);
                    $("#employee").attr('disabled', false);
                    $("#employee").empty();
                    $("#employee").append('<option value="">-Select Employee-</option>');
                    $.each(response,function(key, value)
                    {
                        $("#employee").append('<option value=' + key + '>' + value + '</option>');
                    });
                }
            });
        }
    </script>
@endpush
