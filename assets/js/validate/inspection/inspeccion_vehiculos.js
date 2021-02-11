$( document ).ready( function () {
			
	$("#hours").bloquearTexto().maxlength(10);
	$( "#form" ).validate( {
		rules: {
			hours: 							{ number: true, minlength: 2, maxlength: 10 },
			radiador:						{ required: true },
			tapa:							{ required: true },
			nivel_refrigeracion: 			{ required: true },
			tension_correa_ventilacion: 	{ required: true },
			manometro_temperatura:			{ required: true },
			persiana:						{ required: true },
			tanque_combustible:				{ required: true },
			indicador:						{ required: true },
			tuberia_baja_presion:			{ required: true },
			grifo:							{ required: true },
			vaso_sedimentacion:				{ required: true },
			filtro_aire:					{ required: true },
			filtro_combustible:				{ required: true },
			prefiltro:						{ required: true },
			filtro_aire_tipo_seco:			{ required: true },
			pre_calentador:					{ required: true },
			acelerador_manual:				{ required: true },
			acelerador_aire:				{ required: true },
			ahogador:						{ required: true },
			consumo_acpm:					{ required: true },
			tapon_carter:					{ required: true },
			nivel_aceite_motor:				{ required: true },
			bayoneta:						{ required: true },
			presion_aceite_motor:			{ required: true },
			indicador_presion:				{ required: true },
			tapa_drenaje_caja:				{ required: true },
			bombillo_tablero:				{ required: true },
			nivel_aceite_direccion:			{ required: true },
			bomba_hidraulica:				{ required: true },
			bateria:						{ required: true },
			nivel_electrolito:				{ required: true },
			bornes_bateria:					{ required: true },
			terminales:						{ required: true },
			seguro_bateria:					{ required: true },
			caja:							{ required: true },
			tapa_celdas:					{ required: true },
			conexiones_alternador:			{ required: true },
			regulador_corriente:			{ required: true },
			indicador_tablero:				{ required: true },
			luz_testigo:					{ required: true },
			horometro:						{ required: true },
			interruptor:					{ required: true },
			farolas_delanteras:				{ required: true },
			farolas_traseras:				{ required: true },
			pedal_embrague:					{ required: true },
			tolerancia_pedal:				{ required: true },
			engrase_sistema:				{ required: true },
			nivel_aceite:					{ required: true },
			palanca_baja:					{ required: true },
			palanca_alta:					{ required: true },
			selector_velocidad:				{ required: true },
			esfera_palanca:					{ required: true },
			palanca:						{ required: true },
			barra_tiro:						{ required: true },
			bloqueador:						{ required: true },
			nivel_aceite_diferencial:		{ required: true },
			bayoneta_diferencial:			{ required: true },
			pesas_delanteras:				{ required: true },
			pesas_traseras:					{ required: true },
			pernos_delanteros:				{ required: true },
			palanca_control_posicion:		{ required: true },
			palanca_control_automatico:		{ required: true },
			nivel_aceite_hidraulico:		{ required: true },
			bayoneta_hidraulico:			{ required: true },
			tuberia_conduccion:				{ required: true },
			radiador_enfriado:				{ required: true },
			brazos_levante:					{ required: true },
			cadenas_tensoras:				{ required: true },
			mangueras:						{ required: true },
			tonillo_nivelados:				{ required: true },
			guardafangos:					{ required: true },
			asiento:						{ required: true },
			capot:							{ required: true },
			caja_direccion:					{ required: true },
			brazo_direccion:				{ required: true },
			barra_principal:				{ required: true },
			soporte_delantero:				{ required: true },
			tolerancia_frenos:				{ required: true },
			freno_mano:						{ required: true },
			tapa_rueda_delantera:			{ required: true },
			rines_traseros:					{ required: true },
			rines_delanteros:				{ required: true }
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
			error.addClass( "help-block" );
			error.insertAfter( element );

		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
		},
		submitHandler: function (form) {
			return true;
		}
	});
						
	$("#btnSubmit").click(function(){		
	
		if ($("#form").valid() == true){
		
				//Activa icono guardando
				$('#btnSubmit').attr('disabled','-1');
				$("#div_load").css("display", "inline");
				$("#div_error").css("display", "none");
			
				$.ajax({
					type: "POST",	
					url: base_url + "inspection/save_inspection_vehiculos",	
					data: $("#form").serialize(),
					dataType: "json",
					contentType: "application/x-www-form-urlencoded;charset=UTF-8",
					cache: false,
					
					success: function(data){
                                            
						if( data.result == "error" )
						{
							alert(data.mensaje);
							$("#div_load").css("display", "none");
							$('#btnSubmit').removeAttr('disabled');							
							
							$("#span_msj").html(data.mensaje);
							$("#div_error").css("display", "inline");
							return false;
						} 

						if( data.result )//true
						{	                                                        
							$("#div_load").css("display", "none");
							$('#btnSubmit').removeAttr('disabled');

							var url = base_url + "inspection/add_vehiculos_inspection/" + data.idInspection;
							$(location).attr("href", url);
						}
						else
						{
							alert('Error. Reload the web page.');
							$("#div_load").css("display", "none");
							$("#div_error").css("display", "inline");
							$('#btnSubmit').removeAttr('disabled');
						}	
					},
					error: function(result) {
						alert('Error. Reload the web page.');
						$("#div_load").css("display", "none");
						$("#div_error").css("display", "inline");
						$('#btnSubmit').removeAttr('disabled');
					}
					
				});	
		
		}//if			
		else
		{
			alert('Faltan campos por diligenciar.');
			
		}					
	});

});