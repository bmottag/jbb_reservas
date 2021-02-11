<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class External extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("external_model");
		$this->load->helper('form');
    }
	
	/**
	 * Info equipo
     * @since 22/1/2021
     * @author BMOTTAG
	 */
	public function buscar_equipo()
	{
			$arrParam = array("numero_inventario" => $this->security->xss_clean($this->input->post('numero_inventario')));
			$data['info'] = $this->general_model->get_equipos_info($arrParam);
						
			$data["view"] = 'listado_equipos';
			$this->load->view("layout_calendar", $data);
	}
	


	
	
}