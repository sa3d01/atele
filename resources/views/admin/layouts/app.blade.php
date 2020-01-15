<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="sa3d01">
        <link rel="shortcut icon" href="{{asset('panel/assets/images/amerni.png')}}">
{{--        <link href="{{url('panel/assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css')}}" rel="stylesheet" />--}}
{{--        <link href="{{url('panel/assets/plugins/switchery/css/switchery.min.css')}}" rel="stylesheet" />--}}
{{--        <link href="{{url('panel/assets/plugins/multiselect/css/multi-select.css')}}"  rel="stylesheet" type="text/css" />--}}
{{--        <link href="{{url('panel/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />--}}
{{--        <link href="{{url('panel/assets/plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" />--}}
{{--        <link href="{{url('panel/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />--}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css" rel="stylesheet" type="text/css">
        <link href="{{asset('panel/assets/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('panel/assets/css/core.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('panel/assets/css/components.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('panel/assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('panel/assets/css/pages.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('panel/assets/css/responsive.css')}}" rel="stylesheet" type="text/css" />
{{--        <link href="{{asset('panel/assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--        <link href="{{asset('panel/assets/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--        <link href="{{asset('panel/assets/plugins/datatables/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--        <link href="{{asset('panel/assets/plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--        <link href="{{asset('panel/assets/plugins/datatables/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--        <link href="{{asset('panel/assets/plugins/datatables/dataTables.colVis.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--        <link href="{{asset('panel/assets/plugins/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--        <link rel="stylesheet" href="{{asset('panel/assets/dropify/dist/css/dropify.min.css')}}">--}}
{{--        <link href="{{asset('panel/assets/plugins/datatables/fixedColumns.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>--}}
{{--        <link rel="stylesheet" href="{{ asset('panel/assets/plugins/fileinput/css/fileinput.css') }}">--}}
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/droid-arabic-kufi" type="text/css"/>
{{--        <link rel="stylesheet" href="{{asset('panel/assets/plugins/morris/morris.css')}}">--}}

        <style>
            p, a, h1, h2, h3, h4, td, table, div, span, li {
                font-family: 'DroidArabicKufiRegular' !important;
                font-weight: normal !important;
                font-style: normal !important;
            }
        </style>
        <title>@yield('title','لوحة التحكم')</title>
        @yield('style')
{{--        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>--}}
{{--        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>--}}
{{--        <script src="{{asset('panel/assets/js/modernizr.min.js')}}"></script>--}}
    </head>
    <body class="fixed-left" >
        <div id="wrapper" >
            @include('admin.layouts.topbar')
            @include('admin.layouts.sidebar')
            <div class="content-page">
                @yield('content')
                @include('admin.layouts.footer')
            </div>
        </div>
        <script>
            var resizefunc = [];
        </script>
        <script src="{{asset('panel/assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('panel/assets/plugins/waypoints/lib/jquery.waypoints.js')}}"></script>
        <script src="{{asset('panel/assets/plugins/counterup/jquery.counterup.min.js')}}"></script>
        <script>
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 10,
                    time: 1000
                });
            });
        </script>
        <script src="{{asset('panel/assets/js/bootstrap-rtl.min.js')}}"></script>
{{--        <script src="{{asset('panel/assets/js/detect.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/js/fastclick.js')}}"></script>--}}
        <script src="{{asset('panel/assets/js/jquery.slimscroll.js')}}"></script>
        <script src="{{asset('panel/assets/js/jquery.blockUI.js')}}"></script>
        <script src="{{asset('panel/assets/js/waves.js')}}"></script>
        <script src="{{asset('panel/assets/js/wow.min.js')}}"></script>
        <script src="{{asset('panel/assets/js/jquery.nicescroll.js')}}"></script>
        <script src="{{asset('panel/assets/js/jquery.scrollTo.min.js')}}"></script>
        <script>
            jQuery(document).ready(function($) {
                $(".slimscrollleft").niceScroll("#sidebar-menu",{cursorcolor:"aquamarine"});
            });
        </script>
{{--        <script src="{{asset('panel/assets/plugins/moment/moment.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/plugins/raphael/raphael-min.js')}}"></script>--}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
{{--        <script src="{{asset('panel/assets/pages/jquery.todo.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/pages/jquery.chat.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/plugins/peity/jquery.peity.min.js')}}"></script>--}}

{{--		<script src="{{asset('panel/assets/pages/jquery.dashboard_2.js')}}"></script>--}}

        <script src="{{asset('panel/assets/pages/jquery.sweet-alert.init.js')}}"></script>
{{--        <script src="{{asset('panel/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/plugins/datatables/buttons.bootstrap.min.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/plugins/datatables/jszip.min.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/plugins/datatables/pdfmake.min.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/plugins/datatables/vfs_fonts.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/plugins/datatables/buttons.html5.min.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/plugins/datatables/buttons.print.min.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/plugins/datatables/dataTables.fixedHeader.min.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/plugins/datatables/dataTables.keyTable.min.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/plugins/datatables/responsive.bootstrap.min.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/plugins/datatables/dataTables.scroller.min.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/plugins/datatables/dataTables.colVis.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/plugins/datatables/dataTables.fixedColumns.min.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/pages/datatables.init.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/dropify/dist/js/dropify.min.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/plugins/x-editable/js/bootstrap-editable.min.js')}}"></script>--}}
        <script src="{{asset('panel/assets/plugins/notifyjs/js/notify.js')}}"></script>
        <script src="{{asset('panel/assets/plugins/notifications/notify-metro.js')}}"></script>
{{--        <script src="{{asset('panel/assets/plugins/fileinput/js/fileinput.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/plugins/fileinput/js/fileinput_locale_ar.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/plugins/morris/morris.min.js')}}"></script>--}}
{{--        <script src="{{asset('panel/assets/plugins/jquery-knob/jquery.knob.js')}}"></script>--}}
        @yield('script')
        <script src="{{asset('panel/assets/js/jquery.core.js')}}"></script>
        <script src="{{asset('panel/assets/js/jquery.app.js')}}"></script>
        <div class="container">
            @include('admin.layouts.alerts')
        </div>
    </body>
</html>
