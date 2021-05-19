<div id="page-wrapper">

	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
						<i class="fa fa-gear fa-fw"></i> CONFIGURACIÓN - POP-UP
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
					<i class="fa fa-thumb-tack"></i> POP-UP
				</div>
				<div class="panel-body">

					<div class="form-group">
						<div class="row" align="center">
							<div style="width:40%;" align="center">
								<div class="alert alert-success ">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									Para adicionar un mensaje como ventana emergente en el calendario de reservas, ingrese el contenido en el siguiente campo.
								</div>
							</div>
						</div>
					</div>
					<form  name="form" id="form" class="form-horizontal" method="post" action="<?php echo base_url("settings/save_popup"); ?>" >
												
						<div class="form-group">
							<label class="col-sm-4 control-label" for="inputConfirm">Pop-up: *</label>
							<div class="col-sm-5">
								<textarea id="texto" name="texto" placeholder="Pop-up" class="form-control" rows="3"><?php echo $infoPopup?$infoPopup[0]['parametro_valor']:""; ?></textarea>
							</div>
						</div>
												
						<div class="form-group">
							<div class="row" align="center">
								<div style="width:50%;" align="center">
									<button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary" >
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
