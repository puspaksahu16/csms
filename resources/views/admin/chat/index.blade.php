@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/vendors/css/forms/select/select2.min.css') }}">
@endpush
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
            <div class="content-body"><!-- Basic Horizontal form layout section start -->
                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">

                        <div class="col-12">
                            @if(auth()->user()->role->name == "parent")
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Chat Setting</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <form class="form" action="{{route('chat.store')}}" method="POST">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-label-group">
                                                                <textarea  name="message" class="form-control"></textarea>
                                                                <label for="first-name-column">Message</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" value="Submit">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
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
                                <h4 class="card-title pb-2">Chat List</h4>
                                @if(auth()->user()->role->name == "super_admin" || auth()->user()->role->name == "admin")
                                <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-primary">Add</a>
                                @endif
                                <div class="modal" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Chat</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <form class="form" method="POST" action="{{ url('/send_mail') }}">
                                                    @csrf
                                                    <div class="form-label-group">
                                                        @if(auth()->user()->role->name == "super_admin")
                                                        <select  onchange="getParent()" id="school_id" name="school_id" class="form-control">
                                                            <option>-SELECT School-</option>
                                                            @foreach($schools as $school)
                                                                <option value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @endif
                                                        <br/>
                                                            @if(auth()->user()->role->name == "super_admin" || auth()->user()->role->name == "admin")
                                                                <label>Select Parents</label>
                                                        <select class="select2-size-sm form-control" id="parent"  multiple="multiple" name="parent_id">
                                                            @foreach($parents as $parent)
                                                                <option value="{{ $parent->id }}">{{ $parent->students->first_name." ".$parent->students->last_name }}  ({{ $parent->mother_email }})</option>
                                                            @endforeach
                                                        </select>
                                                            @endif


                                                        <br/>
                                                            <textarea  name="message" class="form-control" placeholder="Message"></textarea>
                                                    </div>
                                                    <button class="btn btn-primary btn-sm pull-right" type="submit">Submit</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-content">

                                <div class="table-responsive">
                                    <table class="table table-striped ">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            @if(auth()->user()->role->name == "super_admin")
                                            <th scope="col">School</th>
                                            @endif
                                            @if(auth()->user()->role->name == "super_admin" || auth()->user()->role->name == "admin")
{{--                                            <th scope="col">Student Name</th>--}}
                                            <th scope="col">Parent Email</th>
                                            @endif
                                            <th scope="col">Message</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($chats as $key => $chat)

                                            <tr>
                                                <td scope="row">{{$key+1}}</td>
                                                @if(auth()->user()->role->name == "super_admin")
                                                    <td>{{$chat->school->full_name}}</td>
                                                @endif
                                                @if(auth()->user()->role->name == "super_admin" || auth()->user()->role->name == "admin")

                                                    <td>{{$chat->parent->mother_email}}</td>
                                                @endif
                                                <td>{{$chat->message}}</td>
                                                <td>{{$chat->created_at}}</td>

                                                <td><a href="{{ url('chat/'.$chat->parent_id.'/'.$chat->school_id.'/') }}" class="btn btn-sm btn-success">view</a></td>
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
    <script src="{{asset('admin_assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{asset('admin_assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{asset('admin_assets/js/scripts/forms/select/form-select2.min.js')}}"></script>

<script>
    function getParent() {
        var school_id = $('#school_id').val();
        // alert(school_id);
        $.ajax({
            url : "/get_parents/"+school_id,
            type:'get',
            success: function(response) {
                console.log(response);
                $("#parent").attr('disabled', false);
                $("#parent").empty();
                $("#parent").append('<option value="">-Select Parent-</option>');
                $.each(response,function(key, value)
                {
                    $("#parent").append('<option value=' + value.id + '>' + value.mother_email + '</option>');
                });
            }
        });
    }
</script>
@endpush
