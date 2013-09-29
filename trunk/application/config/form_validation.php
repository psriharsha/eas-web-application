<?php
$config = array(
		'registration' => array(
				array(
						'field' => 'username',
						'label' => '\'Username\'',
						'rules' => 'required|valid_email'
				),
				array(
						'field' => 'password',
						'label' => '\'Password\'',
						'rules' => 'required|alpha'
				),
				array(
						'field' => 'lastname',
						'label' => '\'GCSE English Grade\'',
						'rules' => 'alpha'
				),
				array(
						'field' => 'contactNumber',
						'label' => '\'Contact Number\'',
						'rules' => 'numeric|max_length[12]'
				)
				),
		'login' => array(
				array(
						'field' => 'emailId',
						'label' => '\'Username\'',
						'rules' => 'required|valid_email'
				),
				array(
						'field' => 'logpassword',
						'label' => '\'Password\'',
						'rules' => 'required'
				)
				),
		'addSubs' => array(
				array(
						'field' => 'emailId',
						'label' => '\'Email Id\'',
						'rules' => ''
				)
				)
		);