<?php
class login_model extends CI_model {
  public function checkUser($uname,$upass){
$this->db->where('uname',$uname);
$this->db->where('upass',$upass);
if($this->db->get('user')->num_rows()!=0){
 return 1;
}else{
    return 0;
}
  }
  
public function checkAccess($uname){
    $this->db->where('uname',$uname);
    $resultusers=$this->db->get('user')->result();
    foreach($resultusers as $key=>$ru){
    return $ru->ustatus;
    }
}

}
?>