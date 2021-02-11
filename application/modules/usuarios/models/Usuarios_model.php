<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Usuarios_model extends CI_Model {

	    function __construct(){        
	        parent::__construct();
	    }
	    
	    /**
	     * Actualizar contraseña usuario
	     * @author BMOTTAG
	     * @since  30/11/2020
	     */
	    public function updatePassword()
		{
				$idUser = $this->input->post("hddId");
				$newPassword = $this->input->post("inputPassword");
				$passwd = str_replace(array("<",">","[","]","*","^","-","'","="),"",$newPassword); 
				$passwd = md5($passwd);
				
				$data = array(
					'password' => $passwd,
					'state' => 1
				);

				$this->db->where('id_user', $idUser);
				$query = $this->db->update('usuarios', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
	    }
	    


		
		
		
		
		
		
		
		
		
		
		
	    
	}