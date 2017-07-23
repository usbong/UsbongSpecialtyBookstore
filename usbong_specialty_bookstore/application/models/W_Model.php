<?php 
class W_Model extends CI_Model
{
	public function getProduct($param)
	{
		$this->db->select('name, author, price, product_overview, product_id, product_type_id, quantity_in_stock');
		$this->db->where('product_id', $param);
		$query = $this->db->get('product');
		return $query->row();
	}
}
?>