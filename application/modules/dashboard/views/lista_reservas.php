<div id="page-wrapper">
	<br>

	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<?php $dashboardURL = $this->session->userdata("dashboardURL"); ?>
					<a class="btn btn-success btn-xs" href=" <?php echo base_url($dashboardURL); ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Dashboard </a> 
					<i class="fa fa-list-ul"></i> <strong>LISTADO DE RESERVAS</strong>
				</div>
				<div class="panel-body">
				
					<div class="alert alert-success">
						<strong>Fecha: </strong>
						<?php echo ucfirst(strftime("%b %d, %G",strtotime($horarioInfo[0]['hora_inicial']))); ?>
						<br><strong>Horario: </strong>
						<?php echo ucfirst(strftime("%I:%M %p",strtotime($horarioInfo[0]['hora_inicial']))); ?>
						-
						<?php echo ucfirst(strftime("%I:%M %p",strtotime($horarioInfo[0]['hora_final']))); ?>
						<?php if($infoReserva){ ?>
						<br><strong>Descargar Listado: </strong>
						<a href='<?php echo base_url('reportes/generaReservaPDF/' . $horarioInfo[0]['id_horario'] ); ?>' target="_blank">PDF <img src='<?php echo base_url_images('pdf.png'); ?>' ></a>
						<?php } ?>
					</div>
					<br>

				<?php
				    if(!$infoReserva){ 
				?>
				        <div class="col-lg-12">
				            <small>
				                <p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en la base de datos.</p>
				            </small>
				        </div>
				<?php
				    }else{
				?>

					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class='text-center'>#</th>
								<th class='text-center'>Correo Electrónico</th>
								<th class='text-center'>No. Celular de Contacto</th>
								<th class='text-center'>Nombre</th>
								<?php 
									if($horarioInfo[0]['tipo_visita'] == 2)
									{
										echo "<th class='text-center'>EPS</th>";
										echo "<th class='text-center'>Número Contancto Emergencia</th>";
									}
								?>	
								<th class='text-center'>Estado</th>														
							</tr>
						</thead>
						<tbody>							
						<?php
							$i = 1;
							foreach ($infoReserva as $lista):
								echo '<tr>';
								echo '<td class="text-center">' . $i . '</td>';
								echo '<td>' . $lista['correo_electronico'] . '</td>';
								echo '<td class="text-center">' . $lista['numero_contacto'] . '</td>';
								echo '<td>' . $lista['nombre_completo'] . '</td>';
								if($horarioInfo[0]['tipo_visita'] == 2)
								{
									echo '<td>' . $lista['eps'] . '</td>';
									echo '<td>' . $lista['emergencia'] . '</td>';
								}
								echo '<td class="text-center">';
								switch ($lista['estado_reserva']) {
								    case 1:
								        $valor = '---';
								        $clase = 'text-success';
								        break;
								    case 2:
								        $valor = 'CANCELADA';
								        $clase = 'text-danger';
								        break;
								}
								echo '<p class="' . $clase . '"><strong>' . $valor . '</strong></p>';
								echo '</td>';
								echo '</tr>';
								$i++;
							endforeach;
						?>
						</tbody>
					</table>
				<?php } ?>

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

<!-- Tables -->
<script>
$(document).ready(function() {
    $('#dataTables').DataTable({
        responsive: true,
		 "ordering": false,
		 paging: false,
		"searching": false,
		"info": false
    });
});
</script>