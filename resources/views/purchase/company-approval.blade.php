{{-- resources/views/adminlte/user/dashboard.blade.php --}}

@extends('layouts.user')

@section('pageTitle', 'Company request for approval')

@section('content')
<div class="row">
    <div class="col-xs-4 mb-2">
        {{--<input type="text" class="form-control" id="serach" name="serach" placeholder="Search Company">      --}}         
    </div>
    <div class="col-xs-8 mb-2">
       
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        @include('partials.flash-messages')
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Company Listing</h3>
                <div class="box-tools"></div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped" id="business-list">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Requested By</th>
							<th>Company Type</th>
                            <th>Request Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('company.company-approval-data')
					   
                    </tbody>
                </table>
                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
            </div>
        </div>
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
    <script>
    	function showSA(obj) {
		    swal.fire({
		        type: obj.type,
		        title: obj.message
		    }).then(function(result) {

				if(typeof obj.urlTarget != 'undefined') {
					window.open(obj.url, obj.urlTarget);
				} else if(typeof obj.url != 'undefined') {
					window.location.href = obj.url;
				}
				
		    });
		}


        $(document).ready(function(){
            // Delete delivery ticket
            
            $('body').on('click', '.approve-admin', function(e){
                //e.preventDefault();
                var dataUrl = $(this).data('url');
                var checkVal = $(this).val();
                var approved = 0;
                var THIS = $(this);
                
                if ($(this).is(':checked')) {
                    approved = 1;
                }

                // Remove delivery ticket
                swal.fire({
                    title: 'Approval for company detail?',
                    text: "This cannot be undone!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#00a65a',
                    cancelButtonColor: '#dd4b39',
                    confirmButtonText: 'Yes, send it!',
                    cancelButtonText: 'N    ever mind'
                }).then(function(result) {      
                    if (result.value) {
                        if ($(this).is(':checked')) {
                            THIS.prop("checked",true);
                        }
                        
                        $.ajax({
                            type: 'POST',
                            url: dataUrl,
                            dataType: 'json',
                            data: {
                                approve:approved
                            },
                            beforeSend: function(){
                                //$('.full-page-loader').show();
                            },
                            error: function(response, status, xhr) {
                            },
                            success: function(response, status, xhr, $form) {

                               // $('.full-page-loader').hide();

                                if(response.status == 'failure') {
                                    showSA({
                                        type: 'error',
                                        message: response.payload.message,
                                    })

                                } else {
                                    showSA({
                                        type: 'success',
                                        message: response.payload.message,
                                    })
                                }
                            }
                        });
                    }
                    else{
                        console.log('else');
                        THIS.prop('checked', false);
                    }
                });
            });    

            $(document).on('keyup', '#serach', function () {
                var query = $('#serach').val();
                var page = $('#hidden_page').val();           
                fetch_data(page, query);
            });

            $(document).on('click', '.pagination a', function (event) { console.log("ddd");
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var query = $('#serach').val();
                $('li').removeClass('active');
                $(this).parent().addClass('active');
                fetch_data(page, query);
            });
            
            $('#insurance_filter').change(function(){
                var query = $('#serach').val();
                var page = $('#hidden_page').val();
                fetch_data(page, query);
            });

            function fetch_data(page, query) {
                $.ajax({
                    url: BASE_URL + "company/search-company?page=" + page + "&query=" + query,
                    beforeSend: function () {
                        $('.full-page-loader').show();
                    },
                    success: function (data)
                    {
                        $('.full-page-loader').hide();
                        $("#business-list").find("tbody").html();
                        $("#business-list").find("tbody").html(data);
                    }
                });
            }
        });
    </script>
@endsection