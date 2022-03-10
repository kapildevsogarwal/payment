
@if (Session::has('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Success!</h4>
    <strong>{{ Session::get('success') }}</strong>
</div>
@endif


@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Error!</h4>
    <strong>{{ Session::get('error') }}</strong>
</div>
@endif


@if (Session::has('warning'))
<div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Warning!</h4>
    <strong>{{ Session::get('warning') }}</strong>
</div>
@endif


@if (Session::has('info'))
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Info!</h4>
    <strong>{{ Session::get('info') }}</strong>
</div>
@endif