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
	public function getMaxTimeStamp($id)
	{
		$this->db->where('idUser',$id);
		$this->db->select_max('detailTime');
		$maxTime = $this->db->get('details')->result_array();
		$this->db->where('detailTime',$maxTime[0]['detailTime']);
		return $this->db->get('details');
	}
	public function deleteData($table,$data)
	{
		return $this->db->delete($table, $data);
	}
	public function getDetails($data)
	{
		$this->db->where('idUser',$data);
		return $this->db->get('users')->row();
	}
}