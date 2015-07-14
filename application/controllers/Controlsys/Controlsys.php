<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Controlsys extends CI_Controller{
	protected $token_prefix='-login_control_user';
	protected $login_mess='';
	protected $user_data;
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
	}
	public function logout()
	{
		unset($_SESSION);
	}
	
	public function index()
	{
		$this->load->library('form_validation');
		$this->load->model('Muser');
		if(isset($_SESSION['user_data'])){
			$user_data=$_SESSION['user_data'];
			$check=$this->Muser->checkuser($user_data['user_name'],$user_data['user_pass']);
			$data_layout['form_lg']='';
			$data_layout['form_ms']=false;
		}else{
			$config = array(
						array(
								'field' => 'user_name',
								'label' => 'Username',
								'rules' => 'required'
						),
						array(
								'field' => 'user_pass',
								'label' => 'Password',
								'rules' => 'required'
						)
			);

			$this->form_validation->set_rules($config);	
			if ($this->form_validation->run() == FALSE)
			{
				 $data_layout['form_lg']=$this->form_register();
				 if((isset($_POST['user_name']) && isset($_POST['user_pass'])) &&($_POST['user_name']=='' || $_POST['user_pass']=='')) { 
					$this->login_mess='Username and Password not null';
				 }
				 $data_layout['form_ms']=$this->login_mess;
			}
			else
			{	 
				 $data_layout['form_lg']='';
				 $data_layout['form_ms']=false;
				 $check_u=$this->form_check_input($_POST['user_name'],$_POST['user_pass'],$_POST['token']);
				 if($check_u==false){
					 $data_layout['form_ms']=$this->login_mess;
					 $data_layout['form_lg']=$this->form_register();
				 }
			}
		}
		$this->load->view('admin/head',$data_layout);	
		$this->load->view('admin/control_login',$data_layout);
		$this->load->view('admin/footer');			
	}
	protected function form_check_input($u,$p,$tk){
		if($tk==md5(date('d').$this->token_prefix)){
			$this->load->model('Muser')	;
			$check=$this->Muser->checkuser($u,$p);
			if($check!=false){
				$_SESSION['user_data']=$check[0];
				return true;
			}else{
				$this->login_mess='Username and Password not null';
				return false;
			}
		}else{
			 $this->login_mess='Error Login';
			return false;
		}
	}
	
	protected function form_register()
	{	
		
		$token_rg=md5(date('d').$this->token_prefix);
		$form_attributes = array('class' => 'navbar-form  ', 'id' => 'signin','role'=>'form');
		$hidden_f=array('token'=>$token_rg);
		$form_output = '<div class="col-md-6 navbar-right">'.form_open('',$form_attributes,$hidden_f);
		$user_name = array(
				'name'  => 'user_name',
				'id'    => 'username',
				'placeholder' => 'Email/User Name',
				'class' => 'form-control',
				'size'          => '150',
			
		);
		$form_output .='<div class="col-md-12"><div class="form-group col-md-5"><div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>'.form_input($user_name).'</div></div>';
		$user_password=array(
				'name'=>'user_pass',
				'id'    => 'userpass',
				'placeholder' => 'Password',
				'size'          => '150',
				'class' => 'form-control'
		);
		$form_output .='<div class="form-group col-md-5"><div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>'.form_password($user_password).'</div></div>';
		
		$data_btsm=array(
			'name'=>'re_sm',
			'class'=>'btn btn-primary',
			'value'=>'Login',
		);
		$form_output .='<div class="col-md-2">'.form_submit($data_btsm).'</div></div>';
		$form_output .=form_close().'</div>';
		return $form_output;
	}
	
	public function setup_info(){
		//$this->load->view('admin/head',$data_layout);	
		$this->load->helper('editor');
		$this->editor('mytextarea')
		$this->load->view('admin/setup_info');
		//$this->load->view('admin/footer');	
	}
}
?>