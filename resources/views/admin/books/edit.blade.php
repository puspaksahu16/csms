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
                                    <li class="breadcrumb-item"><a href="#">Book Edit</a>
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
                                    <h4 class="card-title">Edit Books</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{route('books.update', $books->id)}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    @if(auth()->user()->role->name == "super_admin")
                                                            <div class="col-md-12 col-12">
                                                                <div class="form-label-group">
                                                                    <label for="name">School</label>
                                                                    <select  id="school_id" onchange="getStandard()" class="form-control" name="school_id">
                                                                        <option>-Select School-</option>
                                                                        @foreach($schools as $school)
                                                                            <option  {{ $books->school_id == $school->id ? "selected" : " " }} value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                    @endif
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-label-group">
                                                                <label for="name">Standard</label>
                                                                <select   onchange="getClass(this.value)" id="standard_id" class="form-control" name="standard_id">
                                                                    <option>-Select Standard-</option>
                                                                    @foreach($standard as $std)
                                                                        <option  {{ $std->id == $books->standard_id ? "selected" : " " }} value="{{ $std->id }}">{{ $std->name }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-label-group">
                                                                <label for="name">Class</label>
                                                                <select class="form-control" name="class_id" id="class_id">
                                                                    <option>-Select Class-</option>
                                                                    @foreach($classes as $class)
                                                                        <option  {{ $class->id == $books->class_id ? "selected" : " " }} value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-label-group">
                                                                <label for="name">Publisher</label>
                                                                <select class="form-control" name="publisher_id">
                                                                    <option>-Select Publisher-</option>

                                                                    @foreach($publisher as $publishers)

                                                                        <option  {{ $publishers->id == $books->publisher_id ? "selected" : " " }} value="{{ $publishers->id }}">{{ $publishers->name }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-label-group">
                                                                <label for="name">Subject</label>
                                                                <select class="form-control" name="subject_id">
                                                                    <option>-Select Subject-</option>
                                                                    @foreach($subject as $subjects)
                                                                        <option  {{ $subjects->id == $books->subject_id ? "selected" : " " }} value="{{ $subjects->id }}">{{ $subjects->name }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" placeholder="Product Name" name="name" value="{{$books->name}}">
                                                            <label for="name">Book Name</label>
                                                        </div>
                                                    </div>



                                                    </div>
                                                    <div class="col-12 pt-2">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                        <a href="{{ url()->previous() }}" class="btn btn-outline-warning mr-1 mb-1">Back</a>
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
@push('scripts')
    <script>
        function getStandard() {
            var school_id = $('#school_id').val();
            // alert(csrf);
            $.ajax({
                url : "/get_standard/"+school_id,
                type:'get',
                success: function(response) {
                    console.log(response);
                    $("#standard_id").attr('disabled', false);
                    $("#standard_id").empty();
                    $("#standard_id").append('<option value="">-Select Standard-</option>');
                    $.each(response,function(key, value)
                    {
                        $("#standard_id").append('<option value=' + key + '>' + value + '</option>');
                    });

                }
            });
        }
        function getClass(value) {

            var school_id = $('#school_id').val();
            var standard_id = value;
            // alert(standard_id);
            $.ajax({
                type: "get",
                url: "/get_book_standard_class",
                data:{school_id: school_id, standard_id: standard_id},
                success: function(data){
                    console.log(data);
                    $("#class_id").empty();
                    $.each(data, function(key, value)
                    {
                        $("#class_id").append('<option value=' + key + '>' + value + '</option>');
                    });

                }
            });
        }
    </script>
    <script src="{{asset('admin_assets/vendors/js/vendors.min.js') }}"></script>
@endpush
