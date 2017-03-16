<?php


defined('BASEPATH') OR exit('No direct script access allowed');


class Fornecedores_model extends CI_Model
{

	var $table = 'fornecedores';

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function get_fornecedores()
	{
		$this->db->from('fornecedores');
		$query=$this->db->get();
		return $query->result();
	}
	
	public function count_fornecedores()
	{
		$this->db->from($this->table);
		$query=$this->db->get();
		return $query->num_rows();
	}
	
	public function get_fornecedores_by_array($fornecedores = array())
	{
		$this->db->from('fornecedores');
		$this->db->where_in('fornecedor_id', $fornecedores);
		$query=$this->db->get();
		return $query->result();
	}

	public function get_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('fornecedor_id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function adicionar_fornecedor($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function alterar_fornecedor($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('fornecedor_id', $id);
		$this->db->delete($this->table);
	}
}