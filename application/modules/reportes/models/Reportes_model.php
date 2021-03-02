<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Reportes_model extends CI_Model {
	    
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
				if (array_key_exists("estado", $arrData)) {
					$this->db->where('P.estado', $arrData["estado"]);
				}
				if (array_key_exists("from", $arrData) && $arrData["from"] != '') {
					$this->db->where('H.hora_inicial >=', $arrData["from"]);
				}				
				if (array_key_exists("to", $arrData) && $arrData["to"] != '' && $arrData["from"] != '') {
					$this->db->where('H.hora_inicial <', $arrData["to"]);
				}
				$this->db->order_by('H.id_horario', 'desc');

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

				if (array_key_exists("idReserva ", $arrData)) {
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
		 * Consulta lista de horarios
		 * @since 12/2/2021
		 */
		public function get_info_reservas($arrData)
		{
				$this->db->select('H.hora_inicial, H.hora_final, R.correo_electronico, R.numero_contacto, U.nombre_completo');
				$this->db->join('reservas R', 'R.fk_id_horario = H.id_horario', 'INNER');
				$this->db->join('reservas_usuarios U', 'U.fk_id_reserva = R.id_reserva', 'INNER');
				if (array_key_exists("fecha", $arrData) && $arrData["fecha"] != '') {
					$this->db->like('H.hora_inicial', $arrData["fecha"]); 
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