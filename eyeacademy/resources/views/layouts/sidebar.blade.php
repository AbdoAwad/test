<div id="header_top" style="background-color:#3ca9cd" class="header_top">
	<div class="container">
		<div class="hleft">
			{{-- <img src="{{ asset('/front/images/chat-logo.png') }}" style="width: 35px; margin-top: 10px;"> --}}
			<div class="dropdown">
			</div>
		</div>
		<div class="hright">
			<div class="dropdown">
				<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link icon"><i class="fa fa-sign-out"></i></a>
				<a href="javascript:void(0)" class="nav-link icon menu_toggle"><i class="fa fa-align-left"></i></a>
			</div>
		</div>
	</div>
</div>

<div id="left-sidebar" class="sidebar ">
	<h5 class="brand-name">Eye Academy Management</h5>
	<nav id="left-sidebar-nav" class="sidebar-nav">
		<ul class="metismenu">
			<li class="g_heading">Main Menu</li>
			<li class="{{ request()->is('account*') ? 'active' : '' }}">
				<a href="{{ route('account') }}"><i class="icon-user"></i><span>Account</span></a>
			</li>
			<li class="{{ request()->is('home*') ? 'active' : '' }} {{ request()->is('/*') ? 'active' : '' }}">
				<a href="{{ route('home') }}"><i class="icon-home"></i><span>Dashboard</span></a>
			</li>

			<li class="{{ request()->is('station*') ? 'active' : '' }}">
				<a href="{{route('station')}}"><i class="fa fa-align-justify"></i><span>Station</span></a>
			</li>

            @if(auth()->user()->add_visit == 1)
                <li class="{{ request()->is('patient*') ? 'active' : '' }}">
                    <a href="{{ route('patient') }}"><i class="fas fa-user-injured"></i><span>Patient </span></a>
                </li>
            @endif
            @if(strcasecmp(auth()->user()->name,"super admin") == 0 || strcasecmp(auth()->user()->name, "admin") == 0)
                <li class="{{ request()->is('staff*') ? 'active' : '' }}">
                    <a href="{{route('staff')}}"><i class="fas fa-address-card"></i><span>Staff</span></a>
                </li>

                <li class="{{ request()->is('report*') ? 'active' : '' }}">
                <a href="{{route('report')}}"><i class="fas fa-chart-pie"></i><span>Report</span></a>
                </li>
            @endif

</ul>
</nav>
</div>
