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
                                    <li class="breadcrumb-item"><a href="#">Subscription Plans</a>
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
                                <h4 class="card-title">Subscription Plans</h4>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table zero-configuration" id="">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>

                                            <th scope="col">Name</th>
                                            <th scope="col">Subscription Plan</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                        </thead>
                                            <tbody>
                                            @foreach($subscription_plans as $key => $subscription_plan)
                                                <tr>
                                                    <th scope="row">{{$key+1}}</th>
                                                    <td>{{$subscription_plan->school->full_name}}</td>
                                                    <td>
                                                        @if($subscription_plan->subscription_type == 1)
                                                        30 days
                                                            @elseif($subscription_plan->subscription_type == 2)
                                                        180 days
                                                            @else
                                                        360 days

                                                        @endif

                                                    </td>
                                                    <td>{{$subscription_plan->created_at->format('d F Y')}}</td>
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
