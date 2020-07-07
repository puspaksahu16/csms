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
                            {{--                            <h2 class="content-header-title float-left mb-0">Pre Admission</h2>--}}
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Fees Structure</a>
                                    </li>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">General Fee</a>
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
                                <h4 class="card-title">General Fee</h4>

                                <a class="btn btn-primary" href="{{url('/general/create')}}">Add General Fee</a>
                            </div>
                            <div class="card-content">

                                <div class="table-responsive">
                                    <table class="table zero-configuration">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Fee Name</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($general as $key => $generals)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$generals->name}}</td>
                                                <td>{{$generals->classes->create_class}}</td>
                                                <td>{{$generals->price}}</td>
                                                @if($generals->type == '1')
                                                    <td>Annually</td>
                                                @else
                                                    <td>Monthly</td>
                                                @endif

                                                @if($generals->is_active == '1')
                                                    <td><button class="btn-info">Active</button></td>
                                                @else
                                                    <td><button class="btn-danger">Inactive</button></td>
                                                @endif
                                                <td><a href="{{route('general.edit', $generals->id)}}" class="btn btn-primary">Edit</a></td>
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
