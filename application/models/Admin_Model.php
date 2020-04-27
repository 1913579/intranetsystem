<?php
class Admin_Model extends CI_model {
    public function addnewgroup($group_name){
        $this->db->set('name',$group_name);
        $this->db->insert('group');
    }
    public function getgroups(){
        $results = $this->db->get('group');
        if($results->num_rows() > 0){
            return $results->result();
        }
    }
    public function getteam($id){
        $this->db->select('*');
        $this->db->from('user a'); 
        $this->db->join('team b', 'b.user_id=a.id');
        $this->db->where('b.group_id',$id);
        $result = $this->db->get();
        if($result->num_rows()>0){
            return $result->result_array();
        }
    }
    public function getgroup($id){
        $this->db->where('id',$id);
        $result = $this->db->get('group');
        return $result->result();
    }
    public function submitnewuser($username,$password,$first_name,$last_name,$email,$level,$file){
        $this->db->set('uname',$username);
        $this->db->set('upass',$password);
        $this->db->set('ustatus',$level);
        $this->db->set('uphoto',$file);
        $this->db->insert('user');

    }
    public function userinTeam($uid,$pid){
        $this->db->where('user_id',$uid);
        $this->db->where('group_id',$pid);
        if($this->db->get('team')->num_rows()>0){
        return true;
        }else{
        return  false;
        }
    }
    public function insertmem($data){
        $this->db->set('user_id',$data['uid']);
        $this->db->set('group_id',$data['pid']);
        if($this->db->insert('team')){
            return $this->db->insert_id();
            }else{
                return false;
            }
    }
    public function getuser($id){
        $this->db->where('id',$id);
        $results = $this->db->get('user');
        if($results->num_rows() > 0){
            return $results->result();
        }
        else{ 
            return false;
        }
    }
    public function deletemem($tid){
        $this->db->where('id',$tid);
        $result=$this->db->get('team')->result();
        foreach($result as $key=>$r){
            $uid=$r->user_id;
            $pid=$r->group_id;
            $this->db->where('id',$pid);
            $rows=$this->db->get('group')->result();
            foreach($rows as $key=>$row){
                $user=$row->t_lead;
                if($user==$uid){
                    $this->db->where('id',$pid);
                    $data['t_lead']=0;
                    $this->db->update('group',$data);
                }
            }
        }
                $this->db->where('id',$tid);
                if($this->db->delete('team')){
                return true;
            }else{
                    return false;
                }
    }
    public function teamlead($tid){
        $this->db->where('id',$tid);
        $result=$this->db->get('team')->result();
        foreach($result as $key=>$row){
        $pid=$row->group_id;
        $uid=$row->user_id;
        $data['t_lead']=$uid;
        $this->db->where('id',$pid);
       $query=$this->db->get('group')->result();
       foreach($query as $r){
        $t_lead=$r->t_lead;
       echo $t_lead;
       if($t_lead==0){
        $this->db->where('id',$pid);
        if($this->db->update('group',$data)){
        return true;
        }else{
        return false;
        }
    }else{
      
      $this->db->where('id',$pid);
      
        if($this->db->update('group',$data)){
        
        }else{
        return false;
        }

    }
         } }  
    }
    public function gettotalusers(){
        return $this->db->from("user")->count_all_results();
    }
    public function getusers($status){
        $this->db->where('ustatus',$status);
        return $this->db->from("user")->count_all_results();
    }
    public function deletegroup($id){
        $this->db->where('group_id',$id);
        $this->db->delete('team');
        $this->db->where('id',$id);
        $this->db->delete('group');
    }
    public function assignnewwork($title,$description,$attachment,$group_id){
        $this->db->set('title',$title);
        $this->db->set('description',$description);
        $this->db->set('attachment',$attachment);
        $this->db->set('group_id',$group_id);
        $this->db->insert('work');
    }

}
?>