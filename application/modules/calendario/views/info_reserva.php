<div id="page-wrapper">
	<br>
	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<a class="btn btn-success btn-xs" href=" <?php echo base_url('calendario'); ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 
					<i class="fa fa-briefcase"></i> <strong>INFORMACIÓN RESERVA</strong>
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
								<p>Le recomendamos llegar 20 minutos antes de su reserva para realizar el protocolo de bioseguridad.</p>
<!--
								<strong>Tarifas aplicadas: </strong>
								<table class="table table-hover">
									<thead>
										<tr>
											<th></th>
											<th>GENERAL</th>
											<th>TROPICARIO</th>
										</tr>
									</thead>
									<tr>					
										<td>Mayores de 5 años en adelante</td>
										<td class='text-center'>$5.000</td>
										<td class='text-center'>$5.000</td>
									</tr>
									<tr>					
										<td>Menores de 5 años y mayores de 62 años</td>
										<td class='text-center'>Gratis</td>
										<td class='text-center'>$5.000</td>
									</tr>
									<tr>					
										<td>Nacionales</td>
										<td class='text-center'>$5.000</td>
										<td class='text-center'>$5.000</td>
									</tr>
									<tr>					
										<td>Extranjeros</td>
										<td class='text-center'>$5.000</td>
										<td class='text-center'>$10.000</td>
									</tr>
								</table>
-->
								</small>
							</div>
						</div>
						<!-- /.col-lg-3 (nested) -->

						<div class="col-lg-3">
							<div class="alert alert-success">
								<small>
								<strong>Recomendaciones</strong>
								<ul><li>Usa correctamente tu tapabocas.</li>
								<li>Lava tus manos frecuentemente.</li>
								<li>Desinfecta tu calzado y objetos personales.</li>
								<li>Estornuda en el antebrazo o cúbrete con pañuelo desechable, no con tu mano.</li>
								<li>El personal médico te tomará la temperatura.</li>
								<li>Trae tu kit de desinfección (tapabocas, gel antibacterial y papel higiénico).</li>
								<li>Mantén la distancia mínima de 2 metros.</li>
								<li>Evita aglomeraciones.</li>
								<li>Porta tu paraguas o impermeable por si llueve.</li>
								<li>Recuerda traer agua para hidratarte.</li>
								<li>Descarga la aplicación Coronapp.</li></ul>
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