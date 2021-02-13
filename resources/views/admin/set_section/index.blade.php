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
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Section Setting</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{route('set_section.store')}}" method="POST">
                                            @csrf
                                            <div class="form-body">

                                                <div class="row">
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input autocomplete="off" type="text" value="{{old('name')}}" id="first-name-column" class="form-control" placeholder="Create Section" name="name">
                                                            <label for="first-name-column">Create Section</label>
                                                            <span style="color: red">{{ $errors->first('name') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Submit</button>
                                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
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

            <div class="content-body"><!-- Basic Horizontal form layout section start -->

                <div class="row" id="table-striped">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title pb-2">Section List</h4>
                            </div>
                            <div class="card-content">

                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sections as $key => $section)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                <th style="text-transform: uppercase">{{$section->name}}</th>
                                                <th>{{$section->created_at->format('d F Y')}}</th>
                                                <td><a href="{{route('set_section.edit', $section->id)}}" class="btn btn-sm btn-primary">Edit</a></td>
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
