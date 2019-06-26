<header class="main-header">
    <!-- Logo -->
    <a href="/admin" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="{{URL::asset('/images/recharge-my-plan-fav-white.png')}}" alt="RMP" height="32" width="30"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="{{URL::asset('/images/recharge-my-plan-logo.png')}}" alt="Recharge My Plan" height="28" width="200"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
  
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
  
          @guest
              <li><a href="{{ route('login') }}">Login</a></li>
              <li><a href="{{ route('register') }}">Register</a></li>
          @else
  
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{URL::asset('/images/avatar.png')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->stage_name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{URL::asset('/images/avatar.png')}}" class="img-circle" alt="User Image">
  
                <p>
                  {{ Auth::user()->stage_name }}
                  <small>Member since Nov. 2017</small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat"
                      onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">Sign out</a>
                  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
          @endguest
        </ul>
      </div>
    </nav>
  </header>