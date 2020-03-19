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
                                    <li class="breadcrumb-item"><a href="#">Pre Exam Management</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Result</a>
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
                                    <h4 class="card-title">Create Result</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{route('result.store')}}" method="POST">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">

                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <select onchange="getRoll(this.value)" name="class_id" class="form-control">
                                                                <option>-SELECT CLASS-</option>

                                                                @foreach($classes as $class)
                                                                    <option value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <select id="roll_id" name="roll_no" class="form-control">
                                                                <option>-Roll Number-</option>
                                                                @foreach($rolls as $roll)
                                                                    <option value="{{ $roll->id }}">{{ $roll->roll_no }}</option>
                                                                @endforeach
                                                            </select>
                                                            <label for="name">Roll Number/label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <input type="number" class="form-control" placeholder="Percentage" name="percentage">
                                                            <label for="name">Percentage</label>
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
@push('scripts')
    <script>
       function getRoll(id) {
           // alert(id);
           $.ajax({
               url: "/get_roll",
               type: "post",
               data:{
                   "_token": "{{ csrf_token() }}",
                   class_id: id
               },
               success: function(result){
                   console.log(result);
                   $('#roll_id').empty();
                   // $("#roll_id").append('<option>--Select Nation--</option>');
                   if(result)
                   {
                       $.each(result,function(key,value){
                           $('#roll_id').append($("<option/>", {
                               value: key,
                               text: value
                           }));
                       });
                   }
                   // $("#div1").html(result);
               }});
       }
    </script>
@endpush