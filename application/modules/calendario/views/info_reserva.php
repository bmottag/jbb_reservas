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
										<img src="<?php echo base_url($infoReserva[0]["qr_code_img"]); ?>" class="img-rounded" width="170" height="170" alt="QR CODE" />
										<br><small>Guardar código QR, para el ingreso a las instalaciones.</small>
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
								<strong>Celular de Contaco: </strong> <?php echo $infoReserva[0]['numero_contacto']; ?><br>
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