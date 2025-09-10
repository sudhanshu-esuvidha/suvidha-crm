<?php  
 class Common_Model extends CI_Model  
 {

  function __construct()
  {
    parent::__construct();
  }

 public function get_result($table,$columns,$where=array(),$orderby="id asc")
 {
    $this->db->select($columns);
    $this->db->from($table);
    if($where)
    {
      $this->db->where($where);
    }
    if($table!='dert_master_subject_type')
    {
    $this->db->order_by($orderby);
  }
    $query=$this->db->get();
    return $query->result();
 }
  public function get_row($table,$columns,$where=array())
 {
    $this->db->select($columns);
    $this->db->from($table);
    if($where)
    {
      $this->db->where($where);
    }
    $query=$this->db->get();
    return $query->row();
 }
 public function insert($table,$data)
	 {
	 	$this->db->insert($table,$data);
     	return $this->db->insert_id();

	 }
 public function update($table,$data,$where)
	 {
 	 return $this->db->update($table,$data,$where); 
	 }
	  public function delete($table,$where)
	 {
 	 return $this->db->delete($table,$where); 
	 }




}