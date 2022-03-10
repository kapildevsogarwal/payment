{{-- resources/views/adminlte/layouts/user.blade.php --}}
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <title>@yield('pageTitle') | {{ config('app.name', 'Straw Hat Rentals') }}</title> -->
    <title>Student Portal</title>

    @include('partials.header-assets')

</head>

<body class="hold-transition skin-blue sidebar-mini"><!-- sidebar-collapse -->
    <div class="wrapper">

        <!-- Left side column. contains the logo and sidebar -->
        @include('partials.header')

        <!-- Left side column. contains the logo and sidebar -->
        @include('partials.left-sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    @yield('pageTitle', 'Dashboard')
                    {{-- <small>Version 2.0</small> --}}
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    @hasSection('breadcrumb')
                        @yield('breadcrumb')
                    @else
                        <li class="active"><a href = "{{ url()->current() }}">@yield('pageTitle')</a></li>
                    @endif

                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
            <!-- /.Main content -->

        </div>
        <!-- /.Content Wrapper -->

        @include('partials.footer')

        @include('partials.right-sidebar')

    </div>
    <!-- ./wrapper -->


    <div class="full-page-loader dn">Loading&#8230;</div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

    @include('partials.footer-assets')

    @yield('footer_assets')

</body>

</html>