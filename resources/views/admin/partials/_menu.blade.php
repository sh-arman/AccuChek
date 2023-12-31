<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="{{ url('/') }}" class="app-brand-link"
      {{-- style="background-color: #696CFF; border-radius: 10px;" --}}
      >
        {{-- <span class="app-brand-logo demo">
        </span> --}}
        {{-- <span class="app-brand-text demo menu-text fw-bolder ms-2">Shaheen Food Suppliers</span> --}}
        <img class="header-img-1" src="{{ asset('front/images/acculogo2.svg') }}" alt="ACCU Chek Radiant LiveCheck" style="width: 12rem; padding: .5rem;" />
        <span class="app-brand-text demo menu-text fw-bolder ms-2">
        </span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
      <!-- Dashboard -->
        <li class="menu-item {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>

      <li class="menu-item {{ (request()->is('admin/order')) ? 'active' : '' }}">
        <a href="{{ route('order') }}" class="menu-link">
          <i class='menu-icon bx bxs-zap'></i>
          <div data-i18n="Analytics">Order Code</div>
        </a>
      </li>

      {{-- <li class="menu-item">
        <a href="index.html" class="menu-link">
           <i class="menu-icon tf-icons bx bx-history"></i>
          <div data-i18n="Analytics">Order Log</div>
        </a>
      </li> --}}


      @if ( Auth::user()->role == 'panacea')
      <li class="menu-item {{ (request()->is('admin/template')) ? 'active' : '' }}">
        <a href="{{ route('template') }}" class="menu-link">
            <i class='menu-icon bx bx-bookmarks'></i>
          <div data-i18n="Basic">Template</div>
        </a>
      </li>
      @endif

      <li class="menu-item {{ (request()->is('admin/analytics')) ? 'active' : '' }} {{ (request()->is('admin/analytics_search')) ? 'active' : '' }}" >
        <a href="{{ route('analytics') }}" class="menu-link">
            <i class='menu-icon bx bx-bar-chart-alt-2'></i>
          <div data-i18n="Basic">Analytics</div>
        </a>
      </li>

      {{-- <li class="menu-item">
        <a href="index.html" class="menu-link">
          <i class='menu-icon bx bx-wrench'></i>
          <div data-i18n="Analytics">Settings</div>
        </a>
      </li> --}}

    @if ( Auth::user()->role == 'panacea')
      <li class="menu-item {{ (request()->is('admin/users')) ? 'active' : '' }}">
        <a href="{{ route('users') }}" class="menu-link">
            <i class="menu-icon  tf-icons bx bx-user"></i>
            <div data-i18n="Support">User</div>
        </a>
      </li>
    @endif


    <li class="menu-item {{ (request()->is('admin/track')) ? 'active' : '' }}">
        <a href="{{ route('track') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-history"></i>
          <div data-i18n="Basic">Activity</div>
        </a>
      </li>

      <li class="menu-item {{ (request()->is('admin/support')) ? 'active' : '' }}">
        <a href="{{ route('support') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-support"></i>
            <div data-i18n="Support">Support</div>
        </a>
      </li>

      <li class="menu-item">
        <a class="menu-link" href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
            <i class="menu-icon tf-icons bx bx-power-off me-2"></i>
            {{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
      </li>

      {{-- <li class="menu-item">
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-link">
            <i class="menu-icon tf-icons bx bx-power-off"></i>
            <div data-i18n="Logout">{{ __('Logout') }}</div>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
      </li> --}}

      {{-- <li class="menu-item">
        <a href="index.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-file"></i>
          <div data-i18n="Documentation">Documentation</div>
        </a>
      </li> --}}

    </ul>
  </aside>
