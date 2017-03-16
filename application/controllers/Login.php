<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("login_model", "login");
		if(!empty($_SESSION['usuario_id']))
			redirect('home');
	}
	
	public function index()
	{

		if($_POST) {
			$result = $this->login->validate_user($_POST);
			if(!empty($result)) {
				$data = [
						'usuario_id' => $result->usuario_id,
						'username' => $result->username,
						'nome'=>$result->nome
				];
		
				$this->session->set_userdata($data);
				redirect('home');
			} else {
				$this->session->set_flashdata('flash_data', 'Username or password is wrong!');
				redirect('login');
			}
		}
		
		$data['title'] = 'Login';

		$this->load->view('template/header', $data);
		$this->load->view('login');
		$this->load->view('template/footer');
	}
	
	
}
