<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Ciudadano_model extends CI_Model {
		
		/**
		 * Guardar la informacion de la reserva
		 * @since 13/2/2021
		 */
		public function guardarReserva($pass) 
		{
				$email = trim($this->security->xss_clean($this->input->post('email')));
				$fecha = trim($this->security->xss_clean($this->input->post('fecha')));
				$celular = trim($this->security->xss_clean($this->input->post('celular')));
				$nombreCompleto = trim($this->security->xss_clean($this->input->post('name')));
				$numeroDocumento = trim($this->security->xss_clean($this->input->post('numeroDocumento')));
				$localidad = trim($this->security->xss_clean($this->input->post('localidad')));


				$data = array(
					'fk_id_horario' => $this->input->post('hddIdHorario'),
					'correo_electronico' => $email,
					'numero_contacto' => $celular,
					'numero_cupos_usados' => 1,
					'nombre_completo' => $nombreCompleto,
					'numero_documento' => $numeroDocumento,
					'localidad' => $localidad
				);

				$query = $this->db->insert('reservas_ciudadanos', $data);
				$idReserva = $this->db->insert_id();

				//actualizo la url del codigo QR
				$path = $pass . $idReserva;
				$rutaQRcode = "images/reservas/QR/" . $path . "_qr_code.png";
		
				//actualizo campo con el path encriptado
				$sql = "UPDATE reservas_ciudadanos SET qr_code_llave = '$path', qr_code_img = '$rutaQRcode' WHERE id_reserva_ciudadanos = $idReserva";
				$query = $this->db->query($sql);
			
				if ($query) {
					return $idReserva;
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
				
				$this->db->where('id_horario_ciudadano',  $arrData['idHorario']);
				$query = $this->db->update('horarios_ciudadano', $data);
				
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