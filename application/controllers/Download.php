<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {
    public function index(){
        $path = $this->input->get('p');
        $this->load->helper('download');
        force_download($path,NULL);
    }
}