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

                <div class="row" id="table-striped">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title pb-2">Return Book List</h4>
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
                                            @if(auth()->user()->role->name == "super_admin" || auth()->user()->role->name == "admin" )
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Section</th>
                                            <th scope="col">Student Id</th>
                                            @endif
                                            <th scope="col">Book Id</th>
                                            <th scope="col">Issue Date</th>
                                            <th scope="col">Returnable Date</th>
                                            <th scope="col">Returned Date</th>
                                            <th scope="col">Fine</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($issue_books as $key => $issue_book)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                @if(auth()->user()->role->name == "super_admin")
                                                    <th>{{$issue_book->school->full_name}}</th>
                                                @endif
                                                @if(auth()->user()->role->name == "super_admin" || auth()->user()->role->name == "admin" )
                                                <th>{{$issue_book->student->first_name ." ".$issue_book->student->last_name}}</th>
                                                    <th>{{$issue_book->student->classes->create_class}}</th>
                                                    <th>{{$issue_book->student->section}}</th>
                                                    <th>{{$issue_book->student->student_unique_id}}</th>
                                                @endif
                                                <th>{{$issue_book->book->book_name}}</th>
                                                <th>{{date('d-m-Y',strtotime($issue_book->issue_date))}}</th>
                                                <th>{{date('d-m-Y',strtotime($issue_book->return_date))}}</th>
                                                <th>{{$issue_book->updated_at->format('d-m-Y')}}</th>
                                                <th>
                                                    @if($issue_book->fine == '')
                                                        {{'Na'}}
                                                    @else
                                                        {{$issue_book->fine}}
                                                        @endif
                                                </th>

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

