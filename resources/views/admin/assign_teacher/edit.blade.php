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
                            <h2 class="content-header-title float-left mb-0">Edit</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Assigned Teacher</a>
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
                                    <h4 class="card-title">Edit Assigned Teacher</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" method="POST" action="{{route('assign_teacher.update', $assign_teacher->id)}}">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <div class="col-md-4 col-12">
                                                            <div class="form-label-group">
                                                                <select name="school_id"   onchange="getClass()" id="school_id" class="form-control">
                                                                    <option>-SELECT School-</option>

                                                                    @foreach($schools as $school)
                                                                        <option  {{ $school->id == $assign_teacher->school_id ? "selected" : " " }} value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endif
                                                        <div class="col-md-4 col-12">
                                                            <div class="form-label-group">
                                                                <select  disabled="disabled" type="text" id="class_id" class="form-control"  name="class_id">
                                                                    <option value="">-Select Class-</option>
                                                                    @foreach($classes as $class)
                                                                        <option  {{ $class->id == $assign_teacher->class_id ? "selected" : " " }} value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="standard">Class</label>
                                                            </div>
                                                        </div>
                                                    <div class="col-md-4 col-12">
                                                        <div class="form-label-group">
{{--                                                            <input type="text" id="create_class" class="form-control" placeholder="Class Name" name="create_class"  value="{{$classes->create_class}}">--}}
                                                            <select disabled="disabled" name="employee_id" id="employee_id" class="form-control">
                                                                <option>-Select Teacher-</option>
                                                                @foreach($employees as $employee )
                                                                    <option {{ ($assign_teacher->employee_id ==  $employee->id  ? "selected" : '') }} value="{{ $employee->id }}"  style="text-transform: uppercase">{{ $employee->first_name }}</option>
                                                                @endforeach

                                                            </select>
                                                            <label for="first-name-column">Teacher Name</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <input type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" value="Submit">

                                                        <a href="{{url('/assign_teacher')}}"><input type="button" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" value="Back"></a>
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
        function getClass() {
            var school_id = $('#school_id').val();
            // alert(school_id);
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
                url : "/get_employee/"+school_id,
                type:'get',
                success: function(response) {
                    console.log(response);
                    $("#employee_id").attr('disabled', false);
                    $("#employee_id").empty();
                    $("#employee_id").append('<option value="">-Select Teacher-</option>');
                    $.each(response,function(key, value)
                    {
                        $("#employee_id").append('<option value=' + key + '>' + value + '</option>');
                    });

                }
            });
        }
    </script>
@endpush
