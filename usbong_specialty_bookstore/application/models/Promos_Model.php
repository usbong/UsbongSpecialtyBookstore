<?php 
class Promos_Model extends CI_Model
{
	public function getPromos()
	{
		$this->db->select('product_id, name, author, price, quantity_in_stock');
		$this->db->where('product_type_id','5'); //5 is for type: combos
		$this->db->order_by('name', 'ASEC');
		$query = $this->db->get('product');
		return $query->result_array();
	}
}
?>