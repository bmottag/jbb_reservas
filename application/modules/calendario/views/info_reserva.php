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
							<?php if($infoReserva[0]['qr_code_img']){ ?>
								<div class="form-group">
									<div class="row" align="center">
										<img src="<?php echo base_url($infoReserva[0]["qr_code_img"]); ?>" class="img-rounded" width="200" height="200" alt="QR CODE" />
										<br><small>Guardar código QR, para el ingreso a las instalaciones. Puede tomar una foto con su celular.</small>
									</div>
								</div>
							<?php } ?>
						</div>
						<div class="col-lg-4">
							<div class="alert alert-success"> 

								Se guardó la Reserva de visita para el día: <br><strong><?php echo ucfirst(strftime("%a, %b %d %G, %I:%M %p",strtotime($infoHorario[0]['hora_inicial']))); ?></strong>

								<br><br>
								<strong>No. de Cupos: </strong> <?php echo $infoReserva[0]['numero_cupos_usados']; ?><br>
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
								<?php
								foreach ($infoReserva as $data):
								?>
									<ul>
										<li><?php echo $data['nombre_completo']; ?></li>
									</ul>
								<?php

								endforeach;
								?>
							</div>
						</div>
						<!-- /.col-lg-6 (nested) -->
						<div class="col-lg-6">
						</div>
						<!-- /.col-lg-6 (nested) -->
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