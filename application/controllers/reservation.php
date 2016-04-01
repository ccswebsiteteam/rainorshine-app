<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservation extends MY_Controller {
	public function __construct(){
        parent::__construct();
        
        $this->load->model('reservation_model', 'rm');
        $this->load->model('status_model', 'st');
    }

    public function index() {
    		$this->data['reservations'] = $this->rm->get_all_reservations();
            
            foreach($this->st->get_all_status() as $status) {
                $this->data['statuses'][$status->type] = $status->id;
            }
    }

    public function make_new_reservation() {
    	

    	$this->view = FALSE; // no view... ajax call...
    }

    public function update_reservation_status() {
        if($this->input->post()) {
            print_array($this->input->post());

        }

        $this->view = FALSE; // no view... ajax call...
    }
}