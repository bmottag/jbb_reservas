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
	public function admin($tipoVisita)
	{			
			$data['tipoVisita'] = $tipoVisita;
			$arrParam = array(
				'from' => date('Y-m-d'),
				'tipoVisita' => $tipoVisita
			);
			$data['infoHorarios'] = $this->general_model->get_horario_info($arrParam);

			$arrParam = array(
				'fecha' => date('Y-m-d'),
				'tipoVisita' => $tipoVisita
			);			
			$data['listaReservas'] = $this->general_model->get_info_reservas($arrParam);

			//numero de visitantes para el dia de HOY
			$data['noVisitantesHOY'] = $data['listaReservas']?count($data['listaReservas']):0;

			//calculo numero de visitantes para la semana presente
			if (date('D')=='Mon'){
			     $lunes = date('Y-m-d');
			} else {
			     $lunes = date('Y-m-d', strtotime('last Monday', time()));
			}
			 
			$domingo = strtotime('next Sunday', time());
 			$domingo = date('Y-m-d', $domingo);
 			//le sumo un dia al dia final para que ingrese ese dia en la consulta
			$domingo = date('Y-m-d',strtotime ( '+1 day ' , strtotime ($domingo)));

			$arrParam = array(
				'from' => $lunes,
				'to' => $domingo,
				'tipoVisita' => $tipoVisita
			);
			$data['listaReservasSEMANA'] = $this->general_model->get_info_reservas($arrParam);
			$data['noVisitantesSEMANA'] = $data['listaReservasSEMANA']?count($data['listaReservasSEMANA']):0;

			//calculo numero de visitantes para el MES presente
			$month_start = strtotime('first day of this month', time());
			$month_start = date('Y-m-d', $month_start);
			$month_end = strtotime('last day of this month', time());
			$month_end = date('Y-m-d', $month_end);
 			//le sumo un dia al dia final para que ingrese ese dia en la consulta
			$month_end = date('Y-m-d',strtotime ( '+1 day ' , strtotime ($month_end)));

			$arrParam = array(
				'from' => $month_start,
				'to' => $month_end,
				'tipoVisita' => $tipoVisita
			);
			$data['listaReservasMES'] = $this->general_model->get_info_reservas($arrParam);
			$data['noVisitantesMES'] = $data['listaReservasMES']?count($data['listaReservasMES']):0;

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
			$data["tipoVisita"] = $this->input->post("tipoVisita");	
			$this->load->view('buscar_modal', $data);
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

			$data['fecha'] = $this->input->post('date');
			$data["tipoVisita"] = $this->input->post("tipoVisita");	
			$arrParam = array(
				'fecha' => $data['fecha'],
				'tipoVisita' => $data['tipoVisita']
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
			$data["tipoVisita"] = $this->input->post("tipoVisita");		
			$this->load->view('buscar_rango_modal', $data);
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
			$data["tipoVisita"] = $this->input->post("tipoVisita");	

			$from = formatear_fecha($data['from']);
			//le sumo un dia al dia final para que ingrese ese dia en la consulta
			$to = date('Y-m-d',strtotime ( '+1 day ' , strtotime ( formatear_fecha($data['to']) ) ) );

			$arrParam = array(
				'from' => $from,
				'to' => $to,
				'tipoVisita' => $data['tipoVisita']
			);
			$data['listaReservas'] = $this->general_model->get_info_reservas($arrParam);

			$data["view"] ='lista_reservas_fecha';
			$this->load->view("layout_calendar", $data);
	}
	
	
	
}