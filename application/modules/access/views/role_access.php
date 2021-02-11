<script type="text/javascript" src="<?php echo base_url("assets/js/validate/access/role_access.js"); ?>"></script>

<script>
$(function(){ 
	$(".btn-success").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'access/cargarModalRoleAccess',
                data: {'idPermiso': oID},
                cache: false,
                success: function (data) {
                    $('#tablaDatos').html(data);
                }
            });
	});	
});
</script>

<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
					<i class="fa fa-cogs fa-fw"></i> ADMINISTRAR ACCESO AL SISTEMA
					</h4>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->				
	</div>
	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-puzzle-piece"></i> ACCESO DE ROLES
				</div>
				<div class="panel-body">
					<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal" id="x">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Acceso de Roles
					</button><br>
					
<?php
	$retornoExito = $this->session->flashdata('retornoExito');
	if ($retornoExito) {
?>
		<div class="alert alert-success ">
			<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
			<?php echo $retornoExito ?>		
		</div>
<?php
	}
	$retornoError = $this->session->flashdata('retornoError');
	if ($retornoError) {
?>
		<div class="alert alert-danger ">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<?php echo $retornoError ?>
		</div>
<?php
	}
?> 
				<?php
					if($info){
				?>				
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
								<th class="text-center">Nombre Menú</th>
								<th class="text-center">Nombre Submenú</th>
								<th class="text-center">Nombre Rol</th>
								<th class="text-center">Editar/Eliminar</th>
								<th class="text-center">Tipo Menú</th>
								<th class="text-center">Orden Menú</th>
								<th class="text-center">Orden Enlace</th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($info as $lista):
									echo "<tr>";
									echo "<td>" . $lista['menu_name'] . "</td>";
									echo "<td>" . $lista['link_name'] . "</td>";
									echo "<td class='text-center'>";
									echo '<p class="' . $lista['style'] . '"><strong>' . $lista['role_name'] . '</strong></p>';
									echo "</td>";
									
									echo "<td class='text-center'>";
						?>
									<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_access']; ?>" >
										Editar <span class="glyphicon glyphicon-edit" aria-hidden="true">
									</button>
									
									<button type="button" id="<?php echo $lista['id_access']; ?>" class='btn btn-danger btn-xs' title="Delete">
											<i class="fa fa-trash-o"></i>
									</button>
						<?php
									echo "</td>";
									echo "<td>" . $lista['menu_type'] . "</td>";
									echo "<td>" . $lista['menu_order'] . "</td>";
									echo "<td>" . $lista['order'] . "</td>";
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
		
				
<!--INICIO Modal para adicionar HAZARDS -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
<!--FIN Modal para adicionar HAZARDS -->

<!-- Tables -->
<script>
$(document).ready(function() {
    $('#dataTables').DataTable( {
		"order": [[ 2, "asc" ],[ 4, "asc" ],[ 5, "asc" ],[ 6, "asc" ]],
		paging: false,
		"columnDefs": [
            {
                "targets": [ 4 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 5 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 6 ],
                "visible": false,
                "searchable": false
            }
        ]
    } );
} );
</script>