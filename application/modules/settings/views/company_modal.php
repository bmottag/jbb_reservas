<script type="text/javascript" src="<?php echo base_url("assets/js/validate/settings/company.js"); ?>"></script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Formulario Proveedores
	<br><small>Adicionar/Editar Proveedores.</small>
	</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_proveedor"]:""; ?>"/>
		
		<div class="row">
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="company">Nombre Proveedor: *</label>
					<input type="text" id="company" name="company" class="form-control" value="<?php echo $information?$information[0]["nombre_proveedor"]:""; ?>" placeholder="Nombre Proveedor" required >
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="contact">Contacto: *</label>
					<input type="text" id="contact" name="contact" class="form-control" value="<?php echo $information?$information[0]["contacto"]:""; ?>" placeholder="Contacto" required >
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="movilNumber">Número Celular: *</label>
					<input type="text" id="movilNumber" name="movilNumber" class="form-control" value="<?php echo $information?$information[0]["numero_celular"]:""; ?>" placeholder="Número Celular" required >
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="email">Correo: *</label>
					<input type="text" class="form-control" id="email" name="email" value="<?php echo $information?$information[0]["email"]:""; ?>" placeholder="Correo" />
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