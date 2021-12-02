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
				<?php 
					//si la consulta es por fecha
					if($bandera){
				?>
					<div class="alert alert-success">
						<div class="row">
							<div class="col-lg-2">
								<strong>Fecha: </strong>
								<?php echo ucfirst(strftime("%b %d, %G",strtotime($fecha))); ?>
							</div>
							<?php if($listaReservas){ ?>
							<div class="col-lg-2">
								<form  name="form_descarga" id="form_descarga" method="post" action="<?php echo base_url("reportes/generaReservaFechaPDF"); ?>" target="_blank">
									<input type="hidden" class="form-control" id="bandera" name="bandera" value=1 />
									<input type="hidden" class="form-control" id="fecha" name="fecha" value="<?php echo $fecha ?>" />
									<input type="hidden" name="tipoVisita" id="tipoVisita" value="<?php echo $tipoVisita; ?>">
									<button type="submit" class="btn btn-primary btn-xs" id="btnSubmit2" name="btnSubmit2" value="1" >
										Descargar Listado PDF <span class="fa fa-file-pdf-o" aria-hidden="true" />
									</button>
								</form>
							</div>
							<div class="col-lg-2">
								<form  name="form_descarga" id="form_descarga" method="post" action="<?php echo base_url("reportes/generaReservaFechaXLS"); ?>" target="_blank">
									<input type="hidden" class="form-control" id="bandera" name="bandera" value=1 />
									<input type="hidden" class="form-control" id="fecha" name="fecha" value="<?php echo $fecha ?>" />
									<input type="hidden" name="tipoVisita" id="tipoVisita" value="<?php echo $tipoVisita; ?>">
									<button type="submit" class="btn btn-primary btn-xs" id="btnSubmit2" name="btnSubmit2" value="1" >
										Descargar Listado XLS <span class="fa fa-file-excel-o" aria-hidden="true" />
									</button>
								</form>
							</div>
							<?php } ?>
						</div>
					</div>
				<?php
					}else{
					//si la consulta es por rango de fechas
				?>
					<div class="alert alert-success">
						<div class="row">
							<div class="col-lg-3">
								<strong>Rango de Fechas: </strong>
								<?php 
									echo ucfirst(strftime("%b %d, %G",strtotime($from))); 
									echo ' - ';
									echo ucfirst(strftime("%b %d, %G",strtotime($to))); 
								?>
							</div>
							<?php if($listaReservas){ ?>				
							<div class="col-lg-2">
								<form  name="form_descarga" id="form_descarga" method="post" action="<?php echo base_url("reportes/generaReservaFechaPDF"); ?>" target="_blank">
									<input type="hidden" class="form-control" id="bandera" name="bandera" value=2 />
									<input type="hidden" class="form-control" id="from" name="from" value="<?php echo $from; ?>" />
									<input type="hidden" class="form-control" id="to" name="to" value="<?php echo $to; ?>" />
									<button type="submit" class="btn btn-primary btn-xs" id="btnSubmit2" name="btnSubmit2" value="1" >
										Descargar Listado PDF <span class="fa fa-file-pdf-o" aria-hidden="true" />
									</button>
								</form>
							</div>
							<div class="col-lg-2">
								<form  name="form_descarga" id="form_descarga" method="post" action="<?php echo base_url("reportes/generaReservaFechaXLS"); ?>" target="_blank">
									<input type="hidden" class="form-control" id="bandera" name="bandera" value=2 />
									<input type="hidden" class="form-control" id="from" name="from" value="<?php echo $from; ?>" />
									<input type="hidden" class="form-control" id="to" name="to" value="<?php echo $to; ?>" />
									<button type="submit" class="btn btn-primary btn-xs" id="btnSubmit2" name="btnSubmit2" value="1" >
										Descargar Listado XLS <span class="fa fa-file-excel-o" aria-hidden="true" />
									</button>
								</form>
							</div>
							<?php } ?>
						</div>
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
								<th class='text-center'>#</th>
								<th class='text-center'>Fecha</th>
								<th class='text-center'>Horario</th>
								<th class='text-center'>Correo Electrónico</th>
								<th class='text-center'>No. Celular de Contacto</th>
								<th class='text-center'>Nombre</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							$i = 1;
							foreach ($listaReservas as $lista):
								echo '<tr>';
								echo '<td class="text-center">' . $i . '</td>';
								echo '<td class="text-center">';
								echo ucfirst(strftime("%b %d, %G",strtotime($lista['hora_inicial'])));
								echo '</td>';
								echo '<td class="text-center">';
								echo ucfirst(strftime("%I:%M",strtotime($lista['hora_inicial'])));
								echo ' - ';
								echo ucfirst(strftime("%I:%M %p",strtotime($lista['hora_final'])));
								echo '</td>';
								echo '<td>' . $lista['correo_electronico'] . '</td>';
								echo '<td class="text-center">' . $lista['numero_contacto'] . '</td>';
								echo '<td>' . $lista['nombre_completo'] . '</td>';
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