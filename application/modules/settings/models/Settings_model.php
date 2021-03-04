<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Settings_model extends CI_Model {

	    
		/**
		 * Verify if the user already exist by the social insurance number
		 * @author BMOTTAG
		 * @since  8/11/2016
		 * @review 10/12/2020
		 */
		public function verifyUser($arrData) 
		{
				if (array_key_exists("idUser", $arrData)) {
					$this->db->where('id_user !=', $arrData["idUser"]);
				}			

				$this->db->where($arrData["column"], $arrData["value"]);
				$query = $this->db->get("usuarios");

				if ($query->num_rows() >= 1) {
					return true;
				} else{ return false; }
		}
		
		/**
		 * Add/Edit USER
		 * @since 8/11/2016
		 */
		public function saveEmployee() 
		{
				$idUser = $this->input->post('hddId');
				
				$data = array(
					'first_name' => $this->input->post('firstName'),
					'last_name' => $this->input->post('lastName'),
					'log_user' => $this->input->post('user'),
					'movil' => $this->input->post('movilNumber'),
					'email' => $this->input->post('email'),
					'fk_id_user_role' => $this->input->post('id_role')
				);	

				//revisar si es para adicionar o editar
				if ($idUser == '') {
					$data['state'] = 0;//si es para adicionar se coloca estado inicial como usuario nuevo
					$data['password'] = 'e10adc3949ba59abbe56e057f20f883e';//123456
					$query = $this->db->insert('usuarios', $data);
				} else {
					$data['state'] = $this->input->post('state');
					$this->db->where('id_user', $idUser);
					$query = $this->db->update('usuarios', $data);
				}
				if ($query) {
					return true;
				} else {
					return false;
				}
		}
		
	    /**
	     * Reset user´s password
	     * @author BMOTTAG
	     * @since  11/1/2017
	     */
	    public function resetEmployeePassword($idUser)
		{
				$passwd = '123456';
				$passwd = md5($passwd);
				
				$data = array(
					'password' => $passwd,
					'state' => 0
				);

				$this->db->where('id_user', $idUser);
				$query = $this->db->update('usuarios', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
	    }

	    /**
	     * Update user´s password
	     * @author BMOTTAG
	     * @since  8/11/2016
	     */
	    public function updatePassword()
		{
				$idUser = $this->input->post("hddId");
				$newPassword = $this->input->post("inputPassword");
				$passwd = str_replace(array("<",">","[","]","*","^","-","'","="),"",$newPassword); 
				$passwd = md5($passwd);
				
				$data = array(
					'password' => $passwd
				);

				$this->db->where('id_user', $idUser);
				$query = $this->db->update('usuarios', $data);

				if ($query) {
					return true;
				} else {
					return false;
				}
	    }
		
		/**
		 * Add/Edit Horario
		 * @since 16/2/2021
		 */
		public function saveHorarios() 
		{
				$intervalo = $this->input->post('intervalo');
				$fechaInicio = $this->input->post('start_date');
				$fechaFin = $this->input->post('finish_date');
				$horaInicio = $this->input->post('start_hour');
				$horaFin = $this->input->post('finish_hour');

				$date1 = new DateTime($fechaInicio);
				$date2 = new DateTime($fechaFin);
				$diff = $date1->diff($date2);
				$numeroDias = $diff->days + 1;

				switch ($intervalo) {
					case 1:
						//cada 15 min
						$incremento = '+15 minute';
						$numeroHorariosDia = ($horaFin - $horaInicio)*4;
						break;
					case 2:
						//cada 30 min
						$incremento = '+30 minute';
						$numeroHorariosDia = ($horaFin - $horaInicio)*2;
						break;
					case 3:
						//cada 60 min
						$incremento = '+60 minute';
						$numeroHorariosDia = ($horaFin - $horaInicio);
						break;
				}

				$numeroHorariosDia++;

				$fechaInicial = $fechaInicio . ' ' . $horaInicio . ':00:00';
				
				for ($i = 0; $i < $numeroDias; $i++) 
				{
					$date = new DateTime($fechaInicial);
					$date->modify('+' . $i . ' day');
					$horarioInicio = $date->format('Y-m-d H:i:s');

					for ($y = 0; $y < $numeroHorariosDia; $y++)
					{
						$date = new DateTime($horarioInicio);
						$date->modify($incremento);
						$horaFinal = $date->format('Y-m-d H:i:s');

						$data = array(
							'hora_inicial' => $horarioInicio,
							'hora_final' => $horaFinal,
							'numero_cupos' => $this->input->post('numeroCupos'),
							'numero_cupos_restantes' => $this->input->post('numeroCupos'),
							'estado' => 1,
							'disponible' => 1
						);
						$query = $this->db->insert('horarios', $data);

						$horarioInicio = $horaFinal;
					}

				}
			

				if ($query) {
					return true;
				} else {
					return false;
				}
		}

		/**
		 * Actualizar disponibilidad de horarios
		 * @since 3/3/2021
		 */
		public function actualizarDisponibilidadHorarios() 
		{
			//cambiar todos los horarios VIGENTES, que estan Bloqueados por el administrador (3) a DISPONIBLES (1)
			$data['disponible'] = 1;
			$this->db->where('disponible', 3);
			$query = $this->db->update('horarios', $data);
			

			//update states
			$query = 1;
			if ($disponibilidad = $this->input->post('disponibilidad')) {
				$tot = count($disponibilidad);
				for ($i = 0; $i < $tot; $i++) {
					$data['disponible'] = 3;
					$this->db->where('id_horario', $disponibilidad[$i]);
					$query = $this->db->update('horarios', $data);					
				}
			}
			if ($query) {
				return true;
			} else{
				return false;
			}
		}
		
		
		
	    
	}