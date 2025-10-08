<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>REAL ESTATE | CRM</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/toastr/toastr.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    @yield('custom_css')

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('storage/' . auth()->user()->profile_path) }}" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('img/user8-128x128.jpg') }}" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('img/user3-128x128.jpg') }}" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ asset('img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Fama Real Estate</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar" style="overflow-y: auto;">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ auth()->user()->profile_path ? asset('storage/' . auth()->user()->profile_path) : asset('img/profile1.png') }}"
                            class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->first_name }}
                            {{ auth()->user()->last_name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('dashboard.index') }}"
                                class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        @php
                            $master = 0;
                            if (
                                request()->is([
                                    'areas',
                                    'locality',
                                    'property_type',
                                    'property',
                                    'vendors',
                                    'bank',
                                    'installment',
                                    'payment_mode',
                                    'nationality',
                                ])
                            ) {
                                $master = 1;
                            }
                        @endphp
                        @if (auth()->user()->hasPermissionInRange(1, 45))
                            <li class="nav-item {{ $master ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ $master ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                        Masters
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @if (Gate::any(['Area', 'area.add', 'area.view', 'area.edit', 'area.delete']))
                                        <li class="nav-item">
                                            <a href="{{ route('areas.index') }}"
                                                class="nav-link {{ request()->is('areas') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Area</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (Gate::any(['Locality', 'locality.add', 'locality.view', 'locality.edit', 'locality.delete']))
                                        <li class="nav-item">
                                            <a href="{{ route('locality.index') }}"
                                                class="nav-link {{ request()->is('locality') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Locality</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (Gate::any([
                                            'Property_type',
                                            'property_type.add',
                                            'property_type.view',
                                            'property_type.edit',
                                            'property_type.delete',
                                        ]))
                                        <li class="nav-item">
                                            <a href="{{ route('property_type.index') }}"
                                                class="nav-link {{ request()->is('property_type') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Property Type</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (Gate::any(['Property', 'property.add', 'property.view', 'property.edit', 'property.delete']))
                                        <li class="nav-item">
                                            <a href="{{ route('property.index') }}"
                                                class="nav-link {{ request()->is('property') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Property</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (Gate::any(['Vendor', 'vendor.add', 'vendor.view', 'vendor.edit', 'vendor.delete']))
                                        <li class="nav-item">
                                            <a href="{{ route('vendors.index') }}"
                                                class="nav-link {{ request()->is('vendors') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Vendor</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (Gate::any(['Bank', 'bank.add', 'bank.view', 'bank.edit', 'bank.delete']))
                                        <li class="nav-item">
                                            <a href="{{ route('bank.index') }}"
                                                class="nav-link {{ request()->is('bank') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Bank</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (Gate::any(['Installments', 'installments.add', 'installments.view', 'installments.edit', 'installments.delete']))
                                        <li class="nav-item">
                                            <a href="{{ route('installment.index') }}"
                                                class="nav-link {{ request()->is('installment') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Installment</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (Gate::any(['Payment_mode', 'payment_mode.add', 'payment_mode.view', 'payment_mode.edit', 'payment_mode.delete']))
                                        <li class="nav-item">
                                            <a href="{{ route('payment_mode.index') }}"
                                                class="nav-link {{ request()->is('payment_mode') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Payment Mode</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if (Gate::any(['Nationality', 'nationality.add', 'nationality.view', 'nationality.edit', 'nationality.delete']))
                                        <li class="nav-item">
                                            <a href="{{ route('nationality.index') }}"
                                                class="nav-link {{ request()->is('nationality') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Nationality</p>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if (Gate::any(['User', 'user.add', 'user.view', 'user.edit', 'user.delete']))
                            <li class="nav-item {{ request()->is('user') ? 'menu-open' : '' }}">
                                <a href="{{ route('user.index') }}"
                                    class="nav-link {{ request()->is('user') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Users
                                    </p>
                                </a>
                            </li>
                        @endif
                        {{-- onclick="signoutConf()" --}}
                        <li class="nav-item">
                            <a href="javascript:void(0)" onclick="signoutConf()" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-arrow-right"></i>
                                <p>Sign out</p>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('content')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.1.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/select2/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.5/dist/sweetalert2.all.min.js"></script>

    {{-- <script>
        window.addEventListener("pageshow", function(event) {
            // If page was loaded from back/forward cache
            if (event.persisted ||
                (window.performance && window.performance.getEntriesByType("navigation")[0].type === "back_forward")
            ) {

                // Redirect to login
                window.location.href = "{{ route('login') }}";
            }
        });
    </script> --}}
    @yield('custom_js')

    <!-- AdminLTE -->
    <script src="{{ asset('js/adminlte.js') }}"></script>

    <script>
        $(function() {

            $('.select2').select2()
        });

        function signoutConf() {
            Swal.fire({
                title: "Are you sure?",
                text: "You want to sign out!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, sign out!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // $.ajax({
                    //     type: "POST",
                    //     url: '/logout',
                    //     data: {
                    //         _token: $('meta[name="csrf-token"]').attr('content')
                    //     },
                    //     dataType: "json",
                    //     success: function(response) {
                    //         // toastr.success(response.message);
                    //         window.location.href = '/login';
                    //     }
                    // });
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>

</body>

</html>
