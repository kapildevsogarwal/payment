{{-- resources/views/adminlte/partials/header-assets.blade.php --}}

<!-- Styles -->
{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="{{ asset('themes/' . config('constant.admin_theme') . '/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/57532365b5.js" crossorigin="anonymous"></script>
<!-- Ionicons -->
<link rel="stylesheet" href="{{ asset('themes/' . config('constant.admin_theme') . '/bower_components/Ionicons/css/ionicons.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('themes/' . config('constant.admin_theme') . '/dist/css/AdminLTE.min.css') }}">
<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="{{ asset('themes/' . config('constant.admin_theme') . '/dist/css/skins/_all-skins.min.css') }}">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<!-- Sweetalert -->
<link rel="stylesheet" href="{{ asset('vendors/sweetalert2/dist//sweetalert2.css') }}" />
<link rel="stylesheet" href="{{ asset('/css/jquery.qtip.min.css') }}">

<link rel="stylesheet" href="{{ asset('/css/common.css') }}">
<link rel="stylesheet" href="{{ asset('themes/' . config('constant.admin_theme') . '/css/app.css') }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- datetimepicker -->
<link rel="stylesheet" href="{{ asset('/css/bootstrap-datetimepicker.css') }}">

@yield('header_css')

<!-- Scripts -->
<!-- jQuery 3 -->
<script src="{{ asset('themes/' . config('constant.admin_theme') . '/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript">
    var BASE_URL='{{ url("/") }}/';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('header_js')