<div id="page-wrapper">
	<br>

	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-success">
				<div class="panel-heading">
					<a class="btn btn-success btn-xs" href=" <?php echo base_url('dashboard/admin'); ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Dashboard </a> 
					<i class="fa fa-list-ul"></i> <strong>LISTADO DE RESERVAS</strong>
				</div>
				<div class="panel-body">
				<?php 
					//si la consulta es por fecha
					if($bandera){
				?>
					<div class="alert alert-success">
						<strong>Fecha: </strong>
						<?php echo ucfirst(strftime("%b %d, %G",strtotime($fecha))); ?>
						<?php if($listaReservas){ ?>
<form  name="form_descarga" id="form_descarga" method="post" action="<?php echo base_url("reportes/generaReservaFechaPDF"); ?>" target="_blank">
	<input type="hidden" class="form-control" id="bandera" name="bandera" value=1 />
	<input type="hidden" class="form-control" id="fecha" name="fecha" value="<?php echo $fecha ?>" />
	<button type="submit" class="btn btn-primary btn-xs" id="btnSubmit2" name="btnSubmit2" value="1" >
		Descargar Listado PDF <span class="fa fa-file-pdf-o" aria-hidden="true">
	</button>
</form>
						<?php } ?>
					</div>
				<?php
					}else{
					//si la consulta es por rango de fechas
				?>
					<div class="alert alert-success">
						<strong>Rango de Fechas: </strong>
						<?php 
							echo ucfirst(strftime("%b %d, %G",strtotime($from))); 
							echo ' - ';
							echo ucfirst(strftime("%b %d, %G",strtotime($to))); 
						?>
						<?php if($listaReservas){ ?>				
<form  name="form_descarga" id="form_descarga" method="post" action="<?php echo base_url("reportes/generaReservaFechaPDF"); ?>" target="_blank">
	<input type="hidden" class="form-control" id="bandera" name="bandera" value=2 />
	<input type="hidden" class="form-control" id="from" name="from" value="<?php echo $from; ?>" />
	<input type="hidden" class="form-control" id="to" name="to" value="<?php echo $to; ?>" />
	<button type="submit" class="btn btn-primary btn-xs" id="btnSubmit2" name="btnSubmit2" value="1" >
		Descargar Listado PDF <span class="fa fa-file-pdf-o" aria-hidden="true">
	</button>
</form>
						<?php } ?>
					</div>
				<?php
					}
				?>
				
				<?php
				    if(!$listaReservas){ 
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
								<th class='text-center'>Fecha</th>
								<th class='text-center'>Horario</th>
								<th class='text-center'>Correo Electrónico</th>
								<th class='text-center'>No. Celular de Contacto</th>
								<th class='text-center'>Nombre</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($listaReservas as $lista):

								$movil = $lista['numero_contacto'];
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

									echo '<tr>';
									echo '<td class="text-center">';
									echo ucfirst(strftime("%b %d, %G",strtotime($lista['hora_inicial'])));
									echo '</td>';
									echo '<td class="text-center">';
									echo ucfirst(strftime("%I:%M",strtotime($lista['hora_inicial'])));
									echo ' - ';
									echo ucfirst(strftime("%I:%M %p",strtotime($lista['hora_final'])));
									echo '</td>';
									echo '<td>' . $lista['correo_electronico'] . '</td>';
									echo '<td class="text-center">' . $resultado . '</td>';
									echo '<td>' . $lista['nombre_completo'] . '</td>';
									echo '</tr>';
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