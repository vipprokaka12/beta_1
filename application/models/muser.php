<?php 
class Muser extends CI_Model{
	protected $user_table;
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->user_table=$this->db->dbprefix('user');
	}
	public function listall(){
        $query=$this->db->get(DB_PREFIX."_user");
        return $query->result_array();
    }
	public function checkuser($u,$p)
	{
		$this->db->select('*');
		$this->db->where('user_name',$u);
		$this->db->where('user_pass',md5($p));
		$query=$this->db->get($this->user_table);
		
		if($query->num_rows()==1)
		{
			return $query->result_array();
		}else{
			return false;
		}
	}
}
?>