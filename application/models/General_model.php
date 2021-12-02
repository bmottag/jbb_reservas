<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Clase para consultas generales a una tabla
 */
class General_model extends CI_Model {

    /**
     * Consulta BASICA A UNA TABLA
     * @param $TABLA: nombre de la tabla
     * @param $ORDEN: orden por el que se quiere organizar los datos
     * @param $COLUMNA: nombre de la columna en la tabla para realizar un filtro (NO ES OBLIGATORIO)
     * @param $VALOR: valor de la columna para realizar un filtro (NO ES OBLIGATORIO)
     * @since 8/11/2016
     */
    public function get_basic_search($arrData) {
        if ($arrData["id"] != 'x')
            $this->db->where($arrData["column"], $arrData["id"]);
        $this->db->order_by($arrData["order"], "ASC");
        $query = $this->db->get($arrData["table"]);

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else
            return false;
    }
	
	/**
	 * Delete Record
	 * @since 25/5/2017
	 */
	public function deleteRecord($arrDatos) 
	{
			$query = $this->db->delete($arrDatos ["table"], array($arrDatos ["primaryKey"] => $arrDatos ["id"]));
			if ($query) {
				return true;
			} else {
				return false;
			}
	}
	
	/**
	 * Update field in a table
	 * @since 11/12/2016
	 */
	public function updateRecord($arrDatos) {
		$data = array(
			$arrDatos ["column"] => $arrDatos ["value"]
		);
		$this->db->where($arrDatos ["primaryKey"], $arrDatos ["id"]);
		$query = $this->db->update($arrDatos ["table"], $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Lista de menu
	 * Modules: MENU
	 * @since 30/3/2020
	 */
	public function get_menu($arrData) 
	{		
		if (array_key_exists("idMenu", $arrData)) {
			$this->db->where('id_menu', $arrData["idMenu"]);
		}
		if (array_key_exists("menuType", $arrData)) {
			$this->db->where('menu_type', $arrData["menuType"]);
		}
		if (array_key_exists("menuState", $arrData)) {
			$this->db->where('menu_state', $arrData["menuState"]);
		}
		if (array_key_exists("columnOrder", $arrData)) {
			$this->db->order_by($arrData["columnOrder"], 'asc');
		}else{
			$this->db->order_by('menu_order', 'asc');
		}
		
		$query = $this->db->get('param_menu');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}	

	/**
	 * Lista de roles
	 * Modules: ROL
	 * @since 30/3/2020
	 */
	public function get_roles($arrData) 
	{		
		if (array_key_exists("filtro", $arrData)) {
			$this->db->where('id_role !=', 99);
		}
		if (array_key_exists("idRole", $arrData)) {
			$this->db->where('id_role', $arrData["idRole"]);
		}
		
		$this->db->order_by('role_name', 'asc');
		$query = $this->db->get('param_role');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}
	
	/**
	 * User list
	 * @since 30/3/2020
	 */
	public function get_user($arrData) 
	{			
		$this->db->select();
		$this->db->join('param_role R', 'R.id_role = U.fk_id_user_role', 'INNER');
		if (array_key_exists("state", $arrData)) {
			$this->db->where('U.state', $arrData["state"]);
		}
		
		//list without inactive users
		if (array_key_exists("filtroState", $arrData)) {
			$this->db->where('U.state !=', 2);
		}
		
		if (array_key_exists("idUser", $arrData)) {
			$this->db->where('U.id_user', $arrData["idUser"]);
		}
		if (array_key_exists("idRole", $arrData)) {
			$this->db->where('U.fk_id_user_role', $arrData["idRole"]);
		}

		$this->db->order_by("first_name, last_name", "ASC");
		$query = $this->db->get("usuarios U");

		if ($query->num_rows() >= 1) {
			return $query->result_array();
		} else
			return false;
	}
	
	/**
	 * Lista de enlaces
	 * Modules: MENU
	 * @since 31/3/2020
	 */
	public function get_links($arrData) 
	{		
		$this->db->select();
		$this->db->join('param_menu M', 'M.id_menu = L.fk_id_menu', 'INNER');
		
		if (array_key_exists("idMenu", $arrData)) {
			$this->db->where('fk_id_menu', $arrData["idMenu"]);
		}
		if (array_key_exists("idLink", $arrData)) {
			$this->db->where('id_link', $arrData["idLink"]);
		}
		if (array_key_exists("linkType", $arrData)) {
			$this->db->where('link_type', $arrData["linkType"]);
		}			
		if (array_key_exists("linkState", $arrData)) {
			$this->db->where('link_state', $arrData["linkState"]);
		}
		
		$this->db->order_by('M.menu_order, L.order', 'asc');
		$query = $this->db->get('param_menu_links L');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}
	
	/**
	 * Lista de permisos
	 * Modules: MENU
	 * @since 31/3/2020
	 */
	public function get_role_access($arrData) 
	{		
		$this->db->select('P.id_access, P.fk_id_menu, P.fk_id_link, P.fk_id_role, M.menu_name, M.menu_order, M.menu_type, L.link_name, L.link_url, L.order, L.link_icon, L.link_type, R.role_name, R.style');
		$this->db->join('param_menu M', 'M.id_menu = P.fk_id_menu', 'INNER');
		$this->db->join('param_menu_links L', 'L.id_link = P.fk_id_link', 'LEFT');
		$this->db->join('param_role R', 'R.id_role = P.fk_id_role', 'INNER');
		
		if (array_key_exists("idPermiso", $arrData)) {
			$this->db->where('id_access', $arrData["idPermiso"]);
		}
		if (array_key_exists("idMenu", $arrData)) {
			$this->db->where('P.fk_id_menu', $arrData["idMenu"]);
		}
		if (array_key_exists("idLink", $arrData)) {
			$this->db->where('P.fk_id_link', $arrData["idLink"]);
		}
		if (array_key_exists("idRole", $arrData)) {
			$this->db->where('P.fk_id_role', $arrData["idRole"]);
		}
		if (array_key_exists("menuType", $arrData)) {
			$this->db->where('M.menu_type', $arrData["menuType"]);
		}
		if (array_key_exists("linkState", $arrData)) {
			$this->db->where('L.link_state', $arrData["linkState"]);
		}
		if (array_key_exists("menuURL", $arrData)) {
			$this->db->where('M.menu_url', $arrData["menuURL"]);
		}
		if (array_key_exists("linkURL", $arrData)) {
			$this->db->where('L.link_url', $arrData["linkURL"]);
		}		
		
		$this->db->order_by('M.menu_order, L.order', 'asc');
		$query = $this->db->get('param_menu_access P');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}
	
	/**
	 * menu list for a role
	 * Modules: MENU
	 * @since 2/4/2020
	 */
	public function get_role_menu($arrData) 
	{		
		$this->db->select('distinct(fk_id_menu), menu_url,menu_icon,menu_name,menu_order');
		$this->db->join('param_menu M', 'M.id_menu = P.fk_id_menu', 'INNER');

		if (array_key_exists("idRole", $arrData)) {
			$this->db->where('P.fk_id_role', $arrData["idRole"]);
		}
		if (array_key_exists("menuType", $arrData)) {
			$this->db->where('M.menu_type', $arrData["menuType"]);
		}
		if (array_key_exists("menuState", $arrData)) {
			$this->db->where('M.menu_state', $arrData["menuState"]);
		}
					
		//$this->db->group_by("P.fk_id_menu"); 
		$this->db->order_by('M.menu_order', 'asc');
		$query = $this->db->get('param_menu_access P');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

		/**
		 * Consulta lista de horarios
		 * @since 12/2/2021
		 */
		public function get_horario_info($arrData)
		{
				$this->db->select();
				if (array_key_exists("idHorario", $arrData)) {
					$this->db->where('H.id_horario', $arrData["idHorario"]);
				}
				if (array_key_exists("disponible", $arrData)) {
					$this->db->where('H.disponible', $arrData["disponible"]);
				}
				if (array_key_exists("bloqueados", $arrData) && $arrData["bloqueados"] != '') {
					$this->db->where('H.disponible !=', 3);
				}
				if (array_key_exists("from", $arrData) && $arrData["from"] != '') {
					$this->db->where('H.hora_inicial >=', $arrData["from"]);
				}				
				if (array_key_exists("to", $arrData) && $arrData["to"] != '' && $arrData["from"] != '') {
					$this->db->where('H.hora_inicial <', $arrData["to"]);
				}
				if (array_key_exists("fecha", $arrData) && $arrData["fecha"] != '') {
					$this->db->like('H.hora_inicial', $arrData["fecha"]); 
				}
				if (array_key_exists("tipoVisita", $arrData) && $arrData["tipoVisita"] != '') {
					$this->db->like('H.tipo_visita', $arrData["tipoVisita"]); 
				}

				$this->db->order_by('H.id_horario', 'asc');

				$query = $this->db->get('horarios H');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

		/**
		 * Consultar registros de reservas
		 * @since 15/2/2021
		 */
		public function get_reserva_info($arrData)
		{
				$this->db->select();
				$this->db->join('reservas_usuarios U', 'U.fk_id_reserva = R.id_reserva', 'INNER');

				if (array_key_exists("idReserva", $arrData)) {
					$this->db->where('R.id_reserva ', $arrData["idReserva"]);
				}
				if (array_key_exists("idHorario", $arrData)) {
					$this->db->where('R.fk_id_horario', $arrData["idHorario"]);
				}
				if (array_key_exists("estadoReserva", $arrData)) {
					$this->db->where('R.estado_reserva', $arrData["estadoReserva"]);
				}
				if (array_key_exists("llave", $arrData)) {
					$this->db->where('R.qr_code_llave', $arrData["llave"]);
				}

				$this->db->order_by('R.id_reserva', 'asc');

				$query = $this->db->get('reservas R');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

		/**
		 * Consultar registros de reservas
		 * @since 17/2/2021
		 */
		public function get_reserva($arrData)
		{
				$this->db->select();
				$this->db->join('horarios H', 'H.id_horario = R.fk_id_horario', 'INNER');

				if (array_key_exists("idReserva ", $arrData)) {
					$this->db->where('R.id_reserva ', $arrData["idReserva"]);
				}
				if (array_key_exists("llave", $arrData)) {
					$this->db->where('R.qr_code_llave', $arrData["llave"]);
				}
				if (array_key_exists("email", $arrData)) {
					$this->db->where('R.correo_electronico', $arrData["email"]);
				}
				if (array_key_exists("fecha", $arrData)) {
					$this->db->like('H.hora_inicial', $arrData["fecha"]); 
				}
				if (array_key_exists("estadoReserva", $arrData)) {
					$this->db->where('R.estado_reserva', $arrData["estadoReserva"]); 
				}
				if (array_key_exists("celular", $arrData)) {
					$this->db->where('R.numero_contacto', $arrData["celular"]);
				}

				$this->db->order_by('R.id_reserva', 'asc');

				$query = $this->db->get('reservas R');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

		/**
		 * Consulta lista de horarios
		 * @since 12/2/2021
		 */
		public function get_info_reservas($arrData)
		{
				$this->db->select('H.hora_inicial, H.hora_final, R.correo_electronico, R.numero_contacto, U.nombre_completo');
				$this->db->join('reservas R', 'R.fk_id_horario = H.id_horario', 'INNER');
				$this->db->join('reservas_usuarios U', 'U.fk_id_reserva = R.id_reserva', 'INNER');
				if (array_key_exists('fecha', $arrData) && $arrData['fecha'] != '') {
					$this->db->like('H.hora_inicial', $arrData["fecha"]); 
				}
				if (array_key_exists('from', $arrData) && $arrData['from'] != '') {
					$this->db->where('H.hora_inicial >=', $arrData["from"]);
				}				
				if (array_key_exists('to', $arrData) && $arrData['to'] != '' && $arrData['from'] != '') {
					$this->db->where('H.hora_inicial <', $arrData["to"]);
				}
				$this->db->where('R.estado_reserva', 1); 
				$this->db->order_by('H.hora_inicial', 'asc');

				$query = $this->db->get('horarios H');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}


}