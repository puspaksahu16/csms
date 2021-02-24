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
            <li class=" nav-item"><a href="{{url('/edit-my-profile/'.auth()->user()->employee->id)}}"><i class="fa fa-address-book"></i><span class="menu-title" data-i18n="Dashboard">Edit Profile</span></a>
            </li>
            <li class=" nav-item"><a href="{{url('/view-timetable')}}"><i class="fa fa-address-book"></i><span class="menu-title" data-i18n="Dashboard">Timetable</span></a>
            </li>
            <li class=" nav-item"><a href="{{url('/attendances')}}"><i class="fa fa-address-book"></i><span class="menu-title" data-i18n="Dashboard">Attendance</span></a>
            </li>
        </ul>
    </div>
</div>
