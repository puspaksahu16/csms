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
                                    <li class="breadcrumb-item"><a href="#">Fees Structure</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Extra Class Fee</a>
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
                                    <h4 class="card-title">Edit Extra Classes Fee</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{route('extraclasses.update', $extraclass->id)}}" method="Post">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-label-group">
                                                                <select name="school_id" id="school_id" onclick="getClass()" class="form-control">
                                                                    <option>-SELECT School-</option>

                                                                    @foreach($schools as $school)
                                                                        <option   {{ $extraclass->school_id == $school->id ? "selected" : " " }}  value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" placeholder=" Name" value="{{$extraclass->name}}" name="name">
                                                            <label for="name">Extra Class Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <select name="class_id" id="class" class="form-control">
                                                                <option>-SELECT CLASS-</option>

                                                                    @foreach($classes as $class)
                                                                        <option {{ $class->id == $extraclass->class_id ? "selected" : " " }}  value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                                    @endforeach


                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" placeholder="Price" name="price" value="{{$extraclass->price}}">
                                                            <label for="name">Price</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <select name="type" class="form-control">
                                                                <option>-SELECT TYPE-</option>

                                                                <option {{2 == $extraclass->type ? "selected" : " " }} value="2">Monthly</option>
                                                                <option {{1 == $extraclass->type ? "selected" : " " }} value="1">Annually</option>


                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 pt-2">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                        <a href="{{ url()->previous() }}" class="btn btn-outline-warning mr-1 mb-1">Back</a>
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
    <script>
        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blahid')
                        .attr('src', e.target.result)
                        .width(130)
                        .height(150);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
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
    </script>

        <script src="{{asset('admin_assets/vendors/js/vendors.min.js') }}"></script>

@endpush
