<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendario extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("calendario_model");
		$this->load->helper('form');
    }

	/**
	 * Calendario
     * @since 6/1/2021
     * @author BMOTTAG
	 */
	public function index()
	{
			$data["view"] = 'calendar';
			$this->load->view("layout_calendar", $data);
	}

	/**
	 * Consulta desde el calendario
     * @since 12/2/2021
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
			$horarioInfo = $this->general_model->get_horario_info($arrParam);

			echo  '[';

			if($horarioInfo)
			{
				$longitud = count($horarioInfo);
				$i=1;
				foreach ($horarioInfo as $data):
					
					//revisar disponibilidad y estado
					if($data['disponible'] == 1)
					{
						switch ($data['estado']) {
							case 1:
								$color = 'success';
								break;
							case 2:
								$color = 'yellow';
								break;
						}
					}else{
						$color = 'red';
					}

					echo  '{
							  "id": "' . $data['id_horario'] . '",
						      "title": "# Recorrido: ' . $data['id_horario'] . ' - Cupos disponibles: ' . $data['numero_cupos'] . '",
						      "start": "' . $data['hora_inicial'] . '",
						      "end": "' . $data['hora_final'] . '",
						      "color": "' . $color . '"
						    }';

					if($i<$longitud){
							echo ',';
					}
					$i++;
				endforeach;
			}

			echo  ']';

    }

    /**
     * Cargo modal - formulario reserva
     * @since 12/2/2021
     */
    public function cargarModalReserva() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idHorario"] = $this->input->post("idHorario");

			$arrParam = array(
				"idHorario" => $data["idHorario"]
			);
			$data['information'] = $this->general_model->get_horario_info($arrParam);
			
			$this->load->view("reserva_modal", $data);
    }

	/**
	 * Guardar Reserva
     * @since 12/2/2021
     * @author BMOTTAG
	 */
    public function guardarReserva()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$idHorario = $this->input->post('hddIdHorario');
			$NumeroCuposRestantes = $this->input->post('hddNumeroCuposRestantes');
			$usuarios = $this->input->post('name');
			$primerUsuario = $this->security->xss_clean($usuarios[0]);//limpio el primer valor

			if(empty(trim($primerUsuario)))
			{
					$data["result"] = "error";					
					$data["mensaje"] = " Error. Debe ingresar el nombre completo.";
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> No ingreso nombres');
			}else{
					if ($idReserva = $this->calendario_model->guardarReserva()) 
					{
						$numeroCupos = $this->calendario_model->guardarUsuarios($idReserva);//guardo usuarios

						//guardo numero de cupos
						$arrParam = array(
							'idReserva' => $idReserva,
							'numeroCupos' => $numeroCupos
						);
						$this->calendario_model->actualizarReserva($arrParam);

						//actualizar el numero de cupos restantes en la tabla horarios
						//si cumplio el numero maximo de cupos cambiar estado a cerrado
						$NumeroCuposRestantes = $NumeroCuposRestantes - $numeroCupos;
						$estado = '2'; //En processo
						$disponibilidad = 1;
						if($NumeroCuposRestantes == 0){
							$estado = '3'; //cerrado
							$disponibilidad = 2;
						}
						$arrParam = array(
							'idHorario' => $idHorario,
							'NumeroCuposRestantes' => $NumeroCuposRestantes,
							'estado' => $estado,
							'disponibilidad' => $disponibilidad
						);
						$this->calendario_model->actualizarHorarios($arrParam);

						$data["result"] = true;					
						$this->session->set_flashdata('retornoExito', 'Se guardó la información');
					} else {
						$data["result"] = "error";					
						$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
					}
			}

			echo json_encode($data);
    }
	


	
	
}