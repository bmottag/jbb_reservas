<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(function(){ 
	$(".btn-success").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'settings/cargarModalHorarios',
                data: {'idHorario': oID},
                cache: false,
                success: function (data) {
                    $('#tablaDatos').html(data);
                }
            });
	});	

	$(".btn-danger").click(function () {	
			var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
				url: base_url + 'settings/cargarModalAddCupos',
                data: {'idHorario': oID},
                cache: false,
                success: function (data) {
                    $('#tablaDatos').html(data);
                }
            });
	});	
});

function seleccionar_todo(){
   for (i=0;i<document.form_disponibilidad.elements.length;i++)
      if(document.form_disponibilidad.elements[i].type == "checkbox")
         document.form_disponibilidad.elements[i].checked=1
} 


function deseleccionar_todo(){
   for (i=0;i<document.form_disponibilidad.elements.length;i++)
      if(document.form_disponibilidad.elements[i].type == "checkbox")
         document.form_disponibilidad.elements[i].checked=0
} 
</script>


<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
					<i class="fa fa-briefcase  fa-fw"></i> CONFIGURACIÓN - HORARIOS
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
					<i class="fa fa-briefcase"></i> LISTA DE HORARIOS
				</div>
				<div class="panel-body">
					<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal" id="x">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Horarios
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
					if($infoHorarios){
				?>				
<form  name="form_disponibilidad" id="form_disponibilidad" method="post" action="<?php echo base_url("settings/bloquear_horarios"); ?>">
				<p>
				<a href="javascript:seleccionar_todo()">Marcar Todos</a> |
				<a href="javascript:deseleccionar_todo()">Desmarcar Todos</a>
				</p>
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
						<thead>
							<tr>
                                <th class='text-center'>ID</th>
                                <th class='text-center'>Hora Inicial</th>
                                <th class='text-center'>Hora Final</th>
                                <th class='text-center'>No. Cupos</th>
                                <th class='text-center'>No. Cupos Disponibles</th>
                                <th class='text-center'>Disponiblidad<br>
<button type="submit" class="btn btn-primary btn-xs" id="btnSubmit2" name="btnSubmit2" >
	Bloquear/Desbloquear <span class="glyphicon glyphicon-edit" aria-hidden="true">
</button>
                                </th>
							</tr>
						</thead>
						<tbody>							
						<?php
							foreach ($infoHorarios as $lista):
									echo '<tr>';
	                                echo '<td class="text-center">' . $lista['id_horario'] . '</td>';
	                                echo '<td class="text-center">' . $lista['hora_inicial'] . '</td>';
	                                echo '<td class="text-center">' . $lista['hora_final'] . '</td>';
	                                echo '<td class="text-center">' . $lista['numero_cupos'];
						?>
									<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal" id="<?php echo $lista['id_horario']; ?>" >
										 <span class="glyphicon glyphicon-plus" aria-hidden="true">
									</button>
						<?php

	                                echo '</td>';
	                                echo '<td class="text-center">' . $lista['numero_cupos_restantes'] . '</td>';
                                echo '<td class="text-center">';
                                switch ($lista['disponible']) {
                                    case 1:
                                        $valor = 'DISPONIBLE';
                                        $clase = "text-success";
                                        $disponibilidad = FALSE;
                                        break;
                                    case 2:
                                        $valor = 'BLOQUEADO: USUARIO RESERVANDO';
                                        $clase = "text-warning";
                                        $disponibilidad = FALSE;
                                        break;
                                    case 3:
                                        $valor = 'BLOQUEDA: POR ADMINISTRACIÓN';
                                        $clase = "text-danger";
                                        $disponibilidad = TRUE;
                                        break;
                                }
                                echo '<p class="' . $clase . '"><strong>' . $valor . '</strong>';


                               //se pueden bloquear todas los horarios
                               // if($lista['numero_cupos'] == $lista['numero_cupos_restantes']){

									$data = array(
										'name' => 'disponibilidad[]',
										'id' => 'disponibilidad',
										'value' => $lista['id_horario'],
										'checked' => $disponibilidad,
										'style' => 'margin:10px'
									);
									echo form_checkbox($data);
								//}

                                echo '</p></td>';
                                echo '</tr>';
							endforeach;
						?>
						</tbody>
					</table>
</form>
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
	$('#dataTables').DataTable({
		responsive: true,
		"pageLength": 200
	});
});
</script>