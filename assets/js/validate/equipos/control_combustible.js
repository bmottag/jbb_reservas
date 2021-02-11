$( document ).ready( function () {

	$("#kilometros_actuales").bloquearTexto().maxlength(7);
	$("#valor").bloquearTexto().maxlength(7);
	
	$( "#formCombustible" ).validate( {
		rules: {
			kilometros_actuales: 		{ required: true, minlength: 2, maxlength:7 },
			id_operador:				{ required: true },
			tipo_consumo:				{ required: true },
			cantidad:					{ required: true, maxlength: 20 },
			valor:		 				{ required: true, minlength: 3, maxlength: 7 },
			labor_realizada:		 	{ required: true }
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
	
	$("#btnSubmitCombustible").click(function(){		
	
		if ($("#formCombustible").valid() == true){
		
				//Activa icono guardando
				$('#btnSubmitCombustible').attr('disabled','-1');
				$("#div_error").css("display", "none");
				$("#div_load").css("display", "inline");
			
				$.ajax({
					type: "POST",	
					url: base_url + "equipos/guardar_combustible",	
					data: $("#formCombustible").serialize(),
					dataType: "json",
					contentType: "application/x-www-form-urlencoded;charset=UTF-8",
					cache: false,
					
					success: function(data){
                                            
						if( data.result == "error" )
						{
							$("#div_load").css("display", "none");
							$('#btnSubmitCombustible').removeAttr('disabled');							
							return false;
						} 

						if( data.result )//true
						{	                                                        
							$("#div_load").css("display", "none");
							$('#btnSubmitCombustible').removeAttr('disabled');

							var url = base_url + "equipos/combustible/" + data.idRecord;
							$(location).attr("href", url);
						}
						else
						{
							alert('Error. Reload the web page.');
							$("#div_load").css("display", "none");
							$("#div_error").css("display", "inline");
							$('#btnSubmitCombustible').removeAttr('disabled');
						}	
					},
					error: function(result) {
						alert('Error. Reload the web page.');
						$("#div_load").css("display", "none");
						$("#div_error").css("display", "inline");
						$('#btnSubmitCombustible').removeAttr('disabled');
					}
					
		
				});	
		
		}//if			
	});
});