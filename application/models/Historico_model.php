<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Historico_model extends CI_Model
{

	var $table = 'historico';
	
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function inserir_preco($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	public function get_produto($produto_id)
	{
		$this->db->from($this->table);
		$this->db->where('produto_id',$produto_id);
		$query = $this->db->get();
	
		return $query->result();
	}
	
	
	public function get_fornecedores($produto_id)
	{
		$this->db->select('fornecedor_id');
		$this->db->distinct();
		$this->db->from($this->table);
		$this->db->where('produto_id',$produto_id);
		$query = $this->db->get();
		
		return $query->result();

	}

	public function get_produto_fornecedor($produto_id,$fornecedores_id = array())
	{
		$this->db->from($this->table);
		$this->db->where('produto_id',$produto_id);
		$this->db->where_in('fornecedor_id',$fornecedores_id);
		//$this->db->order_by("data_entrada", "desc");
		$query = $this->db->get();
	
		return $query->result();
	}
	
}