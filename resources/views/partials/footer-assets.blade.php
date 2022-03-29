{{-- resources/views/adminlte/partials/footer-assets.blade.php --}}
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('themes/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('themes/adminlte/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('themes/adminlte/dist/js/adminlte.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('themes/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- Sweetalert -->
<script src="{{ asset('vendors/sweetalert2/dist/sweetalert2.min.js') }}" type="text/javascript"></script>
<!--ToolTip -->
<script src="{{ asset('js/jquery.qtip.min.js') }}"></script>
<!--Jquery Date Picker -->
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- Bootstrap datettimepicker-->
<script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>

<script src="{{ asset('js/common.js') }}"></script>

<script type="text/javascript">
    function refreshToken(){
        $.get('/refresh-csrf').done(function(data){
            csrfToken = data; // the new token
            $('[name="csrf-token"]').attr('content', data);
        });
    }
    $(document).ready(function(){
        setInterval(refreshToken, {{ (config('session.lifetime') * 60 * 1000)/2 }});
    });
</script>