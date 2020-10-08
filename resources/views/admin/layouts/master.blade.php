<!DOCTYPE html>
<html lang="en" >
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <meta name="author" content="Web Garage">
    <title> Welcome to CSMS Pro</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" href="{{asset('admin_assets/images/ico/apple-icon-120.html')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('admin_assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    {{--<link rel="stylesheet" type="text/css" href="{{asset('/admin_assets/feather.woff')}}">--}}
    <link rel="stylesheet" type="text/css" href="{{asset('/admin_assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/admin_assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/vendors/css/extensions/tether-theme-arrows.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/vendors/css/extensions/tether.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/vendors/css/extensions/shepherd-theme-default.css')}}">

    {{--<link rel="stylesheet" type="text/css" href="{{asset('admin_assets/vendors/css/forms/select/select2.min.css')}}">--}}
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/bootstrap-extended.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/colors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/components.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/themes/dark-layout.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/themes/semi-dark-layout.min.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/core/menu/menu-types/vertical-menu.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/core/colors/palette-gradient.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/pages/dashboard-analytics.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/pages/card-analytics.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/plugins/tour/tour.min.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    {{--<script src="{{asset('admin_assets/js/scripts/forms/select/form-select2.min.js')}}"></script>--}}
    {{--<script src="{{asset('admin_assets/vendors/js/forms/select/select2.full.min.js')}}"></script>--}}


    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    {{--<link rel="stylesheet" href="sweetalert2/dist/sweetalert2.css">--}}
    <script src="{{ asset('js/app.js') }}" defer></script>

<style>
    .stepwizard-step p {
        margin-top: 10px;
    }

    .stepwizard-row {
        display: table-row;
    }

    .stepwizard {
        display: table;
        width: 100%;
        position: relative;
    }

    .stepwizard-step button[disabled] {
        opacity: 1 !important;
        filter: alpha(opacity=100) !important;
    }

    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;

    }

    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }

    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }
    #pre_exam_length{
        margin-bottom: 20px !important;
    }
    .modal .modal-header .close {
        left: 0px;
    }
    .modal-content {
        top: 185px;
    }
</style>


    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
{{--    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">--}}
{{--    <script src="https://unpkg.com/feather-icons"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>--}}
    <style>
        .tippy-popper{
            display: none;
        }
        .table-card-header{
            margin-bottom:17px ;
        }
    </style>
    <!-- END: Custom CSS-->
@stack('css')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern dark-layout 2-columns  navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">

<!-- BEGIN: Header-->
@include('admin.common.header')
<!-- END: Header-->


<!-- BEGIN: Main Menu-->
@if(auth()->user()->role->name == 'super_admin')
    @include('admin.common.sidebar_super_admin')
@elseif(auth()->user()->role->name == 'admin')
    @include('admin.common.sidebar_school')
@elseif(auth()->user()->role->name == 'parent')
    @include('admin.common.sidebar_parent')
@elseif(auth()->user()->role->name == 'employee')
    @include('admin.common.sidebar_employee')
@endif
<!-- END: Main Menu-->

<!-- BEGIN: Content-->
@yield('content')
<!-- END: Content-->



<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
@include('admin.common.footer')
<!-- END: Footer-->
@stack('scripts')

<!-- BEGIN: Vendor JS-->
<script src="{{asset('admin_assets/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('admin_assets/vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('admin_assets/vendors/js/extensions/tether.min.js')}}"></script>
<script src="{{asset('admin_assets/vendors/js/extensions/shepherd.min.js')}}"></script>
{{--<script src="{{asset('admin/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>--}}
{{--<script src="{{asset('admin/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>--}}
{{--<script src="{{asset('admin/vendors/js/tables/datatable/datatables.min.js')}}"></script>--}}
{{--<script src="{{asset('admin/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>--}}
{{--<script src="{{asset('admin/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>--}}
{{--<script src="{{asset('admin/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>--}}
{{--<script src="{{asset('admin/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>--}}
{{--<script src="{{asset('admin/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>--}}
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('admin_assets/js/core/app-menu.min.js')}}"></script>
<script src="{{asset('admin_assets/js/core/app.min.js')}}"></script>
<script src="{{asset('admin_assets/js/scripts/components.min.js')}}"></script>
<script src="{{asset('admin_assets/js/scripts/customizer.min.js')}}"></script>
<script src="{{asset('admin_assets/js/scripts/footer.min.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('admin_assets/js/scripts/pages/dashboard-analytics.min.js')}}"></script>
<script src="{{asset('admin_assets/js/scripts/forms/wizard-steps.min.js')}}"></script>
<script src="{{asset('admin_assets/js/scripts/datatables/datatable.min.js')}}"></script>
<script src="{{asset('admin_assets/vendors/js/extensions/jquery.steps.min.js')}}"></script>
<script src="{{asset('admin_assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>

<script>
    $(document).ready(function () {

        // $('#pre_exam').DataTable({
        //     serverSide: true,
        //     processing: true,
        //     responsive: true,
        //     ajax: "/lara_pre_exam",
        //     columns: [
        //         { name: 'exam_name' },
        //         { name: 'full_mark' },
        //         { name: 'classes.create_class', orderable: false },
        //         { name: 'current_year' },
        //         { name: 'action', orderable: false, searchable: false }
        //     ],
        // });

        var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

        allWells.hide();

        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                $item = $(this);

            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-primary').addClass('btn-default');
                $item.addClass('btn-primary');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });

        allNextBtn.click(function(){
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url']"),
                isValid = true;

            $(".form-group").removeClass("has-error");
            for(var i=0; i<curInputs.length; i++){
                if (!curInputs[i].validity.valid){
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }

            if (isValid)
                nextStepWizard.removeAttr('disabled').trigger('click');
        });

        $('div.setup-panel div a.btn-primary').trigger('click');
    });
</script>
</body>
</html>
