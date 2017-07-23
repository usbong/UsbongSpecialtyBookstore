<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {
/* //orig
	public function index()
	{
		//from application/core/MY_Controller
		$this::initStyle();
		$this::initHeader();
		//--------------------------------------------
		
		
		$this->load->view('contact');
		
		//--------------------------------------------
		$this->load->view('templates/footer');	
	}
*/	
	public function index()
	{
/*		
		$this->load->library('email');
		
		$this->email->from('account-update@usbong.ph', 'Usbong Store');
		$this->email->to('masarapmabuhay@gmail.com');
//		$this->email->cc('another@another-example.com');
//		$this->email->bcc('them@their-example.com');
		
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');
		
		$this->email->send();
*/		
		
		
		
		//from application/core/MY_Controller
		$this::initStyle();
		$this::initHeader();
		//--------------------------------------------
		
		
		$this->load->view('contact');
		
		//--------------------------------------------
		$this->load->view('templates/footer');
	}	
}
