@extends('admin.layouts.master')
@section('content')
    <div class="app-content content" id="attendance">
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
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Attendance</a>
                                    </li>
                                    {{--<li class="breadcrumb-item"><a href="#">Time-Table List</a>--}}
                                    {{--</li>--}}
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
                                <div class="container">
                                    <div class="row">
                                        <div class="col-4">
                                            <h4 class="card-title">Attendance</h4>
                                        </div>
                                        <div class="col-8">
                                            <div class="row">
                                                <div class="col-3">
                                                    <select class="form-control" v-model="class_id">
                                                        <option value="">-Select Class-</option>
                                                        <option v-for="cls in  classes" :value="cls.id">@{{ cls.create_class }}</option>
                                                        {{--@foreach($classes as $class)--}}
                                                            {{--<option value="{{ $class->id }}">{{ $class->create_class }}</option>--}}
                                                        {{--@endforeach--}}
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <select class="form-control" v-model="section_id">
                                                        <option value="">-Select Section-</option>
                                                        <option v-for="section in  sections" :value="section.id">@{{ section.section }}</option>
                                                        {{--@foreach($sections as $section)--}}
                                                            {{--<option value="{{ $section->id }}">{{ $section->section }}</option>--}}
                                                        {{--@endforeach--}}
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <select class="form-control" v-model="month" id="month">
                                                        <option value="">-Select Month-</option>
                                                        <option value="01">Jan</option>
                                                        <option value="02">Feb</option>
                                                        <option value="03">Mar</option>
                                                        <option value="04">Apr</option>
                                                        <option value="05">May</option>
                                                        <option value="06">Jun</option>
                                                        <option value="07">Jul</option>
                                                        <option value="08">Aug</option>
                                                        <option value="09">Sep</option>
                                                        <option value="10">Oct</option>
                                                        <option value="11">Nov</option>
                                                        <option value="12">Dec</option>
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <button @click="getAttendance()" type="submit" class="btn btn-outline-primary"> Get</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

{{--                                <a class="btn btn-primary" href="{{url('/timetable/create')}}">Add Time-Table</a>--}}

                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="">
                                        <thead>
                                        <tr>
                                            {{--<th scope="col">#</th>--}}
                                            <th scope="col">Id</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Roll</th>
                                            <th v-for="day in parseInt(days)" :key="day"> @{{ day }}</th>
                                            {{--<th > Total</th>--}}

{{--                                            <th scope="col">Action</th>--}}
{{--                                            <th></th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(student, index) in attendances">
                                                {{--<td>@{{ index }}</td>--}}
                                                <td>@{{ student[0].student.student_unique_id }}</td>
                                                <td>@{{ student[0].student.first_name }} @{{ student[0].student.last_name }}</td>
                                                <td></td>
                                                <td v-for="day in parseInt(days)" > <div v-for="std in student" v-if="day === std.date"> @{{ std.attendance }} </div> </td>
                                                {{--<td>@{{ student[0].total }}</td>--}}
                                            </tr>
                                            {{--v-if="day === std.created_at.format('m')"--}}
                                        {{--@foreach($timetables as $key => $timetable)--}}
                                            {{--<tr>--}}
                                                {{--<th scope="row">{{$key+1}}</th>--}}
                                                {{--<td>{{$timetable->school->full_name}}</td>--}}
                                                {{--<td>{{$timetable->standard->name}}</td>--}}
                                                {{--<td>{{$timetable->class->create_class}}</td>--}}
                                                {{--<td>{{$timetable->section->section}}</td>--}}
                                                {{--<td>{{$timetable->day}}</td>--}}
                                                {{--<td>{{$timetable->period->period_name}}</td>--}}
                                                {{--<td>{{$timetable->subject->name}}</td>--}}
                                                {{--<td>{{$timetable->employee->first_name." ".$timetable->employee->last_name}}</td>--}}
{{--                                                <td><a href="{{route('result.edit', $results->id)}}" class="btn btn-sm btn-primary">Edit</a></td>--}}
{{--                                                <td><a href="result_delete/{{$results->id}}" class="btn btn-sm btn-danger">Delete</a></td>--}}
                                            {{--</tr>--}}
                                        {{--@endforeach--}}
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
    <script> var CLASSES = @json($classes)</script>
    <script> var SECTIONS = @json($sections)</script>
{{--    <script> var SECTIONS = {!! $sections !!}</script>--}}
@endsection
@push('scripts')
    <script>
        var attendance = new Vue({
            el: '#attendance',
            data: {
                classes: CLASSES,
                sections: SECTIONS,
                section_id: '',
                class_id: '',
                month: '',
                days: 0,
                attendances: [],
            },
            methods:{
                getAttendance(){
                    let that = this;
                    this.days = 0;
                    axios.post('/get_attendance', {
                        section_id: that.section_id,
                        month: that.month,
                        class_id: that.class_id,
                    })
                        .then(function (response) {
                            console.log(response);
                            that.attendances = response.data.attendances;
                            that.days = response.data.days;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                school(){
                    let that = this;
                    this.sp = [{product_id: ''}];
                    this.rowData = [{
                        product_id: '',
                        color_id: '',
                        type_id: '',
                        size_id: '',
                        gender_id: '',
                        unit:'',
                        price: '',
                        quantity: '',
                    }];
                    axios.post('/fetch_school_products', {
                        school_id: that.school_id,
                    })
                        .then(function (response) {
                            console.log(response);
                            that.products = response.data;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                submitData(){
                    let that = this;
                    axios.post('/stocks', {
                        stock: that.rowData,
                        school_id: that.school_id,
                    })
                        .then(function (response) {
                            console.log(response);
                            window.location ="/stocks";
                            // swal("Good job!", "You clicked the button!", "success");
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            }
        })
    </script>
@endpush
