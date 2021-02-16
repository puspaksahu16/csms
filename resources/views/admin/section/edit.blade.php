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
                            <h2 class="content-header-title float-left mb-0">Modify Section</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Modify Section</a>
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
                                    <h4 class="card-title">Modify Setting</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" method="POST" action="{{route('section.update', $section->id)}}">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <div class="col-md-4 col-12">
                                                            <div class="form-label-group">
                                                                <select name="school_id"  id="school_id" onchange="getClass()"  class="form-control">
                                                                    <option>-SELECT School-</option>

                                                                    @foreach($schools as $school)
                                                                        <option {{ $school->id == $section->school_id  ? "selected" : " " }} value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-12">
                                                            <div class="form-label-group">
                                                                <select name="class_id" id="class" class="form-control">
                                                                    <option>-SELECT CLASS-</option>

                                                                    @foreach($classes as $class)
                                                                        <option {{ $class->id == $section->class_id  ? "selected" : " " }} value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                        @elseif(auth()->user()->role->name == "admin")
                                                        <div class="col-md-4 col-12">
                                                            <div class="form-label-group">
                                                                <select name="class_id" id="class" class="form-control">
                                                                    <option>-SELECT CLASS-</option>

                                                                    @foreach($classes as $class)
                                                                        <option {{ $class->id == $section->class_id  ? "selected" : " " }} value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endif


                                                    <div class="col-md-4 col-12">
                                                        <div class="form-label-group">
                                                            <select name="section" class="form-control">
                                                                <option>-SELECT Section-</option>
                                                                @foreach($set_sections as $set_section)
                                                                    <option {{ $set_section->name == $section->section  ? "selected" : " " }}  value="{{ $set_section->name }}">{{ $set_section->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <label for="first-name-column">Create Section</label>
                                                        </div>
                                                    </div>





                                                    <div class="col-4">
                                                        <input type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" value="Submit">
                                                        <a href="{{url('/section')}}"><input type="button" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" value="Back"></a>

                                                    </div>

                                                </div>




                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>










                        </div>
                </section>
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
    </script>
    <script src="{{asset('admin_assets/vendors/js/vendors.min.js') }}"></script>
@endpush
