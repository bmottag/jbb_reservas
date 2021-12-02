<script type="text/javascript" src="<?php echo base_url("assets/js/validate/settings/cupos_adicionales.js"); ?>"></script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title text-danger" id="exampleModalLabel">FORMULARIO DE HORARIOS<br>
	<small class="text-danger">Para adicionar cupos a un horario</small>
	</h4>
</div>

<div class="modal-body">

<div class="row">
	<div class="col-lg-6">
		<b>Hora Inicial:</b><br>  <?php echo $information[0]['hora_inicial']; ?><br><br>
		<b>No. Cupos:</b><br>  <?php echo $information[0]['numero_cupos']; ?>
	</div>
	<div class="col-lg-6">
		<b>Hora Final:</b><br>  <?php echo $information[0]['hora_final']; ?><br><br>
		<b>No. Cupos Disponibles:</b><br>  <?php echo $information[0]['numero_cupos_restantes']; ?>
	</div>
</div>
<br>

	<form name="formHorario" id="formHorario" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_horario"]:""; ?>"/>
		<input type="hidden" name="tipoVisita" id="tipoVisita" value=<?php echo $information?$information[0]["tipo_visita"]:""; ?> >
		<input type="hidden" id="hddCuposActuales" name="hddCuposActuales" value="<?php echo $information?$information[0]["numero_cupos"]:""; ?>"/>
		<input type="hidden" id="hddCuposDisponibles" name="hddCuposDisponibles" value="<?php echo $information?$information[0]["numero_cupos_restantes"]:""; ?>"/>
		
		<div class="form-group">
			<div class="row" align="center">
				<div style="width:40%;" align="center">
				<div class="form-group text-left">
					<label class="control-label" for="numeroCupos">Número de Cupos Adicionales: *</label>
					<input type="number" id="numeroCupos" name="numeroCupos" class="form-control" placeholder="Número de Cupos Adicionales" required >
				</div>
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