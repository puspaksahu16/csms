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
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Store</a>
                                    </li>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Damage Stock</a>
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
                                <h4 class="card-title">Damage Stocks</h4>
                                <a class="btn btn-primary" href="{{url('/damages/create')}}">Add</a>
                            </div>
                            <div class="card-content">

                                <div class="table-responsive">
                                    <table class="table table-striped mb-0" id="damages">
                                        <thead>
                                        <tr>
{{--                                            <th scope="col">#</th>--}}
                                            <th scope="col">Product</th>
                                            <!-- <th scope="col">Unit</th> -->
                                            <th scope="col">Color</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Damage</th>
                                            <!-- <th scope="col">Stock out</th> -->
                                            <!-- <th scope="col">Available</th> -->
                                        </tr>
                                        </thead>
{{--                                        <tbody>--}}
{{--                                        @foreach($damages as $key => $damage)--}}
{{--                                            <tr>--}}
{{--                                                <td>{{$key+1}}</td>--}}
{{--                                                <td>{{empty($damage->products->name) ? "--" : $damage->products->name}}</td>--}}
{{--                                                <td>{{!empty($damage->colors->name) ? $damage->colors->name : "--"}}</td>--}}
{{--                                                <td>{{!empty($damage->types->name) ? $damage->types->name : "--"}}</td>--}}
{{--                                                <td>{{!empty($damage->sizes->name) ? $damage->sizes->name : "--"}}</td>--}}
{{--                                                <td>{{!empty($damage->gender_id) ? $damage->gender_id == 1 ? "Boys" : "Girls" : "--"}}</td>--}}
{{--                                                <td>{{!empty($damage->damage) ? $damage->damage : "--"}}</td>--}}
{{--                                                --}}
{{--                                                <!-- <td>{{$damage->available_stocks}}</td> -->--}}
{{--                                                --}}
{{--                                            </tr>--}}
{{--                                        @endforeach--}}
{{--                                        </tbody>--}}
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
