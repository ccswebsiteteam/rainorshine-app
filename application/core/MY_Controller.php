<?php date_default_timezone_set('Asia/Manila');

//http://jamieonsoftware.com/journal/2011/3/18/extending-codeigniters-controller.html
    
class MY_Controller extends CI_Controller{
    protected $data;
    protected $view;
    protected $datetime;
    protected $class_name;
    protected $method_name;
    protected $enable_layout;
    private $arguments_slice;

    /*
     * Remap the CI request, running the method and loading the view
     */
     public function _remap($method, $arguments){
        $this->class_name = ucwords(get_class($this));
        $this->method_name = $method;
        $this->datetime = new DateTime();
        $this->enable_layout = FALSE;
		// $is_authorized = $this->authorization->is_authorized($this->class_name, $method);
        $is_authorized = TRUE;  // @TODO - change in the future
        
        if(method_exists($this, $method) && $is_authorized){ 
            $arguments_slice = array_slice($this->uri->rsegments, 2);
            call_user_func_array(array($this, $this->method_name), $arguments_slice);
            $this->arguments_slice = $arguments_slice;
        }else{
            redirect('error');
        }
        
        $this->_load_view();
     }
     
    /*
     * Load a view into a layout based on controller and method name
     */
    private function _load_view() {
        // Back out if we've explicitly set the view to FALSE
        if ($this->view === FALSE) { return; }

        // Get or automatically set the view and layout name
        $view = ($this->view !== null) ? $this->view: $this->router->directory . $this->router->class . '/' . $this->router->method . '.php';
        // $layout = ($this->layout !== null) ? $this->layout:'page_layout/layout';
        
        
        // $this->data['links'] = create_breadcrumb();

        // Load the view into the data
        if($this->view === null || $this->enable_layout){
            $this->data['class_name'] = $this->class_name;
            $this->layout->view($view, $this->data);
        }
        else{
            $this->load->view($view, $this->data);
        }

        // Display the layout with the view
        // $this->load->view($layout, $this->data);
    }
}

?>
