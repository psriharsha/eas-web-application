<?php
class Account extends CI_Controller{
	
	
	// Registration
	public function register(){
		if($this->session->userdata('username')!="")
			$this->myAccount();
		else
		if($this->form_validation->run('registration')){
		if($this->checkUsername($this->input->post('username'))){
		$data['emailId'] = $this->input->post('username');
		$data['password']  = md5($this->input->post('password'));
		$data['firstName']  = $this->input->post('firstName');
		$data['lastName']  = $this->input->post('lastName');
		$data['typeOfUser'] = $this->input->post('typeOfUser');
		$data['contactNumber'] = $this->input->post('contactNumber');
		$added = $this->user->insertData('users',$data);
		if($added == 1)
			echo "Success";
		else
			echo "Failure";
		}
		else 
		{
			$data['title'] = 'Emergency Alarming System | For senior Citizens';
			$data['loginInvalid'] = "This Mail Id is already registered.";
			$data['content'] = 'index';
			$this->load->view('main',$data);
		}
		}
		else
		{
			$this->home();
		}
	}
	
	public function home()
	{
		$data['title'] = 'Emergency Alarming System | For senior Citizens';
		$data['loginInvalid'] = "";
		$data['content'] = 'index';
		$this->load->view('main',$data);
	}
	
	// Login
	public function Login()
	{
		if($this->session->userdata('username')!="")
			$this->myAccount();
		else
		if($this->form_validation->run('login')){
		$data['emailId'] = $this->input->post('emailId');
		$data['password'] = md5($this->input->post('logpassword'));
		$valid = $this->user->exists('users',$data);
		if($valid->num_rows>0)
		{
			$idUser = $valid->row();
			$user = array(
						'userId' => $idUser->idUser,
						'username' => $this->input->post('emailId')
					);
			$this->session->set_userdata($user);
			$this->myAccount();
		}
		else
		{
			$data['title'] = 'Emergency Alarming System | For senior Citizens';
			$data['loginInvalid'] = "Username or password is incorrect";
			$data['content'] = 'index';
			$this->load->view('main',$data);
		}
	}
	else{
		$this->home();
	}
	}
	
	//Check Username if registered
	public function checkUsername($emailId)
	{
		$data['emailId'] = $emailId;
		$exist = $this->user->exists('users',$data);
		if($exist->num_rows>0)
			return false;
		else
			return true;
	}
	
	public function myAccount()
	{
		$idSubs = array();
		$idSubsC = array();
		$tempId = array();
		$tempMailC = array();
		$senior_citizens_name = array();
		$subsStatus = array();
		$permission = array();
		$resetTime = array();
		$care_givers_name = array();
		$subsStatusC = array();
		$permissionC = array();
		$resetTimeC = array();
		
		$mail['toMail'] = $this->session->userdata('username');
		$name['emailId'] = $this->session->userdata('username');
		$displayName = $this->user->exists('users',$name)->row();
		$senior_citizens = $this->user->exists('subscriptions',$mail);
		$idSubs[] = 0;
		$tempId[] = $this->session->userdata('userId');
		$subsStatus[] = "true";
		$permission[] = "both";
		$resetTime[] = ""; 
		if($senior_citizens->num_rows()>=0)
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
		$id['idUser'] = $this->session->userdata('userId');
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
		$data['display'] = $displayName->firstName." ".$displayName->lastName;
		$data['info'] = $displayName;
		$data['tempId'] = $tempId;
		$data['tempMailC'] = $tempMailC;
		$data['idSubs'] = $idSubs;
		$data['idSubsC'] = $idSubsC;
		$data['senior_citizens_name'] = $senior_citizens_name;
		$data['subsStatus'] = $subsStatus;
		$data['permission'] = $permission;
		$data['resetTime'] = $resetTime;
		$data['care_givers_name'] = $care_givers_name;
		$data['subsStatusC'] = $subsStatusC;
		$data['permissionC'] = $permissionC;
		$data['resetTimeC'] = $resetTimeC;
		$data['title'] = "Emergency Alarming System|Your Dash Board";
		$data['content'] = "dashBoard";
		$this->load->view('main',$data);
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		$this->home();
	}
	
	public function editDetails(){
		$data['firstName'] = $this->input->post('firstName');
		$data['lastName'] = $this->input->post('lastName');
		$data['dob'] = $this->input->post('dob');
		$data['gender'] = $this->input->post('gender');
		$data['bloodGroup'] = $this->input->post('bloodGroup');
		$data['emergencyNumber'] = $this->input->post('emergencyNumber');
		$data['routineStart'] = $this->input->post('routineStart');
		$data['routineEnd'] = $this->input->post('routineEnd');
		$idUser = $this->session->userdata('userId');
		$this->user->updateData('users',$data,$idUser);
		$this->myAccount();
	}
	
}