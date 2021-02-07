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
                        @if(is_array(session()->get('error')))
                            <ul>
                                @foreach (session()->get('error') as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        @else
                            {{ session()->get('error') }}
                        @endif
                    </div>
                @endif
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Assign Class Teacher</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Assign Class Teacher</a>
                                    </li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body"><!-- Basic Horizontal form layout section start -->

                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Assign Class Teacher</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" method="POST" action="{{route('assign_teacher.store')}}">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <div class="col-md-3 col-12">
                                                            <div class="form-label-group">
                                                                <select id="school_id" onchange="getClass()" name="school_id" class="form-control">
                                                                    <option value="">-SELECT School-</option>

                                                                    @foreach($schools as $school)
                                                                        <option value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                    @endforeach

                                                                </select>
                                                                <span style="color: red">{{ $errors->first('school_id') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-12">
                                                            <div class="form-label-group">
                                                                <select disabled="true" onchange="getSection(this.value)" type="text" id="class_id" class="form-control"  name="class_id">
                                                                    <option value="">-Select Class-</option>

                                                                </select>
                                                                <label for="standard">Class</label>
                                                                <span style="color: red">{{ $errors->first('class_id') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-12">
                                                            <div class="form-label-group">
                                                                <select id="section" name="section_id" class="form-control">
                                                                    <option  value="">-Select Section-</option>

                                                                </select>
                                                                <label for="name">Section</label>
                                                                <span style="color: red">{{ $errors->first('section_id') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-12">
                                                            <div class="form-label-group">
                                                                <select disabled="disabled" name="employee_id" id="employee_id" class="form-control">
                                                                    <option value="">-Select Teacher-</option>

                                                                </select>
                                                                <label for="teacher">Teacher Name</label>
                                                                <span style="color: red">{{ $errors->first('employee_id') }}</span>
                                                            </div>
                                                        </div>
                                                    @endif


                                                        @if(auth()->user()->role->name == "admin")
                                                            <div class="col-md-4 col-12">
                                                                <div class="form-label-group">
                                                                    <select type="text" onchange="getSection(this.value)" id="class_id" class="form-control"  name="class_id">
                                                                        <option value="">-Select Class-</option>
                                                                        @foreach($classes as $class)
                                                                        <option  {{ (old('class_id') ==  $class->id  ? "selected" : '') }} value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <label for="standard">Class</label>
                                                                    <span style="color: red">{{ $errors->first('class_id') }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <div class="form-label-group">
                                                                    <select id="section" name="section_id" class="form-control">
                                                                        <option  value="">-Select Section-</option>

                                                                    </select>
                                                                    <label for="name">Section</label>
                                                                    <span style="color: red">{{ $errors->first('section_id') }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <div class="form-label-group">
                                                                    <select  name="employee_id" id="employee_id" class="form-control">
                                                                        <option value="">-Select Teacher-</option>
                                                                        @foreach($employees as $employee )
                                                                            <option {{ (old('employee_id') ==  $employee->id  ? "selected" : '') }} value="{{ $employee->id }}"  style="text-transform: uppercase">{{  $employee->first_name." ".$employee->last_name }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                    <label for="teacher">Teacher Name</label>
                                                                    <span style="color: red">{{ $errors->first('employee_id') }}</span>
                                                                </div>
                                                            </div>
                                                        @endif


                                                    <div class="col-4">
                                                        <input type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" value="Submit">

                                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
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
            <div class="content-body"><!-- Basic Horizontal form layout section start -->

                <div class="row" id="table-striped">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Teacher List</h4>

                            </div>
                            <div class="container">
{{--                                <form class="form" action="{{url('/fetch_class_table')}}" method="get">--}}
{{--                                    @csrf--}}
{{--                                    <div class="row">--}}
{{--                                        @if(auth()->user()->role->name == "super_admin")--}}
{{--                                            <div class="col-md-4 col-12">--}}
{{--                                                <div class="form-label-group">--}}
{{--                                                    <select id="school" onchange="getStd()" name="school_id" class="form-control">--}}
{{--                                                        <option value="">-SELECT School-</option>--}}

{{--                                                        @foreach($schools as $school)--}}
{{--                                                            <option value="{{ $school->id }}">{{ $school->full_name }}</option>--}}
{{--                                                        @endforeach--}}

{{--                                                    </select>--}}

{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                            <div class="col-md-4 col-12">--}}
{{--                                                <div class="form-label-group">--}}
{{--                                                    <select disabled="true" onchange="standardFiler()" type="text" id="standard" class="form-control"  name="standard_id">--}}
{{--                                                        <option value="">-Select Standard-</option>--}}
{{--                                                        @foreach($standards as $standard)--}}
{{--                                                        <option value="{{ $standard->id }}">{{ $standard->name }}</option>--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}

{{--                                    </div>--}}
{{--                                </form>--}}
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
                                            <th scope="col">Class</th>
                                            <th scope="col">Section</th>
                                            <th scope="col">Teacher</th>
                                            <th scope="col">Action</th>
{{--                                            <th></th>--}}
                                        </tr>
                                        </thead>
                                        <tbody id="std_filter">
                                        @foreach($assign_teachers as $key => $assign_teacher)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                @if(auth()->user()->role->name == "super_admin")
                                                <th>{{$assign_teacher->school->full_name}}</th>
                                                @endif
                                                <th>{{$assign_teacher->class->create_class}}</th>
                                                <th>{{$assign_teacher->section->section}}</th>
                                                <th>{{$assign_teacher->employee->first_name." ".$assign_teacher->employee->last_name}}</th>
                                                <td><a href="{{route('assign_teacher.edit', $assign_teacher->id)}}" class="btn btn-sm btn-primary">Edit</a></td>
{{--                                                <td><a href="classes_delete/{{$classes->id}}" class="btn btn-sm btn-danger">Delete</a></td>--}}
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
                    $("#class_id").attr('disabled', false);
                    $("#class_id").empty();
                    $("#class_id").append('<option value="">-Select Class-</option>');
                    $.each(response,function(key, value)
                    {
                        $("#class_id").append('<option value=' + key + '>' + value + '</option>');
                    });

                }
            });

            $.ajax({
                url : "/get_assign_employee/"+school_id,
                type:'get',
                success: function(response) {
                    console.log(response);
                    $("#employee_id").attr('disabled', false);
                    $("#employee_id").empty();
                    $("#employee_id").append('<option value="">-Select Teacher-</option>');
                    $.each(response,function(key, value)
                    {
                        $("#employee_id").append('<option value=' + value.id + ' style="text-transform: uppercase">' + value.first_name + " " + value.last_name + '</option>');
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

    </script>
    @endpush
