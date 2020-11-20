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
                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-label-group">
                                                                <select name="school_id" onclick="getClass()" id="school_id" class="form-control">
                                                                    <option value="">-SELECT School-</option>

                                                                    @foreach($schools as $school)
                                                                        <option value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                    @endforeach

                                                                </select>
                                                                <span style="color: red">{{ $errors->first('school_id') }}</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <select onchange="getRoll(this.value),getExam(this.value)" name="class_id" id="class" class="form-control">
                                                                <option value="">-SELECT CLASS-</option>
                                                                @if(auth()->user()->role->name == "admin")
                                                                    @foreach($classes as $class)
                                                                        <option value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                                    @endforeach
                                                                @endif

                                                            </select>
                                                            <span style="color: red">{{ $errors->first('class_id') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <select id="roll_id" name="roll_no" class="form-control">
                                                                <option value="">-Roll Number-</option>
                                                                {{--@foreach($rolls as $roll)--}}
                                                                    {{--<option value="{{ $roll->id }}">{{ $roll->roll_no }}</option>--}}
                                                                {{--@endforeach--}}
                                                            </select>

                                                            <label for="name">Roll Number</label>
                                                            <span style="color: red">{{ $errors->first('roll_no') }}</span>
                                                        </div>
                                                    </div>
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-label-group">
                                                                <select onchange="getMarks(this.value)" id="exam_id" name="exam_id" class="form-control">
                                                                    <option value="">-Select Exam-</option>
                                                                    @foreach($exams as $exam)
                                                                    <option value="{{ $exam->id }}">{{ $exam->exam_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="name">Exam</label>
                                                                <span style="color: red">{{ $errors->first('exam_id') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-label-group">
                                                                <input type="number" readonly class="form-control" value="{{ old('total_mark') }}" placeholder="Total Mark" name="total_mark" id="total_mark">
                                                                <label for="name">Total Mark</label>
                                                                <span style="color: red">{{ $errors->first('total_mark') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-12">
                                                            <div class="form-label-group">
                                                                <input type="number" class="form-control" value="{{ old('obtained_mark') }}" placeholder="Obtain Mark" id="obtained_mark" name="obtained_mark"  onchange="marks();">
                                                                <label for="name">Obtain Mark</label>
                                                                <span style="color: red">{{ $errors->first('obtained_mark') }}</span>
                                                            </div>
                                                        </div>
                                                    <div class="col-md-12 col-12">
                                                        <div class="form-label-group">
                                                            <input type="number" class="form-control"  value="{{ old('percentage') }}" placeholder="Percentage" name="percentage" id="percentage" readonly>
                                                            <label for="name">Percentage</label>
                                                            <span style="color: red">{{ $errors->first('percentage') }}</span>
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
                       $('#roll_id').append('<option value="">-Select-</option>');
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

       function getExam(id) {
           // alert(id);
           $.ajax({
               url: "/get_exam",
               type: "post",
               data:{
                   "_token": "{{ csrf_token() }}",
                   class_id: id
               },
               success: function(result){
                   console.log(result);
                   $('#exam_id').empty();
                   if(result)
                   {
                       $('#exam_id').append('<option value="">-Select-</option>');
                       $.each(result,function(key,value){
                           $('#exam_id').append($("<option/>", {
                               value: key,
                               text: value
                           }));
                       });
                   }
                   // $("#div1").html(result);
               }});
       }

       function getMarks(id) {
            // alert(id);
           $.ajax({
               url: "/get_mark",
               type: "post",
               data:{
                   "_token": "{{ csrf_token() }}",
                   exam_id: id
               },
               success: function(result){
                   $("#total_mark").val(result);
               }});
       }

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


        function marks(){
            var Tmark = document.getElementById('total_mark').value;
            var Omark = document.getElementById('obtained_mark').value;

            var Per = Omark/Tmark*100;
            $('#percentage').val(Math.round(Per));

        }

    </script>
@endpush
