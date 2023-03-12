<!doctype html>
<html lang="en">

@include('admin-monstar.layouts.header')

<body>
    <!-- Preloader -->
    @include('admin-monstar.layouts.preloder')
    <!-- Preloader -->


    <!-- Setting Panel -->

    <!-- ======================================
    ******* Page Wrapper Area Start **********
    ======================================= -->
    <div class="ecaps-page-wrapper">
        <!-- Sidemenu Area -->
        @include('admin-monstar.layouts.sidebar')
        <!-- Page Content -->
        <div class="ecaps-page-content">
            <!-- Top Header Area -->
            @include('admin-monstar.layouts.topnav')
            <!-- Main Content Area -->
            @yield('content')
        </div>
    </div>

    <!-- ======================================
    ********* Page Wrapper Area End ***********
    ======================================= -->

    <!-- Must needed plugins to the run this Template -->
    @include('admin-monstar.layouts.footer')
    @include('vendor.roksta.toastr')
</body>

</html>
