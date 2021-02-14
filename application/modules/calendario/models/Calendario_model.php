<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Calendario_model extends CI_Model {
		
		/**
		 * Guardar la informacion de la reserva
		 * @since 13/2/2021
		 */
		public function guardarReserva() 
		{
				$data = array(
					'fk_id_horario' => $this->input->post('hddIdHorario'),
					'correo_electronico' => $this->input->post('email'),
					'numero_contacto' => $this->input->post('celular')
				);

				$query = $this->db->insert('reservas', $data);
				$idReserva = $this->db->insert_id();
			
				if ($query) {
					return $idReserva;
				} else {
					return false;
				}
		}

		/**
		 * Guardar usuarios
		 * @since 13/2/2021
		 */
		public function guardarUsuarios($idReserva) 
		{
				$usuarios = $this->input->post('name');

				$numeroCupos=0;
				foreach ($usuarios as $valor) 
				{
					$cleanName = trim($this->security->xss_clean($valor));

					if($cleanName!= '')
					{
							$data = array(
								'fk_id_reserva' => $idReserva,
								'nombre_completo' => $cleanName
							);
							$query = $this->db->insert('reservas_usuarios', $data);
							$numeroCupos++;
					}
				}

				if ($query) {
					return $numeroCupos;
				} else {
					return false;
				}
		}

		/**
		 * Actualizar el numero de cupos de la reserva
		 * @since 13/2/2021
		 */
		public function actualizarReserva($arrData) 
		{				
				$data = array(
					'numero_cupos_usados' => $arrData['numeroCupos']
				);
				
				$this->db->where('id_reserva',  $arrData['idReserva']);
				$query = $this->db->update('reservas', $data);
				
				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		/**
		 * Actualizar el numero de cupos restante del horario
		 * @since 13/2/2021
		 */
		public function actualizarHorarios($arrData) 
		{				
				$data = array(
					'numero_cupos_restantes' => $arrData['NumeroCuposRestantes'],
					'estado' => $arrData['estado'],
					'disponible' => $arrData['disponibilidad']
				);
				
				$this->db->where('id_horario',  $arrData['idHorario']);
				$query = $this->db->update('horarios', $data);
				
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		

		
	    
	}