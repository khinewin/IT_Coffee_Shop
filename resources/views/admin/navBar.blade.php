@include('partials.adminNavbar')



<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12" id="adminPageHeader">
            <h1 class="page-header">@yield('pageTitle')</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    @yield('adminContent')

    </div>
    <!-- /#page-wrapper -->
