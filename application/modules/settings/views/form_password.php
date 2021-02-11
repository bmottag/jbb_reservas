<script type="text/javascript" src="<?php echo base_url("assets/js/validate/password.js"); ?>"></script>

<div id="page-wrapper">

	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
						<i class="fa fa-gear fa-fw"></i> CONFIGURACIÓN - USUARIOS
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
					<i class="fa fa-unlock"></i> CAMBIAR CONTRASEÑA
				</div>
				<div class="panel-body">

					<form  name="form" id="form" class="form-horizontal" method="post" action="<?php echo base_url("settings/update_password"); ?>" >
						<input type="hidden" id="hddId" name="hddId" value="<?php echo $information[0]["id_user"]; ?>"/>
						<input type="hidden" id="hddUser" name="hddUser" value="<?php echo $information[0]["log_user"]; ?>"/>
						<input type="hidden" id="hddState" name="hddState" value="<?php echo $information[0]["state"]; ?>"/>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="firstName">Nombre:</label>
							<div class="col-sm-5">
								<input type="text" id="firstName" name="firstName" class="form-control" value="<?php echo $information[0]['first_name']; ?>" disabled >
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="lastName">Apellido:</label>
							<div class="col-sm-5">
								<input type="text" id="lastName" name="lastName" class="form-control" value="<?php echo $information[0]['last_name']; ?>" disabled >
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="username">Nombre Usuario:</label>
							<div class="col-sm-5">
								<input type="text" id="user" name="user" class="form-control" value="<?php echo $information[0]['log_user']; ?>" disabled >
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputPassword">Contraseña: *</label>
							<div class="col-sm-5">
								<input type="text" id="inputPassword" name="inputPassword" class="form-control" >
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputConfirm">Confirmar contraseña: *</label>
							<div class="col-sm-5">
								<input type="text" id="inputConfirm" name="inputConfirm" class="form-control" >
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
				<!-- /.row (nested) -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
