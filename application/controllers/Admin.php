<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
        parent::__construct();
        $this->load->model("Login_model"); 
        $this->load->model("Admin_Model"); 
		
	}
    function checkUserAccess(){
        if(!$this->session->userdata('uname')){
         redirect(base_url());
        }else if($this->session->userdata('ustatus')!=0){
            redirect(base_url());   
        }
    }
    
	public function index()
	{
    $this->checkUserAccess();	
    $this->db->where('uname',$this->session->userdata('uname'));
    $data['user']=$this->db->get('user')->result();
    $data['totalusers'] = $this->Admin_Model->gettotalusers();
    $data['professors'] = $this->Admin_Model->getusers(1);
    $data['students'] = $this->Admin_Model->getusers(2);
    $data['admins'] = $this->Admin_Model->getusers(0);
    $this->load->view('admin/dashboard',$data);
	}

   public function users(){
    $this->checkUserAccess();	
    $this->db->where('uname',$this->session->userdata('uname'));
    $data['user']=$this->db->get('user')->result();
    $data['users']=$this->db->get('user')->result();
    $this->load->view('admin/users',$data);
   }
    
   public function newuser(){
    $this->checkUserAccess();	
    $this->db->where('uname',$this->session->userdata('uname'));
    $data['user']=$this->db->get('user')->result();
    $this->load->view('admin/newuser',$data);
   }
   public function process_logout(){
        
    $this->session->unset_userdata('uname');
    $this->session->unset_userdata('ustatus');
        redirect(base_url().'admin');
    }
    public function newgroup(){
        $this->checkUserAccess();
        $this->db->where('uname',$this->session->userdata('uname'));
        $data['user']=$this->db->get('user')->result();
        $this->load->view('admin/newgroup',$data);
    }
    public function addnewgroup(){
        $this->checkUserAccess();
        $group_name = $this->input->post('group_name');
        $this->Admin_Model->addnewgroup($group_name);
        redirect(base_url().'Admin');
    }
    public function groups(){
        $this->checkUserAccess();
        $this->db->where('uname',$this->session->userdata('uname'));
        $data['user']=$this->db->get('user')->result();
        $data['groups']  = $this->Admin_Model->getgroups();
        $this->load->view('admin/groups',$data);
    }
    public function team($gid){
        $this->checkUserAccess();
        $data['pid'] = $gid;
        $this->db->where('uname',$this->session->userdata('uname'));
        $data['user']=$this->db->get('user')->result();
        $data['projects'] = $this->Admin_Model->getgroup($gid);
        $data['team'] = $this->Admin_Model->getteam($gid);
        $this->load->view('admin/team',$data);
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
    public function submitnewuser(){
        $this->checkUserAccess();
        $username = $this->input->post('uname');
        $password = $this->input->post('upass');
        $first_name = $this->input->post('fname');
        $last_name = $this->input->post('lname');
        $email = $this->input->post('email');
        $level = $this->input->post('level');
        $config = [
            'allowed_types' => 'gif|png|jpg|jpeg',
            'upload_path' => './assets/profile/',
            'encrypt_name' => TRUE
        ];

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        if (!$this->upload->do_upload('uphoto')){
            // If the upload fails
            echo $this->upload->display_errors();
        }
        else{
            $this->Admin_Model->submitnewuser($username,$password,$first_name,$last_name,$email,$level,$this->upload->data('file_name'));
            redirect(base_url()."Admin/users");
        }
    }
    public function removemem(){
        $this->checkUserAccess();
        $data['tid']=$this->input->post('tid');
        
        if($this->Admin_Model->deletemem($data['tid'])){
        echo "deleted";
        }else{
        echo "already";
        }
    }

    public function addMember(){
        $this->checkUserAccess();
        $data['pid']=$this->input->post('pid');
        $data['uid']=$this->input->post('uid');
        if($this->Admin_Model->userinTeam($data['uid'],$data['pid'])){
            echo "duplicate";  
        }else{
         $insertquery= $this->Admin_Model->insertmem($data);
       if($insertquery!=false){
           $lastid= $insertquery;
           //working from here...
           $userData=$this->Admin_Model->getuser($data['uid']);
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
        echo $this->Admin_Model->teamlead($data['tid']);
    }
    public function deletegroup($id){
        $this->checkUserAccess();
        $this->Admin_Model->deletegroup($id);
        redirect(base_url().'Admin/groups');
    }
    public function assignwork($id){
        $this->checkUserAccess();	
        $this->db->where('uname',$this->session->userdata('uname'));
        $data['user']=$this->db->get('user')->result();
        $data['group_id'] = $id;
        $this->load->view('admin/assignwork',$data);
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
            $this->Admin_Model->assignnewwork($title,$description,$this->upload->data('file_name'),$group_id);
            redirect(base_url().'Admin/groups');
        }
        
    }
}
