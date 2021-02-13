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
                            <h2 class="content-header-title float-left mb-0">Assign Class</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Assign Class</a>
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
                                    <h4 class="card-title">Class Assign</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" method="POST" action="{{route('classes.store')}}">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <div class="col-md-4 col-12">
                                                            <div class="form-label-group">
                                                                <select id="school_id" onchange="getStandard()" name="school_id" class="form-control">
                                                                    <option value="">-SELECT School-</option>

                                                                    @foreach($schools as $school)
                                                                        <option value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                    @endforeach

                                                                </select>
                                                                <span style="color: red">{{ $errors->first('school_id') }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 col-12">
                                                            <div class="form-label-group">
                                                                <select disabled="true" type="text" id="standard_id" class="form-control"  name="standard_id">
                                                                    <option value="">-Select Standard-</option>
                                                                    {{--@foreach($standards as $standard)--}}
                                                                    {{--<option value="{{ $standard->id }}">{{ $standard->name }}</option>--}}
                                                                    {{--@endforeach--}}
                                                                </select>
                                                                <label for="standard">Standard</label>
                                                                <span style="color: red">{{ $errors->first('standard_id') }}</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                        @if(auth()->user()->role->name == "admin")
                                                            <div class="col-md-4 col-12">
                                                                <div class="form-label-group">
                                                                    <select type="text" class="form-control"  name="standard_id">
                                                                        <option value="">-Select Standard-</option>
                                                                        @foreach($standards as $standard)
                                                                        <option  {{ (old('standard_id') ==  $standard->id  ? "selected" : '') }} value="{{ $standard->id }}">{{ $standard->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <label for="standard">Standard</label>
                                                                    <span style="color: red">{{ $errors->first('standard_id') }}</span>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    <div class="col-md-4 col-12">
                                                        <div class="form-label-group">
                                                            <select name="create_class" class="form-control">
                                                                <option value="">-SELECT Class-</option>
                                                                @foreach($set_classes as $set_class )
                                                                    <option {{ (old('create_class') ==  $set_class->name  ? "selected" : '') }} value="{{ $set_class->name }}"  style="text-transform: uppercase">{{ $set_class->name }}</option>
                                                                @endforeach

                                                            </select>
                                                            <label for="first-name-column">Class Name</label>
                                                            <span style="color: red">{{ $errors->first('create_class') }}</span>
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
                <!-- // Basic Floating Label Form section end -->


            </div>
            <div class="content-body"><!-- Basic Horizontal form layout section start -->

                <div class="row" id="table-striped">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Class List</h4>

                            </div>
                            <div class="container">
                                <form class="form" action="{{url('/fetch_class_table')}}" method="get">
                                    @csrf
                                    <div class="row">
                                        @if(auth()->user()->role->name == "super_admin")
                                            <div class="col-md-4 col-12">
                                                <div class="form-label-group">
                                                    <select id="school" onchange="getStd()" name="school_id" class="form-control">
                                                        <option value="">-SELECT School-</option>

                                                        @foreach($schools as $school)
                                                            <option value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                        @endforeach

                                                    </select>

                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <div class="form-label-group">
                                                    <select disabled="true" onchange="standardFiler()" type="text" id="standard" class="form-control"  name="standard_id">
                                                        <option value="">-Select Standard-</option>
                                                        {{--@foreach($standards as $standard)--}}
                                                        {{--<option value="{{ $standard->id }}">{{ $standard->name }}</option>--}}
                                                        {{--@endforeach--}}
                                                    </select>
                                                </div>
                                            </div>
                                        @endif

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
                                                <th scope="col">School Name</th>
                                            @endif
                                            <th scope="col">Standard</th>
                                            <th scope="col">Class Name</th>
                                            <th scope="col">Action</th>
{{--                                            <th></th>--}}
                                        </tr>
                                        </thead>
                                        <tbody id="std_filter">
                                        @foreach($classes as $key => $classes)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                @if(auth()->user()->role->name == "super_admin")
                                                <th>{{$classes->school->full_name}}</th>
                                                @endif
                                                <th>{{$classes->standard->name}}</th>
                                                <th>{{$classes->create_class}}</th>
                                                <td><a href="{{route('classes.edit', $classes->id)}}" class="btn btn-sm btn-primary">Edit</a></td>
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
        function getStandard() {
            var school_id = $('#school_id').val();
            // alert(csrf);
            $.ajax({
                url : "/get_standard/"+school_id,
                type:'get',
                success: function(response) {
                    console.log(response);
                    $("#standard_id").attr('disabled', false);
                    $("#standard_id").empty();
                    $("#standard_id").append('<option value="">-Select Standard-</option>');
                    $.each(response,function(key, value)
                    {
                        $("#standard_id").append('<option value=' + key + '>' + value + '</option>');
                    });

                }
            });
        }



        function getStd() {
            var school_id = $('#school').val();
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

        function standardFiler() {
            var school_id = $('#school').val();
            var standard_id = $('#standard').val();
            // alert(class_id);
            $.ajax({
                type: "get",
                url: "/fetch_classby_standard",
                data:{school_id: school_id, standard_id: standard_id},

                success: function(data){
                    console.log(data);
                    $("#std_filter").empty();
                    $.each(data, function(key, value)
                    {

                        $("#std_filter").append('<tr>' +
                            '<td scope="row">' + (key + 1) + '</td>'+
                            '<td>' + value.school.full_name + '</td>'+
                            '<td>' + value.standard.name + '</td>'+
                            '<td>' + value.create_class + '</td>'+
                            '<td><a href="classes/'+ value.id + '/edit" class="btn btn-primary btn-sm">Edit</a></td>'+

                            '</tr>');
                    });
                }
            });
        }
    </script>

    <script src="{{asset('admin_assets/vendors/js/vendors.min.js') }}"></script>
@endpush
