<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/iconfonts/font-awesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/css/vendor.bundle.addons.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">
    <!-- endinject -->
    @yield('head')
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="/">
                <img src="{{asset('images/logo.png')}}" width="120px" alt="Nosmercado">
            </a>
            <a class="navbar-brand brand-logo-mini" href="/">
                N
            </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="fas fa-bars"></span>
            </button>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                <span class="fas fa-bars"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item nav-profile">
                    <div class="nav-link">
                        <div class="profile-image">
                            <img src="{{asset('assets/admin/images/faces/face5.jpg')}}" alt="image"/>
                        </div>
                        <div class="profile-name">
                            <p class="name">
                                {{auth()->user()->name}}
                            </p>
                            <p class="designation">
                                Admin
                            </p>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.home')}}">
                        <i class="fa fa-home menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.posts')}}">
                        <i class="fas fa-minus-square menu-icon"></i>
                        <span class="menu-title">Active Posts</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.archive.posts')}}">
                        <i class="fa fa-edit menu-icon"></i>
                        <span class="menu-title">Archive Posts</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link"
                       onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                       href="javascript:void(0)">
                        <i class="fa fa-power-off menu-icon"></i>
                        <span class="menu-title">Logout</span>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

                    </a>
                </li>
            </ul>
        </nav>
        <!-- partial -->

        <div class="main-panel">

        @yield('content')

        <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © {{date('Y')}} <a
                                href="http://nosmercado.com" target="_blank">Nosmercado</a>. All rights reserved.</span>

                </div>
            </footer>
            <!-- partial -->
            <!-- main-panel ends -->
        </div>
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="{{asset('assets/admin/vendors/js/vendor.bundle.base.js')}}"></script>
<script src="{{asset('assets/admin/vendors/js/vendor.bundle.addons.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{asset('assets/admin/js/off-canvas.js')}}"></script>
<script src="{{asset('assets/admin/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('assets/admin/js/misc.js')}}"></script>
<script src="{{asset('assets/admin/js/settings.js')}}"></script>
<script src="{{asset('assets/admin/js/todolist.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{asset('assets/admin/js/dashboard.js')}}"></script>
<!-- End custom js for this page-->

@yield('footer')
</body>

</html>
