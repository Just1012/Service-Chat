<!DOCTYPE html>
<html lang="en" data-layout="twocolumn" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none"
    data-preloader="disable">

    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
            <script>
        window.addEventListener('beforeunload', function (e) {
            navigator.sendBeacon('/logout');
        });
    </script>
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('web/assets/images/unidy.png') }}">

        <!-- jsvectormap css -->
        <link href="{{ asset('web/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

        <!--Swiper slider css-->
        <link href="{{ asset('web/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Layout config Js -->
        <script src="{{ asset('web/assets/js/layout.js') }}"></script>

        <!-- Icons Css -->
        <link href="{{ asset('web/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('web/assets/css/app-rtl.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('web/assets/css/custom-rtl.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('web/assets/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- custom Css-->
        <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
        <style>
            * {
                font-family: 'cairo' !important;
            }
        </style>
        @stack('css')
    </head>

    <body dir="rtl" >

        <div id="layout-wrapper">
            @include('layouts.web_ex.header')
            @include('layouts.web_ex.notavcation')
            @include('layouts.web_ex.menu')

            <div class="vertical-overlay"></div>
            @yield('content')

        </div>
        @include('layouts.web_ex.preloader')
        @include('layouts.web_ex.customizer')
        @include('layouts.web_ex.thems')


        <!-- JAVASCRIPT -->

        <!-----------
        <script async>
            if (document.addEventListener) {
                document.addEventListener('contextmenu', function(e) {
                    // alert("This function has been disabled to prevent you from stealing my code!");
                    e.preventDefault();
                }, false);
            } else {
                document.attachEvent('oncontextmenu', function() {
                    //  alert("This function has been disabled to prevent you from stealing my code!");
                    window.event.returnValue = false;
                });
            }

            document.addEventListener('keydown', function(event) {
                if (event.keyCode == 123) {
                    //    alert("This function has been disabled to prevent you from stealing my code!");
                    window.event.returnValue = false;
                    return false;
                } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
                    //  alert("This function has been disabled to prevent you from stealing my code!");
                    window.event.returnValue = false;
                    return false;
                } else if (event.ctrlKey && event.keyCode == 85) {
                    ///  alert("This function has been disabled to prevent you from stealing my code!");
                    window.event.returnValue = false;
                    return false;
                }
            }, false);
        </script>
        ------------>
        <script type="module">
            // Import the functions you need from the SDKs you need
            import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.1/firebase-app.js";
            import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.8.1/firebase-analytics.js";
            // TODO: Add SDKs for Firebase products that you want to use
            // https://firebase.google.com/docs/web/setup#available-libraries

            // Your web app's Firebase configuration
            // For Firebase JS SDK v7.20.0 and later, measurementId is optional
            const firebaseConfig = {
              apiKey: "AIzaSyBtgb39bQ5JE3W7T-zJ2URyXpeZWcbKi_M",
              authDomain: "cleaning-service-66ce3.firebaseapp.com",
              projectId: "cleaning-service-66ce3",
              storageBucket: "cleaning-service-66ce3.appspot.com",
              messagingSenderId: "1010019383791",
              appId: "1:1010019383791:web:80f4c43616f678e32dde1a",
              measurementId: "G-6558DMH33R"
            };

            // Initialize Firebase
            const app = initializeApp(firebaseConfig);
            const analytics = getAnalytics(app);
          </script>
        <script src="{{ asset('web/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('web/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('web/assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('web/assets/libs/feather-icons/feather.min.js') }}"></script>
        <script src="{{ asset('web/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
        <script src="{{ asset('web/assets/js/plugins.js') }}"></script>

        <!-- apexcharts -->
        <script src="{{ asset('web/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

        <!-- Vector map-->
        <script src="{{ asset('web/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>

        <script src="{{ asset('web/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

        <!--Swiper slider js-->
        <script src="{{ asset('web/assets/libs/swiper/swiper-bundle.min.js') }}"></script>

        <!-- Dashboard init -->
        <script src="{{ asset('web/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('web/assets/js/app.js') }}"></script>

        <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
      
        {!! Toastr::message() !!}

<script>
            $('#refresh').on('click', function() {

table.ajax.reload(function (){
    $('#alert').css('display', 'none');


    },false);

});
</script>

        @stack('js')

    </body>
</html>
