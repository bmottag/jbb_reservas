<div id="page-wrapper">
	<br>
	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<a class="btn btn-success btn-xs" href=" <?php echo base_url('ciudadano'); ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
					<i class="fa fa-briefcase"></i> <strong>TERCER ESPACIO DE DIÁLOGO CIUDADANO, EXPEDICIÓN 2021, DIALOGA CONSCIENCIA.</strong>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-3">
							<?php if($infoReserva[0]['qr_code_img'] && file_exists($infoReserva[0]['qr_code_img'])){ ?>
								<div class="form-group">
									<div class="row" align="center">
										<img src="<?php echo base_url($infoReserva[0]["qr_code_img"]); ?>" class="img-rounded" width="200" height="200" alt="QR CODE" />
									</div>
									<p class='text-danger'><small>Guardar código, para el ingreso a las instalaciones. <br>Puede tomar una foto con su celular.</small></p>
									<p class='text-danger'><small>Se envió copia de su registro al correo electrónico registrado. Revisar SPAM o correo no deseado.</small></p>
								</div>
							<?php } ?>
						</div>
						<div class="col-lg-3">
							<div class="alert alert-success"> 
								<small>
								Se guardó la Reserva de visita: <br>
								<strong>Correo Electrónico: </strong> <?php echo $infoReserva[0]['correo_electronico']; ?><br>

							<?php
								$movil = $infoReserva[0]['numero_contacto'];
								// Separa en grupos de tres 
								$count = strlen($movil); 
									
								$num_tlf1 = substr($movil, 0, 3); 
								$num_tlf2 = substr($movil, 3, 3); 
								$num_tlf3 = substr($movil, 6, 2); 
								$num_tlf4 = substr($movil, -2); 

								if($count == 10){
									$resultado = "$num_tlf1 $num_tlf2 $num_tlf3 $num_tlf4";  
								}else{
									$resultado = chunk_split($movil,3," "); 
								}
							?>

								<strong>Celular de Contaco: </strong> <?php echo $resultado; ?><br>
								<strong>Nombres: </strong><?php echo $infoReserva[0]['nombre_completo']; ?><br>
								</small>
							</div>
						<?php
							if($infoReserva[0]['estado_reserva'] == 2){
						?>
							<div class="alert alert-danger"> 
								<small>
								La reserva se canceló el dia: <br><strong><?php echo ucfirst(strftime("%a, %b %d %G, %I:%M %p",strtotime($infoReserva[0]['fecha_cancelacion']))); ?></strong>
								</small>
							</div>
						<?php 
							}
						?>
						</div>
						<!-- /.col-lg-3 (nested) -->
						<div class="col-lg-3">
							<div class="alert alert-success">
								<small>
<p>
En el marco del proceso de Rendición de Cuentas del Jardín Botánico José Celestino Mutis 2021, abrimos la posibilidad a la ciudadanía a realizar la inscripción de manera voluntaria para asistir al Tercer Diálogo de Espacio Ciudadano con enfoque científico mediante un recorrido en el que se conocerán las líneas de investigación de uno de los proyectos misionales de la Entidad. <br><br>
El Diálogo Ciudadano se realizará el <b>14 de diciembre a las 9:00 am.</b>
</p>
								</small>
							</div>
						</div>
						<!-- /.col-lg-3 (nested) -->

						<div class="col-lg-3">
							<div class="alert alert-success">
								<small>
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
						</div>
					</div>
					<!-- /.row (nested) -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->