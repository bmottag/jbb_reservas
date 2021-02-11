$( document ).ready( function () {

	$(".btn-danger").click(function () {	
		var oID = $(this).attr("id");
		if(window.confirm('¿Esta seguro de eliminar la foto?'))
		{
			$(".btn-danger").attr('disabled','-1');
			$.ajax ({
				type: 'POST',
				url: base_url + 'mantenimiento/eliminar_foto_danio',
				data: {'identificador': oID},
				cache: false,
				success: function(data){
					if( data.result == "error" )
					{
						alert(data.mensaje);
						$(".btn-danger").removeAttr('disabled');							
						return false;
					}
					if( data.result )
					{	                                                        
						$(".btn-danger").removeAttr('disabled');
						var url = base_url + "mantenimiento/foto_danio/" + data.idEquipo + "/" + data.idRecord;
						$(location).attr("href", url);
					}
					else
					{
						alert('Error. Reload the web page.');
						$(".btn-danger").removeAttr('disabled');
					}	
				},
				error: function(result) {
					alert('Error. Reload the web page.');
					$(".btn-danger").removeAttr('disabled');
				}
			});
		}
	});
});