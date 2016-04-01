<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Car_Detail_Model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function add_new_car_detail($car_detail) {
		$this->db->insert('car_details', $customer_detail);

		return ($this->db->affected_rows()) ? $this->db->insert_id() : FALSE;
	}

	public function update_car_detail_by_id($car_detail) {
		$this->db->where('id', $car_detail['id']);
		$this->db->update('car_details', $car_detail);

		return ($this->db->affected_rows()) ? TRUE : FALSE;
	}

	public function remove_car_detail_by_id($car_detail_id) {
		$this->db->query("DELETE FROM car_details WHERE id = $car_detail_id");
		
		return ($this->db->affected_rows()) ? TRUE : FALSE;
	}
}