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
                            <h2 class="content-header-title float-left mb-0">General Setting</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Period</a>
                                    </li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
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
                                        <form class="form" method="POST" action="{{route('period.update', $period->id)}}">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    @if(auth()->user()->role->name == "super_admin")
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <select id="school_id"  onchange="getStandard()"  name="school_id" class="form-control">
                                                                    <option>-SELECT School-</option>

                                                                    @foreach($schools as $school)
                                                                        <option {{ $period->school_id == $school->id ? "selected" : " " }} value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <select type="text" id="standard_id" class="form-control"  name="standard_id">
                                                                    <option value="">-Select Standard-</option>
                                                                    @foreach($standards as $standard)
                                                                        <option  {{ $standard->id == $period->standard_id ? "selected" : " " }} value="{{ $standard->id }}">{{ $standard->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="standard">Standard</label>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="col-md-2 col-12">
                                                            <div class="form-label-group">
                                                                <select type="text" id="standard_id" class="form-control"  name="standard_id">
                                                                    <option value="">-Select Standard-</option>
                                                                    @foreach($standards as $standard)
                                                                        <option  {{ $standard->id == $period->standard_id ? "selected" : " " }} value="{{ $standard->id }}">{{ $standard->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label for="standard">Standard</label>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <select type="text" class="form-control"  name="period_name">
                                                                <option value="">-Select Period-</option>
                                                                <option {{ $period->period_name == '1st' ? "selected" : " " }} value="1st">1st</option>
                                                                <option {{ $period->period_name == '2nd'  ? "selected" : " " }} value="2nd">2nd</option>
                                                                <option {{ $period->period_name == '3rd'  ? "selected" : " " }} value="3rd">3rd</option>
                                                                <option {{ $period->period_name == '4th'  ? "selected" : " " }} value="4th">4th</option>
                                                                <option {{ $period->period_name == '5th'  ? "selected" : " " }} value="5th">5th</option>
                                                                <option {{ $period->period_name == '6th'  ? "selected" : " " }} value="6th">6th</option>
                                                                <option {{ $period->period_name == '7th'  ? "selected" : " " }} value="7th">7th</option>
                                                                <option {{ $period->period_name == '8th'  ? "selected" : " " }} value="8th">8th</option>
                                                                <option {{ $period->period_name == 'Recess'  ? "selected" : " " }} value="Recess">Recess</option>
                                                            </select>
                                                            {{--<input type="text" name="period_name" class="form-control" value="{{$period->period_name}}">--}}
                                                            <label for="first-name-column">Period Name</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <input type="time" name="time_from" class="form-control" value="{{$period->time_from }}">
                                                            <label for="first-name-column">Time From</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <input type="time" name="time_to" class="form-control" value="{{$period->time_to }}">
                                                            <label for="first-name-column">Time To</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <input type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" value="Submit">

                                                        <a href="{{url('/period')}}"><input type="button" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light" value="Back"></a>
                                                    </div>

                                                </div>




                                            </div>

                                        </form>
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
    </script>

        <script src="{{asset('admin_assets/vendors/js/vendors.min.js') }}"></script>

@endpush
