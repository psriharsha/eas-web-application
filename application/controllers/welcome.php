<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index()
	{
		if($this->session->userdata('username')!="")
		{
			redirect(base_url().'index.php/Account/myaccount');
		}
		else{
		$data['title'] = 'Emergency Alarming System | For senior Citizens';
		$data['loginInvalid'] = "";
		$data['content'] = 'index';
		$this->load->view('main',$data);
		}
	}
	
}