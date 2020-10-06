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
{{--                                                                <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>--}}
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
                                                        <select class="form-control" id="parent" name="parent_id">
                                                            <option value="">-Select Parent-</option>
                                                            @foreach($parents as $parent)
                                                                <option value="{{ $parent->id }}">{{ $parent->mother_email }}</option>
                                                            @endforeach
                                                        </select>
                                                            @endif
                                                        <br/>
                                                            <textarea  name="message" class="form-control" placeholder="Message"></textarea>



                                                    </div>
                                                    <button class="btn btn-success btn-sm pull-right" type="submit">Submit</button>
                                                </form>
                                            </div>

                                            <!-- Modal footer -->
                                            {{--                                                                <div class="modal-footer">--}}
                                            {{--                                                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>--}}
                                            {{--                                                                </div>--}}

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-content">

                                <div class="table-responsive">
                                    <table class="table table-striped mb-0  zero-configuration">
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
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($chats as $key => $chat)

                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                @if(auth()->user()->role->name == "super_admin")
                                                <th>{{$chat->school->full_name}}</th>
                                                @endif
                                                @if(auth()->user()->role->name == "super_admin" || auth()->user()->role->name == "admin")
{{--                                                <th></th>--}}
                                                <th>{{$chat->parent->mother_email}}</th>
                                                @endif
                                                <th>{{$chat->message}}</th>
                                                <th>{{$chat->created_at}}</th>
                                                @if(auth()->user()->role->name == "parent")
                                                <td><a href="" class="btn btn-sm btn-primary">Edit</a></td>
                                                    @elseif(auth()->user()->role->name == "super_admin" || auth()->user()->role->name == "admin")
                                                    <td><a href="" class="btn btn-sm btn-success">view</a></td>
                                                    <td><a href="" class="btn btn-sm btn-info">Reply</a></td>
                                                    @endif

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
