<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_Detail_Model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function add_new_customer_detail($customer_detail) {
		$this->db->insert('customer_details', $customer_detail);

		return ($this->db->affected_rows()) ? $this->db->insert_id() : FALSE;
	}

	public function update_customer_detail_by_id($customer_detail) {
		$this->db->where('id', $customer_detail['id']);
		$this->db->update('customer_details', $customer_detail);

		return ($this->db->affected_rows()) ? TRUE : FALSE;
	}

	public function remove_customer_detail($customer_detail_id) {
		$this->db->query("DELETE FROM customer_details WHERE id = $customer_detail_id");
		
		return ($this->db->affected_rows()) ? TRUE : FALSE;
	}
}