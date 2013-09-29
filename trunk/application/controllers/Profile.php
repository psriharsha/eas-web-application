<?php
class Profile extends CI_Controller{
	
	//Save User Details after registering
	public function addUserDetails()
	{
		$data['dob'] = $this->input->post('dob');
		$data['gender']  = md5($this->input->post('gender'));
		$data['bloodGroup']  = $this->input->post('bloodGroup');
		$data['contactNumber']  = $this->input->post('contactNumber');
		$data['routineStart']  = $this->input->post('routineStart');
		$data['routineEnd']  = $this->input->post('routineEnd');
		$username = $this->input->post('idUser');
		$added = $this->user->updateData('users',$data,$username);
		if($added == 1)
			echo "Success";
		else
			echo "Failure";
	}
	
	//Add Allergy
	public function addAllergy()
	{
		$data['idUser'] = $this->input->post('idUser');
		$data['allergyName'] = $this->input->post('allergyName');
		$added = $this->user->insertData('allergy',$data);
		if($added == 1)
			echo "Success";
		else
			echo "Failure";
	}
	
	//Add First Aid
	public function addFirstAid()
	{
		$data['idUser'] = $this->input->post('idUser');
		$data['firstAidName'] = $this->input->post('firstAidName');
		$added = $this->user->insertData('firstaid',$data);
		if($added == 1)
			echo "Success";
		else
			echo "Failure";
	}
}