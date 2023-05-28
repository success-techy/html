<?php (defined('BASEPATH')) OR exit('No direct script access allowed');


class MY_Controller extends CI_Controller {
	public function __construct()
	{
		 parent::__construct();
		 $this->load->library('session');
     //For example I have set logged_in = true in authentication on success
     //Checking whether userdata logged_in not set ... if true redirecting to login screen
		/* if(!$this->session->has_userdata('is_logged') || !$this->session->is_logged){
			 header('Location: '.base_url('login'));
			 exit;
		 }*/
	}
}