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
                                    <li class="breadcrumb-item"><a href="#">Store</a>
                                    </li>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Books Stock</a>
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
                                <h4 class="card-title">Books Stock</h4>
                                <a class="btn btn-primary" href="{{url('/book_stocks/create')}}">Add</a>
                            </div>
                            <div class="container">
                                <form class="form" action="{{url('/fetch_class_table')}}" method="get">
                                    @csrf
                                    <div class="row">
                                        @if(auth()->user()->role->name == "super_admin")
                                        <div class="col-md-4">
                                            <select name="school_id" onclick="getClass()" id="school_id" class="form-control">
                                                <option value="">-SELECT School-</option>

                                                @foreach($schools as $school)
                                                    <option value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        @endif
                                        <div class="col-md-4">
                                            <select onchange="classFiler(this.value)" name="class_id" id="class" class="form-control">
                                                <option value="">-SELECT CLASS-</option>
                                                @if(auth()->user()->role->name == "admin")
                                                    @foreach($classes as $class)
                                                        <option value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                        </div>

                                    </div>
                                </form>
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
                                            <th scope="col">Book Name</th>
                                            <th scope="col">class</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Publisher</th>
                                            <th scope="col">Stock in</th>
                                            <th scope="col">Stock out</th>
                                            <th scope="col">Available</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="class_filter">
                                        @foreach($stocks as $key => $stock)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                @if(auth()->user()->role->name == "super_admin")
                                                    <td>{{!empty($stock->schools->full_name) ? $stock->schools->full_name : "--"}}</td>
                                                @endif
                                                <td>{{!empty($stock->book->name) ? $stock->book->name : "--"}}</td>
                                                <td>{{!empty($stock->book->classes->create_class) ? $stock->book->classes->create_class : "--"}}</td>
                                                <td>{{!empty($stock->book->subject->name) ? $stock->book->subject->name : "--"}}</td>
                                                <td>{{!empty($stock->book->publisher->name) ? $stock->book->publisher->name : "--"}}</td>
                                                <td>{{!empty($stock->stock_in) ? $stock->stock_in : "--"}}</td>
                                                <td>{{empty($stock->stock_out) ? 0 : $stock->stock_out}}</td>
                                                <td>{{$stock->available_stocks}}</td>
                                                <td><a class="btn btn-warning btn-sm" href="{{ route('book_stocks.edit', $stock->id) }}">Remove last In</a></td>

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
    <script>
        function getClass() {
            var school_id = $('#school_id').val();
            // alert(csrf);
            $.ajax({
                url : "/get_class/"+school_id,
                type:'get',
                success: function(response) {
                    console.log(response);
                    $("#class").attr('disabled', false);
                    $("#class").empty();
                    $("#class").append('<option value="">-Select Class-</option>');
                    $.each(response,function(key, value)
                    {
                        $("#class").append('<option value=' + key + '>' + value + '</option>');
                    });
                }
            });
        }
        function classFiler() {
            var school_id = $('#school_id').val();
            var class_id = $('#class').val();
            // alert(class_id);
            $.ajax({
                type: "get",
                url: "/fetch_bookstock_class",
                data:{school_id: school_id, class_id: class_id},

                success: function(data){
                    console.log(data);
                    $("#class_filter").empty();
                    $.each(data, function(key, value)
                    {
                        @if(auth()->user()->role->name == "super_admin")
                        $("#class_filter").append('<tr>' +
                            '<td scope="row">' + (key + 1) + '</td>'+
                            '<td>' + value.schools.full_name + '</td>'+
                            '<td>' + value.book.name + '</td>'+
                            '<td>' + value.classes.create_class + '</td>'+
                            '<td>' + value.book.subject.name + '</td>'+
                            '<td>' + value.book.publisher.name + '</td>'+
                            '<td>' + value.stock_in + '</td>'+
                            '<td>' + value.stock_out + '</td>'+
                            '<td>' + (value.stock_in - value.stock_out) + '</td>'+
                            '<td><a href="book_stocks/'+ value.id + '/edit" class="btn btn-warning btn-sm">Remove last In</a></td>'+
                            '</tr>');
                        @else
                        $("#class_filter").append('<tr>' +
                            '<td scope="row">' + (key + 1) + '</td>'+
                            '<td>' + value.book.name + '</td>'+
                            '<td>' + value.classes.create_class + '</td>'+
                            '<td>' + value.book.subject.name + '</td>'+
                            '<td>' + value.book.publisher.name + '</td>'+
                            '<td>' + value.stock_in + '</td>'+
                            '<td>' + value.stock_out + '</td>'+
                            '<td>' + (value.stock_in - value.stock_out) + '</td>'+
                            '<td><a href="book_stocks/'+ value.id + '/edit" class="btn btn-warning btn-sm">Remove last In</a></td>'+
                            '</tr>');
                        @endif
                    });
                }
            });
        }
    </script>


    <script src="{{asset('admin_assets/vendors/js/vendors.min.js') }}"></script>
@endpush
