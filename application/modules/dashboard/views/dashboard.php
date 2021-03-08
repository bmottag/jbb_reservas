<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(function(){ 
    $(".btn-primary").click(function () {   
            var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
                url: base_url + 'dashboard/cargarModalBuscar',
                data: {'idLink': oID},
                cache: false,
                success: function (data) {
                    $('#tablaDatos').html(data);
                }
            });
    }); 
});
</script>

<script>
$(function(){ 
    $(".btn-info").click(function () {   
            var oID = $(this).attr("id");
            $.ajax ({
                type: 'POST',
                url: base_url + 'dashboard/cargarModalBuscarRango',
                data: {'idLink': oID},
                cache: false,
                success: function (data) {
                    $('#formRango').html(data);
                }
            });
    }); 
});
</script>

<div id="page-wrapper">
    <div class="row"><br>
		<div class="col-md-12">
			<div class="panel panel-success">
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
        <div class="col-lg-9">
            <div class="panel panel-violeta">
                <div class="panel-heading">

<form  name="form_descarga" id="form_descarga" method="post" action="<?php echo base_url("reportes/generaReservaFechaPDF"); ?>" target="_blank">
    <input type="hidden" class="form-control" id="bandera" name="bandera" value=1 />
    <input type="hidden" class="form-control" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" />
    <i class="fa fa-list-ul"></i> <strong>LISTADO DE RESERVAS </strong> -  <?php echo ucfirst(strftime("%b %d, %G",strtotime(date('Y-m-d')))); ?>

<?php
    if($listaReservas){ 
?>
    <button type="submit" class="btn btn-violeta btn-xs" id="btnSubmit2" name="btnSubmit2" value="1" >
        Descargar Listado PDF <span class="fa fa-file-pdf-o" aria-hidden="true">
    </button>
<?php
    }
?>
</form>
                       
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

<?php
    if(!$listaReservas){ 
?>
        <div class="col-lg-12">
            <small>
                <p class="text-danger"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> No hay registro de visitas para el día de hoy.</p>
            </small>
        </div>
<?php
    }else{
?>                      

                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                        <thead>
                            <tr>
                                <th class='text-center'>Horario</th>
                                <th class='text-center'>Correo Electrónico</th>
                                <th class='text-center'>No. Celular de Contacto</th>
                                <th class='text-center'>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>                         
                        <?php
                            foreach ($listaReservas as $lista):

                                $movil = $lista['numero_contacto'];
                                // Separa en grupos de tres 
                                $count = strlen($movil); 
                                    
                                $num_tlf1 = substr($movil, 0, 3); 
                                $num_tlf2 = substr($movil, 3, 3); 
                                $num_tlf3 = substr($movil, 6, 2); 
                                $num_tlf4 = substr($movil, -2); 

                                if($count == 10){
                                    $resultado = "$num_tlf1 $num_tlf2 $num_tlf3 $num_tlf4";  
                                }else{
                                    $resultado = chunk_split($movil,3," "); 
                                }

                                    echo '<tr>';
                                    echo '<td class="text-center">';
                                    echo ucfirst(strftime("%I:%M",strtotime($lista['hora_inicial'])));
                                    echo ' - ';
                                    echo ucfirst(strftime("%I:%M %p",strtotime($lista['hora_final'])));
                                    echo '</td>';
                                    echo '<td>' . $lista['correo_electronico'] . '</td>';
                                    echo '<td class="text-center">' . $resultado . '</td>';
                                    echo '<td>' . $lista['nombre_completo'] . '</td>';
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

        <div class="col-lg-3">
            <div class="panel panel-violeta">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> VISITAS
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item" disabled>
                            <p class="text-info"><i class="fa fa-tag fa-fw"></i><strong> No. Visitas Hoy</strong>
                                <span class="pull-right text-muted small"><em><?php echo $noVisitantesHOY; ?></em>
                                </span>
                            </p>
                        </a>

                        <a href="#" class="list-group-item" disabled>
                            <p class="text-success"><i class="fa fa-tag  fa-fw"></i><strong> No. Visitas esta Semana</strong>
                                <span class="pull-right text-muted small"><em><?php echo $noVisitantesSEMANA; ?></em>
                                </span>
                            </p>
                        </a>

                        <a href="#" class="list-group-item" disabled>
                            <p class="text-danger"><i class="fa fa-tag  fa-fw"></i><strong> No. Visitas este Mes</strong>
                                <span class="pull-right text-muted small"><em><?php echo $noVisitantesMES; ?></em>
                                </span>
                            </p>
                        </a>

                    </div>
                    <!-- /.list-group -->

                    <div class="list-group">
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal" id="x">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar Reservas por Fecha
                        </button>

                        <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#modalRango" id="y">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar Reservas por Rango
                        </button>
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

        </div>
        <!-- /.col-lg-4 -->
    </div>

    <!-- /.row -->
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-thumb-tack fa-fw"></i> <strong>HORARIOS VIGENTES</strong>
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
                                <th class='text-center'>No. Cupos</th>
                                <th class='text-center'>No. Cupos Disponibles</th>
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

<!--INICIO Modal Buscar por fecha -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="tablaDatos">

        </div>
    </div>
</div>                       
<!--FIN Modal Buscar por fecha -->

<!--INICIO Modal Buscar por fecha -->
<div class="modal fade text-center" id="modalRango" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="formRango">

        </div>
    </div>
</div>                       
<!--FIN Modal Buscar por fecha -->