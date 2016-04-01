<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservation_Detail_Model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function add_new_reservation_detail($reservation_detail) {
		$this->db->insert('reservation_details', $reservation_detail);

		return ($this->db->affected_rows()) ? $this->db->insert_id() : FALSE;
	}

	public function update_reservation_detail($reservation_details) {
		$this->db->where('id', $reservation_details['id']);
		$this->db->update('reservation_details', $reservation_details);

		return ($this->db->affected_rows()) ? TRUE : FALSE;
	}

	public function remove_reservation_detail($reservation_detail_id) {
		$this->db->query("DELETE FROM reservation_details WHERE id = $reservation_detail_id");
		
		return ($this->db->affected_rows()) ? TRUE : FALSE;
	}

	public function get_reservation_detail_by_id($reservation_detail_id) {
		$query = $this->db->query("SELECT * FROM reservation_details WHERE id = $reservation_detail_id LIMIT 1");
		
		return ($query->num_rows()) ? $query->row() : FALSE;
	}
}