<?php 
class Account_Model extends CI_Model
{
	public function registerAccount($param)
	{		
		$data = array(
				'customer_first_name' => $param['firstNameParam'],
				'customer_last_name' => $param['lastNameParam'],
				'customer_email_address' => $param['emailAddressParam'],
				'customer_password' => password_hash($param['passwordParam'], PASSWORD_DEFAULT)
		);
				
		$this->db->insert('customer', $data);
		
		return $this->db->insert_id(); //customer_id
	}
	
	public function doesEmailAccountExist($param) 
	{
		$this->db->select('customer_email_address');
		$this->db->where('customer_email_address',$param['emailAddressParam']);
		$query = $this->db->get('customer');
		$row = $query->row();
		return $row;
	}
	 
	public function loginAccount($param)
	{		
		$this->db->select('customer_password, customer_first_name, customer_email_address, customer_id'); //edited by Mike, 20170626
		$this->db->where('customer_email_address',$param['emailAddressParam']);
		$query = $this->db->get('customer');
		$row = $query->row();
		
		if ($row!==null) {
			if (password_verify($param['passwordParam'], 
					$row->customer_password)) {
				return $row;//->customer_first_name;//"true";
			}
		}
		return null;//"false";
	}	

	public function getCustomerInformation($customerId) {
		$this->db->select('customer_email_address, customer_first_name, customer_last_name, customer_contact_number, customer_shipping_address, customer_city, customer_country, customer_postal_code, mode_of_payment_id, is_admin');
		$this->db->where('customer_id', $customerId);		
		$query = $this->db->get('customer');
		$row = $query->row();
		return $row;
	}
	
	
	public function updateAccount($customerId, $data) {				
		//step 1: change the quantity of all cart rows with the same productId and customerId to 0
		$updateData = array(
				'customer_email_address' => $data['emailAddressParam'],
				'customer_first_name' => $data['firstNameParam'],
				'customer_last_name' => $data['lastNameParam'],
				'customer_contact_number' => $data['contactNumberParam'],
				'customer_shipping_address' => $data['shippingAddressParam'],
				'customer_city' => $data['cityParam'],
				'customer_country' => $data['countryParam'],
				'customer_postal_code' => $data['postalCodeParam'],				
				'mode_of_payment_id' => $data['modeOfPaymentParam']				
		);
		$this->db->where('customer_id', $customerId);
		$this->db->update('customer', $updateData);		
	}

	public function updateAccountPassword($customerId, $data) {
		//step 1: change the quantity of all cart rows with the same productId and customerId to 0
		$updateData = array(
				'customer_password' =>  password_hash($data['newPasswordParam'], PASSWORD_DEFAULT)
		);
		$this->db->where('customer_id', $customerId);
		$this->db->update('customer', $updateData);
	}
	
	public function isCurrentPasswordCorrect($param)
	{				
		$this->db->select('customer_password'); //edited by Mike, 20170626
		$this->db->where('customer_id',$param['customerId']);
		$query = $this->db->get('customer');
		$row = $query->row();
		
		if ($row!==null) {
			if (password_verify($param['currentPasswordParam'],
					$row->customer_password)) {
						return null;//$row;//"true";
			}
		}
		return new stdClass;//null;//"false";
	}
	
	public function getCustomerOrders($customerId) {
		$this->db->select('added_datetime_stamp, quantity, status_accepted, order_total_price');
		$this->db->where('customer_id', $customerId);
		$this->db->where('status_accepted', 1);
		$this->db->order_by('added_datetime_stamp', 'DESC');
		$query = $this->db->get('customer_order');
		return $query->result_array();
	}
	
	public function getCustomerOrdersAdmin() {
		$this->db->select('added_datetime_stamp, customer_id, quantity, status_accepted, order_total_price, fulfilled_status');
		$this->db->where('status_accepted', 1);
		$this->db->order_by('added_datetime_stamp', 'DESC');
		$query = $this->db->get('customer_order');
		return $query->result_array();
	}
		
	public function updateCustomerOrderAdmin($fulfilledStatus, $addedDatetimeStamp, $productCustomerId) {
		$updateData = array(
				'fulfilled_status' => $fulfilledStatus
		);
		$this->db->where('customer_id', $productCustomerId);
		$this->db->where('added_datetime_stamp', $addedDatetimeStamp);		
		$this->db->update('customer_order', $updateData);
	}
	
	public function getCustomerEmailAddress($customerId) {
		$this->db->select('customer_email_address');
		$this->db->where('customer_id', $customerId);
		$query = $this->db->get('customer');
		return $query->row();
	}

	public function getOrderDetails($customerId, $addedDateTimeStamp) {
		$this->db->select('t1.customer_order_id, t1.cart_id, t1.product_id, t1.quantity, t1.price, t3.name, t3.author, t3.product_type_id, t2.order_total_price');
		$this->db->from('cart as t1');
		$this->db->join('customer_order as t2', 't1.customer_order_id = t2.customer_order_id', 'LEFT');
		$this->db->join('product as t3', 't1.product_id = t3.product_id', 'LEFT');	
		$this->db->where('t1.customer_id', $customerId);
		$this->db->where('t2.added_datetime_stamp', $addedDateTimeStamp);		
		$this->db->where('t1.purchased_datetime_stamp', $addedDateTimeStamp);		
		$this->db->order_by('t1.added_datetime_stamp', 'DESC');	
		$query = $this->db->get();
		
		return $query->result_array();		
	}	
	
	public function getOrderDetailsAdmin($customerId, $addedDateTimeStamp) {
		$this->db->select('t1.customer_order_id, t1.cart_id, t1.product_id, t1.quantity, t1.price, t3.name, t3.author, t3.product_type_id, t2.order_total_price, t2.customer_id');
		$this->db->from('cart as t1');
		$this->db->join('customer_order as t2', 't1.customer_order_id = t2.customer_order_id', 'LEFT');
		$this->db->join('product as t3', 't1.product_id = t3.product_id', 'LEFT');
		$this->db->where('t1.customer_id', $customerId);
		$this->db->where('t2.added_datetime_stamp', $addedDateTimeStamp);
		$this->db->where('t1.purchased_datetime_stamp', $addedDateTimeStamp);
		$this->db->order_by('t1.added_datetime_stamp', 'DESC');
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
}
?>