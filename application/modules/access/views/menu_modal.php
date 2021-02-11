<script type="text/javascript" src="<?php echo base_url("assets/js/validate/access/menu.js"); ?>"></script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Enlaces Menú
	<br><small>Adicionar/Editar Enlaces Menú</small>
	</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_menu"]:""; ?>"/>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="menu_name">Nombre Menú: *</label>
					<input type="text" id="menu_name" name="menu_name" class="form-control" value="<?php echo $information?$information[0]["menu_name"]:""; ?>" placeholder="Nombre Menú" required >
				</div> 
			</div>
			
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="menu_url">URL Menú: *</label>
					<input type="text" id="menu_url" name="menu_url" class="form-control" value="<?php echo $information?$information[0]["menu_url"]:""; ?>" placeholder="URL Menú" >
				</div> 
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="order">Orden: *</label>
					<select name="order" id="order" class="form-control" required>
						<option value='' >Seleccione...</option>
						<?php for ($i = 1; $i <= 10; $i++) { ?>
							<option value='<?php echo $i; ?>' <?php if ($information && $i == $information[0]["menu_order"]) { echo 'selected="selected"'; } ?> ><?php echo $i; ?></option>
						<?php } ?>									
					</select>
				</div> 
			</div>
		
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="menu_type">Tipo Menú: *</label>
					<select name="menu_type" id="menu_type" class="form-control" required>
						<option value=''>Seleccione...</option>
						<option value=1 <?php if($information && $information[0]["menu_type"] == 1) { echo "selected"; }  ?>>Menú Lateral</option>
						<option value=2 <?php if($information && $information[0]["menu_type"] == 2) { echo "selected"; }  ?>>Menú Superior</option>
					</select>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="menu_state">Estado: *</label>
					<select name="menu_state" id="menu_state" class="form-control" required>
						<option value=''>Seleccione...</option>
						<option value=1 <?php if($information && $information[0]["menu_state"] == 1) { echo "selected"; }  ?>>Activo</option>
						<option value=2 <?php if($information && $information[0]["menu_state"] == 2) { echo "selected"; }  ?>>Inactivo</option>
					</select>
				</div>
			</div>
		
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="menu_icon">Icono Menú: *</label>
					<input type="text" id="menu_icon" name="menu_icon" class="form-control" value="<?php echo $information?$information[0]["menu_icon"]:""; ?>" placeholder="Icono Menú" >
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