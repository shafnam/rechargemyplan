<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{URL::asset('/images/avatar.png')}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->stage_name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <!--<form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>-->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
  
      <li class="{{ Request::is('admin') ? 'active' : '' }}">
        <a href="{{ route('admin.dashboard') }}">
          <i class="fa fa-home"></i> <span>Home</span>
          <!--<span class="pull-right-container">
            <small class="label pull-right bg-green">new</small>
          </span>-->
        </a>
      </li>
      <li class="treeview {{ Request::is('admin/carriers/list') ? 'active' : '' || Request::is('admin/carriers/add') ? 'active' : ''}}">
        <a href="#">
          <i class="fa fa-rss"></i> <span>Carriers</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::is('admin/carriers/list') ? 'active' : '' }}"><a href="{{ route('admin.carriers.list') }}"><i class="fa fa-clone"></i> All Carriers</a></li>
          <li class="{{ Request::is('admin/carriers/add') ? 'active' : '' }}"><a href="{{ route('admin.carriers.add.get') }}"><i class="fa fa-plus"></i> Add new </a></li>
        </ul>
      </li>
      <li class="treeview {{ Request::is('admin/plans/list') ? 'active' : '' || Request::is('admin/plans/add') ? 'active' : ''}}">
        <a href="#">
          <i class="fa fa-server"></i> <span>Plans</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::is('admin/plans/list') ? 'active' : '' }}"><a href="{{ route('admin.plans.list') }}"><i class="fa fa-clone"></i> All Plans</a></li>
          <li class="{{ Request::is('admin/plans/add') ? 'active' : '' }}"><a href="{{ route('admin.plans.add.get') }}"><i class="fa fa-plus"></i> Add new </a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-credit-card"></i> <span>SIMs</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-clone"></i> All SIMs</a></li>
          <li><a href="#"><i class="fa fa-plus"></i> Add new </a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-bars"></i> <span>Orders</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-clone"></i> All Orders</a></li>
          <li><a href="#"><i class="fa fa-plus"></i> Add new </a></li>
        </ul>
      </li>
      <li class="treeview {{ Request::is('admin/blogs/list') ? 'active' : '' || Request::is('admin/blogs/add') ? 'active' : ''}}">
        <a href="#">
          <i class="fa fa-pencil-square-o"></i> <span>Blogs</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Request::is('admin/blogs/list') ? 'active' : '' }}"><a href="{{ route('admin.blogs.list') }}"><i class="fa fa-clone"></i> All Blogs</a></li>
          <li class="{{ Request::is('admin/blogs/add') ? 'active' : '' }}"><a href="{{ route('admin.blogs.add.get') }}"><i class="fa fa-plus"></i> Add new </a></li>
        </ul>
      </li>
    </ul>
  </section>