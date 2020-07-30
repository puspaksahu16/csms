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
                            <h2 class="content-header-title float-left mb-0">Create Period</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Create Period</a>
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
                                    <h4 class="card-title">Period Setting</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" method="POST" action="{{route('period.store')}}">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                           <input type="text" name="period_name" class="form-control">
                                                            <label for="first-name-column">Period Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <select type="text" class="form-control"  name="standard_id">
                                                                <option value="">-Select Standard-</option>
                                                                @foreach($standards as $standard)
                                                                    <option value="{{ $standard->id }}">{{ $standard->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <label for="standard">Standard</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <input type="time" name="time_from" class="form-control">
                                                            <label for="first-name-column">Time From</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <input type="time" name="time_to" class="form-control">
                                                            <label for="first-name-column">Time To</label>
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
                                <h4 class="card-title">Period List</h4>

                            </div>
                            <div class="card-content">

                                <div class="table-responsive">
                                    <table class="table zero-configuration" id="">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Period</th>
                                            <th scope="col">Standard</th>
                                            <th scope="col">Time From</th>
                                            <th scope="col">Time To</th>
                                            <th scope="col">Action</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($periods as $key => $period)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                <th>{{$period->period_name}}</th>
                                                <th>{{$period->standards->name}}</th>
                                                <th>{{$period->time_from}}</th>
                                                <th>{{$period->time_to}}</th>
                                                <td><a href="{{route('period.edit', $period->id)}}" class="btn btn-sm btn-primary">Edit</a></td>
                                                <td><a href="period_delete/{{$period->id}}" class="btn btn-sm btn-danger">Delete</a></td>
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