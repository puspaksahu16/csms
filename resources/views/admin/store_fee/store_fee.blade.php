@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/plugins/forms/wizard.min.css') }}">
    <script src="{{ asset('admin_assets/js/scripts/forms/wizard-steps.min.js') }}"></script>
    <style>
        .btn{
            color: #fffdfd;
            background-color: #7b7b7d;
            border: 2px solid #7367f0;
            }
    </style>
@endpush
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Store Fee</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Store Fee</a>
                                    </li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <div class="content-body"><!-- Basic Horizontal form layout section start -->

                <section id="multiple-column-form">
                    <div class="row match-height">

                            <div class="col-12">
                                <div class="card">

                                    <div class="card-content">
                                        <div class="card-body">

                                            <div class="form-body">
                                                <div class="row">

{{--                                                    Wizard start                      --}}

                                                    <div class="container">
                                                        <div class="stepwizard">
                                                            <div class="stepwizard-row setup-panel">
                                                                <div class="stepwizard-step">
                                                                    <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                                                    <p>Product Fee</p>
                                                                </div>
                                                                <div class="stepwizard-step">
                                                                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                                                    <p>Book</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form class="form" method="POST" action="{{url('store_fee_store/'.$id)}}">
                                                            @csrf

                                                            <div class="row setup-content" id="step-1">
                                                                <div class="card-header">
                                                                    <h4 class="card-title">Product Fee</h4>
                                                                </div>
                                                                <div class="container">
                                                                    <br/><br/>
                                                                    <div class="row">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped mb-0">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th scope="col">#</th>
                                                                                    <th scope="col">Product Name</th>
                                                                                    <th scope="col">Color</th>
                                                                                    <th scope="col">Type</th>
                                                                                    <th scope="col">Size</th>
                                                                                    <th scope="col">Gender</th>
                                                                                    <th scope="col">Price</th>
                                                                                    <th scope="col">Quantity</th>
                                                                                    <th scope="col">Available</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                @foreach($products as $key => $p)
                                                                                    <tr>
                                                                                        <td>
                                                                                            <div class="custom-control custom-checkbox">
                                                                                                <input type="checkbox" class="custom-control-input" checked="" name="product[{{$key}}][id]" value="{{ $p->id }}" id="{{$key}}">
                                                                                                <label class="custom-control-label" for="{{$key}}"></label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>{{!empty($p->products->name) ? $p->products->name : "--"}}</td>
                                                                                        <td>{{!empty($p->colors->name) ? $p->colors->name : "--"}}</td>
                                                                                        <td>{{!empty($p->types->name) ? $p->types->name : "--"}}</td>
                                                                                        <td>{{!empty($p->sizes->name) ? $p->sizes->name : "--"}}</td>
                                                                                        <td>{{!empty($p->gender_id) ? $p->gender_id == 1 ? "Boys" : "Girls" : "--"}}</td>
                                                                                        <td>{{!empty($p->price) ? $p->price.'/-' : "--/-"}}</td>
                                                                                        <td>
                                                                                            <a id="negative-{{$key}}" onclick="negative(this.id)" class="btn btn-sm btn-danger">-</a>
                                                                                            <input readonly value="{{ !empty($p->quantity) ? $p->quantity : "1" }}" style="width:23% !important;" class="form-control" id="quantity-{{$key}}" name="product[{{$key}}][quantity]" >
                                                                                            <a id="positive-{{$key}}" onclick="positive(this.id)" class="btn btn-sm btn-success">+</a>
                                                                                        </td>
                                                                                        <td>{{!empty($p->available_stocks) ? $p->available_stocks : "not available"}}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn btn-primary nextBtn pull-right" type="button" >Next</button>
                                                                </div>
                                                            </div>

                                                            <div class="row setup-content" id="step-2">
                                                                <div class="card-header">
                                                                    <h4 class="card-title">Book</h4>
                                                                </div>
                                                                <div class="container">
                                                                    <br/><br/>
                                                                    <div class="row">
                                                                        <table class="table table-striped mb-0" id="">
                                                                            <thead>
                                                                            <tr>

                                                                                <th scope="col">#</th>
                                                                                <th scope="col">Book Name</th>
                                                                                <th scope="col">class</th>
                                                                                <th scope="col">Subject</th>
                                                                                <th scope="col">Publisher</th>
                                                                                <th scope="col">Available</th>

                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            @foreach($book as $key => $b)
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class="custom-control-input" checked="" name="book[]" value="{{ $b->id }}" id="{{$b->name.$key}}">
                                                                                            <label class="custom-control-label" for="{{$b->name.$key}}"></label>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>{{!empty($b->name) ? $b->name : "--"}}</td>
                                                                                    <td>{{!empty($b->classes->create_class) ? $b->classes->create_class : "--"}}</td>
                                                                                    <td>{{!empty($b->subject->name) ? $b->subject->name : "--"}}</td>
                                                                                    <td>{{!empty($b->publisher->name) ? $b->publisher->name : "--"}}</td>
                                                                                    <td>{{!empty($b->price) ? $b->price : "--"}}</td>
                                                                                    <td>{{$b->available_stocks}}</td>

                                                                                </tr>
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <button class="btn btn-success pull-right waves-effect waves-light" type="Submit" >Finish</button>
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>
{{--                                                    Wizard end                       --}}
                                                </div>
                                            </div>
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
    <script>
        function negative(id) {
            var key = id.split("-");
            var quantity = $('#quantity-'+key[1]).val();
            if(quantity == 1)
            {
                alert('Minimum Quantity is 1');
            }else{
                $('#quantity-'+key[1]).val(quantity - 1);
            }
        }
        function positive(id) {
            var key = id.split("-");
            var quantity = $('#quantity-'+key[1]).val();

            $('#quantity-'+key[1]).val(parseInt(quantity) + 1);
            // if(quantity == 1)
            // {
            //     alert('Minimum Quantity is 1');
            // }else{
            //     $('#quantity-'+key[1]).val(quantity - 1);
            // }
        }
        function permanent() {
            var a = $('#is_same').is(':checked') ? 1 : 0;
            if (a == 0)
            {
                $('#permanent').css('display', 'block');
            }
            else
            {
                $('#permanent').css('display', 'none');
            }
            // alert(a);
        }
        function pic(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#p1')
                        .attr('src', e.target.result)
                        .width(130)
                        .height(150);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        function pic2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#p2')
                        .attr('src', e.target.result)
                        .width(130)
                        .height(150);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        function yesnoCheck(that) {
            if (that.value == "yes") {
                // alert("check");
                document.getElementById("ifYes").style.display = "block";
            } else {
                document.getElementById("ifYes").style.display = "none";
            }
        }
    </script>
    <script src="{{ asset('admin_assets/vendors/js/extensions/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
@endpush
