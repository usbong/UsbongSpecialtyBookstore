<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
/*		$this->load->view('templates/style');
		$this->load->view('templates/header');
*/		
		$this->viewBooksCategory();
/*		$this->load->view('templates/footer');
 */
	}
	
	//---------------------------------------------------------
	// Books Category
	//---------------------------------------------------------
	public function viewBooksCategory()
	{
		$this->load->view('templates/style');
		$this->load->view('templates/header');
		//--------------------------------------------
		
		$data['content'] = 'category/Books';
		$this->load->model('Books_Model');
		$data['books'] = $this->Books_Model->getBooks();
//		$this->load->view('templates/general_template',$data);
		$this->load->view('b/books',$data);

		//--------------------------------------------
		$this->load->view('templates/footer');
	}	
	
	//---------------------------------------------------------
	// COMBOS Category
	//---------------------------------------------------------
	public function viewCombosCategory()
	{
		$this->load->view('templates/style');
		$this->load->view('templates/header');
		//--------------------------------------------
		
		$data['content'] = 'category/Combos';
		$this->load->model('Combos_Model');
		$data['combos'] = $this->Combos_Model->getCombos();
		//		$this->load->view('templates/general_template',$data);
		$this->load->view('b/combos',$data);

		//--------------------------------------------
		$this->load->view('templates/footer');		
	}
	
}
