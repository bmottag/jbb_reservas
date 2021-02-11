<div id="page-wrapper">
	<br>	
	<!-- /.row -->
	<div class="row">

		<div class="col-lg-12">
			<div class="panel panel-info">
				<div class="panel-heading">	
					<a class="btn btn-info btn-xs" href="<?php echo base_url('login/search_equipment'); ?> "><span class="glyphicon glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar </a> 				
					<i class="fa fa-truck"></i> Listado Equipos
				</div>
				<div class="panel-body">	

<?php 										
	if(!$info){ 
		echo '<div class="col-lg-12">
				<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en el sistema.</p>
			</div>';
	}else{
?>
			
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center">No. Inventario Entidad</th>
								<th class="text-center">Marca</th>
								<th class="text-center">Modelo</th>
								<th class="text-center">Número Serial</th>
								<th class="text-center">Estado</th>
								<th class="text-center">Observación</th>
								<th class="text-center">Ver Equipo</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($info as $lista):
							
									echo "<tr>";
									echo "<td class='text-center'>" . $lista['numero_inventario'] . "</td>";
									echo "<td>" . $lista['marca'] . "</td>";
									echo "<td>" . $lista['modelo'] . "</td>";
									echo "<td class='text-center'>" . $lista['numero_serial'] . "</td>";
									echo "<td class='text-center'>";

									$enlace =  base_url('login/index/' . $lista['qr_code_encryption']);
									$deshabilitar = '';

									switch ($lista['estado_equipo']) {
										case 1:
											$valor = 'Activo';
											$clase = "text-success";
											break;
										case 2:
											$valor = 'Inactivo';
											$clase = "text-danger";
											$enlace = '#';
											$deshabilitar = 'disabled';
											break;
									}
									echo '<p class="' . $clase . '"><strong>' . $valor . '</strong></p>';
									echo "</td>";
									echo "<td>" . $lista['observacion'] . "</td>";

									echo "<td class='text-center'>";
								?>

									<a class='btn btn-success btn-xs' href='<?php echo $enlace; ?>' <?php echo $deshabilitar; ?>>
										Ver Equipo <span class="fa fa-arrow-circle-right" aria-hidden="true" >
									</a>

								<?php
									echo "</td>";
									echo "</tr>";

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
		paging: false,
		"searching": false,
		"pageLength": 25
	});
});
</script>