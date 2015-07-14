<?php 
class Gallery extends CI_Controller{
    public function __construct(){    
        parent::__construct();
        $this->load->helper("url");    
    }
    
    public function index(){
        $this->load->model("Mgallery");
        
        if($this->input->post("ok")){
                $this->Mgallery->do_upload();
        }
        $data['images'] = $this->Mgallery->get_images();
        $this->load->view("gallery_view",$data);    
    }
}
?>