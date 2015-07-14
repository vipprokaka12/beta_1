<?php
class Mgallery extends CI_Model{
    protected $_gallery_path = "";
    protected $_gallery_url = "";
    public function __construct(){
        parent::__construct();
        //L?y du?ng d?n url c?a thu m?c ch?a h�nh ?nh du?c upload
        $this->_gallery_url = base_url()."public/images/";
        //L?y du?ng d?n v?t l� c?a thu m?c ch?a h�nh ?nh duoc upload
        $this->_gallery_path = realpath(APPPATH. "../public/images");
    }
    
    //h�m th?c hi?n c�ng vi?c upload v� resize l?i h�nh ?nh
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
        //k?t th�c c�ng do?n upload h�nh ?nh
        
        $config = array("source_image" => $image_data['full_path'],
                        "new_image" => $this->_gallery_path . "/thumbs",
                        "maintain_ration" => true,
                        "width" => '150',
                        "height" => "100");
        $this->load->library("image_lib",$config);
        $this->image_lib->resize();
        //k?t th�c c�ng do?n resize l?i h�nh ?nh                
    }
    
    
    //h�m l?y h�nh ?nh t? thu m?c luu file d� upload
    public function get_images(){
        $file = scandir($this->_gallery_path);
        $file = array_diff($file, array('.', '..', 'thumbs'));
        //t�n t?t c? c�c file h�nh trong thu m?c d� du?c upload l�n.
        
        
        $images = array();
        foreach($file as $img){
            $images[] = array("url"        => $this->_gallery_url . $img,
                              "thumb_url" => $this->_gallery_url . "thumbs/" . $img);    
        }
        return $images;
    }
}