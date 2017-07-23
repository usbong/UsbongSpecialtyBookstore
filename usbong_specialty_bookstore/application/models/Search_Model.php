<?php 
class Search_Model extends CI_Model
{
	public function getSearchResult($param)
	{
		//edited by Mike, 20170624
		$splitParamArray = explode(" ", $param);		
	
		$this->db->select('name, author, price, product_overview, product_id, quantity_in_stock, product_type_id');
		
		foreach ($splitParamArray as $value) {
			$this->db->like('name', $value);
			$this->db->or_like('author', $value);			
		}
		$query = $this->db->get('product');
		
/*		
		$this->db->select('product_id, name, author, price, product_type_id');
		$this->db->like('name', $splitParam); 
		$this->db->or_like('author', $splitParam); 
		$query = $this->db->get('product');
*/		
		return $query->result_array();		
	}
}
?>