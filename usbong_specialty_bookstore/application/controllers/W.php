<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class W extends MY_Controller {

	public function index($productDetail, $productId)
	{
//		$data['param'] = $this->input->get('param'); //added by Mike, 20170616
		
		//from application/core/MY_Controller
		$this::initStyle();
		$this::initHeader();
		//--------------------------------------------
		
//		$productName = str_replace('-',' ',$param); 
			
		$this->load->model('W_Model');
		$data['result'] = $this->W_Model->getProduct($productId);
//		$data['result'] = $this->W_Model->getProduct($param);
		
		$this->load->view('w', $data);
		
		//--------------------------------------------
		$this->load->view('templates/footer');	
	}
}
