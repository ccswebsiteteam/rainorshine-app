<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Layout 
{
    private $data = array();
    
    public function view($page_path, $page_contents = "", $flag = FALSE)
    {
        $CI = & get_instance();
        
        $this->data["title"] = ucwords(str_replace("_", " ", get_class($CI)));
        $this->data["content"] = $CI->load->view($page_path, $page_contents, TRUE);
        
        return $CI->load->view("layout/index", $this->data, $flag);
    }
}
?>
