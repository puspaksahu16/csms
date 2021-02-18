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
                                <h4 class="card-title">Products Stock</h4>
                                <a class="btn btn-primary" href="{{url('/stocks/create')}}">Add</a>
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
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Color</th>
                                            <th scope="col">Pages</th>
                                            <th scope="col">Size</th>

                                            <th scope="col">Stock in</th>
                                            <th scope="col">Stock out</th>
                                            <th scope="col">Available</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($stocks as $key => $stock)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                @if(auth()->user()->role->name == "super_admin")
                                                <td>{{!empty($stock->schools->full_name) ? $stock->schools->full_name : "--"}}</td>
                                                @endif
                                                <td>{{!empty($stock->products->name) ? $stock->products->name : "--"}}</td>
                                                <td>{{!empty($stock->gender_id) ? $stock->gender_id == 1 ? "Boys" : "Girls" : "--"}}</td>
                                                <td>{{!empty($stock->colors->name) ? $stock->colors->name : "--"}}</td>
                                                <td>{{!empty($stock->types->name) ? $stock->types->name : "--"}}</td>
                                                <td>{{!empty($stock->sizes->name) ? $stock->sizes->name : "--"}}</td>

                                                <td>{{!empty($stock->stock_in) ? $stock->stock_in : "--"}}</td>
                                                <td>{{empty($stock->stock_out) ? 0 : $stock->stock_out}}</td>
                                                <td>{{$stock->available_stocks}}</td>
                                                <td><a class="btn btn-warning btn-sm" href="{{ route('stocks.edit', $stock->id) }}">Remove last In</a></td>
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
    <script src="{{asset('admin_assets/vendors/js/vendors.min.js') }}"></script>
@endpush
