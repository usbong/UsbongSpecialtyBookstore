<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function login()//$param)
	{
//		$data['param'] = $this->input->get('param'); //added by Mike, 20170616
		
		//from application/core/MY_Controller
		$this::initStyle();
		$this::initHeader();
		//--------------------------------------------
		
/*		
		$this->load->library('session');
		$this->load->library('form_validation');
*/		
/*				
		$fields = array('emailAddressParam', 'passwordParam');
		
		foreach ($fields as $field)
		{
			$data[$field] = $_POST[$field];
		}
		
		$this->load->model('Account_Model');
		$data['is_login_success'] = $this->Account_Model->loginAccount($data);
*/				
		$this->load->view('account/login');
		
		//--------------------------------------------
		$this->load->view('templates/footer');	
	}
	
	public function ordersummary() {
		$customer_id = $this->session->userdata('customer_id');
		
		if (!isset($customer_id)) {
			redirect('account/login'); //home page
		}
		
		//from application/core/MY_Controller
		$this::initStyle();
		$this::initHeader();
		//--------------------------------------------
		
		
		$this->load->model('Account_Model');
		$data['order_summary'] = $this->Account_Model->getCustomerOrders($customer_id);

		$data['customer_email_address'] = $this->Account_Model->getCustomerEmailAddress($customer_id)->customer_email_address;
		
		$this->load->view('account/ordersummary', $data);
		
		//--------------------------------------------
		$this->load->view('templates/footer');	
	}
	
	public function ordersummaryadmin() {
		$customer_id = $this->session->userdata('customer_id');
		$is_admin = $this->session->userdata('is_admin');		
		
		if ((!isset($customer_id)) ||
//			($customer_id!="12")) {
			($is_admin!="1")) {			
				redirect('account/login'); //home page
		}
				
		//from application/core/MY_Controller
		$this::initStyle();
		$this::initHeader();
		//--------------------------------------------
		
		$this->load->model('Account_Model');
		$fulfilled_status = $this->uri->segment(3);
		if ($fulfilled_status!==null) {			
			date_default_timezone_set('Asia/Hong_Kong');			
			$addedDateTimeStamp = date('Y-m-d H:i:s', $this->uri->segment(4));			
			$productCustomerId = $this->uri->segment(5);
			
			$this->Account_Model->updateCustomerOrderAdmin($fulfilled_status, $addedDateTimeStamp, $productCustomerId);			
		}
						
		$data['order_summary'] = $this->Account_Model->getCustomerOrdersAdmin();
		
		$data['customer_email_address'] = $this->Account_Model->getCustomerEmailAddress($customer_id)->customer_email_address;
		
		$this->load->view('account/ordersummaryadmin', $data);
		
		//--------------------------------------------
		$this->load->view('templates/footer');
	}
	
	public function orderdetails() {
		$customer_id = $this->session->userdata('customer_id');
		
		if (!isset($customer_id)) {
			redirect('account/login'); //home page
		}
		
		//from application/core/MY_Controller
		$this::initStyle();
		$this::initHeader();
		//--------------------------------------------

		date_default_timezone_set('Asia/Hong_Kong');
		$addedDateTimeStamp = date('Y-m-d H:i:s', $this->uri->segment(3));		
//		echo 'hello '.$addedDateTimeStamp.'<br>';

		$this->load->model('Account_Model');
		$data['order_details'] = $this->Account_Model->getOrderDetails($customer_id, $addedDateTimeStamp);
		
		$data['result'] = $this->Account_Model->getCustomerInformation($customer_id);		
		
		$this->load->view('account/orderdetails', $data);

		//--------------------------------------------
		$this->load->view('templates/footer');
	}
	
	public function orderdetailsadmin() {
		$customer_id = $this->session->userdata('customer_id');
		$is_admin = $this->session->userdata('is_admin');
		
		if ((!isset($customer_id)) ||
//			($customer_id!="12")) {
			($is_admin!="1")) {
				redirect('account/login'); //home page
		}
				
		//from application/core/MY_Controller
		$this::initStyle();
		$this::initHeader();
		//--------------------------------------------
		
		date_default_timezone_set('Asia/Hong_Kong');
		$addedDateTimeStamp = date('Y-m-d H:i:s', $this->uri->segment(3));
//		echo 'hello '.$addedDateTimeStamp.'<br>';
		
		$product_customer_id = $this->uri->segment(4);
		
		$this->load->model('Account_Model');
		$data['order_details'] = $this->Account_Model->getOrderDetailsAdmin($product_customer_id, $addedDateTimeStamp);
		
		$data['result'] = $this->Account_Model->getCustomerInformation($product_customer_id);
		
		$this->load->view('account/orderdetailsadmin', $data);
		
		//--------------------------------------------
		$this->load->view('templates/footer');
	}
	
	public function logout() {
		session_destroy();
		
		redirect(''); //home page		
	}
	
	public function create()
	{
		//from application/core/MY_Controller
		$this::initStyle();
		$this::initHeader();
		//--------------------------------------------
		
		$this->load->library('session');
		$this->load->library('form_validation');
		
		/*
		 $this->load->model('Cart_Model');
		 $data['result'] = $this->Cart_Model->getCart();//$this->input->post('customer'));//$param);
		 */
		$this->load->view('account/create');
		
		//--------------------------------------------
		$this->load->view('templates/footer');
	}	

	public function settings()
	{
		$customer_id = $this->session->userdata('customer_id');
		
		if (!isset($customer_id)) {
			redirect('account/login'); //home page			
		}
		
		//from application/core/MY_Controller
		$this::initStyle();
		$this::initHeader();
		//--------------------------------------------
		
		$this->load->library('session');
		$this->load->library('form_validation');
		
		$this->load->model('Account_Model');
		$data['result'] = $this->Account_Model->getCustomerInformation($customer_id);
				
		$this->load->view('account/settings', $data);
		
		//--------------------------------------------
		$this->load->view('templates/footer');
	}
	
	public function save()
	{				
		$customer_id = $this->session->userdata('customer_id');

		$this->form_validation->set_rules('emailAddressParam', 'Email Address', 'valid_email|trim|required');
		$this->form_validation->set_rules('firstNameParam', 'First Name', 'trim|required');
		$this->form_validation->set_rules('lastNameParam', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('contactNumberParam', 'Contact Number', 'trim|required|numeric');
		$this->form_validation->set_rules('shippingAddressParam', 'Shipping Address', 'trim|required');
		$this->form_validation->set_rules('cityParam', 'City', 'trim|required');
		$this->form_validation->set_rules('countryParam', 'Country', 'trim|required');
		$this->form_validation->set_rules('postalCodeParam', 'Postal Code', 'trim|required|numeric');
		
		$fields = array('emailAddressParam', 'firstNameParam', 'lastNameParam', 'contactNumberParam', 'shippingAddressParam', 'cityParam', 'countryParam', 'postalCodeParam', 'modeOfPaymentParam');
		
		foreach ($fields as $field)
		{
			$data[$field] = $_POST[$field];
		}
				
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('errors', validation_errors());
			$this->session->set_flashdata('data', $data);
			
			//from application/core/MY_Controller
			$this::initStyle();
			$this::initHeader();
			//--------------------------------------------
			
			$this->load->library('session');
			$this->load->library('form_validation');
									
			$this->load->view('account/settings');
			
			//--------------------------------------------
			$this->load->view('templates/footer');
		}
		else
		{
			/*
			 $this->load->model('Account_Model');
			 $this->Account_Model->registerAccount($data);
			 
			 //added by Mike, 20170624
			 $newdata = array(
			 'customer_first_name'  => $data['firstNameParam'],
			 'customer_email_address'     => $data['emailAddressParam'],
			 'logged_in' => TRUE
			 );
			 $this->session->set_userdata($newdata);
			 
			 $this::initStyle();
			 $this::initHeader();
			 
			 //--------------------------------------------
			 
			 $this->load->model('Books_Model');
			 $data['books'] = $this->Books_Model->getBooks();
			 $this->load->view('b/books',$data);
			 
			 //--------------------------------------------
			 $this->load->view('templates/footer');
			 */
//			echo "OK! Success!";
/*			
			$this->session->set_flashdata('data', $data);
			
			$newdata = array(
					'customer_id'  => $customer_id
			);
			$this->session->set_userdata($newdata);
*/			
/*			
//			$customer_id = $this->session->userdata('customer_id');
			
			//from application/core/MY_Controller
			$this::initStyle();
			$this::initHeader();
			//--------------------------------------------
			
			$this->load->library('session');
			$this->load->library('form_validation');
			
			$this->load->model('Account_Model');
			$this->Account_Model->updateAccount($customer_id, $data);
			
			$this->load->view('account/settings');
			
			//--------------------------------------------
			$this->load->view('templates/footer');			
*/
			$this->load->model('Account_Model');
			$this->Account_Model->updateAccount($customer_id, $data);
			
			$this->settings();
		}
	}	

	public function updatepassword() {
		$this->updatepasswordWith(null);
	}
	
	public function updatepasswordWith($param)
	{
		//from application/core/MY_Controller
		$this::initStyle();
		$this::initHeader();
		//--------------------------------------------
		
		
		 $this->load->library('session');
		 $this->load->library('form_validation');
		
		/*
		 $fields = array('emailAddressParam', 'passwordParam');
		 
		 foreach ($fields as $field)
		 {
		 $data[$field] = $_POST[$field];
		 }
		 
		 $this->load->model('Account_Model');
		 $data['is_login_success'] = $this->Account_Model->loginAccount($data);
		 */
		 		 		 
		$data['is_update_password_successful'] = $param;
		$this->load->view('account/updatepassword', $data);
		
		//--------------------------------------------
		$this->load->view('templates/footer');
	}
	
	public function savepassword()
	{
		$customer_id = $this->session->userdata('customer_id');
		
		$this->form_validation->set_rules('currentPasswordParam', 'Current Password', 'trim|required');
		$this->form_validation->set_rules('newPasswordParam', 'New Password', 'trim|required');
		$this->form_validation->set_rules('confirmNewPasswordParam', 'Confirm New Password', 'trim|required|matches[newPasswordParam]');
		
		$fields = array('currentPasswordParam', 'newPasswordParam', 'confirmNewPasswordParam');
		
		foreach ($fields as $field)
		{
			$data[$field] = $_POST[$field];
		}
		
		$data['customerId'] = $customer_id;
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('errors', validation_errors());
			$this->session->set_flashdata('data', $data);
			
			$this->updatepassword();			
		}
		else
		{			
			$this->load->model('Account_Model');
			$data['password_is_incorrect'] = $this->Account_Model->isCurrentPasswordCorrect($data);
			
			if (isset($data['password_is_incorrect'])) {
				$this->session->set_flashdata('data', $data);				
				$this->updatepassword();				
			}
			else {
				$this->Account_Model->updateAccountPassword($customer_id, $data);				
				$this->updatepasswordWith("success");				
			}			
		}
	}	
}
