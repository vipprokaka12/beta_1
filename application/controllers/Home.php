<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Home extends CI_Controller{
	
	public function index()
	{
		$this->load->view('theme/head');	
		$this->load->view('layout/home');
		$this->load->view('theme/footer');			
	}
}
?>