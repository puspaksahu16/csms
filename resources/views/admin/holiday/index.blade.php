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
            <div class="content-body"><!-- Basic Horizontal form layout section start -->
                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">

                        <div class="col-12">
                            @if(auth()->user()->role->name == "super_admin" || auth()->user()->role->name == "admin" )
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Holiday Setting</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{route('holiday.store')}}" method="POST">
                                            @csrf
                                            <div class="form-body">
                                                @if(auth()->user()->role->name == "super_admin")
                                                    <div class="row">
                                                        <div class="col-md-3 col-12">
                                                            <div class="form-label-group">
                                                                <select  name="school_id" class="form-control">
                                                                    <option value="">-SELECT School-</option>

                                                                    @foreach($schools as $school)
                                                                        <option {{ (old('school_id') == $school->id ? "selected" : '') }} value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                    @endforeach

                                                                </select>
                                                                <span style="color: red">{{ $errors->first('school_id') }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-3">
                                                            <div class="form-label-group">
                                                                <input type="text" value="{{ old('holiday_name') }}" name="holiday_name" class="form-control">
                                                                <label for="first-name-column">Name of Holiday</label>
                                                                <span style="color: red">{{ $errors->first('holiday_name') }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-3">
                                                             <div class="form-label-group">
                                                                <input type="date"  value="{{ old('from_date') }}" name="from_date" class="form-control">
                                                                <label for="first-name-column">From Date</label>
                                                                 <span style="color: red">{{ $errors->first('from_date') }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-3">
                                                            <div class="form-label-group">
                                                                <input type="date" value="{{ old('to_date') }}" name="to_date" class="form-control">
                                                                <label for="first-name-column">To Date</label>
                                                                <span style="color: red">{{ $errors->first('to_date') }}</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div align="right">
                                                        <input type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" value="Submit">
                                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                                                    </div>
                                                @elseif(auth()->user()->role->name == "admin")
                                                    <div class="row">
                                                            <div class="col-4">
                                                                <div class="form-label-group">
                                                                    <input type="text" name="holiday_name" class="form-control">
                                                                    <label for="first-name-column">Name of Holiday</label>
                                                                </div>
                                                            </div>

                                                        <div class="col-3">
                                                            <div class="form-label-group">
                                                                <input type="date" name="from_date" class="form-control">
                                                                <label for="first-name-column">from Date</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-3">
                                                            <div class="form-label-group">
                                                                <input type="date" name="to_date" class="form-control">
                                                                <label for="first-name-column">To Date</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div align="right">
                                                        <input type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" value="Submit">
                                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                                                    </div>
                                                @endif


                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
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
                                <h4 class="card-title pb-2">Holiday List</h4>
                            </div>
                            <div class="card-content">

                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            @if(auth()->user()->role->name == "super_admin")
                                                <th scope="col">School</th>
                                            @endif
                                            <th scope="col">Holiday Name</th>
                                            <th scope="col">From Date</th>
                                            <th scope="col">To Date</th>
                                            @if(auth()->user()->role->name == "super_admin" || auth()->user()->role->name == "admin")
                                            <th scope="col">Action</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($holidays as $key => $holiday)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                @if(auth()->user()->role->name == "super_admin")
                                                    <th>{{$holiday->school->full_name}}</th>
                                                @endif
                                                <th>{{$holiday->holiday_name}}</th>
                                                <th>{{\Carbon\Carbon::parse($holiday->from_date)->format('d-M-Y')}}</th>
                                                <th>{{\Carbon\Carbon::parse($holiday->to_date)->format('d-M-Y')}}</th>
                                                @if(auth()->user()->role->name == "super_admin" || auth()->user()->role->name == "admin")
                                                <td><a href="" class="btn btn-sm btn-primary">Edit</a></td>
                                                @endif
{{--                                                <td><a href="set_section_delete/{{$section->id}}" class="btn btn-sm btn-danger">Delete</a></td>--}}
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
