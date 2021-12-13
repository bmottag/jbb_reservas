<div id="page-wrapper">
	<br>

	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<?php $dashboardURL = $this->session->userdata("dashboardURL"); ?>
					<a class="btn btn-success btn-xs" href=" <?php echo base_url($dashboardURL); ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Dashboard </a> 
					<i class="fa fa-list-ul"></i> <strong>LISTADO INSCRIPCIÓN TERCER ESPACIO DE DIÁLOGO CIUDADANO</strong>
				</div>
				<div class="panel-body">

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
								<th class='text-center'>Número de identificación</th>	
								<th class='text-center'>Localidad</th>														
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
								echo '<td>' . $lista['numero_documento'] . '</td>';
								echo '<td>' . $lista['localidad'] . '</td>';
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