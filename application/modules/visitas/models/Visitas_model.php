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

				$localidad = $this->input->post('localidad');
				$tipoDocumento = $this->input->post('tipoDocumento');
				$numeroDocumento = $this->input->post('numeroDocumento');
				$genero = $this->input->post('genero');
				$grupoEtnico = $this->input->post('grupoEtnico');
				$rangoEdad = $this->input->post('rangoEdad');
				$nivelEducativo = $this->input->post('nivelEducativo');
				$objetivoVisita = $this->input->post('objetivoVisita');

				$numeroCupos=0;
				for($i = 0; $i < count($usuarios); ++$i) {
					$cleanName = trim($this->security->xss_clean($usuarios[$i]));
					$cleaneps = trim($this->security->xss_clean($eps[$i]));
					$cleanemergencia = trim($this->security->xss_clean($emergencia[$i]));	
					$fk_id_localidad = trim($this->security->xss_clean($localidad[$i]));
					$tipo_documento = trim($this->security->xss_clean($tipoDocumento[$i]));
					$numero_documento = trim($this->security->xss_clean($numeroDocumento[$i]));
					$fk_id_genero = trim($this->security->xss_clean($genero[$i]));
					$fk_id_grupo_etnico = trim($this->security->xss_clean($grupoEtnico[$i]));
					$fk_id_rango_edad = trim($this->security->xss_clean($rangoEdad[$i]));
					$fk_id_nivel_educativo = trim($this->security->xss_clean($nivelEducativo[$i]));					
					$fk_id_objetivo_visita = trim($this->security->xss_clean($objetivoVisita[$i]));

					if($cleanName!= '')
					{
							$data = array(
								'fk_id_reserva' => $idReserva,
								'nombre_completo' => $cleanName,
								'eps' => $cleaneps,
								'emergencia' => $cleanemergencia,
								'fk_id_localidad' => $fk_id_localidad,
								'tipo_documento' => $tipo_documento,
								'numero_documento' => $numero_documento,
								'fk_id_genero' => $fk_id_genero,
								'fk_id_grupo_etnico' => $fk_id_grupo_etnico,
								'fk_id_rango_edad' => $fk_id_rango_edad,
								'fk_id_nivel_educativo' => $fk_id_nivel_educativo,
								'fk_id_objetivo_visita' => $fk_id_objetivo_visita
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