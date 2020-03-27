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
                            {{--                            <h2 class="content-header-title float-left mb-0">Pre Admission</h2>--}}
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Fee Structure</a>
                                    </li>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Books Price</a>
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
                                <h4 class="card-title">Books Price</h4>
                                <a class="btn btn-primary" href="{{url('/book_price_update')}}">Update</a>
                            </div>
                            <div class="card-content">

                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">class</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Book</th>
                                            <th scope="col">Publisher</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($books as $key => $book)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{ $book->classes->create_class }}</td>
                                                <td>{{ $book->subject->name }}</td>
                                                <td>{{ $book->name }}</td>
                                                <td>{{ $book->publisher->name }}</td>
                                                <td>{{ $book->price }}</td>

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