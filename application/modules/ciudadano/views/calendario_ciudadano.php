<script>
$(function(){ 
	$(".btn-success").click(function () {	
			var oID = 1;
            $.ajax ({
                type: 'POST',
				url: base_url + '/ciudadano/cargarModalVisitas',
                data: {'idHorario': oID},
                cache: false,
                success: function (data) {
                    $('#tablaDatos').html(data);
                }
            });
	});	
});
</script>


<div id="page-wrapper">
	<br>	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">	
            <div class="panel panel-default">
<input type="hidden" id="hddPopUp" name="hddPopUp" value="<?php echo $infoPopup?$infoPopup[0]['parametro_valor']:""; ?>" />                
                <div class="panel-body">
                	<div class="row">
                		<div class="col-lg-12">	
                			<p class="lead">TERCER DIÁLOGO CIUDADANO, EXPEDICIÓN 2021, DIALOGA CONSCIENCIA. </p>
                		</div>
                	</div>
                	<small>
                	
<p>
En el marco del proceso de Rendición de Cuentas del Jardín Botánico José Celestino Mutis 2021, abrimos la posibilidad a la ciudadanía a realizar la inscripción de manera voluntaria para asistir al Tercer Diálogo de Espacio Ciudadano con enfoque científico mediante un recorrido en el que se conocerán las líneas de investigación de uno de los proyectos misionales de la Entidad.  
</p>

                    <p>A tener en cuenta: </p>

				    <ul>
				    
<li> La inscripción arrojará un Código el cual debe guardar y presentar al momento de ingresar a las instalaciones del Jardín Botánico.   </li>
<li> Contar con kit de bioseguridad; gel antibacterial y tapabocas.  </li>
<li> Esquema completo de vacunación para COVID-19.  </li>
<li> Para un mejor disfrute de la actividad al aire libre, asistir con ropa cómoda, tenis o botas.   </li>
<li> El ingreso de mascotas no está permitido.  </li>
<li> Contar con cadena en caso de tener bicicleta como medio de transporte. Se dejará en el biciparqueadero del Jardín.  </li>
<li> No se permite el ingreso de alimentos ni bebidas.  </li>
<li> El Jardín Botánico está comprometido con la protección de sus datos personales. Por ello, la información y datos de contacto que Usted ha comparte aquí para el registro, se acogen a la Política de Seguridad de Privacidad y Seguridad de la Información, así como la de Protección de Datos Personales, tal como lo dispone la normatividad vigente.  </li>
<li> La actividad está sujeta a cambios por situaciones climáticas o de otra índole que implique riesgo en general.  </li>
<li> Después de la visita al Jardín Botánico se diagnostica con Covid-19, debe reportarlo de inmediato a las autoridades de salud y al teléfono 4377060. Por su salud y la de quienes asistieron #BogotáSeSabeMover.   </li>

				  
			    
					</ul>

					</small>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
	</div>

	<div class="row">
		<div class="col-lg-4"></div>
		<div class="col-lg-4">

			<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal" id="x">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Inscribirse
			</button>
		</div>
	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->

<!--INICIO Modal para RESERVAS -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
<!--FIN Modal para RESERVAS -->