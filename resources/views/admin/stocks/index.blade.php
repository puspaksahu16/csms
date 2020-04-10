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
                            {{--                            <h2 class="content-header-title float-left mb-0">Pre Admission</h2>--}}
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Store</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Stock</a>
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
                                <h4 class="card-title">Stocks</h4>
                                <a class="btn btn-primary" href="{{url('/stocks/create')}}">Add</a>
                            </div>
                            <div class="card-content">

                                <div class="table-responsive">
                                    <table class="table zero-configuration" id="">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Color</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Stock in</th>
                                            <th scope="col">Stock out</th>
                                            <th scope="col">Available</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($stocks as $key => $stock)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{!empty($stock->products->name) ? $stock->products->name : "--"}}</td>
                                                <td>{{!empty($stock->colors->name) ? $stock->colors->name : "--"}}</td>
                                                <td>{{!empty($stock->types->name) ? $stock->types->name : "--"}}</td>
                                                <td>{{!empty($stock->sizes->name) ? $stock->sizes->name : "--"}}</td>
                                                <td>{{!empty($stock->gender_id) ? $stock->gender_id == 1 ? "Boys" : "Girls" : "--"}}</td>
                                                <td>{{!empty($stock->stock_in) ? $stock->stock_in : "--"}}</td>
                                                <td>{{empty($stock->stock_out) ? 0 : $stock->stock_out}}</td>
                                                <td>{{$stock->available_stocks}}</td>
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
