<?php
class Service extends CI_Controller{
	public function hello()
	{
		echo "Hello World";
	}
	public function register(){
		if($this->checkUsername($this->input->post('emailId'))){
		$data['emailId'] = $this->input->post('emailId');
		$data['password']  = md5($this->input->post('password'));
		$data['firstName']  = $this->input->post('firstName');
		$data['lastName']  = $this->input->post('lastName');
		$data['typeOfUser'] = $this->input->post('typeOfUser');
		$added = $this->user->insertData('users',$data);
		if($added == 1)
			echo "Success";
		else
			echo "Failure";
		}
		else 
			echo "Username";
	}
	
	public function checkUsername($emailId)
	{
		$data['emailId'] = $emailId;
		$exist = $this->user->exists('users',$data);
		if($exist->num_rows>0)
			return false;
		else
			return true;
	}
	
	public function checkUser()
	{
		$data['emailId'] = $this->input->post('emailId');
		$data['password'] = md5($this->input->post('password'));
		$valid = $this->user->exists('users',$data);
		if($valid->num_rows>0)
		{
			$idUser = $valid->row();
			echo $idUser->idUser;
		}
		else
			echo "Failure";
	}
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
	public function addDetails()
	{
		$data['idUser'] = $this->input->post('idUser');
		$data['actX'] = $this->input->post('actX');
		$data['actY']  = $this->input->post('actY');
		$data['actZ']  = $this->input->post('actZ');
		$data['latitude']  = $this->input->post('latitude');
		$data['longitude']  = $this->input->post('longitude');
		$added = $this->user->insertData('details',$data);
		if($added == 1)
			echo "Success";
		else
			echo "Failure";
	}
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
	public function addSubscription()
	{
		$data['idUser'] = $this->input->post('idUser');
		$data['toMail'] = $this->input->post('toMail');
		if($this->checkSubscription($data))
		{
		$data['permission'] = $this->input->post('permission');
		$data['status'] = $this->input->post('status');
		$added = $this->user->insertData('subscriptions',$data);
		if($added == 1)
			echo "Success";
		else
			echo "Failure";
		}
		else{
			$where['idUser'] = $this->input->post('idUser');
			$where['toMail'] = $this->input->post('toMail');
		$dataUp['permission'] = $this->input->post('permission');
		$dataUp['status'] = $this->input->post('status');
		$added = $this->user->updateMultipleData('subscriptions',$dataUp,$where);
		if($added == 1)
			echo "Success";
		else
			echo "Failure";
		}
	}
	
	public function checkSubscription($data)
	{
		$exist = $this->user->exists('subscriptions',$data);
		if($exist->num_rows>0)
			return false;
		else
			return true;
	}
	
	public function updateSubscription()
	{
		$where['idUser'] = $this->input->post('idUser');
		$where['toMail'] = $this->input->post('toMail');
		$data['permission'] = $this->input->post('permission');
		$data['status'] = $this->input->post('status');
		$data['resetBy'] = $this->input->post('resetBy');
		$datestring = "%Y-%m-%d %H:%i:00";
		$time = time();		
		$data['resetTime'] = mdate($datestring, $time);
		$added = $this->user->updateMultipleData('subscriptions',$data,$where);
		if($added == 1)
			echo "Success";
		else
			echo "Failure";
	}
}