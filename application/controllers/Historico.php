<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historico extends CI_Controller {

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

	public function get_historico_fornecedores($id)
	{
		$data = $this->historico_model->get_fornecedores($id);

		$fornecedores_id = array();

		foreach ($data as $key => $fornecedor_id)
		{
			$fornecedores_id[] = $fornecedor_id->fornecedor_id;
		}

		$data = $this->fornecedores_model->get_fornecedores_by_array($fornecedores_id);

		echo json_encode($data);
	}

	public function random_color(){

		$r = rand(128,255);
		$g = rand(128,255);
		$b = rand(128,255);
		return "rgb(".$r.",".$g.",".$b.")";

	}

	public function get_historico_preco($produto_id, $fornecedores_id)
	{

		$fornecedores_id = array_map('intval', explode(',', $fornecedores_id));

		$data = $this->historico_model->get_produto_fornecedor($produto_id,$fornecedores_id);

		$arr = array();

		foreach($data as $key => $item)
		{
			$arr[$item->fornecedor_id][$key] = $item;
		}

		ksort($arr, SORT_NUMERIC);

		$_datasets = array('datasets' => []);

		foreach($arr as $chave => $valor)
		{
			$border = $this->random_color();

			$background = $this->random_color();

			$data_dataset = array();

			foreach($valor as $fornecedor => $dados)
			{

				$data_dataset[] = ['x' => $dados->data_entrada, 'y'=> $dados->preco];

			}

			$set = array('borderColor' => $border,
					'backgroundColor' => $border,
					'pointBorderColor' => $border,
					'pointBackgroundColor'=> $background,
					'pointBorderWidth' => 3,
					'label'=> $this->fornecedores_model->get_id($chave)->fornecedor_nome,
					'lineTension' => 0,
					'fill' => false,
					'data'=> $data_dataset
			);

			$_datasets['datasets'][] = $set;

		}

		echo json_encode($_datasets);

	}

}
