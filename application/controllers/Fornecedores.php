<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fornecedores extends CI_Controller {

	function __construct() {
		parent::__construct();

		if(empty($this->session->userdata('usuario_id'))) {
			$this->session->set_flashdata('flash_data', 'You don\'t have access!');
			redirect('login');
		}

		$this->load->model('fornecedores_model');

	}

	public function index()
	{
		$data['title'] = 'Fornecedores';
		
		$data['fornecedores']= $this->fornecedores_model->get_fornecedores();

		$this->load->view('template/header', $data);
		$this->load->view('template/dashboard', $data);
		$this->load->view('fornecedores',$data);
		$this->load->view('template/footer');
	}

	public function adicionar_fornecedor()
	{
		$data = array(
				'fornecedor_nome' => $this->input->post('fornecedor_nome'),
				'descricao' => $this->input->post('descricao'),
				'data_cadastro' => date("Y-m-d")
		);
		$insert = $this->fornecedores_model->adicionar_fornecedor($data);
		echo json_encode(array("status" => TRUE));
	}

	public function alterar_fornecedor()
	{
		$data = array(
				'nome' => $this->input->post('nome'),
				'descricao' => $this->input->post('descricao')
		);
		$this->fornecedores_model->alterar_fornecedor(array('fornecedor_id' => $this->input->post('fornecedor_id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->fornecedores_model->get_id($id);

		echo json_encode($data);
	}

	public function deletar_fornecedor($id)
	{
		$this->fornecedores_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}




}
