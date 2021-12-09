<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home {

    private $ci;
    private $db;

    public function __construct() {
        $this->ci = & get_instance();
        !$this->ci->load->library('session') ? $this->ci->load->library('session') : false;
        !$this->ci->load->helper('url') ? $this->ci->load->helper('url') : false;
        $this->db = $this->ci->load->database("default", true);
    }

    public function check_login() {
        $error = FALSE;
		$flag = TRUE;
        $arrModules = array("login", "ieredirect", "calendario", "visitas", "ciudadano");
        if (!in_array($this->ci->uri->segment(1), $arrModules)) {
            if ($this->ci->uri->segment(1) == "menu") {
                if(($this->ci->uri->segment(2) . '/' . $this->ci->uri->segment(3)) != 'menu/salir') {
                    if (isset($this->ci->session) && $this->ci->session->userdata('id') == FALSE) {
                        $error = TRUE;
                    }
                }
            } else if ($this->ci->uri->segment(1) == "programming") {//SI NO LLEVAN SESSION LOS DEJA PASAR, A LOS SIGUIENTES METODOS
                $arrControllers = array($this->ci->uri->segment(1), "verificacion", "verificacion_flha", "verificacion_tool_box");
                if ($this->ci->uri->segment(2) != FALSE && !in_array($this->ci->uri->segment(2), $arrControllers)) {
                    if (isset($this->ci->session) && $this->ci->session->userdata('id') == FALSE) {
                        $error = TRUE;
                    }
                }
            } else if ($this->ci->uri->segment(1) == "reportes") {
                $arrControllers = array("generaReservaPDF", "generaReservaFechaPDF", "generaReservaFechaXLS", "generaWorkOrderPDF", "generaPayrollPDF", "generaInsectionSpecialPDF", "generaInsectionHeavyPDF", "generaInsectionDailyPDF", "generaHaulingPDF", "generaSafetyPDF");
                if ($this->ci->uri->segment(2) != FALSE && in_array($this->ci->uri->segment(2), $arrControllers)) {
					$flag = FALSE;//NO SE VERIFICA SI EXISTE PERMISOS A ESTE ENLACE
                }
            } else if ($this->ci->uri->segment(1) == "workorders") {
                $arrControllers = array("generaWorkOrderXLS", "generaWorkOrderPDF");
                if ($this->ci->uri->segment(2) != FALSE && in_array($this->ci->uri->segment(2), $arrControllers)) {
					$flag = FALSE;//NO SE VERIFICA SI EXISTE PERMISOS A ESTE ENLACE
                }
            } else {
                if ($this->ci->session->userdata('id') == FALSE) {
                    $error = TRUE;
                }
            }
            
            if ($error == FALSE && $flag) {
                //Se consulta si la ruta actual tiene permiso o no en el sistema
                $this->ci->load->model('general_model', 'mm');
                $ruta_validar = '';
                for ($i = 1; $i <= 5; $i++) {
                    if ($this->ci->uri->segment($i)) {
                        $ruta_validar .= ($i == 1) ? $this->ci->uri->segment($i) : '/' . $this->ci->uri->segment($i);
                    }
                }
                
				//consulto si existe permiso en menu para esa URL
				$arrParam = array(
					'menuURL' => $ruta_validar
				);
                if($ruta_valida = $this->ci->mm->get_role_access($arrParam)) 
				{
                    //Se consulta si el usuario actual tiene permiso para esa URL
                    $arrParam = array(
                        'idRole' => $this->ci->session->userdata('role'),
						'menuURL' => $ruta_validar
                    );

                    if(!$ruta_valida = $this->ci->mm->get_role_access($arrParam)) {
                        $error = TRUE;
                    }
				}else{					
					//consulto si existe permiso para en los enlaces para esa URL
					$arrParam = array(
						'linkURL' => $ruta_validar
					);
					if($ruta_valida = $this->ci->mm->get_role_access($arrParam)) {
						//Se consulta si el usuario actual tiene permiso para esa URL
						$arrParam = array(
							'idRole' => $this->ci->session->userdata('role'),
							'linkURL' => $ruta_validar
						);

						if(!$ruta_valida = $this->ci->mm->get_role_access($arrParam)) 
						{
							$error = TRUE;
						}
					}
				}
            }
        }
        
        if ($error) {
            if (isset($this->ci->session) && $this->ci->session->userdata('id') == FALSE) {
                $this->ci->session->unset_userdata("auth");
                $this->ci->session->sess_destroy();
            }
            redirect(site_url("/menu/menu/salir"));
        }
    }
}
//EOC