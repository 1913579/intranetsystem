<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Student_Model"); 
	}
    function checkUserAccess(){
        if(!$this->session->userdata('uname')){
         redirect(base_url());
        }else if($this->session->userdata('ustatus')!=2){
            redirect(base_url());   
        }
    }
    public function index(){
        $this->checkUserAccess();
        $this->db->where('uname',$this->session->userdata('uname'));
        $data['user']=$this->db->get('user')->result();
        $data['users'] = $this->db->from("user")->count_all_results();
        $data['professors'] = $this->Student_Model->getusers(1);
        $data['students'] = $this->Student_Model->getusers(2);
        $data['admins'] = $this->Student_Model->getusers(0);
        $this->load->view('student/dashboard',$data);
    }
    public function work(){
        $this->checkUserAccess();
        $this->db->where('uname',$this->session->userdata('uname'));
        $data['user']=$this->db->get('user')->result();
        $data['works'] = $this->Student_Model->getwork($this->session->userdata('uname'));
        $this->load->view('student/work',$data);
    }
    public function allstudentwork(){
        $this->checkUserAccess();
        $this->db->where('uname',$this->session->userdata('uname'));
        $data['user']=$this->db->get('user')->result();
        $data['works'] = $this->Student_Model->getallwork();
        $this->load->view('student/allstudentwork',$data);
    }
    public function submitwork($id){
        $this->checkUserAccess();
        $this->db->where('uname',$this->session->userdata('uname'));
        $data['user']=$this->db->get('user')->result();
        $data['work_id'] = $id;
        $this->load->view('student/submitwork',$data);
    }
    public function submitstudentwork($id){
        $this->checkUserAccess();
        $description = $this->input->post('description');
        $this->db->where('uname',$this->session->userdata('uname'));
        $user=$this->db->get('user')->result(); 
         $config = [
            'allowed_types' => 'txt|docx|png|jpg|jpeg',
            'upload_path' => './assets/documents/',
            'encrypt_name' => TRUE
        ];

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        if (!$this->upload->do_upload('attachment')){
            // If the upload fails
            echo $this->upload->display_errors();
        }
        else{
           $this->Student_Model->submitwork($id,$description,$this->upload->data('file_name'));
           redirect(base_url()."Student/work");
        }
        
        
    }
    public function askquestion($id){
        $this->checkUserAccess();
        $this->db->where('uname',$this->session->userdata('uname'));
        $data['user']=$this->db->get('user')->result();
        $data['work'] = $this->Student_Model->getuserwork($id);
        $data['comments'] = $this->Student_Model->getcomments($id);
        $this->load->view('student/askquestion',$data);
    }
    public function submitcomment($id){
        $this->checkUserAccess();
        $this->db->where('uname',$this->session->userdata('uname'));
        $user=$this->db->get('user')->row_array();
        $comment = $this->input->post('comment');
        $this->Student_Model->submitcomment($id,$user['id'],$comment);
        redirect(base_url().'Student/allstudentwork');
    }
    public function groups(){
        $this->checkUserAccess();
        $this->db->where('uname',$this->session->userdata('uname'));
        $data['user']=$this->db->get('user')->result();
        $data['groups']  = $this->Student_Model->getgroups();
        $this->load->view('student/groups',$data);
    }
    public function newgroup(){
        $this->checkUserAccess();
        $this->db->where('uname',$this->session->userdata('uname'));
        $data['user']=$this->db->get('user')->result();
        $this->load->view('student/newgroup',$data);
    }
    public function addnewgroup(){
        $this->checkUserAccess();
        $group_name = $this->input->post('group_name');
        $this->Student_Model->addnewgroup($group_name);
        redirect(base_url().'Student');
    }
    public function team($gid){
        $this->checkUserAccess();
        $data['pid'] = $gid;
        $this->db->where('uname',$this->session->userdata('uname'));
        $data['user']=$this->db->get('user')->result();
        $data['projects'] = $this->Student_Model->getgroup($gid);
        $data['team'] = $this->Student_Model->getteam($gid);
        $this->load->view('student/team',$data);
    }
    public function process_logout(){
        
    $this->session->unset_userdata('uname');
    $this->session->unset_userdata('ustatus');
        redirect(base_url().'admin');
    }
    public function searchUser(){
        $this->checkUserAccess();
        $term=$this->input->post('term');
        $this->db->like('uname', $term);
        $this->db->where('ustatus',2);
        $results=$this->db->get('user')->result();
        foreach($results as $key=>$result){
            $photo="profile.png";
        
            if($result->uphoto!=""){
            $photo=$result->uphoto;
            }
            
            $uid=$result->id;
            echo "<li id='list' onclick='addMember(\"$uid\")'>
        <div class='leftimage'><img src='".base_url()."assets/profile/".$photo."'/></div><div class='rightimage'>
            " . $result->uname. "
            </div>
            </li>";
        }
    }
    public function removemem(){
        $this->checkUserAccess();
        $data['tid']=$this->input->post('tid');
        
        if($this->Student_Model->deletemem($data['tid'])){
        echo "deleted";
        }else{
        echo "already";
        }
    }

    public function addMember(){
        $this->checkUserAccess();
        $data['pid']=$this->input->post('pid');
        $data['uid']=$this->input->post('uid');
        if($this->Student_Model->userinTeam($data['uid'],$data['pid'])){
            echo "duplicate";  
        }else{
         $insertquery= $this->Student_Model->insertmem($data);
       if($insertquery!=false){
           $lastid= $insertquery;
           //working from here...
           $userData=$this->Student_Model->getuser($data['uid']);
         if($userData!=false){
             
         foreach($userData as $key=>$user){
             $uphoto="profile.png";
             if($user->uphoto!=""){
                 $uphoto=$user->uphoto;
             }
             ?>

        <div class="col-lg-3 col-sm-6 text-center" id="usert<?php echo $lastid;?>">
            <div class="card">
                <div class="card-block">
                    <div class="card-title bg-primary">
                    <img src="<?php echo base_url();?>assets/profile/<?php echo $uphoto;?>" class="img70"/>
                    </div>
                    <div class="card-text">
                  <strong>  Name:<?php echo $user->uname;?><br>
                    <a href="#" onclick="teamlead('<?php echo $lastid;?>')"class="text-success" id="lead<?php echo $lastid;?>">  Make Team Lead</a>
                    <br>
                    <a href="#" onclick="remove('<?php echo $lastid;?>')"class="text-danger" id="remove<?php echo $lastid;?>">  Remove Member</a>
                    
                    
                    </strong>
                    </div>
                    
                </div>
                </div>
                </div>
               
             <?php
           }
           
         }else{
             echo "DB Issue";
         }
       }else{
           echo "Database issue";
       }
        }

    }
    public function teamlead(){
        $this->checkUserAccess();
        $data['tid']=$this->input->post('tid');   
        echo $this->Student_Model->teamlead($data['tid']);
    }
    public function assignwork($id){
        $this->checkUserAccess();	
        $this->db->where('uname',$this->session->userdata('uname'));
        $data['user']=$this->db->get('user')->result();
        $data['group_id'] = $id;
        $this->load->view('student/assignwork',$data);
    }
    public function newassignwork($group_id){
        $this->checkUserAccess();	
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $config = [
            'allowed_types' => 'txt|png|jpg|jpeg|docx',
            'upload_path' => './assets/documents/',
            'encrypt_name' => TRUE
        ];

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        if (!$this->upload->do_upload('attachment')){
            // If the upload fails
            echo $this->upload->display_errors();
        }
        else{
            $this->Student_Model->assignnewwork($title,$description,$this->upload->data('file_name'),$group_id);
            redirect(base_url().'Student/groups');
        }
        
    }
}