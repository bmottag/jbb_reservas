<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model("usuarios_model");
        $this->load->model("general_model");
    }

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
			$idUser = $this->session->userdata("id");
									
			$arrParam = array(
				"idUser" => $idUser
			);
			$data['information'] = $this->general_model->get_user($arrParam);

			$data["view"] = "form_password";
			$this->load->view("layout", $data);
	}
	

	/**
	 * Actulizar contraseña
	 */
	public function updatePassword()
	{
			$data = array();			
			
			$newPassword = $this->input->post("inputPassword");
			$confirm = $this->input->post("inputConfirm");
			$passwd = str_replace(array("<",">","[","]","*","^","-","'","="),"",$newPassword); 
			$idUser = $this->input->post("hddId");
			
			$data['linkBack'] = $this->session->userdata("dashboardURL");
			$data['titulo'] = "<i class='fa fa-unlock fa-fw'></i> CAMBIAR CONTRASEÑA";
			
			if($newPassword == $confirm)
			{					
					if ($this->usuarios_model->updatePassword()) {
						
						//elimino datos anteriores de tabla recuperar
						$arrParam = array(
							"table" => "usuarios_llave_contraseña",
							"primaryKey" => "fk_id_user_ulc",
							"id" => $idUser
						);
						$this->general_model->deleteRecord($arrParam);
						
						$data["msj"] = "Se actualizó la contraseña.";
						$data["msj"] .= "<br><strong>Nombre Usuario: </strong>" . $this->input->post("hddUser");
						$data["msj"] .= "<br><strong>Contraseña: </strong>" . $passwd;
						$data["clase"] = "alert-success";
					}else{
						$data["msj"] = "<strong>Error!!!</strong> Ask for help.";
						$data["clase"] = "alert-danger";
					}
			}else{
				//definir mensaje de error
				echo "pailas no son iguales";
			}
						
			$data["view"] = "template/answer";
			$this->load->view("layout", $data);
	}
	
	/**
	 * photo
	 */
	public function detalle($error = '')
	{			
			$idUser = $this->session->userdata("id");
			
			//busco datos del usuario
			$arrParam = array(
				"idUser" => $idUser
			);
			$data['UserInfo'] = $this->general_model->get_user($arrParam);
			
			$data['error'] = $error; //se usa para mostrar los errores al cargar la imagen 
			$data["view"] = 'detalle_usuario';
			$this->load->view("layout", $data);
	}
	
    //FUNCIÓN PARA SUBIR LA IMAGEN 
    function do_upload() 
	{
			$config['upload_path'] = './images/usuarios/';
			$config['overwrite'] = true;
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '3000';
			$config['max_width'] = '2024';
			$config['max_height'] = '2008';
			$idUser = $this->session->userdata("id");
			$config['file_name'] = $idUser;

			$this->load->library('upload', $config);
			//SI LA IMAGEN FALLA AL SUBIR MOSTRAMOS EL ERROR EN LA VISTA 
			if (!$this->upload->do_upload()) {
				$error = $this->upload->display_errors();
				$this->detalle($error);
			} else {
				$file_info = $this->upload->data();//subimos la imagen
				
				//USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
				//ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA
				$this->_create_thumbnail($file_info['file_name']);
				$data = array('upload_data' => $this->upload->data());
				$imagen = $file_info['file_name'];
				$path = "images/usuarios/thumbs/" . $imagen;
				
				//actualizamos el campo photo
				$arrParam = array(
					"table" => "usuarios",
					"primaryKey" => "id_user",
					"id" => $idUser,
					"column" => "photo",
					"value" => $path
				);

				$this->load->model("general_model");
				$data['linkBack'] = "usuarios/detalle";
				$data['titulo'] = "<i class='fa fa-user fa-fw'></i> FOTO USUARIO";
				
				if($this->general_model->updateRecord($arrParam))
				{
					$data['clase'] = "alert-success";
					$data['msj'] = "Se actualizó la foto del usuario.";			
				}else{
					$data['clase'] = "alert-danger";
					$data['msj'] = "Ask for help.";
				}
							
				$data["view"] = 'template/answer';
				$this->load->view("layout", $data);
				//redirect('employee/photo');
			}
    }
	
    //FUNCIÓN PARA CREAR LA MINIATURA A LA MEDIDA QUE LE DIGAMOS
    function _create_thumbnail($filename) 
	{
        $config['image_library'] = 'gd2';
        //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
        $config['source_image'] = 'images/usuarios/' . $filename;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        //CARPETA EN LA QUE GUARDAMOS LA MINIATURA
        $config['new_image'] = 'images/usuarios/thumbs/';
        $config['width'] = 150;
        $config['height'] = 150;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
    }

	
}
