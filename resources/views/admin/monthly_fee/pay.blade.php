@extends('admin.layouts.master')
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
{{--                            <h2 class="content-header-title float-left mb-0"></h2>--}}
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Monthly Fee</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Pay</a>
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
                                    <h4 class="card-title">Pay</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{url('/monthly_payment/'.$id)}}" method="POST">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">

                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <select required onchange="pay_type()" id="payment_methode" name="type" class="form-control">
                                                                <option value="">-SELECT PAY TYPE-</option>
                                                                <option value="1">Cash</option>
                                                                <option value="2">Online</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text"  style="display: none" class="form-control" id="transaction_id" placeholder="Transaction ID" name="transaction_id">
                                                            <label for="name">Transaction ID</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" required class="form-control" placeholder="Amount" value="{{ $installment->monthly_fee }}" name="amount">
                                                            <label for="name">Amount</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 pt-2">
                                                        <input onclick="this.disabled=true;this.value='Loading...';this.form.submit();" type="submit" class="btn btn-primary mr-1 mb-1" value="Submit">
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
    <script>
        function pay_type() {
            var payment_methode = $('#payment_methode').val();
            // alert(payment_methode);
            if (payment_methode == 2) {
                $('#transaction_id').show();
            }else{
                $('#transaction_id').hide();
            }
        }
    </script>
@endsection
@push('scripts')
    <script src="{{asset('admin_assets/vendors/js/vendors.min.js') }}"></script>
@endpush
