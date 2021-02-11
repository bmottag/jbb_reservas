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
		$this->db->select();
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
					
		$this->db->group_by("P.fk_id_menu"); 
		$this->db->order_by('M.menu_order', 'asc');
		$query = $this->db->get('param_menu_access P');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return false;
		}
	}
	
		/**
		 * Consulta lista de equipos
		 * @since 19/11/2020
		 */
		public function get_equipos_info($arrData) 
		{		
				$this->db->select();
				$this->db->join('param_dependencias D', 'D.id_dependencia = A.fk_id_dependencia', 'INNER');
				$this->db->join('param_tipo_equipos T', 'T.id_tipo_equipo = A.fk_id_tipo_equipo', 'INNER');

				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('A.id_equipo', $arrData["idEquipo"]);
				}
				if (array_key_exists("estadoEquipo", $arrData)) {
					$this->db->where('A.estado_equipo', $arrData["estadoEquipo"]);
				}
				if (array_key_exists("encryption", $arrData)) {
					$this->db->where('A.qr_code_encryption ', $arrData["encryption"]);
				}
				if (array_key_exists("idTipoEquipo", $arrData) && $arrData["idTipoEquipo"] != '') {
					$this->db->like('A.fk_id_tipo_equipo', $arrData["idTipoEquipo"]); 
				}
				if (array_key_exists("numero_inventario", $arrData) && $arrData["numero_inventario"] != '') {
					$this->db->like('A.numero_inventario', $arrData["numero_inventario"]); 
				}
				if (array_key_exists("marca", $arrData) && $arrData["marca"] != '') {
					$this->db->like('A.marca', $arrData["marca"]); 
				}
				if (array_key_exists("modelo", $arrData) && $arrData["modelo"] != '') {
					$this->db->like('A.modelo', $arrData["modelo"]); 
				}
				if (array_key_exists("numero_serial", $arrData) && $arrData["numero_serial"] != '') {
					$this->db->like('A.numero_serial', $arrData["numero_serial"]); 
				}

				$this->db->order_by('id_equipo', 'desc');
				
				if (array_key_exists("limit", $arrData)) {
					$query = $this->db->get('equipos A', $arrData["limit"]);
				}else{
					$query = $this->db->get('equipos A');
				}

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Consulta detalles de quipos tipo vehiculos
		 * @since 3/12/2020
		 */
		public function equipos_detalle_vehiculo($arrData) 
		{		
				$this->db->select();				
				$this->db->join('param_clase_vehiculo C', 'C.id_clase_vechiculo = A.fk_id_clase_vechiculo', 'LEFT');
				$this->db->join('param_tipo_carroceria T', 'T.id_tipo_carroceria = A.fk_id_tipo_carroceria', 'LEFT');

				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('A.fk_id_equipo', $arrData["idEquipo"]);
				}
				
				$query = $this->db->get('equipos_detalle_vehiculo A');


				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Consulta detalles de quipos tipo bombas
		 * @since 9/12/2020
		 */
		public function equipos_detalle_bomba($arrData) 
		{		
				$this->db->select();				

				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('A.fk_id_equipo_bomba', $arrData["idEquipo"]);
				}
				
				$query = $this->db->get('equipos_detalle_bomba A');


				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Lista de polizas
		 * Modules: Dashboard 
		 * @since 6/1/2021
		 */
		public function get_polizas($arrData) 
		{		
				$this->db->select();
				$this->db->join('equipos E', 'E.id_equipo = P.fk_id_equipo_poliza ', 'INNER');
				
				if (array_key_exists("from", $arrData) && $arrData["from"] != '') {
					$this->db->where('P.fecha_vencimiento >=', $arrData["from"]);
				}				
				if (array_key_exists("to", $arrData) && $arrData["to"] != '' && $arrData["from"] != '') {
					$this->db->where('P.fecha_vencimiento <', $arrData["to"]);
				}
				
				$this->db->order_by('P.id_equipo_poliza', 'desc');
				$query = $this->db->get('equipos_poliza P');

				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}			
		}

		/**
		 * Lista de fotos por equipo
		 * @since 14/12/2020
		 */
		public function get_fotos_equipos($arrData) 
		{		
				$this->db->select("A.*, CONCAT(first_name, ' ', last_name) name");
				$this->db->join('usuarios U', 'U.id_user = A.fk_id_user_ef', 'INNER');

				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('A.fk_id_equipo_foto', $arrData["idEquipo"]);
				}
				if (array_key_exists("idEquipoFoto", $arrData)) {
					$this->db->where('A.id_equipo_foto', $arrData["idEquipoFoto"]);
				}
				
				$this->db->order_by('A.id_equipo_foto', 'asc');
				$query = $this->db->get('equipos_fotos A');


				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}
		
		/**
		 * Consulta lista de mantenimientos correctivo por equipo
		 * @since 26/1/2021
		 */
		public function get_mantenimiento_correctivo($arrData)
		{
				$this->db->select("C.*, CONCAT(U.first_name, ' ', U.last_name) name");
				$this->db->join('usuarios U', 'C.fk_id_user_correctivo = U.id_user', 'INNER');
				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('C.fk_id_equipo_correctivo', $arrData["idEquipo"]);
				}
				if (array_key_exists("idMantenimiento", $arrData)) {
					$this->db->where('C.id_correctivo', $arrData["idMantenimiento"]);
				}
				if (array_key_exists("filtroFecha", $arrData)) {
					$this->db->where('C.fecha >=', $arrData["filtroFecha"]);
				}
				if (array_key_exists("estadoMantenimiento", $arrData)) {
					$this->db->where('C.estado', $arrData["estadoMantenimiento"]);
				}
				$this->db->order_by('C.id_correctivo', 'desc');
				$query = $this->db->get('mantenimiento_correctivo C');
				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

		/**
		 * Consulta orden de trabajo
		 * @since 27/1/2021
		 */
		public function get_orden_trabajo($arrData)
		{
				$this->db->select("C.*, CONCAT(U.first_name, ' ', U.last_name) name, CONCAT(X.first_name, ' ', X.last_name) encargado");
				$this->db->join('usuarios U', 'U.id_user = C.fk_id_user_orden', 'INNER');
				$this->db->join('usuarios X', 'X.id_user = C.fk_id_user_encargado', 'INNER');
				if (array_key_exists("idOrdenTrabajo", $arrData)) {
					$this->db->where('C.id_orden_trabajo ', $arrData["idOrdenTrabajo"]);
				}
				if (array_key_exists("idMantenimiento", $arrData) && array_key_exists("tipoMantenimiento", $arrData)) {
					$this->db->where('C.fk_id_mantenimiento', $arrData["idMantenimiento"]);
				}
				if (array_key_exists("tipoMantenimiento", $arrData)) {
					$this->db->where('C.tipo_mantenimiento ', $arrData["tipoMantenimiento"]);
				}
				if (array_key_exists("idEquipo", $arrData)) {
					$this->db->where('C.fk_id_equipo_ot', $arrData["idEquipo"]);
				}
				if (array_key_exists("estado", $arrData)) {
					$this->db->where('C.estado_actual', $arrData["estado"]);
				}
				if (array_key_exists("from", $arrData) && $arrData["from"] != '') {
					$this->db->where('C.fecha_asignacion >=', $arrData["from"]);
				}				
				if (array_key_exists("to", $arrData) && $arrData["to"] != '' && $arrData["from"] != '') {
					$this->db->where('C.fecha_asignacion <=', $arrData["to"]);
				}

				$this->db->order_by('C.id_orden_trabajo', 'desc');
				$query = $this->db->get('orden_trabajo C');
				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

		/**
		 * Consulta estado orden de trabajo
		 * @since 29/1/2021
		 */
		public function get_estado_orden_trabajo($arrData)
		{
				$this->db->select("C.*, CONCAT(U.first_name, ' ', U.last_name) name");
				$this->db->join('usuarios U', 'U.id_user = C.fk_id_user_ote', 'INNER');
				if (array_key_exists("idOrdenTrabajoEstado", $arrData)) {
					$this->db->where('C.id_orden_trabajo_estado', $arrData["idOrdenTrabajoEstado"]);
				}
				if (array_key_exists("idOrdenTrabajo", $arrData)) {
					$this->db->where('C.fk_id_orden_trabajo_estado', $arrData["idOrdenTrabajo"]);
				}

				$this->db->order_by('C.id_orden_trabajo_estado', 'desc');
				$query = $this->db->get('orden_trabajo_estado C');
				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}

		/**
		 * Consulta lista de mantenimientos preventivos
		 * @since 1/2/2021
		 */
		public function get_mantenimiento_preventivo($arrData)
		{
				$this->db->select("P.*, T.tipo_equipo, CONCAT(U.first_name, ' ', U.last_name) name");
				$this->db->join('usuarios U', 'P.fk_id_user_preventivo = U.id_user', 'INNER');
				$this->db->join('param_tipo_equipos T', 'T.id_tipo_equipo = P.fk_id_tipo_equipo_preventivo', 'INNER');
				if (array_key_exists("idMantenimiento", $arrData)) {
					$this->db->where('P.id_preventivo', $arrData["idMantenimiento"]);
				}
				if (array_key_exists("estado", $arrData)) {
					$this->db->where('P.estado', $arrData["estado"]);
				}
				if (array_key_exists("tipoEquipo", $arrData) && $arrData["tipoEquipo"] != '') {
					$this->db->like('P.fk_id_tipo_equipo_preventivo', $arrData["tipoEquipo"]); 
				}
				if (array_key_exists("frecuencia", $arrData) && $arrData["frecuencia"] != '') {
					$this->db->like('P.fk_id_frecuencia', $arrData["frecuencia"]); 
				}
				$this->db->order_by('P.id_preventivo', 'desc');
				if (array_key_exists("limit", $arrData)) {
					$query = $this->db->get('mantenimiento_preventivo P', $arrData["limit"]);
				}else{
					$query = $this->db->get('mantenimiento_preventivo P');
				}
				if ($query->num_rows() > 0) {
					return $query->result_array();
				} else {
					return false;
				}
		}


}