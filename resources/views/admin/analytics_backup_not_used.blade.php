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

    <title>Analytics | Shaheen Food Admin Panel</title>

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
            @include('admin.partials._menu')
            <div class="layout-page">

                {{-- <div class="row">
                    <div class="col-6 navbar-nav-left d-flex align-items-center">
                        <div class="col-2 text-primary">Select Dates</div>
                        <form action="{{ route('analytics_search') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control mt-2" id="datepicker1"
                                    name="startDate"autocomplete="off" />
                                <input type="text" class="form-control mt-2" id="datepicker2"
                                    name="endDate"autocomplete="off" />
                                <button id="searchBtn1" class="btn btn-primary mt-2"type="submit"><i
                                        class='bx bx-search-alt'></i> Search</button>
                            </div>
                        </form>
                    </div>
                </div> --}}

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        {{-- ========================================================================================== --}}

                        <div class="row mb-4">
                            <div class="col-lg-8">
                                <div class="">
                                    <div class="d-flex align-items-end">
                                        <form action="{{ route('analytics_search') }}" method="POST">
                                            @csrf
                                            <div class="input-group">
                                                <span class="input-group-text">From</span>
                                                <input type="text" class="form-control" id="datepicker1"
                                                    name="startDate"autocomplete="off" />
                                                    <span class="input-group-text">To</span>
                                                <input type="text" class="form-control" id="datepicker2"
                                                    name="endDate"autocomplete="off" />
                                                <button id="searchBtn1" class="btn btn-primary"type="submit"><i class='bx bx-search-alt'></i>&nbsp; Search</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <ul class="card list-group">
                                    <li style="list-style: none;">
                                        <form action="{{ route('analytics_csv') }}" method="POST">
                                            @csrf
                                            <input type="date" name="sDate" value="{{ $startDate }}"
                                                hidden />
                                            <input type="date" name="eDate" value="{{ $endDate }}"
                                                hidden />
                                            <div class="input-group">
                                                <select name="remarks" class="form-select">
                                                    <option selected value="all">All Status</option>
                                                    <option value="firsttime">First Checks</option>
                                                    <option value="verified">Verified Checks</option>
                                                </select>
                                                <button class="btn btn-outline-primary"
                                                    type="submit">Download CSV</button>
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card p-1">
                                    <canvas id="myChart" height="450"></canvas>
                                </div>
                            </div>

                            <div class="col-lg-4">

                                <ul class="card list-group mb-2">
                                    <li class="list-group-item text-primary text-center text-light fw-semibold">Live Check Verifications</li>
                                </ul>

                                <ul class="card list-group mb-2">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        From
                                        <span
                                            class="badge bg-primary">{{ Carbon\Carbon::parse($startDate)->format('d M y') }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center">
                                        To
                                        <span
                                            class="badge bg-primary">{{ Carbon\Carbon::parse($endDate)->format('d M y') }}</span>
                                    </li>
                                </ul>

                                        <ul class="card list-group mb-2">
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                Total Checks
                                                <span class="badge bg-dark">{{ $total }}</span>
                                            </li>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                Web
                                                <span class="badge bg-dark">{{ $totalWeb }}</span>
                                            </li>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                Sms
                                                <span class="badge bg-dark">{{ $totalSms }}</span>
                                            </li>
                                        </ul>



                                    <ul class="card list-group mb-2">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                        First Checks
                                        <span class="badge bg-success">{{ $firstTime }}</span>
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Repeat Checks
                                        <span class="badge bg-danger">{{ $verified }}</span>
                                    </li>
                                    </ul>





                                        {{-- <ul class="card list-group mt-4">
                                            <li style="list-style: none;">
                                                <form action="{{ route('analytics_csv') }}" method="POST">
                                                    @csrf
                                                    <input type="date" name="sDate" value="{{ $startDate }}"
                                                        hidden />
                                                    <input type="date" name="eDate" value="{{ $endDate }}"
                                                        hidden />
                                                    <div class="input-group">
                                                        <select name="remarks" class="form-select">
                                                            <option selected value="all">All Status</option>
                                                            <option value="firsttime">First Checks</option>
                                                            <option value="verified">Verified Checks</option>
                                                        </select>
                                                        <button class="btn btn-outline-primary"
                                                            type="submit">Download CSV</button>
                                                    </div>
                                                </form>
                                            </li>
                                        </ul> --}}
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

    <!-- Core JS -->
    {{-- <script src="{{ asset('admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/menu.js') }}"></script> --}}


    <!-- Main JS -->
    {{-- <script src="{{ asset('admin/assets/js/main.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script> --}}

      {{-- <!-- Helpers -->
      <script src="{{ asset('admin/assets/vendor/js/helpers.js') }}"></script>
      <script src="{{ asset('admin/assets/js/config.js') }}"></script> --}}



    {{-- Analytics --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="https://cdnjs.com/libraries/Chart.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    {{-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> --}}

    <script>
        // chart js
        var _lebels = JSON.parse('{!! json_encode($months) !!}');
        var _data = JSON.parse('{!! json_encode($monthCount) !!}');
        var _from = JSON.parse('{!! json_encode($startDate) !!}');

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
        });
    </script>


</body>

</html>
