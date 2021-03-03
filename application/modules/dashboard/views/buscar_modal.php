<script type="text/javascript" src="<?php echo base_url("assets/js/validate/dashboard/buscar.js"); ?>"></script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Buscar resevas por fecha	</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" action="<?php echo base_url('dashboard/buscar_reservas'); ?>">

<script>
	$( function() {
		$( "#fecha" ).datepicker({
			changeMonth: false,
			changeYear: false,
			dateFormat: 'yy-mm-dd'
		});
	});
</script>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="fecha">Fecha:</label>
					<input type="text" class="form-control" id="fecha" name="fecha" value="" placeholder="Fecha" required />
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">

		<div class="form-group">
			<div class="row" align="center">
				<div style="width:50%;" align="center">
					<br>
					<button type="button" id="btnSubmit" name="btnSubmit" class="btn btn-primary" >
						Buscar <span class="glyphicon glyphicon-search" aria-hidden="true">
					</button> 
				</div>
			</div>
		</div>


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
			
	</form>
</div>