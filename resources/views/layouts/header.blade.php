<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="{{route('home')}}" class="site_title"><i class="fa fa-book"></i> <span>{{trans('content.title')}}</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile">
      <div class="profile_pic">
        <img src="{{asset('img/avatar.png')}}" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Welcome,</span>
        <h2>{{auth()->user()->profile->firstname.' '.auth()->user()->profile->lastname}}</h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    @include('layouts.sidebar')
  </div>
</div>

<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="{{asset('img/avatar.png')}}" alt="">{{auth()->user()->profile->firstname.' '.auth()->user()->profile->lastname}}
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="{{route('account::profile')}}"> Profile</a></li>
            <li><a href="{{route('account::change-password')}}"> Change Password</a></li>
            <li><a href="{{route('logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->