<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professor extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Professor_Model');
    }
    
    function checkUserAccess(){
        if(!$this->session->userdata('uname')){
         redirect(base_url());
        }else if($this->session->userdata('ustatus')!=1){
            redirect(base_url());   
        }
    }
    function index(){
        $this->checkUserAccess();
        $this->db->where('uname',$this->session->userdata('uname'));
        $data['user']=$this->db->get('user')->result();
        $data['users'] = $this->db->from("user")->count_all_results();
        $data['professors'] = $this->Professor_Model->getusers(1);
        $data['students'] = $this->Professor_Model->getusers(2);
        $data['admins'] = $this->Professor_Model->getusers(0);
        $this->load->view('professor/dashboard',$data);
    }
    public function submittedwork(){
        $this->checkUserAccess();
        $this->db->where('uname',$this->session->userdata('uname'));
        $data['user']=$this->db->get('user')->result();
        $data['works'] = $this->Professor_Model->getsubmittedwork();
        $this->load->view('professor/submittedwork',$data);
    }
    public function remarks($id){
        $this->checkUserAccess();
        $this->db->where('uname',$this->session->userdata('uname'));
        $data['user']=$this->db->get('user')->result();
        $data['work_id'] = $id;
        $this->load->view('professor/remarks',$data);
    }
    public function process_logout(){
        
    $this->session->unset_userdata('uname');
    $this->session->unset_userdata('ustatus');
        redirect(base_url().'admin');
    }
    public function giveremarks($id){
        $this->checkUserAccess();
        $this->db->where('uname',$this->session->userdata('uname'));
        $data['user']=$this->db->get('user')->result();
        $remarks = $this->input->post('remarks');
        $this->Professor_Model->giveremarks($id,$remarks);
        redirect(base_url().'Professor/submittedwork');
    }
    public function groups(){
        $this->checkUserAccess();
        $this->db->where('uname',$this->session->userdata('uname'));
        $data['user']=$this->db->get('user')->result();
        $data['groups']  = $this->Professor_Model->getgroups();
        $this->load->view('professor/groups',$data);
    }
    public function newgroup(){
        $this->checkUserAccess();
        $this->db->where('uname',$this->session->userdata('uname'));
        $data['user']=$this->db->get('user')->result();
        $this->load->view('professor/newgroup',$data);
    }
    public function addnewgroup(){
        $this->checkUserAccess();
        $group_name = $this->input->post('group_name');
        $this->Professor_Model->addnewgroup($group_name);
        redirect(base_url().'Professor');
    }
    public function team($gid){
        $this->checkUserAccess();
        $data['pid'] = $gid;
        $this->db->where('uname',$this->session->userdata('uname'));
        $data['user']=$this->db->get('user')->result();
        $data['projects'] = $this->Professor_Model->getgroup($gid);
        $data['team'] = $this->Professor_Model->getteam($gid);
        $this->load->view('professor/team',$data);
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
        
        if($this->Professor_Model->deletemem($data['tid'])){
        echo "deleted";
        }else{
        echo "already";
        }
    }

    public function addMember(){
        $this->checkUserAccess();
        $data['pid']=$this->input->post('pid');
        $data['uid']=$this->input->post('uid');
        if($this->Professor_Model->userinTeam($data['uid'],$data['pid'])){
            echo "duplicate";  
        }else{
         $insertquery= $this->Professor_Model->insertmem($data);
       if($insertquery!=false){
           $lastid= $insertquery;
           //working from here...
           $userData=$this->Professor_Model->getuser($data['uid']);
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
        echo $this->Professor_Model->teamlead($data['tid']);
    }
    public function assignwork($id){
        $this->checkUserAccess();	
        $this->db->where('uname',$this->session->userdata('uname'));
        $data['user']=$this->db->get('user')->result();
        $data['group_id'] = $id;
        $this->load->view('professor/assignwork',$data);
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
            $this->Professor_Model->assignnewwork($title,$description,$this->upload->data('file_name'),$group_id);
            redirect(base_url().'Professor/groups');
        }
        
    }
}