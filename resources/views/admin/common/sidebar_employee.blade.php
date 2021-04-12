<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="index-2.html">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">CSMS</h2></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" navigation-header"><span>Apps</span>
            </li>
            <li class=" nav-item"><a href="{{url('/dashboard')}}"><i class="fa fa-address-book"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
            </li>
            @php
               $menu_items = \App\EmployeeMenuItem::where('user_id', auth()->user()->id)->get()->groupBy('category');
            @endphp
            @foreach($menu_items as $key => $menu_item)
                @if(count($menu_item) == 1 && empty($menu_item['item']))
                    <li class=" nav-item">
                        <a href="{{url($menu_item[0]['url'])}}">
                            <i class="{{$menu_item[0]['category_icon']}}"></i>
                            <span class="menu-title" data-i18n="Dashboard">{{$menu_item[0]['category']}}</span>
                        </a>
                    </li>
                @else
                    <li class=" nav-item"><a href="#"><i class="fa fa-shopping-bag"></i><span class="menu-title" data-i18n="PreAdmission">{{$key}}</span></a>
                    @foreach($menu_item as $item)
                        <ul class="menu-content">
                            <li><a href="{{url($item['url'])}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="PreExam">{{$item['item']}}</span></a></li>
                        </ul>
                    @endforeach
                    </li>
                @endif
           @endforeach

{{--            <li class=" nav-item"><a href="{{url('/edit-my-profile/'.auth()->user()->employee->id)}}"><i class="fa fa-address-book"></i><span class="menu-title" data-i18n="Dashboard">Edit Profile</span></a>--}}
{{--            </li>--}}
{{--            <li class=" nav-item"><a href="{{url('/view-timetable')}}"><i class="fa fa-address-book"></i><span class="menu-title" data-i18n="Dashboard">Timetable</span></a>--}}
{{--            </li>--}}
{{--            <li class=" nav-item"><a href="{{url('/attendances')}}"><i class="fa fa-address-book"></i><span class="menu-title" data-i18n="Dashboard">Attendance</span></a>--}}
{{--            </li>--}}

        </ul>
    </div>
</div>
