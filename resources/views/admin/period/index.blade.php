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
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Create Period</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Create Period</a>
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
                    <div class="row match-height">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Period Setting</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" method="POST" action="{{route('period.store')}}">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <select id="school_id" onchange="getStandard()" name="school_id" class="form-control">
                                                                    <option value="">-SELECT School-</option>

                                                                    @foreach($schools as $school)
                                                                        <option value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                    @endforeach

                                                                </select>
                                                                <span style="color: red">{{ $errors->first('school_id') }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <select disabled="true" type="text" id="standard_id" class="form-control"  name="standard_id">
                                                                    <option value="">-Select Standard-</option>
                                                                    {{--@foreach($standards as $standard)--}}
                                                                    {{--<option value="{{ $standard->id }}">{{ $standard->name }}</option>--}}
                                                                    {{--@endforeach--}}
                                                                </select>
                                                                <label for="standard">Standard</label>
                                                                <span style="color: red">{{ $errors->first('standard_id') }}</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if(auth()->user()->role->name == "admin")
                                                        <div class="col-md-4 col-12">
                                                            <div class="form-label-group">
                                                                <select type="text" class="form-control"  name="standard_id">
                                                                    <option value="">-Select Standard-</option>
                                                                    @foreach($standards as $standard)
                                                                        <option {{ (old('standard_id') == $standard->id ? "selected" : '') }} value="{{ $standard->id }}">{{ $standard->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="standard">Standard</label>
                                                                <span style="color: red">{{ $errors->first('standard_id') }}</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <select type="text" class="form-control"  name="period_name">
                                                                <option value="">-Select Period-</option>
                                                                <option  {{ (old('period_name') == '1st' ? "selected" : '') }} value="1st">1st</option>
                                                                <option {{ (old('period_name') == '2nd' ? "selected" : '') }} value="2nd">2nd</option>
                                                                <option {{ (old('period_name') == '3rd' ? "selected" : '') }} value="3rd">3rd</option>
                                                                <option {{ (old('period_name') == '4th' ? "selected" : '') }} value="4th">4th</option>
                                                                <option {{ (old('period_name') == '5th' ? "selected" : '') }} value="5th">5th</option>
                                                                <option {{ (old('period_name') == '6th' ? "selected" : '') }} value="6th">6th</option>
                                                                <option {{ (old('period_name') == '7th' ? "selected" : '') }}  value="7th">7th</option>
                                                                <option {{ (old('period_name') == '8th' ? "selected" : '') }} value="8th">8th</option>
                                                                <option {{ (old('period_name') == 'Recess' ? "selected" : '') }} value="Recess">Recess</option>
                                                            </select>
{{--                                                           <input type="text" name="period_name" class="form-control">--}}
                                                            <label for="first-name-column">Period Name</label>
                                                            <span style="color: red">{{ $errors->first('period_name') }}</span>
                                                        </div>
                                                    </div>
{{--                                                    <div class="col-md-2 col-12">--}}
{{--                                                        <div class="form-label-group">--}}
{{--                                                            <select type="text" class="form-control"  name="standard_id">--}}
{{--                                                                <option value="">-Select Standard-</option>--}}
{{--                                                                @foreach($standards as $standard)--}}
{{--                                                                    <option value="{{ $standard->id }}">{{ $standard->name }}</option>--}}
{{--                                                                @endforeach--}}
{{--                                                            </select>--}}
{{--                                                            <label for="standard">Standard</label>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <input type="time" value="{{old('time_from')}}" name="time_from" class="form-control">
                                                            <label for="first-name-column">Time From</label>
                                                            <span style="color: red">{{ $errors->first('time_from') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <input type="time" value="{{old('time_to')}}" name="time_to" class="form-control">
                                                            <label for="first-name-column">Time To</label>
                                                            <span style="color: red">{{ $errors->first('time_to') }}</span>
                                                        </div>
                                                    </div>


                                                    <div class="col-4">
                                                        <input type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" value="Submit">

                                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
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
            <div class="content-body"><!-- Basic Horizontal form layout section start -->

                <div class="row" id="table-striped">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Period List</h4>

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
                                            <th scope="col">Standard</th>
                                            <th scope="col">Period</th>
                                            <th scope="col">Time From</th>
                                            <th scope="col">Time To</th>

                                            <th scope="col">Action</th>
{{--                                            <th></th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($periods as $key => $period)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                @if(auth()->user()->role->name == "super_admin")
                                                    <th>{{$period->school->full_name}}</th>
                                                @endif
                                                <th>{{$period->standard->name}}</th>
                                                <th>{{$period->period_name}}</th>
                                                <th>{{$period->time_from}}</th>
                                                <th>{{$period->time_to}}</th>

                                                <td><a href="{{route('period.edit', $period->id)}}" class="btn btn-sm btn-primary">Edit</a></td>
{{--                                                <td><a href="period_delete/{{$period->id}}" class="btn btn-sm btn-danger">Delete</a></td>--}}
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
    </script>
@endpush
