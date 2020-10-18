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
                                        <h4 class="card-title">Create Library</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="form" action="{{route('library.store')}}" method="POST">
                                                @csrf
                                                <div class="form-body">



                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <div class="row">
                                                            <div class="col-md-3 col-12">
                                                                <div class="form-label-group">
                                                                    <select  name="school_id" class="form-control">
                                                                        <option>-SELECT School-</option>

                                                                        @foreach($schools as $school)
                                                                            <option value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="col-3">
                                                                <div class="form-label-group">
                                                                    <input type="text" name="book_id" class="form-control">
                                                                    <label for="first-name-column">Book ID</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-label-group">
                                                                    <input type="text" name="book_name" class="form-control">
                                                                    <label for="first-name-column">Book Name</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-3">
                                                                <div class="form-label-group">
                                                                    <input type="text" name="publisher" class="form-control">
                                                                    <label for="first-name-column">Publisher</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-label-group">
                                                                    <input type="text" name="edition" class="form-control">
                                                                    <label for="first-name-column">Edition</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-label-group">
                                                                    <input type="text" name="book_price" class="form-control">
                                                                    <label for="first-name-column">Price</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-3"></div>
                                                            <div class="col-3">

                                                                <input type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" value="Submit">
                                                                <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                                                            </div>
                                                        </div>
                                                        <div align="right">

                                                        </div>
                                                    @elseif(auth()->user()->role->name == "admin")
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div class="form-label-group">
                                                                    <input type="text" name="book_id" class="form-control">
                                                                    <label for="first-name-column">Book ID</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="form-label-group">
                                                                    <input type="text" name="book_name" class="form-control">
                                                                    <label for="first-name-column">Book Name</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <div class="form-label-group">
                                                                    <input type="text" name="publisher" class="form-control">
                                                                    <label for="first-name-column">Publisher</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="form-label-group">
                                                                    <input type="text" name="edition" class="form-control">
                                                                    <label for="first-name-column">Edition</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="form-label-group">
                                                                    <input type="text" name="book_price" class="form-control">
                                                                    <label for="first-name-column">Price</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <input type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" value="Submit">
                                                                <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                                                            </div>
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
                                <h4 class="card-title pb-2">Library Book List</h4>
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
                                            <th scope="col">Book Id</th>
                                            <th scope="col">Book Name</th>
                                            <th scope="col">Publisher</th>
                                            <th scope="col">Edition</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($libraries as $key => $library)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                @if(auth()->user()->role->name == "super_admin")
                                                    <th>{{$library->school->full_name}}</th>
                                                @endif
                                                <th>{{$library->book_id}}</th>
                                                <th>{{$library->book_name}}</th>
                                                <th>{{$library->publisher}}</th>
                                                <th>{{$library->edition}}</th>
                                                <th>{{$library->book_price}}</th>

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
