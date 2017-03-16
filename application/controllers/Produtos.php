<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller {

	function __construct() {
		parent::__construct();

		if(empty($this->session->userdata('usuario_id'))) {
			$this->session->set_flashdata('flash_data', 'You don\'t have access!');
			redirect('login');
		}
		
		$this->load->model('produtos_model');
		$this->load->model('fornecedores_model');
		$this->load->model('historico_model');
	}

	public function index()
	{
		$data['title'] = 'Produtos';
		
		$data['produtos']=$this->produtos_model->get_produtos();
		
		$data['fornecedores']= $this->fornecedores_model->get_fornecedores();
		
		$this->load->view('template/header', $data);
		$this->load->view('template/dashboard', $data);
		$this->load->view('produtos',$data);
		$this->load->view('template/footer');
	}
	
	public function adicionar_produto()
	{
		$data = array(
				'produto_nome' => $this->input->post('produto_nome'),
				'descricao' => $this->input->post('descricao'),
				'data_cadastro' => date("Y-m-d")
		);
		$insert = $this->produtos_model->adicionar_produto($data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function alterar_produto()
	{
		$data = array(
				'nome' => $this->input->post('nome'),
				'descricao' => $this->input->post('descricao')
		);
		$this->produtos_model->alterar_produto(array('produto_id' => $this->input->post('produto_id')), $data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_edit($id)
	{
		$data = $this->produtos_model->get_id($id);

		echo json_encode($data);
	}
	
	public function deletar_produto($id)
	{
		$this->produtos_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function novo_preco()
	{
		$data = array(
				'produto_id' => $this->input->post('produto_id'),
				'fornecedor_id' => $this->input->post('fornecedores'),
				'usuario_id' => $this->session->userdata('usuario_id'),
				'preco' => str_replace(",",".",$this->input->post('preco')),
				'data_entrada' => date("Y-m-d H:i:s")
		);
		$insert = $this->historico_model->inserir_preco($data);
		echo json_encode(array("status" => TRUE));
	}

	
}
