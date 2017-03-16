<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
	
		if(empty($this->session->userdata('usuario_id'))) {
			$this->session->set_flashdata('flash_data', 'You don\'t have access!');
			redirect('login');
		}
		
		$this->load->model('produtos_model');
		$this->load->model('fornecedores_model');
	}
	
	public function index()
	{	
		$data['title'] = 'Home';
		
		$data['produtos'] = $this->produtos_model->count_produtos();
		
		$data['fornecedores'] = $this->fornecedores_model->count_fornecedores();
		
		$this->load->view('template/header', $data);
		$this->load->view('template/dashboard', $data);
		$this->load->view('home',$data);
		$this->load->view('template/footer');
	}
	
	public function logout() {
		$data = ['usuario_id', 'username'];
		$this->session->unset_userdata($data);
	
		redirect('login');
	}
	
	
}
