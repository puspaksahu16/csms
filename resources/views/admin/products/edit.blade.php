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
                            {{--                            <h2 class="content-header-title float-left mb-0"></h2>--}}
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Store</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Product</a>
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
                    <div class="row match-height ">
                        <div class="col-6" style="margin: auto">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Product</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{route('products.update', $product->id)}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" placeholder="Product Name" name="name" value="{{$product->name}}">
                                                            <label for="name">Product Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" placeholder="Unit" name="unit" value="{{$product->unit}}">
                                                            <label for="name">Unit</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="row pl-4">
                                                            <div class="custom-control custom-checkbox col-md-3">
                                                                <input  {{ 1 == $product->color ? "checked" : " " }}  type="checkbox" class="custom-control-input" value="1" name="color" id="color">
                                                                <label class="custom-control-label" for="color">Color</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox col-md-3">
                                                                <input {{ 1 == $product->type ? "checked" : " " }} type="checkbox" class="custom-control-input" value="1"  name="type" id="type">
                                                                <label class="custom-control-label" for="type">Pages</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox col-md-3">
                                                                <input {{ 1 == $product->size ? "checked" : " " }} type="checkbox" class="custom-control-input" value="1" name="size" id="size">
                                                                <label class="custom-control-label" for="size">Size</label>
                                                            </div>
                                                            <div class="custom-control custom-checkbox col-md-3">
                                                                <input {{ 1 == $product->gender ? "checked" : " " }} type="checkbox" class="custom-control-input" value="1" name="gender" id="gender">
                                                                <label class="custom-control-label" for="gender">Gender</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 pt-2">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                        <a href="{{ url()->previous() }}" class="btn btn-outline-warning mr-1 mb-1">Back</a>
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
    <script src="{{asset('admin_assets/vendors/js/vendors.min.js') }}"></script>
@endpush
