<?php 
class Toys_and_Collectibles_Model extends CI_Model
{
	public function getToys_and_Collectibles()
	{
		$this->db->select('product_id, name, author, price, quantity_in_stock');
		$this->db->where('product_type_id','8'); //8 is for type: toys & collectibles
		$this->db->order_by('name', 'ASEC');
		$query = $this->db->get('product');
		return $query->result_array();
	}
}
?>