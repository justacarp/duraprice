<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Produtos_model extends CI_Model
{
	
	var $table = 'produtos';

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function get_produtos()
	{
		$this->db->from('produtos');
		$query=$this->db->get();
		return $query->result();
	}
	
	public function count_produtos()
	{
		$this->db->from($this->table);
		$query=$this->db->get();
		return $query->num_rows();
	}
	
	public function get_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('produto_id',$id);
		$query = $this->db->get();
	
		return $query->row();
	}
	
	public function adicionar_produto($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	public function alterar_produto($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	
	public function delete_by_id($id)
	{
		$this->db->where('produto_id', $id);
		$this->db->delete($this->table);
	}
}