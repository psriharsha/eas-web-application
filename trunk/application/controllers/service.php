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
			{
				$type = $idUser->typeOfUser;
				if($type == "carer")
				{
					$typeInfo['typeOfUser'] = "both";
				$username['emailId'] = $this->input->post('emailId'); 
				$this->user->updateMultipleData('users',$typeInfo,$username);
				}
			}
			echo $idUser->idUser;
		}
		else
			echo "Failure";
	}
	public function addUserDetails()
	{
		$data['dob'] = $this->input->post('dob');
		$data['gender']  = ($this->input->post('gender'));
		$data['bloodGroup']  = $this->input->post('bloodGroup');
		$data['emergencyNumber']  = $this->input->post('contactNumber');
		$data['routineStart']  = $this->input->post('routineStart');
		$data['routineEnd']  = $this->input->post('routineEnd');
		$username = $this->input->post('idUser');
		$added = $this->user->updateData('users',$data,$username);
		if($added == 1)
			echo "Success";
		else
			echo "Failure";
	}
	
	public function getUserDetails()
	{
		$username = $this->input->post('idUser');
		$data = $this->user->getDetails($username);
		echo $data->dob."|".$data->gender."|".$data->emergencyNumber."|".$data->routineStart."|".$data->routineEnd."|".$data->bloodGroup;
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
	
	public function showSeniors()
	{
		$mail['toMail'] = $this->input->get('username');
		$senior_citizens = $this->user->exists('subscriptions',$mail);
		if($senior_citizens->num_rows()>0)
		{
			foreach($senior_citizens->result() as $row)
			{
				$idSubs[] = $row->idSubscription;
				$tempId[] = $row->idUser;
				$subsStatus[] = $row->status;
				$permission[] = $row->permission;
				$resetTime[] = $row->resetTime;
			}
			foreach ($tempId as $temp)
			{
				$tempData['idUser'] = $temp;
				$tempUser = $this->user->exists('users',$tempData);
				$senior_citizens_name[] = $tempUser->row()->lastName;
			}
		}
		$data['idSubs'] = $idSubs;
		$data['tempId'] = $tempId;
		$data['subsStatus'] = $subsStatus;
		$data['permission'] = $permission;
		$data['resetTime'] = $resetTime;
		$data['senior_citizens_name'] = $senior_citizens_name;
		$this->load->view('senior',$data);
	}
	
	public function showCareGivers(){
		$care_givers_name = array();
		$subsStatusC = array();
		$permissionC = array();
		$id['idUser'] = $this->input->get('userId');
		$myData = $this->user->exists('users',$id)->result_array();
		$care_givers = $this->user->exists('subscriptions',$id);
		if($care_givers->num_rows()>0)
		{
			foreach($care_givers->result() as $row)
			{
				$idSubsC[] = $row->idSubscription;
				$tempMailC[] = $row->toMail;
				$subsStatusC[] = $row->status;
				$permissionC[] = $row->permission;
				$resetTimeC[] = $row->resetTime;
			}
			foreach ($tempMailC as $temp)
			{
				$tempDataC['emailId'] = $temp;
				$tempUser = $this->user->exists('users',$tempDataC);
				if($tempUser->num_rows == 1)
					$care_givers_name[] = $tempUser->row()->lastName;
				else
					$care_givers_name[] = $temp;
				$temp = "";
			}
		}
		$data['care_givers_name'] = $care_givers_name;
		$data['subsStatusC'] = $subsStatusC;
		$data['permissionC'] = $permissionC;
		$this->load->view('careGivers',$data);
	}
	
	public function showActivity()
	{
		$id = $this->input->get('userId');
		$data['id'] = $id;
		$data['title'] = "Emergency Alarming System | Activity";
		$this->load->view('serviceAct',$data);
	}
	
	public function showLocation()
	{
		$id = $this->input->get('userId');
		$data['id'] = $id;
		$data['title'] = "Emergency Alarming System | Location";
		$this->load->view('serviceLoc',$data);
	}
	public function sendMail()
	{
		$to = "k1213328@kingston.ac.uk";
		$msg = "Over";
		$this->load->library('email');
		
		$this->email->from('prabhala56@gmail.com', 'harsha');
		$this->email->to($to);
		
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');
		
		$this->email->send();
		
		echo $this->email->print_debugger();
	}
}