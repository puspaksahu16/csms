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
                                    <li class="breadcrumb-item"><a href="#">Monthly Fee</a>
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
                                <h4 class="card-title">Monthly Fee</h4>
                                {{--<a class="btn btn-primary" href="{{url('/pre_admissions/create')}}">Add</a>--}}
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
                                            <th scope="col">Student ID</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Section</th>
                                            <th scope="col">Total Due</th>
                                            <th scope="col">Total Fine</th>
                                            <th scope="col">Total Paid</th>
                                            <th scope="col">Monthly Fee</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $key => $mf)
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            @if(auth()->user()->role->name == "super_admin")
                                            <td>{{$mf->school->full_name}}</td>
                                            @endif
                                            <td>{{$mf->student_unique_id}}</td>
                                            <td>{{$mf->first_name." ".$mf->last_name}}</td>
                                            <td>{{$mf->classes->create_class}}</td>
                                            <td>{{!empty($mf->section_data->section) ? $mf->section_data->section : "Not Assign"}}</td>
                                            <td>{{ $mf->monthly_fee->due }}</td>
                                            <td>{{ $mf->monthly_fee->fine }}</td>
                                            <td>{{ $mf->monthly_fee->paid }}</td>

                                            <td>{{ $mf->monthly_fee->fee }}</td>
                                            @php
                                                $history = $mf->monthly_fee->history->where('status', 'Paid')
                                            @endphp
                                            <td>
                                                @if(count($history) == 0)
                                                    <a href="#" data-toggle="modal" data-target="#myModal{{$mf->monthly_fee->id}}" class="btn btn-sm btn-primary">Total Month</a>
                                                    <div class="modal" id="myModal{{$mf->monthly_fee->id}}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">

                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Assign Section</h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>

                                                                <!-- Modal body -->
                                                                <div class="modal-body">
                                                                    <form class="form" method="POST" action="{{ url('/total_month/'.$mf->monthly_fee->id) }}">
                                                                        @csrf
                                                                        <div class="form-label-group">
                                                                            <select name="total_month" class="form-control">
                                                                                <option>-Select Months-</option>
                                                                                <option value="10">10 Months</option>
                                                                                <option value="11">11 Months</option>
                                                                                <option value="12">12 Months</option>
                                                                            </select>
                                                                            <label for="first-name-column">Create Section</label>
                                                                        </div>
                                                                        <button class="btn btn-success btn-sm pull-right" type="submit">Submit</button>
                                                                    </form>
                                                                </div>

                                                                <!-- Modal footer -->
                                                                {{--                                                                <div class="modal-footer">--}}
                                                                {{--                                                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>--}}
                                                                {{--                                                                </div>--}}

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <a href="{{url('/monthly_fee_history/'.$mf->monthly_fee->id)}}" class="btn btn-sm btn-success"> History</a>
                                            </td>
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
