<!DOCTYPE html>
<html
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
    data-assets-path="{{url('assets/').'/'}}"
    data-template="vertical-menu-template-starter"
    data-theme="theme-default"
    dir="rtl"
    lang="fa"
>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>قالب مدیریت</title>
    <meta content="" name="description" />
    <!-- Favicon -->
    <link
        href="{{url('assets/img/favicon/favicon.ico')}}"
        rel="icon"
        type="image/x-icon"
    />
    <link href="{{url('assets/vendor/fonts/tabler-icons.css')}}" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="assets/vendor/fonts/fontawesome.css" /> -->
    <!-- <link rel="stylesheet" href="assets/vendor/fonts/flag-icons.css" /> -->
    <!-- Core CSS -->
    <link
        class="template-customizer-core-css"
        href="{{url('assets/vendor/css/rtl/core.css')}}"
        rel="stylesheet"
    />
    <link
        class="template-customizer-theme-css"
        href="{{url('assets/vendor/css/rtl/theme-default.css')}}"
        rel="stylesheet"
    />
    <link href="{{url('assets/css/demo.css')}}" rel="stylesheet" />
    <!-- Vendors CSS -->
    <link
        href="{{asset('/assets/vendor/libs/node-waves/node-waves.css')}}"
        rel="stylesheet"
    />
    <link
        href="{{asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}"
        rel="stylesheet"
    />
    <!-- Page CSS -->
    <!-- Helpers -->
    <script src="{{asset('/assets/vendor/js/helpers.js')}}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{asset('/assets/vendor/js/template-customizer.js')}}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('/assets/js/config.js')}}"></script>
    <!-- Better experience of RTL -->
    <link href="{{asset('/assets/css/rtl.css')}}" rel="stylesheet" />
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        @include('admin.partials.navigation')
        <!-- / Menu -->
        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            @include('admin.partials.header')
            <!-- / Navbar -->
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                {{$slot}}
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
</div>
<!-- / Layout wrapper -->
<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{asset('/assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{asset('/assets/vendor/libs/popper/popper.js')}}"></script>
<script src="{{asset('/assets/vendor/js/bootstrap.js')}}"></script>
<script src="{{asset('/assets/vendor/libs/node-waves/node-waves.js')}}"></script>
<script src="{{asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('/assets/vendor/libs/hammer/hammer.js')}}"></script>
<script src="{{asset('/assets/vendor/js/menu.js')}}"></script>
<!-- endbuild -->
<!-- Vendors JS -->
<!-- Main JS -->
<script src="{{asset('assets/js/main.js')}}"></script>
<!-- Page JS -->
</body>
</html>

