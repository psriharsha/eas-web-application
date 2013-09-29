<?php
class Subscription extends CI_Controller{
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
	
	public function updateSubscription($idUser,$toMail,$permission,$resetBy)
	{
		$where['idUser'] = $idUser;
		$where['toMail'] = $toMail;
		$data['permission'] = $permission;
		$data['resetBy'] = $resetBy;
		$datestring = "%Y-%m-%d %H:%i:00";
		$time = time();
		$data['resetTime'] = mdate($datestring, $time);
		$added = $this->user->updateMultipleData('subscriptions',$data,$where);
		if($added == 1)
			return "Success";
		else
			return "Failure";
	}
	
	public function deleteSubscription()
	{
		$permission = $this->input->get('perm');
		$id = $this->input->get('idSubs');
		$where['idSubscription'] = $id;
		$subscription = $this->user->exists('subscriptions',$where)->row();
		if($subscription!=null){
		$actualPermission = $subscription->permission;
		$finalPermission="";
		$result = "";
		if($actualPermission == "both")
		{
			if($permission == "location"){
			$finalPermission = "activity";
			$result = $this->updateSubscription($subscription->idUser, $subscription->toMail, $finalPermission, $this->session->userdata('userId'));
			}			
		}
		if($permission == "activity")
		{
			$res = $this->user->deleteData('subscriptions',$where);
			if($res == 1)
				$result = "Success";
			else $result = "Failure";
		}
		if($result == "Success")
			$this->myAccount();
		else
		echo $permission."||".$actualPermission."||".$finalPermission;
		}
		else $this->myAccount();
	}
	
	public function showActivity()
	{
		$id = $this->input->get('idSubs');
		$data['id'] = $id;
		$data['title'] = "Emergency Alarming System | Activity";
		$data['content'] = "activity";
		$this->load->view('main',$data);
	}
	
	public function showLocation()
	{
		$id = $this->input->get('idSubs');
		$data['id'] = $id;
		$data['title'] = "Emergency Alarming System | Location";
		$data['content'] = "location";
		$this->load->view('main',$data);
	}
	
	public function getLatestTime()
	{
		$time = $this->user->getMaxTimeStamp($this->input->post('id'));
		if($time->num_rows()>0)
		{
			$temp = $time->result_array();
			$dat = date_create_from_format('Y-m-d H:i:s',$temp[0]['detailTime']);
			$ret = array($temp[0]['detailTime'],$temp[0]['actX'],$temp[0]['actY'],$temp[0]['actZ'],$temp[0]['latitude'],$temp[0]['longitude']);
			echo json_encode($ret);
		}
	}
	
	public function randomData()
	{
		// The x value is the current JavaScript time, which is the Unix time multiplied by 1000.
		$x = time() * 1000;
		// The y value is a random number
		$y = rand(0, 100);
		
		// Create a PHP array and echo it as JSON
		$ret = array($x, $y);
		echo json_encode($ret);
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
	
	public function changeSubs(){
		$data['idSubscription'] = $this->input->get('idSubs');
		$detail = $this->user->exists('Subscriptions',$data)->row();
		$initStatus = $detail->status;
		$final['status'] = "";
		if($initStatus == "true")
			$final['status'] = "false";
		else 
			$final['status'] = "true";
		$this->user->updateMultipleData('Subscriptions',$final,$data);
		$this->myAccount();
	}
	
}