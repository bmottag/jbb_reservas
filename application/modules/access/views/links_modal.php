<script type="text/javascript" src="<?php echo base_url("assets/js/validate/access/links.js"); ?>"></script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Enlaces Submenú
	<br><small>Adicionar/Editar Submenú</small>
	</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddId" name="hddId" value="<?php echo $information?$information[0]["id_link"]:""; ?>"/>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="perfil">Nombre Menú: *</label>
					<select name="id_menu" id="id_menu" class="form-control" required>
						<option value="">Select...</option>
						<?php for ($i = 0; $i < count($menuList); $i++) { ?>
							<option value="<?php echo $menuList[$i]["id_menu"]; ?>" <?php if($information && $information[0]["fk_id_menu"] == $menuList[$i]["id_menu"]) { echo "selected"; }  ?>><?php echo $menuList[$i]["menu_name"]; ?></option>	
						<?php } ?>
					</select>
				</div>
			</div>
		
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="link_name">Nombre Submenú: *</label>
					<input type="text" id="link_name" name="link_name" class="form-control" value="<?php echo $information?$information[0]["link_name"]:""; ?>" placeholder="Nombre Submenú" required >
				</div> 
			</div>
		
		</div>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="link_url">URL Enlace: *</label>
					<input type="text" id="link_url" name="link_url" class="form-control" value="<?php echo $information?$information[0]["link_url"]:""; ?>" placeholder="URL Enlace" required >
				</div> 
			</div>
		
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="order">Orden: *</label>
					<select name="order" id="order" class="form-control" required>
						<option value='' >Seleccione...</option>
						<?php for ($i = 1; $i <= 25; $i++) { ?>
							<option value='<?php echo $i; ?>' <?php if ($information && $i == $information[0]["order"]) { echo 'selected="selected"'; } ?> ><?php echo $i; ?></option>
						<?php } ?>									
					</select>
				</div> 
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="link_state">Estado: *</label>
					<select name="link_state" id="link_state" class="form-control" required>
						<option value=''>Seleccione...</option>
						<option value=1 <?php if($information && $information[0]["link_state"] == 1) { echo "selected"; }  ?>>Activo</option>
						<option value=2 <?php if($information && $information[0]["link_state"] == 2) { echo "selected"; }  ?>>Inactivo</option>
					</select>
				</div>
			</div>
		
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="link_icon">Icono Enlace: *</label>
					<input type="text" id="link_icon" name="link_icon" class="form-control" value="<?php echo $information?$information[0]["link_icon"]:""; ?>" placeholder="Icono Enlace" >
				</div> 
			</div>
		</div>
		
		<div class="row">		
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="link_type">Tipo Enlace: *</label>
					<select name="link_type" id="link_type" class="form-control" required>
						<option value=''>Seleccione...</option>
						<option value=1 <?php if($information && $information[0]["link_type"] == 1) { echo "selected"; }  ?>>URL interna</option>
						<option value=2 <?php if($information && $information[0]["link_type"] == 2) { echo "selected"; }  ?>>URL externa</option>
						<option value=3 <?php if($information && $information[0]["link_type"] == 3) { echo "selected"; }  ?>>Divider</option>
						<option value=4 <?php if($information && $information[0]["link_type"] == 4) { echo "selected"; }  ?>>URL externa - Video</option>
						<option value=5 <?php if($information && $information[0]["link_type"] == 5) { echo "selected"; }  ?>>URL externa - Manual</option>
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