<script type="text/javascript" src="<?php echo base_url("assets/js/validate/settings/horarios.js"); ?>"></script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">FORMULARIO DE HORARIOS</h4>
</div>

<div class="modal-body">
	<form name="formHorario" id="formHorario" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_proveedor"]:""; ?>"/>
		
		<div class="row">
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="numeroCupos">Número de Cupos: *</label>
					<input type="text" id="numeroCupos" name="numeroCupos" class="form-control" value="<?php echo $information?$information[0]["numero_cupos"]:""; ?>" placeholder="Número de Cupos" required >
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="intervalo">Intervalo: *</label>
					<select name="intervalo" id="intervalo" class="form-control" required>
						<option value=''>Seleccione...</option>
						<option value=1 >Cada 15 min</option>
						<option value=2 >Cada 30 min</option>
						<option value=3 >Cada 60 min</option>
					</select>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">		
				<div class="form-group text-left">
				
<script>
	$( function() {
		$( "#start_date" ).datepicker({
			minDate: '1',
			dateFormat: 'yy-mm-dd'
		});
	});
</script>
					<label class="control-label" for="start_date">Fecha Desde: *</label>
					<input type="text" class="form-control" id="start_date" name="start_date" placeholder="Fecha Desde" required />
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label for="type" class="control-label">Hora Inicio: *</label>
					<select name="start_hour" id="start_hour" class="form-control" required>
						<option value='' >Select...</option>
						<?php
						for ($i = 8; $i < 21; $i++) {
							
							$i = $i<10?"0".$i:$i;
							?>
							<option value='<?php echo $i; ?>' ><?php echo $i; ?></option>
						<?php } ?>									
					</select>
				</div>
			</div>
				
		</div>

		
		<div class="row">
			<div class="col-sm-6">		
				<div class="form-group text-left">
				
<script>
	$( function() {
		$( "#finish_date" ).datepicker({
			minDate: '1',
			dateFormat: 'yy-mm-dd'
		});
	});
</script>
					<label class="control-label" for="finish_date">Fecha Hasta: *</label>
					<input type="text" class="form-control" id="finish_date" name="finish_date" placeholder="Fecha Hasta" required />
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label for="type" class="control-label">Hora Fin: *</label>
					<select name="finish_hour" id="finish_hour" class="form-control" required>
						<option value='' >Select...</option>
						<?php
						for ($i = 10; $i < 23; $i++) {
							
							$i = $i<10?"0".$i:$i;
							?>
							<option value='<?php echo $i; ?>' ><?php echo $i; ?></option>
						<?php } ?>									
					</select>
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
					<button type="button" id="btnSubmit" name="btnSubmit" class="btn btn-primary" >
						Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
					</button> 
				</div>
			</div>
		</div>
			
	</form>
</div>