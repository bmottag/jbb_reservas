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
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-briefcase fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $noOrdenesTrabajo; ?></div>
                            <div>Ordenes de Trabajo Asignadas</div>
                        </div>
                    </div>
                </div>
				
                <a href="#anclaOT">
                    <div class="panel-footer">
                        <span class="pull-left">Últimos registros</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
		
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-car fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $noVehiculos; ?></div>
                            <div>Vehículos</div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <form  name="formBuscarVehiculos" id="formBuscarVehiculos" method="post" action="<?php echo base_url("equipos"); ?>">
                        <input type="hidden" id="id_tipo_equipo" name="id_tipo_equipo" class="form-control" value="1" placeholder="Número Inventario Entidad" >
                            <button type="submit" class="btn btn-link btn-xs" id='btnBuscar' name='btnBuscar'>
                                    <span class="pull-right"> Ver registros <i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                            </button>
                    </form>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-bomb fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $noBombas; ?></div>
                            <div>Bombas</div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <form  name="formBuscarVehiculos" id="formBuscarVehiculos" method="post" action="<?php echo base_url("equipos"); ?>">
                        <input type="hidden" id="id_tipo_equipo" name="id_tipo_equipo" class="form-control" value="2" placeholder="Número Inventario Entidad" >
                            <button type="submit" class="btn btn-link btn-xs" id='btnBuscar' name='btnBuscar'>
                                    <span class="pull-right"> Ver registros <i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                            </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-truck fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">0</div>
                            <div>Maquinas</div>
                        </div>
                    </div>
                </div>

                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">NO HAY REGISTROS </span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

	</div>

    <!-- /.row -->
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-wrench fa-fw"></i> Lista Mantenimiento Correctivo <strong>Nuevas - <?php echo date("Y"); ?></strong>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

<?php
    if(!$infoMantenimientoCorrectivo){ 
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
                                <th class='text-center'>Fecha Registro</th>
                                <th class='text-center'>Descripción Falla</th>
                                <th class='text-center'>Requerimiento</th>
                                <th class='text-center'>Usuario</th>
                                <th class='text-center'>Ver</th>
                            </tr>
                        </thead>
                        <tbody>                         
                        <?php
                            foreach ($infoMantenimientoCorrectivo as $lista):
                                echo "<tr>";
                                echo "<td class='text-center'>";
                                echo $lista['fecha']; 
                                echo "</td>";
                                echo "<td>" . $lista['descripcion'] . "</td>";
                                echo "<td>" . $lista['consideracion'] . "</td>";
                                echo "<td>" . $lista['name'] . "</td>";
                                echo "<td class='text-center'>";
                                ?>
                                <a href="<?php echo base_url("mantenimiento/correctivo/" . $lista['fk_id_equipo_correctivo']); ?>" class="btn btn-success btn-xs">Ver <span class="glyphicon glyphicon-edit" aria-hidden="true"></a>
                                <?php
                                echo "</td>";
                                echo "</tr>";
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

    <!-- /.row -->
    <div class="row">
<a name="anclaOT" ></a>
        <div class="col-lg-9">
            <div class="panel panel-violeta">
                <div class="panel-heading">
                    <i class="fa fa-briefcase fa-fw"></i> Ordenes de Trabajo <strong>Asignadas - <?php echo date("Y"); ?></strong>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

<?php
    if(!$infoOrdenesTrabajo){ 
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
                                <th class='text-center'>No. OT</th>
                                <th class='text-center'>Fecha Asignación</th>
                                <th class='text-center'>Encargado</th>
                                <th class='text-center'>Tipo Mantenimiento</th>
                                <th class='text-center'>Información Adicional</th>
                                <th class='text-center'>Ver</th>
                            </tr>
                        </thead>
                        <tbody>                         
                        <?php
                            foreach ($infoOrdenesTrabajo as $lista):
                                echo "<tr>";
                                echo "<td class='text-center'>" . $lista['id_orden_trabajo'] . "</td>";
                                echo "<td class='text-center'>" . ucfirst(strftime("%b %d, %G",strtotime($lista['fecha_asignacion']))) . "</td>";
                                echo "<td >" . $lista['encargado'] . "</td>";
                                echo "<td class='text-center'>";
                                switch ($lista['tipo_mantenimiento']) {
                                    case 1:
                                        $valor = 'Correctivo';
                                        $clase = "text-danger";
                                        break;
                                    case 2:
                                        $valor = 'Preventivo';
                                        $clase = "text-info";
                                        break;
                                }
                                echo '<p class="' . $clase . '"><strong>' . $valor . '</strong></p>';
                                echo "</td>";
                                echo "<td>" . $lista['informacion_adicional'] . "</td>";
                                echo "<td class='text-center'>";
                                ?>
                                <a href="<?php echo base_url("ordentrabajo/ver_orden/" . $lista['id_orden_trabajo']); ?>" class="btn btn-success btn-xs">Ver OT <span class="glyphicon glyphicon-edit" aria-hidden="true"></a>
                                <?php
                                echo "</td>";
                                echo "</tr>";
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
                    <i class="fa fa-bell fa-fw"></i> OT - <?php echo date("Y"); ?>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        <?php 
                            $enlace = '#';
                            $enlace2 = '#';
                            $enlace3 = '#';
                            if($asignadas){
                                $enlace = base_url("ordentrabajo/orden_estado/1/" . date("Y"));
                            }
                            if($solucionadas){
                                $enlace2 = base_url("ordentrabajo/orden_estado/2/" . date("Y"));
                            }
                            if($canceladas){
                                $enlace3 = base_url("ordentrabajo/orden_estado/3/" . date("Y"));
                            }
                        ?>
                        <a href="<?php echo $enlace; ?>" class="list-group-item" disabled>
                            <p class="text-info"><i class="fa fa-thumb-tack fa-fw"></i><strong> Asignadas</strong>
                                <span class="pull-right text-muted small"><em><?php echo $asignadas; ?></em>
                                </span>
                            </p>
                        </a>

                        <a href="<?php echo $enlace2; ?>" class="list-group-item">
                            <p class="text-success"><i class="fa fa-check fa-fw"></i><strong> Solucionadas</strong>
                                <span class="pull-right text-muted small"><em><?php echo $solucionadas; ?></em>
                                </span>
                            </p>
                        </a>
                        <a href="<?php echo $enlace3; ?>" class="list-group-item">
                            <p class="text-danger"><i class="fa fa-times fa-fw"></i><strong> Canceladas</strong>
                                <span class="pull-right text-muted small"><em><?php echo $canceladas; ?></em>
                                </span>
                            </p>
                        </a>

                    </div>
                    <!-- /.list-group -->

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

        </div>
        <!-- /.col-lg-4 -->
    
    </div>

</div>