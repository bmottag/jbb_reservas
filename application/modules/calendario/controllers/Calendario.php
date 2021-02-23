<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendario extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("calendario_model");
        $this->load->model("general_model");
		$this->load->helper('form');
    }

	/**
	 * Calendario
     * @since 6/1/2021
     * @author BMOTTAG
	 */
	public function index()
	{
			$data["view"] = 'calendar';
			$this->load->view("layout_calendar", $data);
	}

	/**
	 * Consulta desde el calendario
     * @since 12/2/2021
     * @author BMOTTAG
	 */
    public function consulta() 
    {
	        header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos

			$start = $this->input->post('start');
			$end = $this->input->post('end');
			$start = substr($start,0,10);
			$end = substr($end,0,10);

			//busco horarios bloqueados para revisarlos y desbloquearlos si pasaron los 5 minutos
			$arrParam = array(
				'from' => $start,
				'to' => $end,
				'disponible' => 2
			);
			$horarioBloqueados = $this->general_model->get_horario_info($arrParam);

			$date1 = new DateTime('now');
			if($horarioBloqueados){
				foreach ($horarioBloqueados as $data):
					$date2 = new DateTime($data['fecha_bloqueo']);
					$diff = $date1->diff($date2);
					$numeroMinutos = $diff->i;
					if($numeroMinutos > 5){
							$arrParam = array(
								'idHorario' => $data['id_horario'],
								'NumeroCuposRestantes' => $data['numero_cupos_restantes'],
								'estado' => $data['estado'],
								'disponibilidad' => 1
							);
							$this->calendario_model->actualizarHorarios($arrParam);
					}
				endforeach;
			}

			$arrParam = array(
				'from' => $start,
				'to' => $end
			);
			$horarioInfo = $this->general_model->get_horario_info($arrParam);

			echo  '[';

			if($horarioInfo)
			{
				$longitud = count($horarioInfo);
				$i=1;
				foreach ($horarioInfo as $data):
					
					switch ($data['estado']) {
						case 1:
							$color = '#b1eeb1';
							break;
						case 2:
							$color = '#f7f79a';
							break;
						case 3:
							$color = '#f7c0c0';
							break;
					}

					echo  '{
							  "id": "' . $data['id_horario'] . '",
						      "title": "Cupos disponibles: ' . $data['numero_cupos_restantes'] . '",
						      "start": "' . $data['hora_inicial'] . '",
						      "end": "' . $data['hora_final'] . '",
						      "color": "' . $color . '"
						    }';

					if($i<$longitud){
							echo ',';
					}
					$i++;
				endforeach;
			}

			echo  ']';

    }

    /**
     * Cargo modal - formulario reserva
     * @since 12/2/2021
     */
    public function cargarModalReserva() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos
			
			$data['information'] = FALSE;
			$data["idHorario"] = $this->input->post("idHorario");

			$arrParam = array(
				"idHorario" => $data["idHorario"]
			);
			$data['information'] = $this->general_model->get_horario_info($arrParam);

			if($data['information'][0]['estado'] == 3)
			{
				echo '<br><p><strong>Atención:</strong><br>';
				echo 'Se completo el cupo máximo para este horario, por favor seleccione otro.</p>';
			}elseif($data['information'][0]['disponible'] == 2)
			{
				echo '<br><p><strong>Atención:</strong><br>';
				echo 'Esta fecha esta siendo asignada, por favor seleccione otra.</p>';
			}else{
				//bloquear sala por 5 minutos mientras se realiza la reserva
				$arrParam = array(
					'idHorario' => $data['idHorario'],
					'disponibilidad' => 2
				);
				$this->calendario_model->habilitarHorario($arrParam);

				$this->load->view("reserva_modal", $data);
			}
    }

	/**
	 * Guardar Reserva
     * @since 12/2/2021
     * @author BMOTTAG
	 */
    public function guardarReserva()
	{			
			header('Content-Type: application/json');
			$data = array();

			$pass = $this->generaPass();//clave para colocarle al codigo QR
			
			$idHorario = $this->input->post('hddIdHorario');
			$NumeroCuposRestantes = $this->input->post('hddNumeroCuposRestantes');
			$usuarios = $this->input->post('name');
			$primerUsuario = $this->security->xss_clean($usuarios[0]);//limpio el primer valor

			if(empty(trim($primerUsuario)))
			{
					$data["result"] = "error";					
					$data["mensaje"] = " Error. Debe ingresar el nombre completo.";
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> No ingreso nombres');
			}else{
					if ($idReserva = $this->calendario_model->guardarReserva($pass)) 
					{
						//genero el codigo QR y subo la imagen
						//INCIO - genero imagen con la libreria y la subo 
						$this->load->library('ciqrcode');

						$data['idRecord'] = $llave = $pass . $idReserva;
						$valorQRcode = base_url("calendario/registro/" . $llave);
						$rutaImagen = "images/reservas/QR/" . $llave . "_qr_code.png";
						
						$params['data'] = $valorQRcode;
						$params['level'] = 'H';
						$params['size'] = 10;
						$params['savename'] = FCPATH.$rutaImagen;
										
						$this->ciqrcode->generate($params);
						//FIN - genero imagen con la libreria y la subo

						$numeroCupos = $this->calendario_model->guardarUsuarios($idReserva);//guardo usuarios

						//guardo numero de cupos
						$arrParam = array(
							'idReserva' => $idReserva,
							'numeroCupos' => $numeroCupos
						);
						$this->calendario_model->actualizarReserva($arrParam);

						//actualizar el numero de cupos restantes en la tabla horarios
						//si cumplio el numero maximo de cupos cambiar estado a cerrado
						$NumeroCuposRestantes = $NumeroCuposRestantes - $numeroCupos;
						$estado = '2'; //En processo
						$disponibilidad = 1;
						if($NumeroCuposRestantes == 0){
							$estado = '3'; //cerrado
						}
						$arrParam = array(
							'idHorario' => $idHorario,
							'NumeroCuposRestantes' => $NumeroCuposRestantes,
							'estado' => $estado,
							'disponibilidad' => $disponibilidad
						);
						$this->calendario_model->actualizarHorarios($arrParam);

						$data["result"] = true;					
						$this->session->set_flashdata('retornoExito', 'Se guardó la información');
					} else {
						$data["result"] = "error";					
						$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
					}
			}

			echo json_encode($data);
    }
	
	public function generaPass()
	{
			//Se define una cadena de caractares. Te recomiendo que uses esta.
			$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
			//Obtenemos la longitud de la cadena de caracteres
			$longitudCadena=strlen($cadena);
			 
			//Se define la variable que va a contener la contraseña
			$pass = "";
			//Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
			$longitudPass=20;
			 
			//Creamos la contraseña
			for($i=1 ; $i<=$longitudPass ; $i++){
				//Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
				$pos=rand(0,$longitudCadena-1);
			 
				//Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
				$pass .= substr($cadena,$pos,1);
			}
			return $pass;
	}	

	/**
	 * Info del registro
     * @since 15/2/2021
     * @author BMOTTAG
	 */
	public function registro($llave)
	{
			$arrParam = array("llave" => $this->security->xss_clean($llave));
			$data['infoReserva'] = $this->general_model->get_reserva_info($arrParam);

			$arrParam = array("idHorario" => $data['infoReserva'][0]['fk_id_horario']);
			$data['infoHorario'] = $this->general_model->get_horario_info($arrParam);

			//envio de correo
			$idReserva = $data['infoReserva'][0]['id_reserva'];
			$this->email($idReserva);
						
			$data["view"] = 'info_reserva';
			$this->load->view("layout_calendar", $data);
	}


	/**
	 * Info del registro
     * @since 15/2/2021
     * @author BMOTTAG
	 */
	public function habilitar()
	{
			$idHorario = $this->input->post("idHorario");

			//desbloquear horario
			$arrParam = array(
				'idHorario' => $idHorario,
				'disponibilidad' => 1
			);
			$this->calendario_model->habilitarHorario($arrParam);
	}

    /**
     * Cargo modal - formulario eliminar reserva
     * @since 17/2/2021
     */
    public function cargarModalEliminar() 
	{
			header("Content-Type: text/plain; charset=utf-8"); //Para evitar problemas de acentos

			$this->load->view("eliminar_modal");
    }

	/**
	 * Eliminar Reserva
     * @since 17/2/2021
     * @author BMOTTAG
	 */
    public function eliminarRegistro()
	{			
			header('Content-Type: application/json');
			$data = array();
			
			$email = trim($this->security->xss_clean($this->input->post('email')));
			$fecha = trim($this->security->xss_clean($this->input->post('fecha')));
			$celular = trim($this->security->xss_clean($this->input->post('celular')));

			$arrParam = array(
				'email' => $email,
				'fecha' => $fecha,
				'celular' => $celular,
				'estadoReserva' => 1
			);
			$infoReserva = $this->general_model->get_reserva($arrParam);

			if(!$infoReserva)
			{
					$data["result"] = "error";					
					$data["mensaje"] = " Error. No hay reservas con esa información.";
					$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> No hay reservas con esa información.');
			}else{
					//deshaiblito reseva
					$arrParam = array(
						'idReserva' => $infoReserva[0]['id_reserva']
					);
					if ($idReserva = $this->calendario_model->deshabilitarReserva($arrParam)) 
					{
						$NumeroCuposRestantes = $infoReserva[0]['numero_cupos_restantes'];
						$numeroCupos = $infoReserva[0]['numero_cupos_usados'];
						//actualizar el numero de cupos restantes en la tabla horarios
						//si cumplio el numero maximo de cupos cambiar estado a cerrado
						$NumeroCuposRestantes = $NumeroCuposRestantes + $numeroCupos;
						$estado = '2'; //En processo
						$disponibilidad = 1;

						$arrParam = array(
							'idHorario' => $infoReserva[0]['fk_id_horario'],
							'NumeroCuposRestantes' => $NumeroCuposRestantes,
							'estado' => $estado,
							'disponibilidad' => $disponibilidad
						);
						$this->calendario_model->actualizarHorarios($arrParam);

						$data["result"] = true;					
						$this->session->set_flashdata('retornoExito', 'Se guardó la información');
					} else {
						$data["result"] = "error";					
						$this->session->set_flashdata('retornoError', '<strong>Error!!!</strong> Ask for help');
					}
			}

			echo json_encode($data);
    }

	/**
	 * Evio de correo
     * @since 17/2/2021
     * @author BMOTTAG
	 */
	public function email($idReserva)
	{
			$arrParam = array("idReserva" => $idReserva);
			$infoReserva = $this->general_model->get_reserva_info($arrParam);

			$arrParam = array("idHorario" => $infoReserva[0]['fk_id_horario']);
			$infoHorario = $this->general_model->get_horario_info($arrParam);
			
			$subjet = 'Reserva Jardín Botánico';
			$to = $infoReserva[0]['correo_electronico'];

			//mensaje del correo
			$msj = '<p><strong>Gracias por reservar su visita </strong></p>';
			$msj .= '<p>Sr.(a) ' . $infoReserva[0]['nombre_completo'] . ' lo(a) esperamos el día ';
			$msj .= "<strong>" . ucfirst(strftime("%d de %b, %G",strtotime($infoHorario[0]['hora_inicial']))) . "</strong>";
			$msj .= ' a las ' . "<strong>" .ucfirst(strftime("%I:%M %p",strtotime($infoHorario[0]['hora_inicial'])))  . "</strong>";
			$msj .= ' para que se acerque a nuestra taquilla y adquiera los ingresos conforme a las tarifas aplicadas*, con el código de este correo.</p>';
			$msj .= '<p>Le recomendamos llegar 20 minutos antes de su reserva para realizar el protocolo de bioseguridad.</p>';
			$msj .= '<p>Teléfono de contacto: 319 433 9710</p>';
			$msj .= "<strong>No. Visitantes: </strong>" . $infoReserva[0]['numero_cupos_usados'];
			$msj .= '<p><strong>* Tarifas aplicadas: </strong></p>';
			$msj .= '<ul><li>Adultos $3.500</li>';
			$msj .= '<li>Niños de 4 a 12 años $1.800</li>';
			$msj .= '<li>Niños de 3 o menos años y adultos mayores de 60 años no pagan</li></ul>';
			$msj .= "<img src=" . base_url($infoReserva[0]['qr_code_img']) . " class='img-rounded' width='200' height='200' />";


			$msj .= '<p>';
			$msj .= '<strong>Recomendaciones</strong>
					<ul><li>Usa correctamente tu tapabocas.</li>
					<li>Lava tus manos frecuentemente.</li>
					<li>Desinfecta tu calzado y objetos personales.</li>
					<li>Estornuda en el antebrazo o cúbrete con pañuelo desechable, no con tu mano.</li>
					<li>El personal médico te tomará la temperatura.</li>
					<li>Trae tu kit de desinfección (tapabocas, gel antibacterial y papel higiénico).</li>
					<li>Mantén la distancia mínima de 2 metros.</li>
					<li>Evita aglomeraciones.</li>
					<li>Porta tu paraguas o impermeable por si llueve.</li>
					<li>Recuerda traer agua para hidratarte.</li>
					<li>Descarga la aplicación Coronapp.</li></ul>';
			$msj .= '</p>';
									
			$mensaje = "<html>
			<head>
			  <title> $subjet </title>
			</head>
			<body>
				<p>$msj</p>
				<p>Cordialmente,</p>
				<p><strong>Jardín Botánico de Bogotá</strong></p>
			</body>
			</html>";		

			$this->load->library('email');   
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			$this->email->to($to, 'Usuario');
			$this->email->from('benmotta@gmail.com','JBB APP');
			$this->email->subject($subjet);
			$this->email->message($mensaje);

			if (!$this->email->send())
			{
			    show_error($this->email->print_debugger());
			}
			else
			{
			    return TRUE;
			}


	}	



	
	
}