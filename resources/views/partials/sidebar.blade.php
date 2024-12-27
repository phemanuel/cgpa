<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('admin-dashboard') }}">
        <img alt="image" src="{{ asset('dashboard/assets/img/logo.png') }}" class="header-logo" />
        <span class="logo-name">E-Result</span>
      </a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Main</li>
      <li class="dropdown active">
        <a href="{{ route('admin-dashboard') }}" class="nav-link">
          <i data-feather="monitor"></i><span>Dashboard</span>
        </a>
      </li>
      <li class="dropdown">
        <a href="{{ route('transcript-request') }}" class="nav-link">
          <i data-feather="briefcase"></i><span>Transcript Requests</span>
        </a>
      </li>
      <li class="dropdown">
        <a href="{{ route('admin-account-setting', ['id' => auth()->user()->id]) }}" class="nav-link">
          <i data-feather="command"></i><span>Account Settings</span>
        </a>
      </li>
      <li class="dropdown">
        <a href="{{ route('users') }}" class="nav-link">
          <i data-feather="mail"></i><span>Users</span>
        </a>
      </li>
    </ul>
  </aside>
</div>
