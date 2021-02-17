<div id="page-wrapper">
    <div class="row"><br>
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
						DASHBOARD
					</h4>
				</div>
			</div>
		</div>
		<!-- /.col-lg-12 -->
    </div>
								
<?php
$retornoExito = $this->session->flashdata('retornoExito');
if ($retornoExito) {
    ?>
	<div class="row">
		<div class="col-lg-12">	
			<div class="alert alert-success ">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				<strong><?php echo $this->session->userdata("firstname"); ?></strong> <?php echo $retornoExito ?>		
			</div>
		</div>
	</div>
    <?php
}

$retornoError = $this->session->flashdata('retornoError');
if ($retornoError) {
    ?>
	<div class="row">
		<div class="col-lg-12">	
			<div class="alert alert-danger ">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<?php echo $retornoError ?>
			</div>
		</div>
	</div>
    <?php
}
?> 
    <!-- /.row -->
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-thumb-tack fa-fw"></i> HORARIOS VIGENTES
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

<?php
    if(!$infoHorarios){ 
?>
        <div class="col-lg-12">
            <small>
                <p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registros en la base de datos.</p>
            </small>
        </div>
<?php
    }else{
?>                      
                    
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                        <thead>
                            <tr>
                                <th class='text-center'>ID</th>
                                <th class='text-center'>Hora Inicial</th>
                                <th class='text-center'>Hora Final</th>
                                <th class='text-center'>No. de Cupos</th>
                                <th class='text-center'>No. Disponibles</th>
                                <th class='text-center'>Estado</th>
                                <th class='text-center'>Ver Reservas</th>
                            </tr>
                        </thead>
                        <tbody>                         
                        <?php
                            foreach ($infoHorarios as $lista):
                                echo '<tr>';
                                echo '<td class="text-center">' . $lista['id_horario'] . '</td>';
                                echo '<td class="text-center">' . $lista['hora_inicial'] . '</td>';
                                echo '<td class="text-center">' . $lista['hora_final'] . '</td>';
                                echo '<td class="text-center">' . $lista['numero_cupos'] . '</td>';
                                echo '<td class="text-center">' . $lista['numero_cupos_restantes'] . '</td>';
                                echo '<td class="text-center">';
                                switch ($lista['estado']) {
                                    case 1:
                                        $valor = 'Iniciada';
                                        $clase = "text-success";
                                        break;
                                    case 2:
                                        $valor = 'En Proceso';
                                        $clase = "text-warning";
                                        break;
                                    case 3:
                                        $valor = 'Cerrada';
                                        $clase = "text-danger";
                                        break;
                                }
                                echo '<p class="' . $clase . '"><strong>' . $valor . '</strong></p>';
                                echo '</td>';
                                echo '<td class="text-center">';
                            ?>
                                    <a class='btn btn-success btn-xs' href='<?php echo base_url('dashboard/reservas/' . $lista['id_horario']) ?>'>
                                        Ver Reservas <span class="fa fa-check" aria-hidden="true">
                                    </a>
                            <?php
                                echo '</td>';
                                echo '</tr>';
                            endforeach;
                        ?>
                        </tbody>
                    </table>
                    
<?php   } ?>                    
                </div>
                <!-- /.panel-body -->
            </div>

        </div>
    
    </div>

</div>