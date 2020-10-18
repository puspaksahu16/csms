@extends('admin.layouts.master')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/pages/app-chat.min.css')}}">
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
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Chat</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body" >
                                            {{--<div style=" width: 100%; height:380px">--}}
                                            <div style="background-image: url({{url('/admin_assets/images/backgrounds/chat-bg-3.png')}}); width: 100%;">
                                                <div style="background-color: #10163ab3;padding-top: 50px; padding-bottom: 20px; padding-left: 20px;padding-right: 20px">
                                                        @foreach($chats as $chat)
                                                            @if(auth()->user()->role->name == 'super_admin' AND $chat->sender_type == 'admin')
                                                                <div class="pull-right">
                                                                    <span class="" style="border: #0C141C solid 1px;padding: 6px;background-color: #7367f0cf;border-radius: 10px;box-sizing: border-box; color: #fff">
                                                                        {{$chat->message}}
                                                                    </span>
                                                                    <br/>
                                                                    <p align="right" style="color: white">
                                                                        {{$chat->created_at->format('d-m-Y')}}
                                                                    </p>

                                                                </div>
                                                                <br>
                                                                <br>
                                                            @elseif(auth()->user()->role->name == $chat->sender_type)
                                                                <div class="pull-right">

                                                                    <span class="" style="border: #0C141C solid 1px;padding: 6px;background-color: #7367f0cf;border-radius: 10px;box-sizing: border-box; color: #fff">
                                                                        {{$chat->message}}
                                                                    </span>
                                                                    <br/>
                                                                    <p align="right" style="color: white">
                                                                        {{$chat->created_at->format('d-m-Y')}}
                                                                    </p>
                                                                </div>
                                                                <br>
                                                                <br>
                                                            @else
                                                            <div class="pull-left">
                                                                @if($chat->sender_type == 'admin')
                                                                    <div class="avatar user-profile-toggle m-0 m-0 mr-1">
                                                                        @if($chat->school->logo == '')
                                                                            <img class="round" src="{{asset('admin_assets/images/default.png')}}" alt="avatar" height="40" width="40" title="{{$chat->school->full_name}}">
                                                                            <span  class="" style=" color: #fff ; padding-top: 15px">&nbsp;
                                                                        {{$chat->created_at->format('d-m-Y')}}
                                                                    </span>
                                                                            @else
                                                                        <img class="round" src="{{asset('images/school_photo/'.$chat->school->logo)}}" alt="avatar" height="40" width="40" title="{{$chat->school->full_name}}">
                                                                            <span  class="" style=" color: #fff ; padding-top: 15px">&nbsp;
                                                                        {{$chat->created_at->format('d-m-Y')}}
                                                                    </span>

                                                                            @endif
                                                                    </div>
                                                                @else
                                                                    <div class="avatar user-profile-toggle m-0 m-0 mr-1">
                                                                        <img class="round" src="{{asset('admin_assets/images/portrait/small/avatar-s-1.jpg')}}" alt="avatar" height="40" width="40" title="{{$chat->parent->mother_email}}">

                                                                        <span  class="" style=" color: #fff ; padding-top: 15px">&nbsp;
                                                                        {{$chat->created_at->format('d-m-Y')}}
                                                                    </span>
                                                                    </div>

                                                                @endif
                                                                <span class="" style="border: #0C141C solid 1px;padding: 6px;background-color: #0C141C;border-radius: 10px;box-sizing: border-box; color: #fff">
                                                                        {{$chat->message}}
                                                                    </span>


                                                            </div>
                                                            <br>
                                                            <br>
                                                            @endif
                                                        @endforeach
                                                </div>
                                            </div>
                                            <br>
                                            <div class="container">
                                                <form method="post" action="{{ url('replay/'.$parent_id.'/'.$school_id.'/') }}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-11">
                                                            <input type="text" class="form-control message " name="message" placeholder="Type your message">
                                                        </div>
                                                        <div class="col-1">
                                                            <button type="submit" class="btn btn-primary" ><i class="fa fa-paper-plane-o"></i></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
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
    {{--<div class="app-content content">--}}
        {{--<div class="content-overlay"></div>--}}
        {{--<div class="header-navbar-shadow"></div>--}}
        {{--<div class="content-area-wrapper">--}}

            {{--<div class="content-right">--}}
                {{--<div class="content-wrapper">--}}
                    {{--<div class="content-header row">--}}
                    {{--</div>--}}
                    {{--<div class="content-body"><div class="chat-overlay"></div>--}}
                        {{--<section class="chat-app-window">--}}

                            {{--<div class="active-chat ">--}}
                                {{--<div class="chat_navbar">--}}
                                    {{--<header class="chat_header d-flex justify-content-between align-items-center p-1">--}}
                                        {{--<div class="vs-con-items d-flex align-items-center">--}}
                                            {{--<div class="sidebar-toggle d-block d-lg-none mr-1"><i class="feather icon-menu font-large-1"></i></div>--}}
                                            {{--<div class="avatar user-profile-toggle m-0 m-0 mr-1">--}}
                                                {{--<img src="{{ asset('admin_assets/images/portrait/small/avatar-s-1.jpg') }}" alt="" height="40" width="40" />--}}
                                                {{--<span class="avatar-status-busy"></span>--}}
                                            {{--</div>--}}
                                            {{--<h6 class="mb-0">Felecia Rower</h6>--}}
                                        {{--</div>--}}
                                        {{--<span class="favorite"><i class="feather icon-star font-medium-5"></i></span>--}}
                                    {{--</header>--}}
                                {{--</div>--}}
                                {{--<div class="user-chats">--}}
                                    {{--<div class="chats">--}}
                                        {{--<div class="chat">--}}
                                            {{--<div class="chat-avatar">--}}
                                                {{--<a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">--}}
                                                    {{--<img src="{{ asset('admin_assets/app-assets/images/portrait/small/avatar-s-1.jpg') }}" alt="avatar" height="40" width="40"/>--}}
                                                {{--</a>--}}
                                            {{--</div>--}}
                                            {{--<div class="chat-body">--}}
                                                {{--<div class="chat-content">--}}
                                                    {{--<p>How can we help? We're here for you!</p>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="chat chat-left">--}}
                                            {{--<div class="chat-avatar">--}}
                                                {{--<a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">--}}
                                                    {{--<img src="{{ asset('admin_assets/images/portrait/small/avatar-s-7.jpg') }}" alt="avatar" height="40" width="40"/>--}}
                                                {{--</a>--}}
                                            {{--</div>--}}
                                            {{--<div class="chat-body">--}}
                                                {{--<div class="chat-content">--}}
                                                    {{--<p>Hey John,  I am looking for the best admin template.</p>--}}
                                                    {{--<p>Could you please help me to find it out?</p>--}}
                                                {{--</div>--}}
                                                {{--<div class="chat-content">--}}
                                                    {{--<p>It should be Bootstrap 4 compatible.</p>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="divider">--}}
                                            {{--<div class="divider-text">Yesterday</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="chat">--}}
                                            {{--<div class="chat-avatar">--}}
                                                {{--<a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">--}}
                                                    {{--<img src="{{ asset('admin_assets/images/portrait/small/avatar-s-1.jpg') }}" alt="avatar" height="40" width="40"/>--}}
                                                {{--</a>--}}
                                            {{--</div>--}}
                                            {{--<div class="chat-body">--}}
                                                {{--<div class="chat-content">--}}
                                                    {{--<p>Absolutely!</p>--}}
                                                {{--</div>--}}
                                                {{--<div class="chat-content">--}}
                                                    {{--<p>Vuexy admin is the responsive bootstrap 4 admin template.</p>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="chat chat-left">--}}
                                            {{--<div class="chat-avatar">--}}
                                                {{--<a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">--}}
                                                    {{--<img src="../../../app-assets/images/portrait/small/avatar-s-7.jpg" alt="avatar" height="40" width="40"/>--}}
                                                {{--</a>--}}
                                            {{--</div>--}}
                                            {{--<div class="chat-body">--}}
                                                {{--<div class="chat-content">--}}
                                                    {{--<p>Looks clean and fresh UI.</p>--}}
                                                {{--</div>--}}
                                                {{--<div class="chat-content">--}}
                                                    {{--<p>It's perfect for my next project.</p>--}}
                                                {{--</div>--}}
                                                {{--<div class="chat-content">--}}
                                                    {{--<p>How can I purchase it?</p>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="chat">--}}
                                            {{--<div class="chat-avatar">--}}
                                                {{--<a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">--}}
                                                    {{--<img src="../../../app-assets/images/portrait/small/avatar-s-1.jpg" alt="avatar" height="40" width="40"/>--}}
                                                {{--</a>--}}
                                            {{--</div>--}}
                                            {{--<div class="chat-body">--}}
                                                {{--<div class="chat-content">--}}
                                                    {{--<p>Thanks, from ThemeForest.</p>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="chat chat-left">--}}
                                            {{--<div class="chat-avatar">--}}
                                                {{--<a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">--}}
                                                    {{--<img src="../../../app-assets/images/portrait/small/avatar-s-7.jpg" alt="avatar" height="40" width="40"/>--}}
                                                {{--</a>--}}
                                            {{--</div>--}}
                                            {{--<div class="chat-body">--}}
                                                {{--<div class="chat-content">--}}
                                                    {{--<p>I will purchase it for sure.</p>--}}
                                                {{--</div>--}}
                                                {{--<div class="chat-content">--}}
                                                    {{--<p>Thanks.</p>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="chat">--}}
                                            {{--<div class="chat-avatar">--}}
                                                {{--<a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">--}}
                                                    {{--<img src="../../../app-assets/images/portrait/small/avatar-s-1.jpg" alt="avatar" height="40" width="40"/>--}}
                                                {{--</a>--}}
                                            {{--</div>--}}
                                            {{--<div class="chat-body">--}}
                                                {{--<div class="chat-content">--}}
                                                    {{--<p>Great, Feel free to get in touch on</p>--}}
                                                {{--</div>--}}
                                                {{--<div class="chat-content">--}}
                                                    {{--<p>https://pixinvent.ticksy.com/</p>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="chat-app-form">--}}
                                    {{--<form class="chat-app-input d-flex" onsubmit="enter_chat();" action="javascript:void(0);">--}}
                                        {{--<input type="text" class="form-control message mr-1 ml-50" id="iconLeft4-1" placeholder="Type your message">--}}
                                        {{--<button type="button" class="btn btn-primary send" onclick="enter_chat();"><i class="fa fa-paper-plane-o d-lg-none"></i> <span class="d-none d-lg-block">Send</span></button>--}}
                                    {{--</form>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</section>--}}
                        {{--<!-- User Chat profile right area -->--}}
                        {{--<div class="user-profile-sidebar">--}}
                            {{--<header class="user-profile-header">--}}
    {{--<span class="close-icon">--}}
      {{--<i class="feather icon-x"></i>--}}
    {{--</span>--}}
                                {{--<div class="header-profile-sidebar">--}}
                                    {{--<div class="avatar">--}}
                                        {{--<img src="../../../app-assets/images/portrait/small/avatar-s-1.jpg" alt="user_avatar" height="70" width="70">--}}
                                        {{--<span class="avatar-status-busy avatar-status-lg"></span>--}}
                                    {{--</div>--}}
                                    {{--<h4 class="chat-user-name">Felecia Rower</h4>--}}
                                {{--</div>--}}
                            {{--</header>--}}
                            {{--<div class="user-profile-sidebar-area p-2">--}}
                                {{--<h6>About</h6>--}}
                                {{--<p>Toffee caramels jelly-o tart gummi bears cake I love ice cream lollipop. Sweet liquorice croissant candy danish dessert icing. Cake macaroon gingerbread toffee sweet.</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<!--/ User Chat profile right area -->--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection
@push('scripts')
    <script src="{{asset('admin_assets/js/scripts/pages/app-chat.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendors/js/vendors.min.js')}}"></script>
@endpush
