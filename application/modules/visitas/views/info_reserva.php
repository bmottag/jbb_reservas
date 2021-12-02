<div id="page-wrapper">
	<br>
	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<a class="btn btn-success btn-xs" href=" <?php echo base_url('calendario'); ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
					<i class="fa fa-briefcase"></i> <strong>INFORMACIÓN VISITA CERROS</strong>
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
								Se guardó la Reserva de visita para el día: <br><strong><?php echo ucfirst(strftime("%a, %b %d %G, %I:%M %p",strtotime($infoHorario[0]['hora_inicial']))); ?></strong>

								<br><br>
								<strong>No. de Visitantes: </strong> <?php echo $infoReserva[0]['numero_cupos_usados']; ?><br>
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
								<strong>Nombres: </strong>
								<ul>
								<?php
								foreach ($infoReserva as $data):
								?>
									<li><?php echo $data['nombre_completo']; ?></li>
								<?php
								endforeach;
								?>
								</ul>
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
								<strong>CAMINO SAN FRANCISCO VICACHÁ </strong>
<p>
El camino San Francisco-Vicachá se encuentra en la parte oriental del casco urbano de la ciudad de Bogotá en la Reserva Forestal Protectora Bosque Oriental de Bogotá. En este lugar se localizan los predios Molino del Boquerón, Molino inglés y Cerezos Los Laureles, propiedades de la EAAB-ESP, en las localidades de Santa fe y La Candelaria y limita con el barrio Los Laches y la vereda Fátima. El recorrido inicia, aproximadamente a 200 metros después del acceso al funicular del cerro de Monserrate, por la avenida circunvalar hacia el sur (EAAB, 2021).
<br>
<b>Longitud Aproximada: </b>2.082 metros (Camino empinado y escalonado)
<br>
<b>Altura: </b>desde 2.718 m.s.n.m hasta 2.910 m.s.n.m
<br>
<b>Tiempo de recorrido: </b>1 hora y 30 minutos aproximadamente.
<br>
<b>Costo: </b>El ingreso al camino es gratis
</p>
								</small>
							</div>
						</div>
						<!-- /.col-lg-3 (nested) -->

						<div class="col-lg-3">
							<div class="alert alert-success">
								<small>
								<strong>Recomendaciones</strong>
								<ol>
<li>
 Los menores de edad son responsabilidad de los adultos que los inscriben. Se recomienda la participación de niños y niñas de 7 años en adelante. • Llevar ropa de fácil secado y zapatos o botas de buen agarre. • Utilizar protección solar (gafas, gorras y bloqueador) y llevar impermeable en caso de lluvia. • Para mujeres en periodo de gestación, personas con problemas respiratorios o cardiovasculares y mayores de 65 años, se recomienda no realizar caminatas largas o de exigencia física.
</li>
<li>Si tiene alguna enfermedad o consume medicamentos, consulte a su médico, antes de programar la visita.</li>

<li>Si presenta alguna condición física durante el recorrido contacte al apoyo médico.</li>
<li>Realizar actividades de calentamiento y estiramiento para prevenir esguinces, luxaciones y desgarres musculares. • No ingerir alimentos mientras camina, especialmente en ascensos, así evita la obstrucción de las vías aéreas. </li>
<li> En caso de sentir mareo, agotamiento, dolor de cabeza, tos y congestión, realice paradas de descanso, tome agua y respire profundo y despacio 5 veces. </li>
	<li> Si los síntomas continúan consulte al personal del Jardín Botánico José Celestino Mutis.</li>
<li> No hay área para parquear vehículos en el camino de San Francisco Vicachá. Consulte, antes de la visita, los parqueaderos cercanos y calcule el tiempo para llegar puntualmente.</li>

<li>Si identifica situaciones inseguras u observa alguna posibilidad de accidente por favor haga la sugerencia.</li>

<li>Respete los cultos, ritos o manifestaciones religiosas de los visitantes.</li>

<li>Mantenga las condiciones ambientales del camino, disfrute y conserve.</li>
								</ol>
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