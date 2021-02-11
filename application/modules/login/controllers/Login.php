<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("login_model");
		$this->load->helper("cookie");
    }

	/**
	 * Index Page for this controller.
	 * @param int $id: id del vehiculo encriptado para el hauling
	 */
	public function index($id = 'x')
	{
			$this->session->sess_destroy();
			$data['idEquipo'] = FALSE;
			$data['idTipoEquipo'] = FALSE;
			//si envio llave encriptada, entonces busco el ID del equipo para pasarlo a la vista
			if ($id != 'x') {				
				$arrParam['encryption'] = $id;
				$data['equipoInfo'] = $this->general_model->get_equipos_info($arrParam);

				$data['idEquipo'] = $data['equipoInfo'][0]['id_equipo'];
			}
			$this->load->view('login', $data);
	}
	
	public function validateUser()
	{
			$login = $this->security->xss_clean($this->input->post("inputLogin"));
			$passwd = $this->security->xss_clean($this->input->post("inputPassword"));
			$data['idEquipo'] = $this->input->post("hddId");
						
			//busco datos del usuario
			$arrParam = array(
				"table" => "usuarios",
				"order" => "id_user",
				"column" => "log_user",
				"id" => $login
			);
			$userExist = $this->general_model->get_basic_search($arrParam);

			if ($userExist)
			{
					$arrParam = array(
						"login" => $login,
						"passwd" => $passwd
					);
					$user = $this->login_model->validateLogin($arrParam); //brings user information from user table

					if(($user["valid"] == true)) 
					{
						$userRole = intval($user["role"]);
						//busco url del dashboard de acuerdo al rol del usuario
						$arrParam = array(
							"idRole" => $userRole
						);
						$rolInfo = $this->general_model->get_roles($arrParam);

						$sessionData = array(
							"auth" => "OK",
							"id" => $user["id"],
							"dashboardURL" => $rolInfo[0]['dashboard_url'],
							"firstname" => $user["firstname"],
							"lastname" => $user["lastname"],
							"name" => $user["firstname"] . ' ' . $user["lastname"],
							"logUser" => $user["logUser"],
							"state" => $user["state"],
							"role" => $user["role"],
							"photo" => $user["photo"],
							"idEquipo" => $data['idEquipo']
						);
												
						$this->session->set_userdata($sessionData);
						//cookies
						set_cookie('user',$login, '350000'); 
						set_cookie('password',$passwd,'350000'); 
						
						$this->login_model->redireccionarUsuario();
					}else{					
						$data["msj"] = "<strong>" . $userExist[0]["first_name"] . "</strong> esa no es su contraseña.";
						$this->session->sess_destroy();
						$this->load->view('login', $data);
					}
			}else{
				$data["msj"] = "<strong>" . $login . "</strong> no esta registrado.";
				$this->session->sess_destroy();
				$this->load->view('login', $data);
			}
	}
	
	/**
	 * Form to ask for a new password
	 */
	public function recover()
	{
		$this->load->view("form_email");
	}
	
	/**
	 * Se valida correo, se envia correo con enlace para cambiar contraseña y se guarda llave en la base de datos
	 */	
	public function validateEmail()
	{
			$email = $this->security->xss_clean($this->input->post("email"));
			
			$this->load->model("general_model");
			//busco datos del usuario
			$arrParam = array(
				"table" => "usuarios",
				"order" => "id_user",
				"column" => "email",
				"id" => $email
			);
			$userExist = $this->general_model->get_basic_search($arrParam);
			
			if ($userExist)
			{
				$idUsuario = $userExist[0]['id_user'];
				
				//elimino datos anteriores de tabla recuperar
				$arrParam = array(
					"table" => "usuarios_llave_contraseña",
					"primaryKey" => "fk_id_user_ulc",
					"id" => $idUsuario
				);
				$this->general_model->deleteRecord($arrParam);
				
				//genero llave
				$llave = $this->randomText();

				//guardo llave en tabla recuperar
				$this->login_model->saveKey($idUsuario, $email, $llave);
				
				//envio correo con url para cambio de contraseña
				//$this->email($llave);

				$data["msjSuccess"] = "Se envío correo a <strong>" . $email . "</strong> para recuperar la contraseña.";
				$this->load->view('form_email', $data);
				
			}else{
				$data["msj"] = "<strong>" . $email . "</strong> no existe.";
				$this->session->sess_destroy();
				$this->load->view('form_email', $data);
			}
	}
	
	//FUNCION PARA CREAR UNA CLAVE ALEATORIA
	function randomText()
	{ 		
			$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
			$key = "";
			//Reconstruimos la contraseña segun la longitud que se quiera
			for($i=0;$i<20;$i++) {
			  //obtenemos un caracter aleatorio escogido de la cadena de caracteres
			  $key .= substr($str,rand(0,62),1);
			}

			return $key; 
	} 
	
	/**
	 * Evio correo al usuario con llave para recuperar la contraseña
     * @since 25/11/2020
     * @author BMOTTAG
	 */
	public function email($key)
	{
			//busco informacion en la base de datos
			$arrParam = array("key" => $key);
			$information = $this->login_model->validateLoginKey($arrParam);//brings user information from user table
										
			$subjet = "Recuperar contrasela - JBB-APP";
			$user = $information["firstname"] . ' ' . $information["lastname"];
			$to = $information["email"];
				
			//mensaje del correo
			$msj = "<p>Siga el enlace para recuperar su contraseña:</p>";
			$msj .= "<a href='" . base_url("login/keyLogin/" . $key) . "'>Recuperar contraseña</a>";
			
			$mensaje = "<html>
			<head>
			  <title> $subjet </title>
			</head>
			<body>
				<p>Señor(a)	$user:</p>
				<p>$msj</p>
				<p>Cordialmente,</p>
				<p><strong>Administrador JBB-APP</strong></p>
			</body>
			</html>";
			
			$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$cabeceras .= 'To: ' . $user . '<' . $to . '>' . "\r\n";
			$cabeceras .= 'From: JBB-APP <admin@tuapoyo.com.co>' . "\r\n";

			//enviar correo al cliente
			mail($to, $subjet, $mensaje, $cabeceras);
			
			return true;
	}
	
	/**
	 * Login por medio de LLAVE de recuperacion de contraseña
	 * @param varchar $valor: llave de la tabla recuperar
	 */
	public function keyLogin($valor = 'x')
	{
			$arrParam = array("key" => $valor);
			$user = $this->login_model->validateLoginKey($arrParam);//brings user information from user table
			$data['idVehicle'] = FALSE;
			$data['inspectionType'] = FALSE;

			if (($user["valid"] == true)) 
			{
				$userRole = intval($user["role"]);
				//busco url del dashboard de acuerdo al rol del usuario
				$arrParam = array(
					"idRole" => $userRole
				);
				$rolInfo = $this->general_model->get_roles($arrParam);
				
				$sessionData = array(
					"auth" => "OK",
					"id" => $user["id"],
					"dashboardURL" => $rolInfo[0]['dashboard_url'],
					"firstname" => $user["firstname"],
					"lastname" => $user["lastname"],
					"name" => $user["firstname"] . ' ' . $user["lastname"],
					"logUser" => $user["logUser"],
					"state" => 66,
					"role" => $user["role"],
					"idVehicle" => 'x',
					"inspectionType" => FALSE,
					"linkInspection" => FALSE,
					"formInspection" => FALSE
				);
				$this->session->set_userdata($sessionData);
				
				$this->login_model->redireccionarUsuario();			
			}else{					
				$data["msj"] = "<strong>Error</strong> datos incorrectos.";
				$this->load->view('login', $data);
			}
	}

	/**
	 * Form to search a equipment
	 */
	public function search_equipment()
	{
		$this->load->view("form_search_equipment");
	}
	
	
	
	
	
}
