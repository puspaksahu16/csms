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
                        <div class="col-12" style="margin: auto">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Time-Table</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-content">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Day</th>
                                                    <th scope="col">Period 1</th>
                                                    <th scope="col">Period 2</th>
                                                    <th scope="col">Period 3</th>
                                                    <th scope="col">Period 4</th>
                                                    <th scope="col">Break</th>
                                                    <th scope="col">Period 5</th>
                                                    <th scope="col">Period 6</th>
                                                    <th scope="col">Period 7</th>
                                                    <th scope="col">Period 8</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Monday</td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Monday' AND $timetable->period->period_name == '1st')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Monday' AND $timetable->period->period_name == '2nd')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Monday' AND $timetable->period->period_name == '3rd')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Monday' AND $timetable->period->period_name == '4th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            Break
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Monday' AND $timetable->period->period_name == '5th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Monday' AND $timetable->period->period_name == '6th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Monday' AND $timetable->period->period_name == '7th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Monday' AND $timetable->period->period_name == '8th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tuesday</td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Tuesday' AND $timetable->period->period_name == '1st')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Tuesday' AND $timetable->period->period_name == '2nd')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Tuesday' AND $timetable->period->period_name == '3rd')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Tuesday' AND $timetable->period->period_name == '4th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            Break
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Tuesday' AND $timetable->period->period_name == '5th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Tuesday' AND $timetable->period->period_name == '6th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Tuesday' AND $timetable->period->period_name == '7th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Tuesday' AND $timetable->period->period_name == '8th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Wednesday</td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Wednesday' AND $timetable->period->period_name == '1st')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Wednesday' AND $timetable->period->period_name == '2nd')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Wednesday' AND $timetable->period->period_name == '3rd')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Wednesday' AND $timetable->period->period_name == '4th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            Break
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Wednesday' AND $timetable->period->period_name == '5th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Wednesday' AND $timetable->period->period_name == '6th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Wednesday' AND $timetable->period->period_name == '7th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Wednesday' AND $timetable->period->period_name == '8th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Thursday</td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Thursday' AND $timetable->period->period_name == '1st')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Thursday' AND $timetable->period->period_name == '2nd')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Thursday' AND $timetable->period->period_name == '3rd')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Thursday' AND $timetable->period->period_name == '4th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            Break
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Thursday' AND $timetable->period->period_name == '5th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Thursday' AND $timetable->period->period_name == '6th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Thursday' AND $timetable->period->period_name == '7th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Thursday' AND $timetable->period->period_name == '8th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Friday</td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Friday' AND $timetable->period->period_name == '1st')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Friday' AND $timetable->period->period_name == '2nd')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Friday' AND $timetable->period->period_name == '3rd')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Friday' AND $timetable->period->period_name == '4th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            Break
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Friday' AND $timetable->period->period_name == '5th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Friday' AND $timetable->period->period_name == '6th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Friday' AND $timetable->period->period_name == '7th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Friday' AND $timetable->period->period_name == '8th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Saturday</td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Saturday' AND $timetable->period->period_name == '1st')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Saturday' AND $timetable->period->period_name == '2nd')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Saturday' AND $timetable->period->period_name == '3rd')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Saturday' AND $timetable->period->period_name == '4th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            Break
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Saturday' AND $timetable->period->period_name == '5th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Saturday' AND $timetable->period->period_name == '6th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Saturday' AND $timetable->period->period_name == '7th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($timetables as $timetable)
                                                                @if($timetable->day == 'Saturday' AND $timetable->period->period_name == '8th')
                                                                    {{ $timetable->subject->name }}<br>
                                                                    ({{$timetable->employee->first_name." ".$timetable->employee->last_name}})
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
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
