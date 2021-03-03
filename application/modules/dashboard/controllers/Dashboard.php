<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("dashboard_model");
		$this->load->model("general_model");
    }
		
	/**
	 * SUPER ADMIN DASHBOARD
	 */
	public function admin()
	{				
			$arrParam = array(
				'from' => date('Y-m-d')
			);
			$data['infoHorarios'] = $this->general_model->get_horario_info($arrParam);
			
			$data["view"] = "dashboard";
			$this->load->view("layout_calendar", $data);
	}

	/**
	 * Lista de reservas
     * @since 17/2/2021
     * @author BMOTTAG
	 */
	public function reservas($idHorario)
	{		
			$arrParam = array(
				'idHorario' => $idHorario
			);			
			$data['horarioInfo'] = $this->general_model->get_horario_info($arrParam);

			$data['infoReserva'] = $this->general_model->get_reserva_info($arrParam);

			$data["view"] ='lista_reservas';
			$this->load->view("layout_calendar", $data);
	}

    /**
     * Cargo modal - formulario buscar resercar por fecha
     * @since 1/3/2021
     */
    public function cargarModalBuscar() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
						
			$this->load->view('buscar_modal');
    }

	/**
	 * Lista de reservas
     * @since 1/3/2021
     * @author BMOTTAG
	 */
	public function buscar_reservas()
	{	
			//para identificar en la visda de donde viene
			$data['bandera'] = TRUE;

			$data['fecha'] = $this->input->post('fecha');
			$arrParam = array(
				'fecha' => $data['fecha']
			);			
			$data['listaReservas'] = $this->general_model->get_info_reservas($arrParam);

			$data["view"] ='lista_reservas_fecha';
			$this->load->view("layout_calendar", $data);
	}

    /**
     * Cargo modal - formulario buscar reservas por rango de fechas
     * @since 1/3/2021
     */
    public function cargarModalBuscarRango() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
						
			$this->load->view('buscar_rango_modal');
    }

	/**
	 * Lista de reservas
     * @since 3/3/2021
     * @author BMOTTAG
	 */
	public function buscar_reservas_rango()
	{		
			//para identificar en la visda de donde viene
			$data['bandera'] = FALSE;

			$data['from'] = $this->input->post('from');
			$data['to'] = $this->input->post('to');

			$from = formatear_fecha($data['from']);
			//le sumo un dia al dia final para que ingrese ese dia en la consulta
			$to = date('Y-m-d',strtotime ( '+1 day ' , strtotime ( formatear_fecha($data['to']) ) ) );

			$arrParam = array(
				'from' => $from,
				'to' => $to
			);
			$data['listaReservas'] = $this->general_model->get_info_reservas($arrParam);

			$data["view"] ='lista_reservas_fecha';
			$this->load->view("layout_calendar", $data);
	}
	
	
	
}