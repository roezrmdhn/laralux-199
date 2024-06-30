<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Datum | CRM Admin Dashboard Template</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" />

    <link rel="stylesheet" href="{{ asset('css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/backend.css?v=1.0.0') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"
        type='text/css'>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
</head>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <div class="side-menu-bt-sidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-secondary wrapper-menu" width="30"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-label="Toggle navigation">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-secondary" width="30" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto navbar-list align-items-center">
                                <li class="nav-item nav-icon search-content">
                                    <a href="#" class="search-toggle rounded" id="dropdownSearch"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg class="svg-icon text-secondary" id="h-suns" height="25"
                                            width="25" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </a>
                                    <div class="iq-search-bar iq-sub-dropdown dropdown-menu"
                                        aria-labelledby="dropdownSearch">
                                        <form action="#" class="searchbox p-2">
                                            <div class="form-group mb-0 position-relative">
                                                <input type="text" class="text search-input font-size-12"
                                                    placeholder="type here to search...">
                                                <a href="#" class="search-link">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class=""
                                                        width="20" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="nav-item nav-icon dropdown">
                                    <a href="#" class="nav-item nav-icon dropdown-toggle pr-0 search-toggle"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <img src="{{ asset('images/user/1.jpg') }}" class="img-fluid avatar-rounded"
                                            alt="user">
                                        <span class="mb-0 ml-2 user-name">{{ Auth::user()->name }}</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="dropdownMenuButton">
                                        <li class="dropdown-item  d-flex svg-icon border-top">
                                            <svg class="svg-icon mr-0 text-secondary" id="h-05-p" width="20"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>

                                            <form class="ml-2" id="logout-form" action="{{ route('logout') }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm bg-transparent"> Log
                                                    Out</button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="iq-sidebar sidebar-default">
            <div class="iq-sidebar-logo d-flex align-items-end justify-content-between">
                <a href="/dashboard" class="header-logo">
                    <img src="{{ asset('images/logo.png') }}" class="img-fluid rounded-normal light-logo"
                        alt="logo">
                    <img src="{{ asset('images/logo-dark.png') }}"
                        class="img-fluid rounded-normal d-none sidebar-light-img" alt="logo">
                    <span>Datum</span>
                </a>
                <div class="side-menu-bt-sidebar-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-light wrapper-menu" width="30"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
            <div class="data-scrollbar" data-scroll="1">
                <nav class="iq-sidebar-menu">
                    <ul id="iq-sidebar-toggle" class="side-menu">
                        <li class="px-3 pt-3 pb-2">
                            <span class="text-uppercase small font-weight-bold">Administrator /
                                {{ Auth::user()->roles }}</span>
                        </li>

                        <li class=" sidebar-layout">
                            <a href="/data-room" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                                    </svg>
                                </i>
                                <span class="ml-2">Room</span>
                            </a>
                        </li>
                        <li class=" sidebar-layout">
                            <a href="/data-hotel" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                                    </svg>
                                </i>
                                <span class="ml-2">Hotel</span>
                            </a>
                        </li>
                        <li class=" sidebar-layout">
                            <a href="/data-fasilitas" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                                    </svg>
                                </i>
                                <span class="ml-2">Fasilitas</span>
                            </a>
                        </li>
                        @if (Auth::user()->roles == 'Owner')
                            <li class=" sidebar-layout">
                                <a href="/data-membership" class="svg-icon">
                                    <i class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                                        </svg>
                                    </i>
                                    <span class="ml-2">Membership</span>
                                </a>
                            </li>
                        @endif

                        <li class=" sidebar-layout">
                            <a href="/data-hotel-type" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                    </svg>
                                </i>
                                <span class="ml-2">Hotels Type</span>
                            </a>
                        </li>
                        <li class=" sidebar-layout">
                            <a href="/data-room-type" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                    </svg>
                                </i>
                                <span class="ml-2">Rooms Type</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="pt-5 pb-5"></div>
            </div>
        </div>
        @yield('content')
    </div>
    <!-- Wrapper End-->
    <footer class="iq-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="../backend/privacy-policy.html">Privacy Policy</a>
                        </li>
                        <li class="list-inline-item"><a href="../backend/terms-of-service.html">Terms of Use</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 text-right">
                    <span class="mr-1">
                        Copyright
                        <script>
                            document.write(new Date().getFullYear())
                        </script>© <a href="#" class="">Datum</a>
                        All Rights Reserved.
                    </span>
                </div>
            </div>
        </div>
    </footer> <!-- Backend Bundle JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
    <script src="{{ asset('/js/backend-bundle.min.js') }}"></script>
    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('/js/customizer.js') }}"></script>

    <script src="{{ asset('/js/sidebar.js') }}"></script>

    <!-- Flextree Javascript-->
    <script src="{{ asset('/js/flex-tree.min.js') }}"></script>
    <script src="{{ asset('/js/tree.js') }}"></script>

    <!-- Table Treeview JavaScript -->
    <script src="{{ asset('/js/table-treeview.js') }}"></script>

    <!-- SweetAlert JavaScript -->
    <script src="{{ asset('/js/sweetalert.js') }}"></script>

    <!-- Vectoe Map JavaScript -->
    <script src="{{ asset('/js/vector-map-custom.js') }}"></script>

    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('/js/chart-custom.js') }}"></script>
    <script src="{{ asset('/js/charts/01.js') }}"></script>
    <script src="{{ asset('/js/charts/02.js') }}"></script>

    <!-- slider JavaScript -->
    <script src="{{ asset('/js/slider.js') }}"></script>

    <!-- Emoji picker -->
    <script src="{{ asset('/vendor/emoji-picker-element/index.js') }}" type="module"></script>


    <!-- app JavaScript -->
    <script src="{{ asset('/js/app.js') }}"></script>

    @yield('script')
</body>

</html>
