<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservation_Model extends CI_Model {
	public function __construct() {
		parent::__construct();

		$this->load->model('customer_detail_model', 'custdm');
		$this->load->model('reservation_detail_model', 'resdm');
	}

	public function get_all_reservations() {
		$query = $this->db->query("SELECT rd.id as r_id, rd.*, cud.*, cad.*, ct.*, st.type as st_type FROM reservation_details as rd 
			INNER JOIN customer_details as cud ON cud.id = rd.customer_detail_id 
			INNER JOIN car_details as cad ON cad.id = rd.car_detail_id 
			INNER JOIN car_types as ct ON ct.id = cad.car_type_id 
			INNER JOIN status_types as st ON st.id = rd.status_type_id");

		return ($query->num_rows()) ? $query->result() : FALSE;
	}

	public function get_reservation_by_reference_number($reference_number) {
		$query = $this->db->query("SELECT rd.*, cud.*, cad.*, ct.* FROM reservation_details as rd 
			INNER JOIN customer_details as cud ON cud.id = rd.customer_detail_id 
			INNER JOIN car_details as cad ON cad.id = rd.car_detail_id 
			INNER JOIN car_types as ct ON ct.id = cad.car_type_id 
			INNER JOIN status_types as st ON st.id = rd.status_type_id
			WHERE rd.reference_number = '$reference_number' 
			LIMIT 1");

		return ($query->num_rows()) ? $query->row() : FALSE;
	}

	public function add_new_reservation($customer_detail, $reservation_detail) {
		$this->db->trans_begin();
		
		$customer_detail_id = $this->custdm->add_new_customer_detail($customer_detail);
		if($this->db->trans_status() && $customer_detail_id) {
			$reservation_detail_id = $this->resdm->add_new_reservation_detail($reservation_detail);
			if($this->db->trans_status() && $reservation_detail_id)
				$this->db->trans_commit();
		}

		$this->db->trans_rollback();
	}

	public function remove_reservation($reservation_detail_id) {
		$this->db->trans_begin();

		$reservation_detail = $this->resdm->get_reservation_detail_by_id($reservation_detail_id);
		if($reservation_detail) {
			if($this->resdm->remove_reservation_detail($reservation_detail_id) && $this->db->trans_status())
				if($this->custdm->remove_customer_detail($reservation_detail->customer_detail_id) && $this->db->trans_status())
					$this->db->trans_commit();

			$this->db->trans_rollback();
		}
	}
}