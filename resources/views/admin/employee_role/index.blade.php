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
                                    <li class="breadcrumb-item"><a href="#">General Setting</a>
                                    </li>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Employee Role</a>
                                    </li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body"><!-- Basic Horizontal form layout section start -->

                <section id="multiple-column-form">
                    <div class="row match-height ">
                        <div class="col-12" style="margin: auto">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add Employee Role</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{route('employees_roles.store')}}" method="POST">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <div class="col-md-4 col-12">
                                                            <div class="form-label-group">
                                                                <select name="school_id" onclick="getClass()" id="school_id" class="form-control">
                                                                    <option value="">-SELECT School-</option>

                                                                    @foreach($schools as $school)
                                                                        <option value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                    @endforeach

                                                                </select>
                                                                <span style="color: red">{{ $errors->first('school_id') }}</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="col-md-4 col-12">
                                                        <div class="form-label-group">
                                                            <input autocomplete="off" type="text" class="form-control"  placeholder="Role Name" name="role_name">
                                                            <label for="name">Role Name</label>
                                                            <span style="color: red">{{ $errors->first('role_name') }}</span>
                                                        </div>
                                                    </div>


                                                    <div class="col-4">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
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

                <div class="row" id="table-striped">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header table-card-header">
                                <h4 class="card-title">Employee Roles List</h4>


                            </div>
                            <div class="card-content">

                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">School Name</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Date</th>
{{--                                            <th></th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($employee_roles as $key => $employee_role)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$employee_role->school->full_name}}</td>
                                                <td>{{$employee_role->role_name}}</td>
                                                <td>{{$employee_role->created_at->format('d F Y')}}</td>
{{--                                                <td><a href="{{route('employees_roles.edit', $employee_role->id)}}" class="btn btn-sm btn-primary">Edit</a></td>--}}
{{--                                                <td><a href="publisher_delete/{{$employee_role->id}}" class="btn btn-sm btn-danger">Delete</a></td>--}}

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
