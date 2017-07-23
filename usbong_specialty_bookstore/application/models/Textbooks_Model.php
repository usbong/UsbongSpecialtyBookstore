<?php 
class Textbooks_Model extends CI_Model
{
	public function getTextbooks()
	{
//		$this->db->join('account', 'stories.userid = account.id');
		$this->db->select('product_id, name, author, price, quantity_in_stock');
		$this->db->where('product_type_id','9'); //9 is for type: textbooks		
		$this->db->order_by('name', 'ASEC');
		$query = $this->db->get('product');
		return $query->result_array();
	}
}
?>