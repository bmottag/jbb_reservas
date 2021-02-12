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
					echo  '{
						      "title": "W.O. #: ' . $data['id_workorder'] . ' - Job Code/Name: ' . $data['job_description'] . '",
						      "start": "' . $data['date'] . '",
						      "end": "' . $data['date'] . '",
						      "color": "green",
						      "url": "' . base_url("dashboard/info_by_day/" . $data['date']) . '"
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