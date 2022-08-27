    <script>
        var arrGlobalItems = [];
        var getObject = [];

        $(document).ready(function(){

            // Form helpers
            function isEmpty(obj) {
                for(var key in obj) {
                    if(obj.hasOwnProperty(key))
                        return false;
                }
                return true;
            }
            $(document).on('input', '.allow_decimal', function(evt){
                var self = $(this);
                self.val(self.val().replace(/[^0-9\.]/g, ''));
                if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) {
                     evt.preventDefault();
                }
            });

            $(".invoice_date" ).datepicker({
                dateFormat: 'M dd, yy',
                changeMonth: true,
                changeYear: true
            });

            $('.date_time_validate').datetimepicker({
                format: "M dd, yy HH:ii P",
                todayBtn:  false,
                autoclose: 1,
                startView: 2,
                forceParse: 1,
                showMeridian: 1,
                minuteStep:1,
                rtl: 1
            });

			$("#party_info").change(function() {
				$('.full-page-loader').show();
				let getSelect = $(this).val();
				$('#party_info option[value="'+getSelect+'"]').attr("selected", "selected");
				if(getSelect !=''){
					$('#party_id').val(getSelect);
					var _Url = BASE_URL + 'party/getDetail';
					$.ajax({
						type: "get",
						url: _Url,
						data: 'id='+$(this).val(),
						dataType: 'JSON',
						cache: false,
						beforeSend: function(){
							//$('.full-page-loader').show();
						},
						success: function(data){
							$('.full-page-loader').hide();
							$('#party_name').val(data.name);
							$('#party_address').val(data.address);
							$('#party_gst_number').val(data.gst_number);
						}
					});
				}
				else{
					$('.full-page-loader').hide();
					$('#party_name').val('');
					$('#party_address').val('');
					$('#party_gst_number').val('');
				}
			});
			
			
			$("#net_amount").keyup(function() {
				let getVal = $(this).val();
				if(getVal!='' && getVal > 0){
					$('#igst_percent').prop("readOnly", false);
					$('#ca_gst_percent').prop("readOnly", false);
					$('#sgst_percent').prop("readOnly", false);
					getVal  = (parseFloat(getVal).toFixed(2));
					$('#total_amount').val(getVal);
				}
				else{
					$('#igst_percent').prop("readOnly", true);
					$('#ca_gst_percent').prop("readOnly", true);
					$('#sgst_percent').prop("readOnly", true);
					$('#igst_percent').val('');
					$('#ca_gst_percent').val('');
					$('#sgst_percent').val('');
					$('#igst_total').val('');
					$('#ca_gst_total').val('');
					$('#sgst_total').val('');
					$('#total_amount').val('');
				}
			});
			
			
			function percentage(num, per)
			{
			  return ((num/100)*per).toFixed(2);
			}
          
			
			$("#igst_percent").keyup(function() {
				let getVal = $(this).val();
				let getNetAmount = $('#net_amount').val();
				if(getVal!=''){console.log("ppppppp");
					let getIGSTAmount = percentage(getNetAmount, getVal);
					$('#igst_total').val(getIGSTAmount);
					let caGstTotal = (($('#ca_gst_total').val() > 0) ? $('#ca_gst_total').val() : 0.00);
					let sGstTotal = (($('#sgst_total').val() > 0) ? $('#sgst_total').val() : 0.00);
					let total = (parseFloat(getNetAmount) + parseFloat(getIGSTAmount) + parseFloat(caGstTotal) + parseFloat(sGstTotal)).toFixed(2);
					$('#total_amount').val(total);
				}
				else{
					$('#igst_total').val('');
					$('#total_amount').val('');
					let csGstTotal = (($('#ca_gst_total').val() > 0) ? $('#ca_gst_total').val() : 0.00);
					let sgstTotal = (($('#sgst_total').val() > 0) ? $('#sgst_total').val(): 0.00);
					let total = ( parseFloat(getNetAmount) + parseFloat(csGstTotal) + parseFloat(sgstTotal)).toFixed(2);
					$('#total_amount').val(total);
				}
			});
			
			$("#ca_gst_percent").keyup(function() {
				let getVal = $(this).val();
				let getNetAmount = $('#net_amount').val();
				$('#total_amount').val('');
				if(getVal!=''){
					let getCAGSTAmount = percentage(getNetAmount, getVal);
					$('#ca_gst_total').val(getCAGSTAmount);
					let iGstTotal = (($('#igst_total').val() > 0) ? $('#igst_total').val() : 0.00);
					let sGstTotal = (($('#sgst_total').val() > 0) ? $('#sgst_total').val() : 0.00);					
					let total =  (parseFloat(getNetAmount) + parseFloat(getCAGSTAmount) + parseFloat(iGstTotal) + parseFloat(sGstTotal)).toFixed(2);
					$('#total_amount').val(total);
				}
				else{
					$('#ca_gst_total').val('');
					$('#total_amount').val('');
					let csGstTotal = (($('#igst_total').val() > 0) ? $('#igst_total').val() : 0.00);
					let sgstTotal = (($('#sgst_total').val() > 0) ? $('#sgst_total').val(): 0.00);
					let total = ( parseFloat(getNetAmount) + parseFloat(csGstTotal) + parseFloat(sgstTotal)).toFixed(2);
					$('#total_amount').val(total);
				}
			});
			
			
			$("#sgst_percent").keyup(function() {
				let getVal = $(this).val();
				let getNetAmount = $('#net_amount').val();
				$('#total_amount').val('');
				if(getVal!=''){
					let getCAGSTAmount = percentage(getNetAmount, getVal);
					$('#sgst_total').val(getCAGSTAmount);
					let iGstTotal = (($('#igst_total').val() > 0) ? $('#igst_total').val() : 0.00);
					let sGstTotal = (($('#ca_gst_total').val() > 0) ? $('#ca_gst_total').val() : 0.00);					
					let total =  (parseFloat(getNetAmount) + parseFloat(getCAGSTAmount) + parseFloat(iGstTotal) + parseFloat(sGstTotal)).toFixed(2);
					$('#total_amount').val(total);
				}
				else{
					$('#sgst_total').val('');
					$('#total_amount').val('');
					let csGstTotal = (($('#igst_total').val() > 0) ? $('#igst_total').val() : 0.00);
					let sgstTotal = (($('#ca_gst_total').val() > 0) ? $('#ca_gst_total').val(): 0.00);
					let total = ( parseFloat(getNetAmount) + parseFloat(csGstTotal) + parseFloat(sgstTotal)).toFixed(2);
					$('#total_amount').val(total);
				}
			});
			
			
            // Allow numeric only
            $(".allow_numeric_only").inputFilter(function(value) {
                 return /^\d*$/.test(value);
            });

            // allow decimal only
            $(".allow_decimal").inputFilter(function(value) {
                return /^-?\d*[.]?\d*$/.test(value);
            });


        });

    (function($) {
        $.fn.inputFilter = function(inputFilter) {
            return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                }
                else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                }
                else {
                    this.value = "";
                }
            });
        };
    }(jQuery));
    </script>