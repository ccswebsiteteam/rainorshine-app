<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct(){
        parent::__construct();
        
        $this->load->model('reservation_model', 'rm');
    }

	public function index() {
		// echo generate_reference_number();
		// print_array($this->rm->remove_reservation(4));
	}
}
