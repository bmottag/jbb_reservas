<script type="text/javascript" src="<?php echo base_url("assets/js/validate/settings/employee_v3.js"); ?>"></script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Formulario de Usuario
	<br><small>Adicionar/Editar Usuario</small>
	</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_user"]:""; ?>"/>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="firstName">Nombre: *</label>
					<input type="text" id="firstName" name="firstName" class="form-control" value="<?php echo $information?$information[0]["first_name"]:""; ?>" placeholder="Nombre" required >
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="lastName">Apellido: *</label>
					<input type="text" id="lastName" name="lastName" class="form-control" value="<?php echo $information?$information[0]["last_name"]:""; ?>" placeholder="Apellido" required >
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="user">Nombre Usuario: *</label>
					<input type="text" id="user" name="user" class="form-control" value="<?php echo $information?$information[0]["log_user"]:""; ?>" placeholder="Nombre Usuario" required >
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="email">Correo: *</label>
					<input type="text" class="form-control" id="email" name="email" value="<?php echo $information?$information[0]["email"]:""; ?>" placeholder="Correo" />
				</div>
			</div>
		</div>
				
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="movilNumber">Número Celular: *</label>
					<input type="text" id="movilNumber" name="movilNumber" class="form-control" value="<?php echo $information?$information[0]["movil"]:""; ?>" placeholder="Número Celular" required >
				</div>
			</div>
				
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="id_role">Rol Usuario: *</label>					
					<select name="id_role" id="id_role" class="form-control" required>
						<option value="">Seleccione...</option>
						<?php for ($i = 0; $i < count($roles); $i++) { ?>
							<option value="<?php echo $roles[$i]["id_role"]; ?>" <?php if($information && $information[0]["fk_id_user_role"] == $roles[$i]["id_role"]) { echo "selected"; }  ?>><?php echo $roles[$i]["role_name"]; ?></option>	
						<?php } ?>
					</select>
				</div>
			</div>
			
	<?php if($information){ ?>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="state">Estado: *</label>
					<select name="state" id="state" class="form-control" required>
						<option value=''>Seleccione...</option>
						<option value=1 <?php if($information[0]["state"] == 1) { echo "selected"; }  ?>>Activo</option>
						<option value=2 <?php if($information[0]["state"] == 2) { echo "selected"; }  ?>>Inactivo</option>
					</select>
				</div>
			</div>
	<?php } ?>
		
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