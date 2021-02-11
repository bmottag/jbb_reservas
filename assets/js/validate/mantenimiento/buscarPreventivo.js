$( document ).ready( function () {
	
	$( "#formBuscar" ).validate( {
		rules: {
			tipo_equipo:	{ required: true }
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
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
	
	$("#btnBuscar").click(function(){		
		if ($("#formBuscar").valid() == true){
			var form = document.getElementById('form');
			form.submit();
		} else {
			//alert('Error.');
		}
	});
});