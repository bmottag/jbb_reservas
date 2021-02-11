<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("dashboard_model");
    }
		
	/**
	 * SUPER ADMIN DASHBOARD
	 */
	public function admin()
	{				
			$data = array();
			$arrParam = array();

			//filtrar por estado y fecha, para el cuadro de notificaciones
			$year = date('Y');
			$firstDay = date('Y-m-d', mktime(0,0,0, 1, 1, $year));//primer dia del año, para filtrar por año

			$arrParam['from'] = $firstDay;//filtro registros desde el primeri dia del año
			$arrParam['estado'] = 1;
			$data['infoOrdenesTrabajo'] = $this->general_model->get_orden_trabajo($arrParam);
			$data['noOrdenesTrabajo'] = $data['infoOrdenesTrabajo']?count($data['infoOrdenesTrabajo']):0;

			$arrParam['estadoMantenimiento'] = 1;
			$data['infoMantenimientoCorrectivo'] = $this->general_model->get_mantenimiento_correctivo($arrParam);

			$data['asignadas'] = $this->general_model->get_orden_trabajo($arrParam);
			$data['asignadas'] = $data['asignadas']?count($data['asignadas']):0;

			$arrParam['estado'] = 2;
			$data['solucionadas'] = $this->general_model->get_orden_trabajo($arrParam);
			$data['solucionadas'] = $data['solucionadas']?count($data['solucionadas']):0;

			$arrParam['estado'] = 3;
			$data['canceladas'] = $this->general_model->get_orden_trabajo($arrParam);
			$data['canceladas'] = $data['canceladas']?count($data['canceladas']):0;

			//Tipo -> vehiculos
			$arrParam = array(
				"idTipoEquipo" => 1,
				"estadoEquipo" => 1
			);
			$infoVehiculos = $this->general_model->get_equipos_info($arrParam);//info de vehiculos
			$data['noVehiculos'] = $infoVehiculos?count($infoVehiculos):0;

			//Tipo -> Bombas
			$arrParam = array(
				"idTipoEquipo" => 2,
				"estadoEquipo" => 1
			);
			$infoBombas = $this->general_model->get_equipos_info($arrParam);//info de bombas
			$data['noBombas'] = $infoBombas?count($infoBombas):0;
			
			$data["view"] = "dashboard";
			$this->load->view("layout", $data);
	}
	
	/**
	 * Informacion de los roles
     * @since 1/12/2020
     * @author BMOTTAG
	 */
	public function rol_info()
	{		
			$data["view"] ='rol_info';
			$this->load->view("layout", $data);
	}

	/**
	 * Calendario
     * @since 6/1/2021
     * @author BMOTTAG
	 */
	public function calendar()
	{
			$data["view"] = 'calendar';
			$this->load->view("layout", $data);
	}

	/**
	 * Consulta desde el calendario
     * @since 6/1/2021
     * @author BMOTTAG
	 */
    public function consulta() 
    {
	        header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos

			$start = $this->input->post('start');
			$end = $this->input->post('end');
			$start = substr($start,0,10);
			$end = substr($end,0,10);

			$arrParam = array(
				"from" => $start,
				"to" => $end
			);
			
			//informacion Work Order
			$polizas = $this->general_model->get_polizas($arrParam);

			echo  '[';

			if($polizas)
			{
				$longitud = count($polizas);
				$i=1;
				foreach ($polizas as $data):
					echo  '{
						      "title": "Póliza a vencerse #: ' . $data['numero_poliza'] . ' - Equipo No. Inventario: ' . $data['numero_inventario'] . '",
						      "start": "' . $data['fecha_vencimiento'] . '",
						      "end": "' . $data['fecha_vencimiento'] . '",
						      "color": "green",
						      "url": "' . base_url("equipos/detalle/" . $data['id_equipo']) . '"
						    }';

					if($i<$longitud){
							echo ',';
					}
					$i++;
				endforeach;
			}

			echo  ']';

    }
	
	
}