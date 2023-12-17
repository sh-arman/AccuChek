<!DOCTYPE html>

<head>

    {{-- -----------------------------------------------------------------------
    --------------------------------------------------------------------------
       Author: Shajedul Hasan Arman - armanhassan504@gmail.com
    --------------------------------------------------------------------------
       Github: https://github.com/sh-arman
       Linkedin: https://www.linkedin.com/in/armanhassan504
    --------------------------------------------------------------------------- --}}
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="description"
        content="SFS | Shaheen Food Product liveCheck | Shaheen Food suppliers | Shaheen LiveCheck | Panacea Live Ltd.">
    <meta name="author"
        content="Shajedul Hasan Arman | armanhassan504@gmail.com | https://github.com/sh-arman | https://www.linkedin.com/in/armanhassan504">

    <title>Analytics | Shaheen Food Suppliers Admin Panel</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('admin/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/boxicons.css') }}" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    {{-- Analytics --}}
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

</head>

<body>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            {{-- @include('admin.partials._menu') --}}
            <div class="layout-page">

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">


                        <nav class="card shadow-lg bg-white rounded navbar navbar-expand-lg">
                            <a class="navbar-brand text-center" href="#" style="color: #F27022; font-weight: bold;">SHAHEEN <br> Food Suppliers Analytics</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                              <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                              <div class="navbar-nav">


                                {{--  --}}


                                <a class="nav-item nav-link d-flex align-items-center
                                    {{ (request()->is('admin/dashboard')) ? 'active' : '' }}"
                                    href="{{ route('dashboard') }}">
                                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                                    Dashboard
                                </a>


                                <a class="nav-item nav-link d-flex align-items-center
                                    {{ (request()->is('admin/order')) ? 'active' : '' }}"
                                    href="{{ route('order') }}" >
                                    <i class="menu-icon bx bxs-zap"></i>
                                    Order Code
                                </a>


                                @if ( Auth::user()->role == 'panacea')
                                <a class="nav-item nav-link d-flex align-items-center
                                    {{ (request()->is('admin/template')) ? 'active' : '' }}"
                                    href="{{ route('template') }}">
                                    <i class='menu-icon bx bx-bookmarks'></i>
                                    Template
                                </a>
                                <a class="nav-item nav-link d-flex align-items-center
                                    {{ (request()->is('admin/users')) ? 'active' : '' }}"
                                    href="{{ route('users') }}">
                                    <i class="menu-icon  tf-icons bx bx-user"></i>
                                    User
                                </a>
                                @endif


                                <a class="nav-item nav-link d-flex align-items-center
                                {{ (request()->is('admin/analytics')) ? 'active' : '' }} {{ (request()->is('admin/analytics_search')) ? 'active' : '' }}"
                                    href="{{ route('analytics') }}">
                                    <i class='menu-icon bx bx-bar-chart-alt-2'></i>
                                    Analytics
                                </a>


                                <a class="nav-item nav-link d-flex align-items-center
                                    {{ (request()->is('admin/track')) ? 'active' : '' }}"
                                    href="{{ route('track') }}">
                                    <i class="menu-icon tf-icons bx bx-history"></i>
                                    Activity
                                </a>


                                <a class="nav-item nav-link d-flex align-items-center
                                    {{ (request()->is('admin/support')) ? 'active' : '' }}"
                                    href="{{ route('support') }}">
                                    <i class="menu-icon tf-icons bx bx-support"></i>
                                    Support
                                </a>



                                <a
                                class="nav-item nav-link d-flex align-items-center"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    <i class="menu-icon tf-icons bx bx-power-off me-2"></i>
                                    {{ __('Logout') }}
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </a>


                              </div>
                            </div>
                          </nav>
                        {{-- ========================================================================================== --}}

                        <div class="row mb-4 mt-2">
                            <div class="col-lg-8 mt-2">


                                {{-- <div class="d-md-block d-lg-block d-xl-none d-flex align-items-end">
                                    <form class="card shadow-lg bg-white rounded" action="{{ route('analytics_search') }}" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            <span class="input-group-text">From :</span>
                                            <input type="text" class="form-control" id="datepicker3"
                                                name="startDate"autocomplete="off" />
                                            <span class="input-group-text">To :</span>
                                            <input type="text" class="form-control" id="datepicker4"
                                                name="endDate"autocomplete="off" />
                                            <button class="btn btn-primary"type="submit"><i
                                                    class='bx bx-search-alt'></i>&nbsp; Search</button>
                                            <a class="btn btn-dark text-white" type="button"
                                                href="{{ route('analytics_search_lastyear') }}">
                                                <i class='bx bx-search-alt'></i>&nbsp; Last Year
                                            </a>
                                        </div>
                                    </form>
                                </div> --}}


                                    <div class="d-flex flex-wrap">
                                        <form class="card shadow-lg bg-white rounded" action="{{ route('analytics_search') }}" method="POST">
                                            @csrf

                                            <div class="row">
                                                <div class="col-md-10 col-lg-8 col-sm-12 d-flex align-items-center">
                                                    <span class="p-2">From</span>
                                                    <input type="text" class=" p-2 form-control" id="datepicker1" name="startDate"autocomplete="off" />


                                                    <span class="p-2">To</span>
                                                    <input type="text" class="p-2 form-control" id="datepicker2" name="endDate"autocomplete="off" />
                                                    <button class="btn btn-primary"type="submit"><i class='bx bx-search-alt'></i></button>
                                                </div>

                                                <div class="col d-flex justify-content-center">
                                                    <a class="btn btn-dark text-white" style="margin-left: -1rem;" type="button" href="{{ route('analytics_search_lastyear') }}"><i class='bx bx-search-alt'></i>&nbsp; Last Year</a>&nbsp;
                                                    <a class="btn btn-dark text-white" type="button" href="{{ route('analytics') }}"><i class='bx bx-refresh'></i>&nbsp; Refresh</a>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                            </div>

                            <div class="col-lg-4 mt-2">
                                <ul class="card list-group card shadow-lg bg-white rounded">
                                    <li class="list-group-item text-center bg-primary">
                                        <h5 class="text-white fw-semibold" style="margin: 0;">
                                            Verifications Report
                                        </h5>
                                    </li>
                                </ul>

                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card p-1 card shadow-lg bg-white rounded">
                                    <canvas id="myChart" height="450"></canvas>
                                </div>
                            </div>

                            <div class="col-lg-4">



                                <ul class="card list-group mb-4 card shadow-lg bg-white rounded mt-2">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        From
                                        <span
                                            class="badge bg-primary">{{ Carbon\Carbon::parse($startDate)->format('d M y') }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        To
                                        <span
                                            class="badge bg-primary">{{ Carbon\Carbon::parse($endDate)->format('d M y') }}</span>
                                    </li>
                                </ul>

                                <ul class="card list-group mb-4 card shadow-lg bg-white rounded">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Total Verifications
                                        <span class="badge bg-dark">{{ $total }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Web
                                        <span class="badge bg-dark">{{ $totalWeb }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Sms
                                        <span class="badge bg-dark">{{ $totalSms }}</span>
                                    </li>
                                </ul>



                                <ul class="card list-group mb-4 card shadow-lg bg-white rounded">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        First Verifications
                                        <span class="badge bg-success">{{ $firstTime }}</span>
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Repeat Verifications
                                        <span class="badge bg-danger">{{ $verified }}</span>
                                    </li>
                                </ul>

                                <ul class="card list-group card shadow-lg bg-white rounded">
                                    <li style="list-style: none;">
                                        <form action="{{ route('analytics_csv') }}" method="POST">
                                            @csrf
                                            <input type="date" name="sDate" value="{{ $startDate }}" hidden />
                                            <input type="date" name="eDate" value="{{ $endDate }}" hidden />
                                            <div class="input-group">
                                                <select name="remarks" class="form-select">
                                                    <option selected value="all">All Status</option>
                                                    <option value="firsttime">First Checks</option>
                                                    <option value="verified">Repeat Checks</option>
                                                </select>
                                                <button class="btn btn-primary" type="submit"><i
                                                        class='bx bxs-download'></i> &nbsp; Download CSV</button>
                                            </div>
                                        </form>
                                    </li>
                                </ul>

                            </div>
                        </div>

                    </div>
                    @include('admin.partials._footer')
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    {{-- <div class="buy-now">
      <a href="" target="_blank" class="btn btn-danger btn-buy-now">Upgrade to Live Check Pro</a>
    </div> --}}

    {{-- bootstrap --}}
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"crossorigin="anonymous"></script>

    {{-- Analytics --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <script>
        // chart js
        var _lebels = JSON.parse('{!! json_encode($months) !!}');
        var _data = JSON.parse('{!! json_encode($monthCount) !!}');

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: _lebels,
                datasets: [{
                    label: 'Verification',
                    data: _data,
                    fill: true,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Live Check Analytics'
                    }
                }
            }
        });

        // Select date Picker
        $(function() {
            $("#datepicker1").datepicker({
                setDate: new Date(),
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd',
                showButtonPanel: true
            }).datepicker("setDate", '. -1 month');
            $("#datepicker2").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd',
                showButtonPanel: true
            }).datepicker("setDate", 'now');


            // $("#datepicker3").datepicker({
            //     setDate: new Date(),
            //     changeMonth: true,
            //     changeYear: true,
            //     dateFormat: 'yy-mm-dd',
            //     showButtonPanel: true
            // }).datepicker("setDate", '. -1 month');
            // $("#datepicker4").datepicker({
            //     changeMonth: true,
            //     changeYear: true,
            //     dateFormat: 'yy-mm-dd',
            //     showButtonPanel: true
            // }).datepicker("setDate", 'now');
        });
    </script>


</body>

</html>
