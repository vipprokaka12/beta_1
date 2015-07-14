<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Register extends CI_Controller{
	
	public function index()
	{
		
		$this->load->library('form_validation');
		
		$config = array(
						array(
								'field' => 'user_pass',
								'label' => 'Password',
								'rules' => 'required',
								'errors' => array(
										'required' => 'You must provide a %s.',
								),
						),
						array(
								'field' => 'user_repass',
								'label' => 'Password Confirmation',
								'rules' => 'required'
						),
						array(
								'field' => 'user_email',
								'label' => 'Email',
								'rules' => 'required'
						)
		);

		$this->form_validation->set_rules($config);	
		$this->form_validation->set_rules('user_name','Tên đăng nhập ','callback_usernamecheck'); 
		if ($this->form_validation->run() == FALSE)
        {
			
             $data_layout['form_re']=$this->form_register();
        }
        else
        {
             $data_layout['form_re']='Sussece';
        }
		
		$this->load->view('theme/head');	
		$this->load->view('layout/register',$data_layout);
		$this->load->view('theme/footer');			
	}
	public function usernamecheck($u){
		 
		 $this->form_validation->set_message('usernamecheck', '%s đã được đăng ký.');
		 return false; 
	}
	protected function form_register()
	{	
		
		$token_rg=md5(date('d').'-rigester_user');
		$form_attributes = array('class' => 'register_f', 'id' => 'footer-form');
		$hidden_f=array('token'=>$token_rg);
		$form_output = form_open('',$form_attributes,$hidden_f);
		
		$user_name = array(
				'name'  => 'user_name',
				'id'    => 'username',
				'placeholder' => 'username',
				'class' => 'form-control',
				'size'          => '150',
		);
		$form_output .=form_input($user_name);
		$form_output .=form_error('user_name');     
		$user_password=array(
				'name'=>'user_pass',
				'id'    => 'userpass',
				'placeholder' => 'password',
				'size'          => '150',
				'class' => 'form-control'
		);
		$form_output .=form_password($user_password);
		
		$user_repassword=array(
				'name'=>'user_repass',
				'id'    => 'userrepass',
				'placeholder' => 're-password',
				'size'          => '150',
				'class' => 'form-control'
		);
		$form_output .=form_password($user_repassword);
		
		$user_email = array(
				'name'  => 'user_email',
				'id'    => 'useremail',
				'placeholder' => 'user@example.com',
				'class' => 'form-control',
				'size'          => '250',
		);
		$form_output .=form_input($user_name);
		
		$data_btsm=array(
			'name'=>'re_sm',
			'class'=>'btn btn-default',
			'value'=>'Register',
		);
		$form_output .=form_submit($data_btsm);
		$form_output .=form_close();
		return $form_output;
	}
}
?>