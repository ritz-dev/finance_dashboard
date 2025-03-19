<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
        <a href="index.html" class="logo">
          <img
            src="{{asset('assets/img/kaiadmin/favicon.png')}}"
            alt="navbar brand"
            class="navbar-brand"
            height="50"
          />
        </a>

        <h6 class="text-info text-center mt-2">Finance Management System</h6>
        {{-- <div class="nav-toggle">
          <button class="btn btn-toggle toggle-sidebar">
            <i class="gg-menu-right"></i>
          </button>
          <button class="btn btn-toggle sidenav-toggler">
            <i class="gg-menu-left"></i>
          </button>
        </div>
        <button class="topbar-toggler more">
          <i class="gg-more-vertical-alt"></i>
        </button> --}}
      </div>
      <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
        <ul class="nav nav-secondary">
          <li class="nav-item @yield('dashboard-active')">
            <a href="{{url('/')}}">
                <i class="fa-solid fa-house"></i>
                <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item @yield('chart-account-active')">
            <a href="{{url('account-list')}}">
                <i class="fa-solid fa-chart-column"></i>
                <p>Chart Account</p>
            </a>

          </li>

          <li class="nav-item @yield('transaction-active')">
            <a href="{{url('transactions')}}">
                <i class="fa-solid fa-right-left"></i>
                <p>Transaction</p>
            </a>

          </li>

          <li class="nav-item @yield('journal-active')">
            <a href="{{url('journals')}}">
                <i class="fa-solid fa-shuffle"></i>
                <p>Journal</p>
            </a>

          </li>

          <li class="nav-item @yield('ledger-active')">
            <a href="{{url('ledgers')}}">
                <i class="far fa-check-circle"></i>
                <p>Ledger</p>
            </a>

          </li>

          <li class="nav-item @yield('trial-balance-active')">
            <a href="{{url('trial_balance_list')}}">
                <i class="fa-solid fa-scale-balanced"></i>
                <p>Trial Balance</p>
            </a>

          </li>

          <li class="nav-item @yield('balance-sheet-active')">
            <a href="{{url('balance_sheet_list')}}">
                <i class="fa-solid fa-sheet-plastic"></i>
                <p>Balance Sheet</p>
            </a>

          </li>

        </ul>
      </div>
    </div>
  </div>
