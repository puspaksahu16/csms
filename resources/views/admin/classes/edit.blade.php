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
                            <h2 class="content-header-title float-left mb-0">General Setting</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Class</a>
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
                                    <h4 class="card-title">Class Setting</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" method="POST" action="{{route('classes.update', $classes->id)}}">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <div class="col-md-4 col-12">
                                                            <div class="form-label-group">
                                                                <select name="school_id" class="form-control">
                                                                    <option>-SELECT School-</option>

                                                                    @foreach($schools as $school)
                                                                        <option {{ $classes->school->id == $classes->school_id ? "selected" : " " }} value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endif
                                                        <div class="col-md-4 col-12">
                                                            <div class="form-label-group">
                                                                <select type="text" id="standard_id" class="form-control"  name="standard_id">
                                                                    <option value="">-Select Standard-</option>
                                                                    @foreach($standards as $standard)
                                                                        <option  {{ $standard->id == $classes->standard_id ? "selected" : " " }} value="{{ $standard->id }}">{{ $standard->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="standard">Standard</label>
                                                            </div>
                                                        </div>
                                                    <div class="col-md-4 col-12">
                                                        <div class="form-label-group">
{{--                                                            <input type="text" id="create_class" class="form-control" placeholder="Class Name" name="create_class"  value="{{$classes->create_class}}">--}}
                                                            <select name="create_class" class="form-control">
                                                                <option>-SELECT Class-</option>
                                                                @foreach($set_classes as $set_class )
                                                                    <option {{ $set_class->name == $classes->create_class ? "selected" : " " }}  value="{{ $set_class->name }}">{{ $set_class->name }}</option>
                                                                @endforeach

                                                            </select>
                                                            <label for="first-name-column">Class Name</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <input type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" value="Submit">

                                                        <a href="{{url('/classes')}}"><input type="button" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" value="Back"></a>
                                                    </div>

                                                </div>




                                            </div>

                                        </form>
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
