$( document ).ready( function () {
	
	$("#numeroCupos").bloquearTexto().maxlength(2);
	
	$( "#formHorario" ).validate( {
		rules: {
			numeroCupos: 			{ required: true, minlength: 1, maxlength:2 },
			intervalo: 				{ required: true },
			start_date:	 			{ required: true },
			start_hour:	 			{ required: true },
			finish_date:			{ required: true },
			finish_hour:	 		{ required: true }
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
			error.addClass( "help-block" );
			error.insertAfter( element );

		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-6" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( ".col-sm-6" ).addClass( "has-success" ).removeClass( "has-error" );
		},
		submitHandler: function (form) {
			return true;
		}
	});
	
	$("#btnSubmit").click(function(){		
	
		if ($("#formHorario").valid() == true){
		
				//Activa icono guardando
				$('#btnSubmitWorker').attr('disabled','-1');
				$("#div_error").css("display", "none");
				$("#div_load").css("display", "inline");
			
				$.ajax({
					type: "POST",	
					url: base_url + "settings/save_horarios",	
					data: $("#formHorario").serialize(),
					dataType: "json",
					contentType: "application/x-www-form-urlencoded;charset=UTF-8",
					cache: false,
					
					success: function(data){
                                            
						if( data.result == "error" )
						{
							$("#div_load").css("display", "none");
							$('#btnSubmitWorker').removeAttr('disabled');							
							return false;
						} 

						if( data.result )//true
						{	                                                        
							$("#div_load").css("display", "none");
							$('#btnSubmitWorker').removeAttr('disabled');

							var url = base_url + "settings/horarios/";
							$(location).attr("href", url);
						}
						else
						{
							alert('Error. Reload the web page.');
							$("#div_load").css("display", "none");
							$("#div_error").css("display", "inline");
							$('#btnSubmitWorker').removeAttr('disabled');
						}	
					},
					error: function(result) {
						alert('Error. Reload the web page.');
						$("#div_load").css("display", "none");
						$("#div_error").css("display", "inline");
						$('#btnSubmitWorker').removeAttr('disabled');
					}
					
		
				});	
		
		}//if			
	});
});