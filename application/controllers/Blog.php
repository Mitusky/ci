<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {
        $username = $this->session->userdata('user_name');
        
        if(empty($username)) {
            $this->load->view('index');
        } else {
            $this->load->view('index', array('username'=>$username));
        }
        //echo "Change World! </br>";
    }

    public function test($name, $uid)
	{
		echo "hello </br>";
        echo $name . "</br>";
		echo $uid;
	}
}
