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
                            {{--                            <h2 class="content-header-title float-left mb-0"></h2>--}}
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Store</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Product</a>
                                    </li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body"><!-- Basic Horizontal form layout section start -->

                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height ">
                        <div class="col-6" style="margin: auto">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Product</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{route('books.update', $books->id)}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" placeholder="Product Name" name="name" value="{{$books->name}}">
                                                            <label for="name">Book Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <label for="name">Standard</label>
                                                            <select class="form-control" name="standard_id">
                                                                @foreach($standard as $std)
                                                                    <option>-Select Class-</option>
                                                                    <option  {{ $std->id == $books->standard_id ? "selected" : " " }} value="{{ $std->id }}">{{ $std->name }}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <label for="name">Class</label>
                                                            <select class="form-control" name="class_id">
                                                                @foreach($classes as $class)
                                                                    <option>-Select Class-</option>
                                                                    <option  {{ $class->id == $books->class_id ? "selected" : " " }} value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <label for="name">Publisher</label>
                                                            <select class="form-control" name="publisher_id">
                                                                @foreach($publisher as $publishers)
                                                                    <option>-Select Class-</option>
                                                                    <option  {{ $publishers->id == $books->publisher_id ? "selected" : " " }} value="{{ $publishers->id }}">{{ $publishers->name }}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <label for="name">Subject</label>
                                                            <select class="form-control" name="subject_id">
                                                                @foreach($subject as $subjects)
                                                                    <option>-Select Class-</option>
                                                                    <option  {{ $subjects->id == $books->subject_id ? "selected" : " " }} value="{{ $subjects->id }}">{{ $subjects->name }}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="col-12 pt-2">
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
                <!-- // Basic Floating Label Form section end -->

            </div>
        </div>
    </div>

@endsection
