<script type="text/javascript" src="<?php echo base_url("assets/js/validate/calendario/reserva.js"); ?>"></script>

<script>
$(document).ready(function(){
	var i=1;
	$('#add').click(function(){
		i++;
		$('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Nombre Completo" class="form-control name_list" required /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-times"></i></button></td></tr>');
	});

	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
	});
});
</script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Reservar Visita
	<br><small>Para reservar su visita para <strong>
		<?php echo $information[0]['hora_inicial']; ?> </strong>, favor ingresar los siguientes datos: 
	<p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Cupos disponibles: <?php echo $information[0]['numero_cupos_restantes']; ?></p>
	</small>
	</h4>
</div>

<div class="modal-body">

	<form name="add_reserva" id="add_reserva" role="form" method="post" >
		<input type="hidden" id="hddIdHorario" name="hddIdHorario" value="<?php echo $idHorario; ?>"/>
		<input type="hidden" id="hddNumeroCuposRestantes" name="hddNumeroCuposRestantes" value="<?php echo $information[0]['numero_cupos_restantes']; ?>"/>
		
		<div class="row">	
			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="email">Correo Electrónico: *</label>
					<input type="text" class="form-control" id="email" name="email" placeholder="Correo Electrónico" required />
				</div>
			</div>
			
			<div class="col-sm-4">		
				<div class="form-group text-left">
					<label class="control-label" for="confirmarEmail">Confirmar correo: *</label>
					<input type="text" id="confirmarEmail" name="confirmarEmail" class="form-control" placeholder="Confirmar correo" required >
				</div>
			</div>

			<div class="col-sm-4">		
				<div class="form-group text-left">
					<label class="control-label" for="celular">Celular de Contacto: *</label>
					<input type="text" class="form-control" id="celular" name="celular" placeholder="Celular de Contacto" required />
				</div>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-bordered" id="dynamic_field" border="0">
				<tr>
					<td>
						<input type="text" name="name[]" placeholder="Nombre Completo" class="form-control name_list" required/>
					</td>
					<td>
						<button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i> Agregar Más </button>
					</td>
				</tr>
				</table>
		</div>

				
		<div class="form-group">
			<div id="div_load" style="display:none">		
				<div class="progress progress-striped active">
					<div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
						<span class="sr-only">45% completado</span>
					</div>
				</div>
			</div>
			<div id="div_error" style="display:none">			
				<div class="alert alert-danger"><span class="glyphicon glyphicon-remove" id="span_msj">&nbsp;</span></div>
			</div>	
		</div>
		
		<div class="form-group">
			<div class="row" align="center">
				<div style="width:50%;" align="center">
					<button type="button" id="btnSubmit" name="btnSubmit" class="btn btn-primary" >
						Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
					</button> 
				</div>
			</div>
		</div>
			
	</form>
</div>