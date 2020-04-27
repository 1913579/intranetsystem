<?php
class Student_Model extends CI_model {
    public function getusers($status){
        $this->db->where('ustatus',$status);
        return $this->db->from('user')->count_all_results();
    }
    public function getwork($username){
        $this->db->where('uname',$username);
        $user = $this->db->get('user')->row_array();
        $this->db->select('*');
        $this->db->from('user u');
        $this->db->join('team t','t.user_id = u.id');
        $this->db->join('group g','g.id = t.group_id');
        $this->db->join('work w','w.group_id = g.id');
        $this->db->where('u.id',$user['id']);
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }
    public function getallwork(){
        $this->db->where('is_submitted',1);
        $query = $this->db->get('work');
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        else{
            return false;
        }
    }
    public function submitwork($id,$description,$submit_attachment){
        $this->db->set('submit_desc',$description);
        $this->db->set('submitted_doc',$submit_attachment);
        $this->db->set('is_submitted',1);
        $this->db->where('id',$id);
        $this->db->update('work');
    }
    public function getuserwork($id){
        $this->db->where('id',$id);
        $query = $this->db->get('work');
        return $query->row_array();
    }
    public function submitcomment($work_id,$user_id,$comment){
        $this->db->set('work_id',$work_id);
        $this->db->set('user_id',$user_id);
        $this->db->set('comment',$comment);
        $this->db->insert('comment');
    }
    public function getcomments($work_id){
        $this->db->select('*');
        $this->db->from('user  u');
        $this->db->join('comment c','c.user_id = u.id');
        $this->db->where('c.work_id',$work_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        else{
            return false;
        }
    }
    public function getgroups(){
        $results = $this->db->get('group');
        if($results->num_rows() > 0){
            return $results->result();
        }
    }
    public function addnewgroup($group_name){
        $this->db->set('name',$group_name);
        $this->db->insert('group');
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
     public function assignnewwork($title,$description,$attachment,$group_id){
        $this->db->set('title',$title);
        $this->db->set('description',$description);
        $this->db->set('attachment',$attachment);
        $this->db->set('group_id',$group_id);
        $this->db->insert('work');
    }

}