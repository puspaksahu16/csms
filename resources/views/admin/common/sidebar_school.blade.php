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
            <li class=" nav-item"><a href="{{url('/parents')}}"><i class="fa fa-user"></i><span class="menu-title" data-i18n="Schools">Parents</span></a>
            </li>
            <li class=" nav-item"><a href="{{url('/employee')}}"><i class="fa fa-user"></i><span class="menu-title" data-i18n="Schools">Employee</span></a>
            </li>
            <li class=" nav-item"><a href="#"><i class="fa fa-shopping-bag"></i><span class="menu-title" data-i18n="PreAdmission">Pre Admission</span></a>
                <ul class="menu-content">
                    <li><a href="{{url('/pre_exam')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="PreExam">Pre Exam</span></a></li>
                    <li><a href="{{url('/pre_admissions')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="Register">Register</span></a></li>
                    <li><a href="{{url('/result')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="Result">Result</span></a></li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="fa fa-shopping-bag"></i><span class="menu-title" data-i18n="Admission">Admission</span></a>
                <ul class="menu-content">
                    <li><a href="{{url('/new_admission')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="NewAdmission">New Admission</span></a></li>
                    {{--<li><a href="#"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="ReAdmission">Re Admission</span></a></li>--}}
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="fa fa-shopping-bag"></i><span class="menu-title" data-i18n="Account">Accounts</span></a>
                <ul class="menu-content">
                    <li><a href="{{url('/admission_fee')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="AnnualFee">Annual Fee</span></a></li>
                    <li><a href="{{url('/monthly_fees')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="MonthlyFee">Monthly Fee</span></a></li>
                    <li><a href="{{ url('/store_fees') }}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="StoreFee">Store Fee</span></a></li>
                    {{--<li><a href="#"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="ReAddmission">Re Addmission</span></a></li>--}}
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="fa fa-shopping-bag"></i><span class="menu-title" data-i18n="Store">Store</span></a>
                <ul class="menu-content">
                    <li><a href="{{ url('/products') }}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="products">Products</span></a></li>
                    <li><a href="{{ url('/stocks') }}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="stock">Stock</span></a></li>
                    <li><a href="{{ url('/books') }}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="stock">Book</span></a></li>
                    <li><a href="{{ url('/book_stocks') }}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="stock">Books Stock</span></a></li>
                    <li><a href="{{url('/damages')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="damage">Damage</span></a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="report">Report</span></a></li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="fa fa-shopping-bag"></i><span class="menu-title" data-i18n="GeneralSetting">Fee Structure</span></a>
                <ul class="menu-content">
                    <li><a href="{{url('/general')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="example">General Fee</span></a></li>
                    <li><a href="{{url('/extraclasses')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="example">CCA</span></a></li>
                    <li><a href="{{url('/book_price')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="example">Books</span></a></li>
                    <li><a href="{{ url('/product_price') }}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="example">Products</span></a></li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="fa fa-shopping-bag"></i><span class="menu-title" data-i18n="GeneralSetting">Class and Section</span></a>
                <ul class="menu-content">
                    <li><a href="{{url('/standard')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="example">Assign Standard</span></a></li>
                    <li><a href="{{url('/classes')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="example">Assign Class</span></a></li>
                    <li><a href="{{url('/section')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="example">Assign Section</span></a></li>
                    <li><a href="{{url('/assign_teacher')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="example">Assign Class Teacher</span></a></li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="fa fa-shopping-bag"></i><span class="menu-title" data-i18n="GeneralSetting">Time-Table</span></a>
                <ul class="menu-content">
                    <li><a href="{{url('/timetable')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="example">Set Time-Table</span></a></li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="fa fa-shopping-bag"></i><span class="menu-title" data-i18n="GeneralSetting">General Setting</span></a>
                <ul class="menu-content">
                    <li><a href="{{url('/set_standard')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="example">Create Standard</span></a></li>
                    <li><a href="{{url('/set_class')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="example">Create Class</span></a></li>
                    <li><a href="{{url('/set_section')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="example">Create Section</span></a></li>
                    <li><a href="{{url('/period')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="example">Create Period</span></a></li>
                    <li><a href="{{url('/idproof')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="example">Create Id Proof</span></a></li>
                    <li><a href="{{url('/qualification')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="example">Create Qualification</span></a></li>
                    <li><a href="{{url('/publisher')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="example">Create Publisher</span></a></li>
                    <li><a href="{{url('/subject')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="example">Create Subject</span></a></li>
                </ul>
            </li>
            <li class=" nav-item"><a href="{{url('/holiday')}}"><i class="fa fa-calendar"></i><span class="menu-title" data-i18n="Schools">Holiday list</span></a>
            </li>
            <li class=" nav-item"><a href="{{url('/chat')}}"><i class="fa fa-envelope-open"></i><span class="menu-title" data-i18n="Schools">Mail Box</span></a>
            </li>
            <li class=" nav-item"><a href="#"><i class="fa fa-book"></i><span class="menu-title" data-i18n="PreAdmission">Library</span></a>
                <ul class="menu-content">
                    <li><a href="{{url('/library')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="Libraryphp ">Register</span></a></li>
                    <li><a href="{{url('/issue_book')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="Register">Issue Book</span></a></li>
                    <li><a href="{{url('/return_book')}}"><i class="fa fa-circle-o"></i><span class="menu-item" data-i18n="Result">Return Book</span></a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
