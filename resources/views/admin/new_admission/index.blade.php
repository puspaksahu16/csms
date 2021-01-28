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
                                                <select onchange="getSection(this.value)" name="class_id" id="class" class="form-control">
                                                    <option value="">-SELECT CLASS-</option>
                                                    @if(auth()->user()->role->name == "admin")
                                                        @foreach($classes as $class)
                                                            <option value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                            </div>
                                                <div class="col-md-4">
                                                    <div class="form-label-group">
                                                        <select onchange="classFiler(this.value)" id="section" name="section_id" class="form-control">
                                                            <option  value="">-Select Section-</option>

                                                        </select>
                                                        <label for="name">Section</label>
                                                        <span style="color: red">{{ $errors->first('section_id') }}</span>
                                                    </div>
                                                </div>

                                        </div>
                                    </form>
                                </div>
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
                                            <th scope="col">Section</th>
                                            <th scope="col">Roll No</th>
                                            <th scope="col">Admission Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="class_filter">
                                        @foreach($students as $key => $student)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                @if(auth()->user()->role->name == "super_admin")
                                                <td>{{$student->school->full_name}}</td>
                                                @endif
                                                <td><a href="{{route('new_admission.view', $student->id)}}">{{$student->student_unique_id}}</a></td>
                                                @if($student->ref_no == '')
                                                    <td>N/A</td>
                                                    @else
                                                    <td>{{$student->ref_no}}</td>
                                                    @endif
                                                <td>{{$student->first_name." ".$student->last_name}}</td>
                                                <td>{{$student->classes->create_class}}</td>
                                                <td>
                                                @if ($student->section == "")
                                                    {{'Not Assign'}}
                                                @else
                                                    {{$student->section_data->section}}
                                                @endif

                                               </td>
                                                <td></td>
                                                <td>{{$student->created_at->format('d F Y')}}</td>
                                                <td>
{{--                                                    <a href="{{route('new_admission.view', $student->id)}}" class="btn btn-sm btn-primary">View</a>--}}

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
                                                                            <select name="section" id="section" class="form-control">
                                                                                <option>-SELECT Section-</option>
                                                                                @foreach($student->classes->section as $section)
                                                                                    <option value="{{ $section->id }}">{{ $section->section }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <label for="first-name-column">Create Section</label>
                                                                        </div>
                                                                        <button class="btn btn-success btn-sm pull-right" type="submit">Submit</button>
                                                                    </form>
                                                                </div>

                                                                <!-- Modal footer -->
{{--                                                                <div class="modal-footer">--}}
{{--                                                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>--}}
{{--                                                                </div>--}}

                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(empty($student->fee->fee))
                                                        <a href="{{url('/admission_fee_create/'. $student->id)}}" class="btn btn-sm btn-success">Annual Fee</a>
                                                    @else
                                                        <a href="{{url('/admission_fee_edit/'. $student->fee->id)}}" class="btn btn-sm btn-warning">Edit Annual Fee</a>
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
        function classFiler() {
        var school_id = $('#school_id').val();
        var class_id = $('#class').val();
        var section = $('#section').val();
         // alert(section);
        $.ajax({
            type: "get",
            url: "/fetch_new_admission_class",
            data:{school_id: school_id, class_id: class_id, section: section},

            success: function(data){
                console.log(data);
                $("#class_filter").empty();
                $.each(data, function(key, value)
                {
                    @if(auth()->user()->role->name == "super_admin")
                    $("#class_filter").append('<tr>' +
                        '<td scope="row">' + (key + 1) + '</td>'+
                        '<td>' + value.school.full_name + '</td>'+
                        '<td><a href="/new_admission/'+ value.id + '/view">' + value.student_unique_id + '</a></td>'+
                        '<td>' + value.ref_no + '</td>'+
                        '<td>' + value.first_name +" "+ value.last_name +'</td>'+
                        '<td>' + value.classes.create_class + '</td>'+
                        '<td>' + value.section_data.section + '</td>'+
                        '<td></td>'+
                        '<td>' + value.created_at + '</td>'+
                        // '<td><a href="#" data-toggle="modal" data-target="#myModal'+value.id+'" class="btn btn-sm btn-primary">Assign Section</a>'+(value.fee.fee == null ? '<a href="/admission_fee_create/'+ value.id + '" class="btn btn-sm btn-success"">Admission Fee</a>' : '<a href="/admission_fee_edit/'+ value.fee.id + '" class="btn btn-sm btn-warning">Edit Admission Fee</a>')  +' </td>'+
                        '<td><a href="#" data-toggle="modal" data-target="#myModal'+value.id+'" class="btn btn-sm btn-primary">Assign Section</a>' +
                        '<div class="modal" id="myModal'+value.id+'">' +
                        '<div class="modal-dialog">' +
                        '<div class="modal-content">' +
                        '<div class="modal-header">' +
                        '<h4 class="modal-title">Assign Section</h4>' +
                        '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
                        '</div>' +
                        '<div class="modal-body">'+
                        '<form class="form" method="POST" action="/assign_section/'+ value.id+'">'+
                        '<div class="form-label-group">'+
                        '<select name="section" id="section" class="form-control">'+
                        '<option>-SELECT Section-</option>'+
                        '<option value="'+ value.id +'">'+ value.section +'</option>'+
                        '</select>'+
                        '<label for="first-name-column">Create Section</label>'+
                        '</div>'+
                        '<button class="btn btn-success btn-sm pull-right" type="submit">Submit</button>'+
                        '</form>'+
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'+(value.fee.fee == null ? '<a href="/admission_fee_create/'+ value.id + '" class="btn btn-sm btn-success"">Admission Fee</a>' : '<a href="/admission_fee_edit/'+ value.fee.id + '" class="btn btn-sm btn-warning">Edit Admission Fee</a>')  +' </td>'+
                        '</tr>');
                    @else
                    $("#class_filter").append('<tr>' +
                        '<td scope="row">' + (key + 1) + '</td>'+
                        '<td><a href="/new_admission/'+ value.id + '/view">' + value.student_unique_id + '</a></td>'+
                        '<td>' + value.ref_no + '</td>'+
                        '<td>' + value.first_name +" "+ value.last_name +'</td>'+
                        '<td>' + value.classes.create_class + '</td>'+
                        '<td>' + value.section_data.section + '</td>'+
                        '<td></td>'+
                        '<td>' + value.created_at + '</td>'+
                        '<td><a href="#" data-toggle="modal" data-target="#myModal'+value.id+'" class="btn btn-sm btn-primary">Assign Section</a>'+(value.fee.fee == null ? '<a href="/admission_fee_create/'+ value.id + '" class="btn btn-sm btn-success"">Admission Fee</a>' : '<a href="/admission_fee_edit/'+ value.fee.id + '" class="btn btn-sm btn-warning">Edit Admission Fee</a>')  +' </td>'+
                        '</tr>');
                {{--<div class="modal" id="myModal{{$student->id}}">--}}
                {{--    <div class="modal-dialog">--}}
                {{--    <div class="modal-content">--}}

                {{--    <!-- Modal Header -->--}}
                {{--    <div class="modal-header"><h4 class="modal-title">Assign Section</h4><button type="button" class="close" data-dismiss="modal">&times;</button></div>--}}

                {{--<!-- Modal body -->--}}
                {{--<div class="modal-body">--}}
                {{--    <form class="form" method="POST" action="{{ url('/assign_section/'.$student->id) }}">--}}
                {{--    @csrf--}}
                {{--    <div class="form-label-group">--}}
                {{--    <select name="section" id="section" class="form-control">--}}
                {{--    <option>-SELECT Section-</option>--}}
                {{--@foreach($student->classes->section as $section)--}}
                {{--<option value="{{ $section->id }}">{{ $section->section }}</option>--}}
                {{--    @endforeach--}}
                {{--    </select>--}}
                {{--    <label for="first-name-column">Create Section</label>--}}
                {{--</div>--}}
                {{--<button class="btn btn-success btn-sm pull-right" type="submit">Submit</button>--}}
                {{--    </form>--}}
                {{--    </div>--}}
                {{--    </div>--}}
                {{--    </div>--}}
                {{--    </div>--}}
                    @endif

                });
            }
        });
        }
    </script>
    @endpush
