@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/vendors/css/forms/select/select2.min.css') }}">
@endpush
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
                                        <h4 class="card-title">Issue Book</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="form" action="{{route('issue_book.store')}}" method="POST">
                                                @csrf
                                                <div class="form-body">

                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <div class="row">
                                                            <div class="col-md-4 col-12">
                                                                <div class="form-label-group">
                                                                    <select  onchange="getStudent()" id="school_id" name="school_id" class="form-control">
                                                                        <option>-SELECT School-</option>

                                                                        @foreach($schools as $school)
                                                                            <option value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="col-4">
                                                                <div class="form-label-group">
                                                                    <label for="first-name-column">Student</label>
                                                                    <select class="select2-size-sm form-control" id="student"  name="student_id">
                                                                        <option>-SELECT Student-</option>
                                                                    </select>

                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <div class="form-label-group">
                                                                    <select  class="select2-size-sm form-control"  name="book_id[]" multiple="multiple" id="book" class="form-control">
                                                                        <option>-SELECT Book-</option>
                                                                    </select>
                                                                    <label for="first-name-column">Book</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-6">
                                                                <div class="form-label-group">
                                                                    <input type="date" name="issue_date" class="form-control">
                                                                    <label for="first-name-column">Issue Date</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-6">
                                                                <div class="form-label-group">
                                                                    <input type="date" name="return_date" class="form-control">
                                                                    <label for="first-name-column">Return Date</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div align="right">
                                                            <div class="form-label-group">
                                                            <input type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" value="Submit">
                                                            <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                                                            </div>
                                                        </div>

                                                        @elseif(auth()->user()->role->name == "admin")
                                                        <div class="row">
                                                        <div class="col-4">
                                                            <div class="form-label-group">
                                                                <label for="first-name-column">Student</label>
                                                                <select class="select2-size-sm form-control" id="student"  name="student_id">
                                                                    <option>-SELECT Student-</option>
                                                                    @foreach($students as $student)
                                                                        <option value="{{$student->id}}">{{ $student->first_name." ".$student->last_name." ".$student->student_unique_id }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <div class="form-label-group">
                                                                <select  class="select2-size-sm form-control" name="book_id[]" multiple="multiple" id="book" class="form-control">
                                                                    <option>-SELECT Book-</option>
                                                                    @foreach($books as $book)
                                                                        <option value="{{$book->id}}">{{ $book->book_name." ".$book->book_id }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="first-name-column">Book</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <div class="form-label-group">
                                                                <input type="date" name="issue_date" class="form-control">
                                                                <label for="first-name-column">Issue Date</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <div class="form-label-group">
                                                                <input type="date" name="return_date" class="form-control">
                                                                <label for="first-name-column">Return Date</label>
                                                            </div>
                                                        </div>
                                                        </div>
                                                <div align="right">
                                                    <div class="form-label-group">
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
                                <h4 class="card-title pb-2">Issue Book List</h4>
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
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Book Id</th>
                                            <th scope="col">Issue Date</th>
                                            <th scope="col">Return Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($issue_books as $key => $issue_book)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                @if(auth()->user()->role->name == "super_admin")
                                                    <th>{{$issue_book->school->full_name}}</th>
                                                @endif
                                                <th>{{$issue_book->student->first_name ." ".$issue_book->student->last_name}}</th>
                                                <th>{{$issue_book->book->book_name}}</th>
                                                <th>{{$issue_book->issue_date}}</th>
                                                <th>{{$issue_book->return_date}}</th>
                                                <th><a href="#" data-toggle="modal" data-target="#myModal{{$issue_book->id}}" class="btn btn-sm btn-primary">Return</a></th>
                                                <div class="modal" id="myModal{{$issue_book->id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Return</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form class="form" method="POST" action="{{ url('/return_book/'.$issue_book->id) }}">
                                                                    @csrf
                                                                    <div class="form-label-group">
                                                                        <input type="text" name="fine" class="form-control">
                                                                        <label for="first-name-column">Fine</label>
                                                                    </div>
                                                                    <button class="btn btn-success" type="submit">Submit</button>
                                                                </form>
                                                            </div>

                                                            <!-- Modal footer -->
                                                            {{--                                                                <div class="modal-footer">--}}
                                                            {{--                                                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>--}}
                                                            {{--                                                                </div>--}}

                                                        </div>
                                                    </div>
                                                </div>
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
    <script src="{{asset('admin_assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{asset('admin_assets/js/scripts/forms/select/form-select2.min.js')}}"></script>
    <script>
        function getStudent() {
            var school_id = $('#school_id').val();
            // alert(school_id);
            $.ajax({
                url : "/get_students/"+school_id,
                type:'get',
                success: function(response) {
                    console.log(response);
                    $("#student").attr('disabled', false);
                    $("#student").empty();
                    $("#student").append('<option value="">-Select Student-</option>');
                    $.each(response,function(key, value)
                    {
                        $("#student").append('<option value=' + value.id + '>' + value.first_name +" "+ value.last_name +" "+ value.student_unique_id+'</option>');
                    });
                }
            });

            $.ajax({
                url : "/get_books/"+school_id,
                type:'get',
                success: function(response) {
                    console.log(response);
                    $("#book").attr('disabled', false);
                    $("#book").empty();
                    $("#book").append('<option value="">-Select Book-</option>');
                    $.each(response,function(key, value)
                    {
                        $("#book").append('<option value=' + value.id + '>' + value.book_name +" "+ value.book_id +'</option>');
                    });
                }
            });
        }
    </script>
@endpush
