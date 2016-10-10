<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>&nbsp;</h3>
    <h3>Member Access</h3>
    <ul class="nav side-menu">
      <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Search for a Books </a></li>
      <li><a href="{{route('borrow-books')}}"><i class="fa fa-shopping-cart"></i> Borrowed Books </a></li>
      <li><a href="{{route('return-books')}}"><i class="fa fa-reply"></i> Returned Books </a></li>
    </ul>
  </div>
  @can('admin-access')
      <div class="menu_section">
        <h3>Admin Access</h3>
        <ul class="nav side-menu">
          <li><a href="{{route('admin::member-list')}}"><i class="fa fa-users"></i> Manage Members </a></li>
          <li><a href="{{route('admin::book-list')}}"><i class="fa fa-gear"></i> Manage Books </a></li>
          <li><a href="{{route('admin::report-loans')}}"><i class="fa fa-line-chart"></i> Loan Reports </a></li>
          <li><a href="{{route('admin::report-quantities')}}"><i class="fa fa-pie-chart"></i> Quantity Reports </a></li>
        </ul>
      </div>
  @endcan  
</div>
<!-- /sidebar menu -->