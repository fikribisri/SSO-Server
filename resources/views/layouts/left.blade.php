<div class="sidebar">
    <nav class="sidebar-nav">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/') }}">
            <i class="nav-icon icon-speedometer"></i> Dashboard
          </a>
        </li>
        <li class="nav-title">Manage Application</li>
        <li class="nav-item">
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                  <i class="nav-icon icon-grid"></i> Credential
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.credential')}}">
                        <i class="nav-icon icon-list"></i> List Credential</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.credential.create')}}">
                        <i class="nav-icon icon-plus"></i> Create Credential</a>
                    </li>
                </ul>
            </li>
        </li>
        <li class="nav-title">Setting</li>
        <li class="nav-item">
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                  <i class="nav-icon icon-people"></i> User
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.user')}}">
                        <i class="nav-icon icon-list"></i> List User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.user.create')}}">
                        <i class="nav-icon icon-plus"></i> Create User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.user.import')}}">
                        <i class="nav-icon icon-cloud-upload"></i> Export / Import</a>
                    </li>

                </ul>
            </li>
            <a class="nav-link" href="colors.html">
                <i class="nav-icon icon-settings"></i>Apps
            </a>
        </li>
        <li class="nav-title">Guide</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.integration')}}">
                <i class="nav-icon icon-question"></i> Integration
            </a>
        </li>

        <li class="nav-divider"></li>
        <li class="nav-title">SSO System</li>
        <li class="nav-item px-3 d-compact-none d-minimized-none">
          <div class="text-uppercase mb-1">
            <small>
              <b>User Online</b>
            </small>
          </div>
          <div class="progress progress-xs">
            <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <small class="text-muted">348 Processes. 1/4 Cores.</small>
        </li>
        <li class="nav-item px-3 d-compact-none d-minimized-none">
          <div class="text-uppercase mb-1">
            <small>
              <b>Total Aplikasi</b>
            </small>
          </div>
          <div class="progress progress-xs">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <small class="text-muted">11444GB/16384MB</small>
        </li>
      </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
  </div>
