

/**
 * DOC:: https://sweetalert2.github.io/#examples
 */
swal.mixin({
	width: 400,
	heightAuto: false,
	padding: '2.5rem',
	buttonsStyling: false,
	confirmButtonClass: 'btn btn-success',
	confirmButtonColor: null,
	cancelButtonClass: 'btn btn-secondary',
	cancelButtonColor: null
});

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
           $(".help-block-pop").hide();
           $('.full-page-loader').hide();
            var arrGlobalItems = [];
            var getObject = [];
            
           
	 $('.action-tooltip[title]').qtip({
                position: {
                    my: 'left bottom',
                    at: 'top right'
                }
            });
	$('select[name=company_id]').change(function(){

		if($(this).val() == '') {
			$('input[name=discount]').val('')
			$('input[name=contact_person]').val('')
			return false;
		}

		var getUrl = BASE_URL + 'companies/:id';
		getUrl = getUrl.replace(':id', $(this).val());

		$.ajax({
			type: 'GET',
			url: getUrl,
			dataType: 'JSON',
			beforeSend: function(){
				$('.full-page-loader').show();
			},
			success: function(response, status, xhr, $form) {

				$('.full-page-loader').hide();

				if(response.status == 'success') {
					$('input[name=discount]').val(response.payload.data.discount)
					$('input[name=contact_person]').val(response.payload.data.contact_name)
				}
			}
		});
	});
	
        
	// Print invoice invoice
        $('body').on('click', '.print-invoice-receipt', function(e){
            e.preventDefault();
            var dataUrl = $(this).data('url');
            window.open(dataUrl, '_blank');
            return false;
        });
	
});