{{-- resources/views/adminlte/partials/left-sidebar.blade.php --}}
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
            &nbsp;{{--<img src="{{ asset('images/users/') }}/{{Auth::user()->profile_image}}" class="img-circle" alt="User Image">--}}
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li  class="active"><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
			<li  class="active"><a href="{{ url('/company') }}"><i class="fa fa-dashboard"></i> <span>Company</span></a></li>
            {{-- <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Profile</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Change Password</span></a></li> --}}
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out text-aqua"></i> <span>Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>