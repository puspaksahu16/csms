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
                                    <li class="breadcrumb-item"><a href="#">Time-Table Management</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Time-Table</a>
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

                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height ">
                        <div class="col-6" style="margin: auto">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Create Time-Table</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{route('timetable.store')}}" method="POST">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <select name="school_id" onchange="getStandard(),getSubject(),getEmployee(this.value)" id="school_id" class="form-control">
                                                                    <option  value="">-SELECT School-</option>

                                                                    @foreach($schools as $school)
                                                                        <option value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                    @endforeach

                                                                </select>
                                                                <span style="color: red">{{ $errors->first('school_id') }}</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <select onchange="getPeriod(this.value),getClass(this.value)" name="standard_id" id="standard" class="form-control">
                                                                    <option  value="">-SELECT Standard-</option>
                                                                    @if(auth()->user()->role->name == "admin")
                                                                        @foreach($standards as $standard)
                                                                            <option value="{{ $standard->id }}">{{ $standard->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                                <span style="color: red">{{ $errors->first('standard_id') }}</span>
                                                            </div>
                                                        </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <select onchange="getSection(this.value)" name="class_id" id="class" class="form-control">
                                                                <option value="">-SELECT CLASS-</option>

                                                            </select>
                                                            <span style="color: red">{{ $errors->first('class_id') }}</span>
                                                        </div>
                                                    </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <select id="section" name="section_id" class="form-control">
                                                                    <option  value="">-Select Section-</option>

                                                                </select>
                                                                <label for="name">Section</label>
                                                                <span style="color: red">{{ $errors->first('section_id') }}</span>
                                                            </div>
                                                        </div>

                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <select  name="day" id="day" class="form-control">
                                                                <option value="">-Select Day-</option>
                                                                <option value="Monday">Monday</option>
                                                                <option value="Tuesday">Tuesday</option>
                                                                <option value="Wednesday">Wednesday</option>
                                                                <option value="Thursday">Thursday</option>
                                                                <option value="Friday">Friday</option>
                                                                <option value="Saturday">Saturday</option>
                                                                <option value="Holiday">Holiday</option>
                                                            </select>
                                                            <span style="color: red">{{ $errors->first('day') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <select id="period" name="period_id" class="form-control">
                                                                <option  value="">-Select Period-</option>
{{--                                                                @foreach($periods as $period)--}}
{{--                                                                    <option value="{{ $period->id }}">{{ $period->period_name }}</option>--}}
{{--                                                                @endforeach--}}
                                                            </select>
                                                            <label for="name">Period</label>
                                                            <span style="color: red">{{ $errors->first('period_id') }}</span>
                                                        </div>
                                                    </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <select  name="subject_id" id="subject" class="form-control">
                                                                    <option  value="">-SELECT Subject-</option>
                                                                    @if(auth()->user()->role->name == "admin")
                                                                        @foreach($subjects as $subject)
                                                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                                <span style="color: red">{{ $errors->first('subject_id') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <select  name="employee_id" id="employee" class="form-control">
                                                                    <option value="">-SELECT Teacher-</option>
                                                                    @if(auth()->user()->role->name == "admin")
                                                                        @foreach($employees as $employee)
                                                                            <option value="{{ $employee->id }}">{{ $employee->first_name." ".$employee->last_name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                                <span style="color: red">{{ $errors->first('employee_id') }}</span>
                                                            </div>
                                                        </div>
                                                    <div class="col-12 pt-2">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic Floating Label Form section end -->

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
