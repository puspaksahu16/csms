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
                            <h2 class="content-header-title float-left mb-0">Assign Section</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Assign Section</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body"><!-- Basic Horizontal form layout section start -->

                <section id="multiple-column-form">
                    <div class="row match-height">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Section Assign</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" method="POST" action="{{route('section.store')}}">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <div class="col-md-4 col-12">
                                                            <div class="form-label-group">
                                                                <select name="school_id"  id="school_id" onchange="getClass()" class="form-control">
                                                                    <option value="">-SELECT School-</option>
                                                                    @foreach($schools as $school)
                                                                        <option {{ (old('school_id') == $school->id ? "selected" : '') }} value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                    @endforeach

                                                                </select>
                                                                <span style="color: red">{{ $errors->first('school_id') }}</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="col-md-4 col-12">
                                                        <div class="form-label-group">
                                                            <select name="class_id"  id="class" class="form-control">
                                                                <option value="">-SELECT CLASS-</option>
                                                                @if(auth()->user()->role->name == "admin")
                                                                @foreach($classes as $class)
                                                                    <option  {{ (old('class_id') == $class->id ? "selected" : '') }} value="{{ $class->id }}" style="text-transform: uppercase">{{ $class->create_class }}</option>
                                                                @endforeach
                                                                    @endif
                                                            </select>
                                                            <span style="color: red">{{ $errors->first('class_id') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        <div class="form-label-group">
                                                            <select name="section" class="form-control">
                                                                <option value="">-SELECT Section-</option>
                                                                @foreach($set_sections as $set_section)
                                                                    <option  {{ (old('section') == $set_section->name ? "selected" : '') }} value="{{ $set_section->name }}" style="text-transform: uppercase">{{ $set_section->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <label for="first-name-column">Create Section</label>
                                                            <span style="color: red">{{ $errors->first('section') }}</span>
                                                        </div>
                                                    </div>
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

                <div class="row" id="table-striped">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Section List</h4>
                            </div>
                            <div class="card-content">

                                <div class="table-responsive">
                                    <table class="table table-striped mb-0 zero-configuration">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            @if(auth()->user()->role->name == "super_admin")
                                                <th>School</th>
                                            @endif
                                            <th scope="col">Class</th>
                                            <th scope="col">Section</th>
                                            <th scope="col">Action</th>
{{--                                            <th></th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($section as $key => $section)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                @if(auth()->user()->role->name == "super_admin")
                                                    <th>{{$section->school->full_name}}</th>
                                                @endif
                                                <th>{{$section->class->create_class}}</th>
                                                <th>{{$section->section}}</th>
                                                <td><a href="{{route('section.edit', $section->id)}}" class="btn btn-sm btn-primary">Edit</a></td>
{{--                                                <td><a href="section_delete/{{$section->id}}" class="btn btn-sm btn-danger">Delete</a></td>--}}
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
