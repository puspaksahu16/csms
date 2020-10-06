@extends('admin.layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/pages/app-chat.min.css')}}">
{{--    <div class="app-content content">--}}
{{--        <div class="content-overlay"></div>--}}
{{--        <div class="header-navbar-shadow"></div>--}}
{{--        <div class="content-wrapper">--}}
{{--            @if (session()->has('success'))--}}
{{--                <div class="alert alert-success">--}}
{{--                    @if(is_array(session()->get('success')))--}}
{{--                        <ul>--}}
{{--                            @foreach (session()->get('success') as $message)--}}
{{--                                <li>{{ $message }}</li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    @else--}}
{{--                        {{ session()->get('success') }}--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            @endif--}}
{{--            <div class="content-body"><!-- Basic Horizontal form layout section start -->--}}
{{--                <!-- // Basic multiple Column Form section start -->--}}
{{--                <section id="multiple-column-form">--}}
{{--                    <div class="row match-height">--}}

{{--                        <div class="col-12">--}}
{{--                            @if(auth()->user()->role->name == "parent")--}}
{{--                                <div class="card">--}}
{{--                                    <div class="card-header">--}}
{{--                                        <h4 class="card-title">Chat Setting</h4>--}}
{{--                                    </div>--}}
{{--                                    <div class="card-content">--}}
{{--                                        <div class="card-body">--}}
{{--                                            <form class="form" action="{{route('chat.store')}}" method="POST">--}}
{{--                                                @csrf--}}
{{--                                                <div class="form-body">--}}

{{--                                                    <div class="row">--}}

{{--                                                        <div class="col-6">--}}
{{--                                                            <div class="form-label-group">--}}
{{--                                                                <textarea  name="message" class="form-control"></textarea>--}}
{{--                                                                <label for="first-name-column">Message</label>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}


{{--                                                        <div class="col-6">--}}
{{--                                                            <input type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" value="Submit">--}}
{{--                                                            --}}{{--                                                                <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}


{{--                                                </div>--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </section>--}}
{{--                <!-- // Basic Floating Label Form section end -->--}}


{{--            </div>--}}

{{--            <div class="content-body"><!-- Basic Horizontal form layout section start -->--}}

{{--                <div class="row" id="table-striped">--}}
{{--                    <div class="col-12">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <h4 class="card-title pb-2">Chat List</h4>--}}
{{--                                @if(auth()->user()->role->name == "super_admin" || auth()->user()->role->name == "admin")--}}
{{--                                    <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-primary">Add</a>--}}
{{--                                @endif--}}
{{--                                <div class="modal" id="myModal">--}}
{{--                                    <div class="modal-dialog">--}}
{{--                                        <div class="modal-content">--}}

{{--                                            <!-- Modal Header -->--}}
{{--                                            <div class="modal-header">--}}
{{--                                                <h4 class="modal-title">Chat</h4>--}}
{{--                                                <button type="button" class="close" data-dismiss="modal">&times;</button>--}}
{{--                                            </div>--}}

{{--                                            <!-- Modal body -->--}}
{{--                                            <div class="modal-body">--}}
{{--                                                <form class="form" method="POST" action="{{ url('/send_mail') }}">--}}
{{--                                                    @csrf--}}
{{--                                                    <div class="form-label-group">--}}
{{--                                                        @if(auth()->user()->role->name == "super_admin")--}}
{{--                                                            <select  onchange="getParent()" id="school_id" name="school_id" class="form-control">--}}
{{--                                                                <option>-SELECT School-</option>--}}
{{--                                                                @foreach($schools as $school)--}}
{{--                                                                    <option value="{{ $school->id }}">{{ $school->full_name }}</option>--}}
{{--                                                                @endforeach--}}
{{--                                                            </select>--}}
{{--                                                        @endif--}}
{{--                                                        <br/>--}}
{{--                                                        @if(auth()->user()->role->name == "super_admin" || auth()->user()->role->name == "admin")--}}
{{--                                                            <select class="form-control" id="parent" name="parent_id">--}}
{{--                                                                <option value="">-Select Parent-</option>--}}
{{--                                                                @foreach($parents as $parent)--}}
{{--                                                                    <option value="{{ $parent->id }}">{{ $parent->mother_email }}</option>--}}
{{--                                                                @endforeach--}}
{{--                                                            </select>--}}
{{--                                                        @endif--}}
{{--                                                        <br/>--}}
{{--                                                        <textarea  name="message" class="form-control" placeholder="Message"></textarea>--}}



{{--                                                    </div>--}}
{{--                                                    <button class="btn btn-success btn-sm pull-right" type="submit">Submit</button>--}}
{{--                                                </form>--}}
{{--                                            </div>--}}

{{--                                            <!-- Modal footer -->--}}
{{--                                            --}}{{--                                                                <div class="modal-footer">--}}
{{--                                            --}}{{--                                                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>--}}
{{--                                            --}}{{--                                                                </div>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                            <div class="card-content">--}}

{{--                                <div class="table-responsive">--}}
{{--                                    <table class="table table-striped mb-0  zero-configuration">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th scope="col">#</th>--}}
{{--                                            @if(auth()->user()->role->name == "super_admin")--}}
{{--                                                <th scope="col">School</th>--}}
{{--                                            @endif--}}
{{--                                            @if(auth()->user()->role->name == "super_admin" || auth()->user()->role->name == "admin")--}}
{{--                                                --}}{{--                                            <th scope="col">Student Name</th>--}}
{{--                                                <th scope="col">Parent Email</th>--}}
{{--                                            @endif--}}
{{--                                            <th scope="col">Message</th>--}}
{{--                                            <th scope="col">Date</th>--}}
{{--                                            <th scope="col">Action</th>--}}
{{--                                            <th></th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        @foreach($chats as $key => $chat)--}}

{{--                                            <tr>--}}
{{--                                                <th scope="row">{{$key+1}}</th>--}}
{{--                                                @if(auth()->user()->role->name == "super_admin")--}}
{{--                                                    <th>{{$chat->school->full_name}}</th>--}}
{{--                                                @endif--}}
{{--                                                @if(auth()->user()->role->name == "super_admin" || auth()->user()->role->name == "admin")--}}
{{--                                                    --}}{{--                                                <th></th>--}}
{{--                                                    <th>{{$chat->parent->mother_email}}</th>--}}
{{--                                                @endif--}}
{{--                                                <th>{{$chat->message}}</th>--}}
{{--                                                <th>{{$chat->created_at}}</th>--}}
{{--                                                @if(auth()->user()->role->name == "parent")--}}
{{--                                                    <td><a href="" class="btn btn-sm btn-primary">Edit</a></td>--}}
{{--                                                @elseif(auth()->user()->role->name == "super_admin" || auth()->user()->role->name == "admin")--}}
{{--                                                    <td><a href="" class="btn btn-sm btn-success">view</a></td>--}}
{{--                                                    <td><a href="" class="btn btn-sm btn-info">Reply</a></td>--}}
{{--                                                @endif--}}

{{--                                            </tr>--}}
{{--                                        @endforeach--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

        <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-area-wrapper">
            <div class="sidebar-left">
                <div class="sidebar"><!-- User Chat profile area -->

                    <!--/ User Chat profile area -->
                    <!-- Chat Sidebar area -->
                    <div class="sidebar-content card">
                        <span class="sidebar-close-icon">
                          <i class="feather icon-x"></i>
                        </span>
                        <div class="chat-fixed-search">
                            <div class="d-flex align-items-center">
                                <div class="sidebar-profile-toggle position-relative d-inline-flex">
                                    <div class="avatar">
                                        <img src="{{asset('/admin_assets/images/portrait/small/avatar-s-11.jpg')}}" alt="user_avatar" height="40" width="40">
                                        <span class="avatar-status-online"></span>
                                    </div>
                                    <div class="bullet-success bullet-sm position-absolute"></div>
                                </div>
                                <fieldset class="form-group position-relative has-icon-left mx-1 my-0 w-100">
                                    <input type="text" class="form-control round" id="chat-search" placeholder="Search or start a new chat">
                                    <div class="form-control-position">
                                        <i class="feather icon-search"></i>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div id="users-list" class="chat-user-list list-group position-relative">
                            <h3 class="primary p-1 mb-0">Chats</h3>
                            <ul class="chat-users-list-wrapper media-list">
                                <li>
                                    <div class="pr-1">
                                      <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{asset('/admin_assets/images/portrait/small/avatar-s-3.jpg')}}" height="42" width="42" alt="Generic placeholder image">
                                      <i></i>
                                      </span>
                                    </div>
                                    <div class="user-chat-info">
                                        <div class="contact-info">
                                            <h5 class="font-weight-bold mb-0">Elizabeth Elliott</h5>
                                            <p class="truncate">Cake pie jelly jelly beans. Marzipan lemon drops halvah cake. Pudding cookie lemon drops icing</p>
                                        </div>
                                        <div class="contact-meta">
                                            <span class="float-right mb-25">4:14 PM</span>
                                            <span class="badge badge-primary badge-pill float-right">3</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="pr-1">
                                      <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{asset('/admin_assets/images/portrait/small/avatar-s-7.jpg')}}" height="42" width="42" alt="Generic placeholder image">
                                      <i></i>
                                      </span>
                                    </div>
                                    <div class="user-chat-info">
                                        <div class="contact-info">
                                            <h5 class="font-weight-bold mb-0">Kristopher Candy</h5>
                                            <p class="truncate">Cake pie jelly jelly beans. Marzipan lemon drops halvah cake. Pudding cookie lemon drops icing</p>
                                        </div>
                                        <div class="contact-meta">
                                            <span class="float-right mb-25">9:09 AM</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <h3 class="primary p-1 mb-0">Contacts</h3>
                            <ul class="chat-users-list-wrapper media-list">
                                <li>
                                    <div class="pr-1">
                                      <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{asset('/admin_assets/images/portrait/small/avatar-s-8.jpg')}}" height="42" width="42" alt="Generic placeholder image">
                                      <i></i>
                                      </span>
                                    </div>
                                    <div class="user-chat-info">
                                        <div class="contact-info">
                                            <h5 class="font-weight-bold mb-0">Sarah Woods</h5>
                                            <p class="truncate">Cake pie jelly jelly beans. Marzipan lemon drops halvah cake. Pudding cookie lemon drops icing.</p>
                                        </div>
                                        <div class="contact-meta">
                                            <span class="float-right mb-25"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="pr-1">
                                      <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{asset('/admin_assets/images/portrait/small/avatar-s-7.jpg')}}" height="42" width="42" alt="Generic placeholder image">
                                      <i></i>
                                      </span>
                                    </div>
                                    <div class="user-chat-info">
                                        <div class="contact-info">
                                            <h5 class="font-weight-bold mb-0">Jenny Perich</h5>
                                            <p class="truncate">Tart dragée carrot cake chocolate bar. Chocolate cake jelly beans caramels tootsie roll candy canes.</p>
                                        </div>
                                        <div class="contact-meta">
                                            <span class="float-right mb-25"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="pr-1">
                                      <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{asset('/admin_assets/images/portrait/small/avatar-s-5.jpg')}}" height="42" width="42" alt="Generic placeholder image">
                                      <i></i>
                                      </span>
                                    </div>
                                    <div class="user-chat-info">
                                        <div class="contact-info">
                                            <h5 class="font-weight-bold mb-0">Sarah Montgomery</h5>
                                            <p class="truncate">Tootsie roll sesame snaps biscuit icing jelly-o biscuit chupa chups powder.</p>
                                        </div>
                                        <div class="contact-meta">
                                            <span class="float-right mb-25"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="pr-1">
                                      <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{asset('/admin_assets/images/portrait/small/avatar-s-9.jpg')}}" height="42" width="42" alt="Generic placeholder image">
                                      <i></i>
                                      </span>
                                    </div>
                                    <div class="user-chat-info">
                                        <div class="contact-info">
                                            <h5 class="font-weight-bold mb-0">Heather Howell</h5>
                                            <p class="truncate">Tart cookie dragée sesame snaps halvah. Fruitcake sugar plum gummies cheesecake toffee.</p>
                                        </div>
                                        <div class="contact-meta">
                                            <span class="float-right mb-25"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="pr-1">
                                      <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{asset('/admin_assets/images/portrait/small/avatar-s-7.jpg')}}" height="42" width="42" alt="Generic placeholder image">
                                      <i></i>
                                      </span>
                                    </div>
                                    <div class="user-chat-info">
                                        <div class="contact-info">
                                            <h5 class="font-weight-bold mb-0">Kelly Reyes</h5>
                                            <p class="truncate">Wafer toffee tart jelly cake croissant chocolate bar cupcake donut. Fruitcake gingerbread tiramisu sweet jelly-o.</p>
                                        </div>
                                        <div class="contact-meta">
                                            <span class="float-right mb-25"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="pr-1">
                                      <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{asset('/admin_assets/images/portrait/small/avatar-s-14.jpg')}}" height="42" width="42" alt="Generic placeholder image">
                                      <i></i>
                                      </span>
                                    </div>
                                    <div class="user-chat-info">
                                        <div class="contact-info">
                                            <h5 class="font-weight-bold mb-0">Vincent Nelson</h5>
                                            <p class="truncate">Toffee gummi bears sugar plum gummi bears chocolate bar donut. Pudding cookie lemon drops icing</p>
                                        </div>
                                        <div class="contact-meta">
                                            <span class="float-right mb-25"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="pr-1">
                                      <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{asset('/admin_assets/images/portrait/small/avatar-s-3.jpg')}}" height="42" width="42" alt="Generic placeholder image">
                                      <i></i>
                                      </span>
                                    </div>
                                    <div class="user-chat-info">
                                        <div class="contact-info">
                                            <h5 class="font-weight-bold mb-0">Elizabeth Elliott</h5>
                                            <p class="truncate">Candy canes ice cream jelly beans carrot cake chocolate bar pastry candy jelly-o.</p>
                                        </div>
                                        <div class="contact-meta">
                                            <span class="float-right mb-25"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="pr-1">
                                      <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{asset('/admin_assets/images/portrait/small/avatar-s-7.jpg')}}" height="42" width="42" alt="Generic placeholder image">
                                      <i></i>
                                      </span>
                                    </div>
                                    <div class="user-chat-info">
                                        <div class="contact-info">
                                            <h5 class="font-weight-bold mb-0">Kristopher Candy</h5>
                                            <p class="truncate">Marzipan bonbon chocolate bar biscuit lemon drops muffin jelly-o sweet jujubes.</p>
                                        </div>
                                        <div class="contact-meta">
                                            <span class="float-right mb-25"></span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--/ Chat Sidebar area -->

                </div>
            </div>
            <div class="content-right">
                <div class="content-wrapper">
                    <div class="content-header row">
                    </div>
                    <div class="content-body"><div class="chat-overlay"></div>
                        <section class="chat-app-window">
                            <div class="start-chat-area">
                                <span class="mb-1 start-chat-icon feather icon-message-square"></span>
                                <h4 class="py-50 px-1 sidebar-toggle start-chat-text">Start Conversation</h4>
                            </div>
                            <div class="active-chat d-none">
                                <div class="chat_navbar">
                                    <header class="chat_header d-flex justify-content-between align-items-center p-1">
                                        <div class="vs-con-items d-flex align-items-center">
                                            <div class="sidebar-toggle d-block d-lg-none mr-1"><i class="feather icon-menu font-large-1"></i></div>
                                            <div class="avatar user-profile-toggle m-0 m-0 mr-1">
                                                <img src="{{asset('/admin_assets/images/portrait/small/avatar-s-1.jpg')}}" alt="" height="40" width="40" />
                                                <span class="avatar-status-busy"></span>
                                            </div>
                                            <h6 class="mb-0">Felecia Rower</h6>
                                        </div>
                                        <span class="favorite"><i class="feather icon-star font-medium-5"></i></span>
                                    </header>
                                </div>
                                <div class="user-chats">
                                    <div class="chats">
                                        <div class="chat">
                                            <div class="chat-avatar">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                    <img src="{{asset('/admin_assets/images/portrait/small/avatar-s-1.jpg')}}" alt="avatar" height="40" width="40"/>
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>How can we help? We're here for you!</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat chat-left">
                                            <div class="chat-avatar">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                                    <img src="{{asset('/admin_assets/images/portrait/small/avatar-s-7.jpg')}}" alt="avatar" height="40" width="40"/>
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Hey John,  I am looking for the best admin template.</p>
                                                    <p>Could you please help me to find it out?</p>
                                                </div>
                                                <div class="chat-content">
                                                    <p>It should be Bootstrap 4 compatible.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="divider">
                                            <div class="divider-text">Yesterday</div>
                                        </div>
                                        <div class="chat">
                                            <div class="chat-avatar">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                    <img src="{{asset('/admin_assets/images/portrait/small/avatar-s-1.jpg')}}" alt="avatar" height="40" width="40"/>
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Absolutely!</p>
                                                </div>
                                                <div class="chat-content">
                                                    <p>Vuexy admin is the responsive bootstrap 4 admin template.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat chat-left">
                                            <div class="chat-avatar">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                                    <img src="{{asset('/admin_assets/images/portrait/small/avatar-s-7.jpg')}}" alt="avatar" height="40" width="40"/>
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Looks clean and fresh UI.</p>
                                                </div>
                                                <div class="chat-content">
                                                    <p>It's perfect for my next project.</p>
                                                </div>
                                                <div class="chat-content">
                                                    <p>How can I purchase it?</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat">
                                            <div class="chat-avatar">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                    <img src="{{asset('/admin_assets/images/portrait/small/avatar-s-1.jpg')}}" alt="avatar" height="40" width="40"/>
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Thanks, from ThemeForest.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat chat-left">
                                            <div class="chat-avatar">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                                    <img src="{{asset('/admin_assets/images/portrait/small/avatar-s-7.jpg')}}" alt="avatar" height="40" width="40"/>
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>I will purchase it for sure.</p>
                                                </div>
                                                <div class="chat-content">
                                                    <p>Thanks.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat">
                                            <div class="chat-avatar">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                    <img src="{{asset('/admin_assets/images/portrait/small/avatar-s-1.jpg')}}" alt="avatar" height="40" width="40"/>
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Great, Feel free to get in touch on</p>
                                                </div>
                                                <div class="chat-content">
                                                    <p>https://pixinvent.ticksy.com/</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-app-form">
                                    <form class="chat-app-input d-flex" onsubmit="enter_chat();" action="javascript:void(0);">
                                        <input type="text" class="form-control message mr-1 ml-50" id="iconLeft4-1" placeholder="Type your message">
                                        <button type="button" class="btn btn-primary send" onclick="enter_chat();"><i class="fa fa-paper-plane-o d-lg-none"></i> <span class="d-none d-lg-block">Send</span></button>
                                    </form>
                                </div>
                            </div>
                        </section>
                        <!-- User Chat profile right area -->
                        <div class="user-profile-sidebar">
                            <header class="user-profile-header">
                        <span class="close-icon">
                          <i class="feather icon-x"></i>
                        </span>
                                <div class="header-profile-sidebar">
                                    <div class="avatar">
                                        <img src="{{asset('/admin_assets/images/portrait/small/avatar-s-1.jpg')}}" alt="user_avatar" height="70" width="70">
                                        <span class="avatar-status-busy avatar-status-lg"></span>
                                    </div>
                                    <h4 class="chat-user-name">Felecia Rower</h4>
                                </div>
                            </header>
                            <div class="user-profile-sidebar-area p-2">
                                <h6>About</h6>
                                <p>Toffee caramels jelly-o tart gummi bears cake I love ice cream lollipop. Sweet liquorice croissant candy danish dessert icing. Cake macaroon gingerbread toffee sweet.</p>
                            </div>
                        </div>
                        <!--/ User Chat profile right area -->

                    </div>
                </div>
            </div>
        </div>
        </div>
<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
@endsection
@push('scripts')
    <script src="{{asset('admin_assets/js/scripts/pages/app-chat.min.js')}}"></script>
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
