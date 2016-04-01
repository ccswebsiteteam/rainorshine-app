<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat_Model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function get_all_chat_messages() {
		$query = $this->db->query("SELECT * FROM chat_messages");

		return ($query->num_rows()) ? $query->result() : FALSE;
	}

	public function add_new_chat_message($chat_message_detail) {
		$this->db->insert('chat_messages', $chat_message_detail);

		return ($this->db->affected_rows()) ? $this->db->insert_id() : FALSE;
	}
}