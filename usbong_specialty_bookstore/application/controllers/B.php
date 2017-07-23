<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B extends MY_Controller {

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
	public function index()
	{						
/*		
		$this->load->library('session');
		$this->load->library('form_validation');
*/		
		$fields = array('emailAddressParam', 'passwordParam');
				
		foreach ($fields as $field)
		{
			if (isset($_POST[$field])) {
				$data[$field] = $_POST[$field];		
			}
		}
		
		if (isset($data)) {
			$this->load->model('Account_Model');
// 			$data['does_email_exist'] = $this->Account_Model->doesEmailAccountExist($data);

			$data['customer_data'] = $this->Account_Model->loginAccount($data);

			if (isset($data['customer_data'])) {
				//added by Mike, 20170626
				$newdata = array(
							'customer_first_name'  => $data['customer_data']->customer_first_name,
							'customer_email_address'     => $data['customer_data']->customer_email_address,
							'logged_in' => TRUE,
							'customer_id' => $data['customer_data']->customer_id
				);
					
				$this->session->set_userdata($newdata);
				$this->books();
					
// 					$this->home($data);					
			}
			else {
					/*
					 $this->session->set_flashdata('data', $data);
					 redirect('account/login');
					 */
					
				//added by Mike, 20170622
				$data['does_email_exist'] = $this->Account_Model->doesEmailAccountExist($data);
				if (isset($data['does_email_exist'])) { 
						$this->session->set_flashdata('data', $data);
						redirect('account/login');
				}										
				else {					
					echo "<script>
							    alert('Either the email address or password you entered is incorrect. If you pasted your temporary password from an email, please enter it by typing it in instead.');
								window.location.href='/usbong_store/';
						  </script>";
// 					redirect('/'); //return to homepage					
// 					$this->books();
				}
			}				
		}
		else {
			$this->books();		
		}
	}
	
	//---------------------------------------------------------
	// Account Creation Successful
	//---------------------------------------------------------
	public function literature_and_fiction()
	{
		$this->form_validation->set_rules('firstNameParam', 'First Name', 'trim|required');
		$this->form_validation->set_rules('lastNameParam', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('emailAddressParam', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('confirmEmailAddressParam', 'Confirm Email Address', 'required|matches[emailAddressParam]');		
		$this->form_validation->set_rules('passwordParam', 'Password', 'required');
		$this->form_validation->set_rules('confirmPasswordParam', 'Password Confirmation', 'required|matches[passwordParam]');		
		
		$fields = array('firstNameParam', 'lastNameParam', 'emailAddressParam', 'confirmEmailAddressParam', 'passwordParam', 'confirmPasswordParam');
		
		foreach ($fields as $field)
		{
			$data[$field] = $_POST[$field];
		}
		
		if ($this->form_validation->run() == FALSE)
		{
//			$this->load->view('myform');
//			$this->load->view('account/create');			
			$this->session->set_flashdata('errors', validation_errors());
			$this->session->set_flashdata('data', $data);		
// 			redirect('account/create');
			redirect('account/create');			
		}
		else
		{
			$this->load->model('Account_Model');
			$customer_id = $this->Account_Model->registerAccount($data);
			
			//added by Mike, 20170624
			$newdata = array(
					'customer_first_name'  => $data['firstNameParam'],
					'customer_email_address'     => $data['emailAddressParam'],
					'logged_in' => TRUE,
					'customer_id' => $customer_id
			);			
			$this->session->set_userdata($newdata);
/*		
			$this->load->view('templates/style');
			$this->load->view('templates/header');
*/
			//from application/core/MY_Controller
			$this::initStyle();
			$this::initHeader();
			
			//--------------------------------------------
							
			$this->load->model('Books_Model');
			$data['books'] = $this->Books_Model->getBooks();
			$this->load->view('b/books',$data);			

			//--------------------------------------------
			$this->load->view('templates/footer');
		}								
	}
/*
	public function home($data) {
//		$data['customer_first_name'] = $param;
		
		$this->load->view('templates/style');
		$this->load->view('templates/header',$data);
		//--------------------------------------------
		
				
		$this->load->model('Books_Model');
		$data['books'] = $this->Books_Model->getBooks();
		$this->load->view('b/books',$data);
		
		//--------------------------------------------
		$this->load->view('templates/footer');		
	}
*/	
	//---------------------------------------------------------
	// Books Category
	//---------------------------------------------------------
	public function books()
	{					
		//from application/core/MY_Controller
		$this::initStyle();
		$this::initHeader();
		//--------------------------------------------
				
//		$data['content'] = 'category/Books';
		$this->load->model('Books_Model');
		$data['books'] = $this->Books_Model->getBooks();
//		$this->load->view('templates/general_template',$data);
		$this->load->view('b/books',$data);

		//--------------------------------------------
		$this->load->view('templates/footer');
	}	

	//---------------------------------------------------------
	// Textbooks Category
	//---------------------------------------------------------
	public function textbooks()
	{
		//from application/core/MY_Controller
		$this::initStyle();
		$this::initHeader();
		//--------------------------------------------
		
		$this->load->model('Textbooks_Model');
		$data['books'] = $this->Textbooks_Model->getTextbooks();
		$this->load->view('b/textbooks',$data);
		
		//--------------------------------------------
		$this->load->view('templates/footer');
	}
	
	//---------------------------------------------------------
	// PROMOS Category
	//---------------------------------------------------------
	public function promos()
	{
		//from application/core/MY_Controller
		$this::initStyle();
		$this::initHeader();
		//--------------------------------------------
		
//		$data['content'] = 'category/Combos';
		$this->load->model('Promos_Model');
		$data['promos'] = $this->Promos_Model->getPromos();
		//		$this->load->view('templates/general_template',$data);
		$this->load->view('b/promos',$data);

		//--------------------------------------------
		$this->load->view('templates/footer');		
	}
	
	//---------------------------------------------------------
	// BEVERAGES Category
	//---------------------------------------------------------
	public function beverages()
	{
		//from application/core/MY_Controller
		$this::initStyle();
		$this::initHeader();
		//--------------------------------------------
		
		$this->load->model('Beverages_Model');
		$data['beverages'] = $this->Beverages_Model->getBeverages();
		//		$this->load->view('templates/general_template',$data);
		$this->load->view('b/beverages',$data);
		
		//--------------------------------------------
		$this->load->view('templates/footer');
	}
	
	//---------------------------------------------------------
	// COMICS Category
	//---------------------------------------------------------
	public function comics()
	{
		//from application/core/MY_Controller
		$this::initStyle();
		$this::initHeader();
		//--------------------------------------------
		
		$this->load->model('Comics_Model');
		$data['comics'] = $this->Comics_Model->getComics();
		//		$this->load->view('templates/general_template',$data);
		$this->load->view('b/comics',$data);
		
		//--------------------------------------------
		$this->load->view('templates/footer');
	}
	
	//---------------------------------------------------------
	// MANGA Category
	//---------------------------------------------------------
	public function manga()
	{
		//from application/core/MY_Controller
		$this::initStyle();
		$this::initHeader();
		//--------------------------------------------
		
		$this->load->model('Manga_Model');
		$data['manga'] = $this->Manga_Model->getManga();
		//		$this->load->view('templates/general_template',$data);
		$this->load->view('b/manga',$data);
		
		//--------------------------------------------
		$this->load->view('templates/footer');
	}
	
	//---------------------------------------------------------
	// TOYS & COLLECTIBLES Category
	//---------------------------------------------------------
	public function toys_and_collectibles()
	{
		//from application/core/MY_Controller
		$this::initStyle();
		$this::initHeader();
		//--------------------------------------------
		
		$this->load->model('Toys_and_Collectibles_Model');
		$data['toys_and_collectibles'] = $this->Toys_and_Collectibles_Model->getToys_and_Collectibles();
		//		$this->load->view('templates/general_template',$data);
		$this->load->view('b/toys_and_collectibles',$data);
		
		//--------------------------------------------
		$this->load->view('templates/footer');
	}	
}
