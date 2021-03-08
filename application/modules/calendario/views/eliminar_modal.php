<?php 
	$variable = $this->input->post("variable"); 
	$archivoValidacion =  base_url('assets/js/validate/calendario/' . $variable . '.js');
?>
<script type="text/javascript" src="<?php echo $archivoValidacion; ?>"></script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel"><?php echo strtoupper($variable); ?> RESERVA
	<br><small>Para <?php echo $variable; ?> su reserva, favor ingresar su correo electrónico, la fecha en que reservo y número de celular de contacto. 
	<?php 
		$claseBoton = 'btn-success';
		$iconoBoton = 'glyphicon-search';
		if($variable == 'eliminar')
		{
			echo 'Borrará todas sus reservas de ese día.';
			$claseBoton = 'btn-danger';
			$iconoBoton = 'glyphicon-remove';
		} 
	?> 
	</small>
	</h4>
</div>

<div class="modal-body">
	<form name="formEliminar" id="formEliminar" role="form" method="post" >		
		<div class="row">
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="email">Correo Electrónico: *</label>
					<input type="text" class="form-control" id="email" name="email" placeholder="Correo Electrónico" required />
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
<script>
	$( function() {
		$( "#fecha" ).datepicker({
			minDate: '0',
			dateFormat: 'yy-mm-dd'
		});
	});
</script>
					<label class="control-label" for="fecha">Fecha: *</label>
					<input type="text" class="form-control" id="fecha" name="fecha" placeholder="Fecha" required />
				</div>
			</div>
		</div>

		<div class="row">	
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="celular">Celular de Contacto: *</label>
					<input type="text" class="form-control" id="celular" name="celular" placeholder="Celular de Contacto" required />
				</div>
			</div>
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
					<button type="button" id="btnSubmit" name="btnSubmit" class="btn <?php echo $claseBoton; ?>" >
						<?php echo ucfirst ($variable); ?> Reserva <span class="glyphicon glyphicon <?php echo $iconoBoton; ?>" aria-hidden="true">
					</button> 
				</div>
			</div>
		</div>
			
	</form>
</div>