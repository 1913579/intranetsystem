<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		
	}
	
	public function index()
	{
		
        $this->load->view('login');
	}

	public function process_login(){
	$uname=$this->input->post('uname');
	$upass=$this->input->post('upass');
	if($this->Login_model->checkUser($uname,$upass)==1){
	$accessRights=$this->Login_model->checkAccess($uname);
	$loginData = array(
        'uname'     => $uname,
        'ustatus'     => $accessRights,
        'logged_in' => TRUE
);
$this->session->set_userdata($loginData);

    if($accessRights==0){
    redirect(base_url()."Admin");
	}else if($accessRights==1){
		redirect(base_url()."Professor");
	}else{
		redirect(base_url()."Student");
	}
	}else{
		$this->session->set_flashdata('Error','User Name or Password is Incorrect' );	
		redirect(base_url());	
	}

	}

}
