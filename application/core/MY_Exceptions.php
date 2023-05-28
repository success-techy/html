<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Exceptions extends CI_Exceptions {

    public function __construct() {
        parent::__construct();
    }

    public function show_404($page = '', $log_error = true) {
        $CI = & get_instance();
        echo "<pre>";print_r($CI);die;
        $data['title'] = '404 Error';
        $data['page'] = 'errors/custom/error_404';
        $CI->output->set_status_header('404'); 
        $CI->load->view('pub_template',$data);
        echo $CI->output->get_output();
        exit;
    }
}