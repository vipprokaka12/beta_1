<?php
class Mgallery extends CI_Model{
    protected $_gallery_path = "";
    protected $_gallery_url = "";
    public function __construct(){
        parent::__construct();
        //L?y du?ng d?n url c?a thu m?c ch?a hình ?nh du?c upload
        $this->_gallery_url = base_url()."public/images/";
        //L?y du?ng d?n v?t lı c?a thu m?c ch?a hình ?nh duoc upload
        $this->_gallery_path = realpath(APPPATH. "../public/images");
    }
    
    //hàm th?c hi?n công vi?c upload và resize l?i hình ?nh
    public function do_upload(){
        $config = array('upload_path'   => $this->_gallery_path,
                        'allowed_types' => 'gif|jpg|png',
                        'max_size'      => '2000');
        $this->load->library("upload",$config);
        if(!$this->upload->do_upload("img")){
            $error = array($this->upload->display_errors());
        }else{
            $image_data = $this->upload->data();    
        }
        //k?t thúc công do?n upload hình ?nh
        
        $config = array("source_image" => $image_data['full_path'],
                        "new_image" => $this->_gallery_path . "/thumbs",
                        "maintain_ration" => true,
                        "width" => '150',
                        "height" => "100");
        $this->load->library("image_lib",$config);
        $this->image_lib->resize();
        //k?t thúc công do?n resize l?i hình ?nh                
    }
    
    
    //hàm l?y hình ?nh t? thu m?c luu file dã upload
    public function get_images(){
        $file = scandir($this->_gallery_path);
        $file = array_diff($file, array('.', '..', 'thumbs'));
        //tên t?t c? các file hình trong thu m?c dã du?c upload lên.
        
        
        $images = array();
        foreach($file as $img){
            $images[] = array("url"        => $this->_gallery_url . $img,
                              "thumb_url" => $this->_gallery_url . "thumbs/" . $img);    
        }
        return $images;
    }
}