<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function initStyle() {		 		
		$this->load->view('templates/style');
	}
	
	public function initHeader() {
		$customer_id = $this->session->userdata('customer_id');

		if ($customer_id!="") {			
			$this->load->model('Account_Model');
			
			$customerInformation = $this->Account_Model->getCustomerInformation($customer_id);
			//$data['customer_first_name'] = $customerInformation->customer_first_name;

			$newdata = array(
					'customer_first_name'  => $customerInformation->customer_first_name,
					'is_admin' => $customerInformation->is_admin
			);
			$this->session->set_userdata($newdata);
			
			$this->load->model('Cart_Model');
			$data['totalItemsInCart'] = $this->Cart_Model->getTotalItemsInCart($customer_id);			
		}	
		else {
			$data['totalItemsInCart'] = 0;			
		}
//		$data['totalItemsInCart']=10;

		$this->load->view('templates/header', $data);		
	}
	
	public function initHeaderWith($data) {
		$this->initHeader();
//		$this->load->view('templates/header', $data);
	}
	
}
