<?php
Class User extends CI_Model{
	public function exists($table,$data)
	{
		return $this->db->get_where($table,$data);
	}
	public function insertData($table,$data)
	{
		return $this->db->insert($table,$data);
	}
	public function updateData($table,$data,$idUser)
	{
		$this->db->where('idUser',$idUser);
		return $this->db->update($table,$data);
	}
	public function updateMultipleData($table,$data,$where)
	{
		return $this->db->update($table,$data,$where);
	}
}