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
                                    <li class="breadcrumb-item"><a href="#">Pre Exam</a>
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
                                    <h4 class="card-title">Pre Exam</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{route('pre_exam.update', $pre_exam->id)}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-label-group">
                                                                <select onchange="get_class(this.value)" name="school_id" class="form-control">
                                                                    <option>-SELECT School-</option>

                                                                    @foreach($schools as $school)
                                                                        <option  {{ $pre_exam->school_id == $school->id ? "selected" : " " }}  value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" placeholder="Exam Name" name="exam_name"  value="{{$pre_exam->exam_name}}">
                                                            <label for="name">Exam Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <select name="class_id" id="class_id" class="form-control">
                                                                <option>-SELECT CLASS-</option>

                                                                {{--<div id="class_show">--}}
                                                                    @foreach($classes as $class)
                                                                        <option {{ $pre_exam->class_id == $class->id ? "selected" : " " }} value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                                    @endforeach
                                                                {{--</div>--}}

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <input type="number" class="form-control" placeholder="Full Mark" name="full_mark"   value="{{$pre_exam->full_mark}}">
                                                            <label for="name">Full Mark</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <select id="year" class="form-control" name="current_year" >
                                                                <option value="">Current Year</option>
                                                                <?php
                                                                    $year = date('Y') ;
                                                                ?>
                                                                @for ($year = 2021; $year <= 2030; $year++)
                                                                    <option {{ $pre_exam->current_year == $year ? "selected" : "" }} value="{{ $year }}">{{ $year }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-label-group">
                                                                <input type="date" class="form-control" value="{{ $pre_exam->exam_date }}" placeholder="Exam Date" name="exam_date">
                                                                <label for="name">Exam Date</label>
                                                                <span style="color: red">{{ $errors->first('exam_date') }}</span>
                                                            </div>
                                                        </div>

                                                    <div class="col-12 pt-2">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                        <a href="{{route('pre_exam.index')}}" class="btn btn-outline-success mr-1 mb-1">Back</a>
{{--                                                        <button class="btn btn-outline-success mr-1 mb-1">Back</button>--}}
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
    <script type="text/javascript">
        function get_class(value) {
            // alert(1);
            $('#class_show').hide();
            jQuery.ajax({
                url : '/get_class/' +value,
                type : "GET",
                dataType : "json",
                success:function(data)
                {
                    console.log(data);
                    $('#class_id').empty();
                    $('#class_id').append('<option value="">Select Class</option>');
                    jQuery.each(data, function(key,value){
                        $('#class_id').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                }
            });
        }
    </script>
    {{--<script type="text/javascript">--}}


        {{--jQuery(document).ready(function ()--}}
        {{--{--}}
            {{--jQuery('select[name="school_id"]').on('change',function(){--}}
                {{--var schoolID = jQuery(this).val();--}}
                {{--if(schoolID)--}}
                {{--{--}}

                    {{--jQuery.ajax({--}}
                        {{--url : 'getclass/' +schoolID,--}}
                        {{--type : "GET",--}}
                        {{--dataType : "json",--}}
                        {{--success:function(data)--}}
                        {{--{--}}
                            {{--console.log(data);--}}
                            {{--$('#class_id').empty();--}}
                            {{--jQuery.each(data, function(key,value){--}}
                                {{--$('#class_id').append('<option value="'+ key +'">'+ value +'</option>');--}}
                            {{--});--}}
                        {{--}--}}
                    {{--});--}}
                {{--}--}}
                {{--else--}}
                {{--{--}}
                    {{--$('select[name="class_id"]').empty();--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
@endsection
