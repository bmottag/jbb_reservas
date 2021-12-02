<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Visitas_model extends CI_Model {
		
		/**
		 * Guardar la informacion de la reserva
		 * @since 13/2/2021
		 */
		public function guardarReserva($pass) 
		{
				$email = trim($this->security->xss_clean($this->input->post('email')));
				$fecha = trim($this->security->xss_clean($this->input->post('fecha')));
				$celular = trim($this->security->xss_clean($this->input->post('celular')));


				$data = array(
					'fk_id_horario' => $this->input->post('hddIdHorario'),
					'correo_electronico' => $email,
					'numero_contacto' => $celular
				);

				$query = $this->db->insert('reservas', $data);
				$idReserva = $this->db->insert_id();

				//actualizo la url del codigo QR
				$path = $pass . $idReserva;
				$rutaQRcode = "images/reservas/QR/" . $path . "_qr_code.png";
		
				//actualizo campo con el path encriptado
				$sql = "UPDATE reservas SET qr_code_llave = '$path', qr_code_img = '$rutaQRcode' WHERE id_reserva = $idReserva";
				$query = $this->db->query($sql);
			
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
				$eps = $this->input->post('eps');
				$emergencia = $this->input->post('emergencia');

				$numeroCupos=0;
				for($i = 0; $i < count($usuarios); ++$i) {
					$cleanName = trim($this->security->xss_clean($usuarios[$i]));
					$cleaneps = trim($this->security->xss_clean($eps[$i]));
					$cleanemergencia = trim($this->security->xss_clean($emergencia[$i]));					
					if($cleanName!= '')
					{
							$data = array(
								'fk_id_reserva' => $idReserva,
								'nombre_completo' => $cleanName,
								'eps' => $cleaneps,
								'emergencia' => $cleanemergencia
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

		/**
		 * Habilitar o desahilitar horaio
		 * @since 13/2/2021
		 */
		public function habilitarHorario($arrData) 
		{				
				$data = array(
					'disponible' => $arrData['disponibilidad'],
					'fecha_bloqueo' => date("Y-m-d G:i:s")
				);
				
				$this->db->where('id_horario',  $arrData['idHorario']);
				$query = $this->db->update('horarios', $data);
				
				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		/**
		 * Actualizar estado de a reserva
		 * @since 17/2/2021
		 */
		public function deshabilitarReserva($arrData) 
		{				
				$data = array(
					'estado_reserva' => 2,
					'fecha_cancelacion' => date("Y-m-d G:i:s")
				);
				
				$this->db->where('id_reserva',  $arrData['idReserva']);
				$query = $this->db->update('reservas', $data);
				
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		

		
	    
	}