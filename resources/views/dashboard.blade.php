{{-- resources/views/adminlte/user/dashboard.blade.php --}}
@extends('layouts.user')

@section('pageTitle', 'Dashboard')

@section('content')

<div class="row">
    <div class="col-xs-12">
        @include('partials.flash-messages')
    </div>
</div>
    <div class="row">


        <div class="col-md-4 col-sm-6 col-xs-12">
		{{--<div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua">
                  <div class="widget-user-image">
                    <span class="info-box-icon bg-aqua"><i class="fas fa-clipboard-list-check"></i></span>
                  </div>
                  <!-- /.widget-user-image -->
                  <h5 class="widget-user-desc">&nbsp;</h5>
                  <h3 class="widget-user-username">Quotes</h3>
                  <h5 class="widget-user-desc">&nbsp;</h5>
                </div>
                <div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
                    <li><a href="{{ route('quotes.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Add New</a></li>
                    <li><a href="{{ route('quotes.index') }}"><i class="fas fa-eye" aria-hidden="true"></i> &nbsp;View All</a></li>
                  </ul>
                </div>
		</div>--}}
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-navy">
                  <div class="widget-user-image">
                    <span class="info-box-icon bg-navy"><i class="fad fa-truck-container"></i></span>
                  </div>
                  <!-- /.widget-user-image -->
                  <h5 class="widget-user-desc">&nbsp;</h5>
                  <h3 class="widget-user-username">View Student List</h3>
                  <h5 class="widget-user-desc">&nbsp;</h5>
                </div>
                <div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
					{{--<li><a href="{{ route('delivery-tickets.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Add New</a></li>--}}
                    <li><a href="{{ route('delivery-tickets.index') }}"><i class="fas fa-eye" aria-hidden="true"></i> &nbsp;View All</a></li>
                  </ul>
                </div>
              </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
		{{--<div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-teal">
                  <div class="widget-user-image">
                    <span class="info-box-icon bg-teal"><i class="fas fa-file-invoice-dollar"></i></span>
                  </div>
                  <!-- /.widget-user-image -->
                  <h5 class="widget-user-desc">&nbsp;</h5>
                  <h3 class="widget-user-username">Invoices</h3>
                  <h5 class="widget-user-desc">&nbsp;</h5>
                </div>
                <div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
                    <li><a href="{{ route('invoices.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;Add New</a></li>
                    <li style="display: flex">
                        <a href="{{ route('invoices.index') }}"><i class="fas fa-eye" aria-hidden="true"></i> &nbsp;View All</a>
                        <a href="{{ route('invoices.index', ['outstanding']) }}"><i class="fas fa-money-check-alt" aria-hidden="true"></i> &nbsp;Outstanding</a>
                    </li>
                  </ul>
                </div>
		</div>--}}
        </div>


    </div>


@endsection


@section('header_css')
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('themes/adminlte/bower_components/jvectormap/jquery-jvectormap.css') }}">
@endsection

@section('footer_assets')

    <!-- Sparkline -->
    <script src="{{ asset('themes/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap  -->
    <script src="{{ asset('themes/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('themes/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- ChartJS -->
    <script src="{{ asset('themes/adminlte/bower_components/chart.js/Chart.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('themes/adminlte/dist/js/pages/dashboard2.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('themes/adminlte/dist/js/demo.js') }}"></script>

@endsection