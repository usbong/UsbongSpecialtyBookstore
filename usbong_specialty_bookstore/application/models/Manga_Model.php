<?php 
class Manga_Model extends CI_Model
{
	public function getManga()
	{
		$this->db->select('product_id, name, author, price, quantity_in_stock');
		$this->db->where('product_type_id','7'); //7 is for type: manga
		$this->db->order_by('name', 'ASEC');
		$query = $this->db->get('product');
		return $query->result_array();
	}
}
?>