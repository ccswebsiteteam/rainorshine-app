<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Status_Model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function get_all_status() {
		$query = $this->db->query("SELECT * FROM status_types");

		return ($query->num_rows()) ? $query->result() : FALSE;
	}
}