<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        {{-- date & time --}}
        <span class="d-sm-block d-none" id='ct7'></span>
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    {{-- <div class="avatar avatar-online">
                        <img src="{{ asset('admin/assets/img/avatars/ceo.jpg') }}" alt
                            class="w-px-40 h-auto rounded-circle" />
                    </div> --}}

                    <span class="fw-semibold d-block">
                        @auth
                            {{ Auth::user()->name }}
                        @else
                            PANACEA
                        @endauth
                    </span>

                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">Company :
                                        @auth
                                            {{ ucfirst(Auth::user()->role) }}
                                        @else
                                            PANACEA
                                        @endauth
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    {{-- <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li> --}}
                    {{-- <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                    </li> --}}
                    {{-- <li>
                        <div class="dropdown-divider"></div>
                    </li> --}}
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                        <i class="bx bx-power-off me-2"></i>
                         {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>



@push('js')
    <script>
        // clock
        function display_ct7() {
            var x = new Date()
            var ampm = x.getHours() >= 12 ? ' PM' : ' AM';
            hours = x.getHours() % 12;
            hours = hours ? hours : 12;
            hours = hours.toString().length == 1 ? 0 + hours.toString() : hours;

            var minutes = x.getMinutes().toString()
            minutes = minutes.length == 1 ? 0 + minutes : minutes;

            var month = (x.getMonth() + 1).toString();
            month = month.length == 1 ? 0 + month : month;

            var dt = x.getDate().toString();
            dt = dt.length == 1 ? 0 + dt : dt;

            var x1 = month + "/" + dt + "/" + x.getFullYear();
            x1 =  " Date : " + x1 + " Time : " + hours + ":" + minutes + " " + ampm;
            document.getElementById('ct7').innerHTML = x1;
            display_c7();
        }

        function display_c7() {
            var refresh = 1000; // Refresh rate in milli seconds
            mytime = setTimeout('display_ct7()', refresh)
        }
        display_c7()





        // autologout.js
        // $(document).ready(function () {
        //     const timeout = 60000;  // 900000 ms = 15 minutes | 60000 ms = 1 minutes
        //     var idleTimer = null;
        //     $('*').bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {
        //         clearTimeout(idleTimer);

        //         idleTimer = setTimeout(function () {
        //             document.getElementById('logout-form').submit();
        //         }, timeout);
        //     });
        //     $("body").trigger("mousemove");
        // });
    </script>
@endpush


{{-- <div class="input-group row">

    <div class="d-flex  col-sm-6 col-md-3">
        <span class="border-0 input-group-text">From</span>
        <input type="text" class="form-control" id="datepicker1" name="startDate"autocomplete="off" />
    </div>

    <div class="d-flex col-sm-6 col-md-3">
        <span class="border-0 input-group-text">To</span>
        <input type="text" class="form-control" id="datepicker2" name="endDate"autocomplete="off" />
    </div>

    <div class="d-flex col-sm-6 col-md-6">
        <button class="btn btn-primary"type="submit"><i class='bx bx-search-alt'></i>&nbsp; Search</button>
        <a class="btn btn-dark text-white" type="button" href="{{ route('analytics_search_lastyear') }}">
            <i class='bx bx-search-alt'></i>&nbsp; Last Year
        </a>
    </div>
</div> --}}



{{--
<div class="d-flex align-items-end">
    <form class="card shadow-lg bg-white rounded" action="{{ route('analytics_search') }}" method="POST">
        @csrf
        <div class="input-group">
            <span class="input-group-text">From :</span>
            <input type="text" class="form-control" id="datepicker1"
                name="startDate"autocomplete="off" />
            <span class="input-group-text">To :</span>
            <input type="text" class="form-control" id="datepicker2"
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
