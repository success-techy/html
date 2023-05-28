<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends MX_Controller {
    
    public function __construct() {
    	parent::__construct();
        $this->load->model('customer_model','customers');
    }

    public function index() {

        $data['page']  = 'index';
        $data['title'] = "Students";
        $data['menu_title'] = "Students";
        $data['datatables'] = true;
        $data['courses'] = $this->customers->get_courses();


    	$this->load->view('template', $data);
    }

    public function get_user_list(){
        $list = $this->customers->get_datatables($_POST);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {
            $status_chg = '<select name="order_st" id="order_st" data-id="'.$customers->customer_ids.'" onchange="change_status(this)">';
            $status_chg = $status_chg.'<option value="1" '.(($customers->status==1)?'selected':"").'>Active</option>';
            $status_chg = $status_chg.'<option value="2" '.(($customers->status==2)?'selected':"").'>Inactive</option></select>';

            $no++;
            $row = array();

            //$row[] = '';
            $row[] = $customers->name;
            $row[] = $customers->email;
            $row[] = $customers->phone;
            $row[] = $customers->dob;
            $row[] = $customers->education;
            $row[] = $customers->city;
            $row[] = $status_chg;
            $row[] = '<a href="'.base_url('customer/add/'.$customers->customer_ids).'" class="btn btn-info">Edit</a>'.$customers->loggedin>0?'<a href="'.base_url('customer/logoff/'.$customers->customer_ids).'" class="btn btn-info">Logoff User</a>':'';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->customers->count_all(),
                        "recordsFiltered" => $this->customers->count_filtered($_POST),
                        "data" => $data,
                );

        echo json_encode($output);
    }

    public function change_status() {
        $this->form_validation->set_rules('id','User Id','required|integer');
        $this->form_validation->set_rules('status','status','required|integer');
        if($this->form_validation->run()) {
            $info = $this->input->post(NULL,true);
            if ($info['status'] == '0') {
                $info['status'] = '1';
            }
            else{
                $info['status'] = '0';
            }
            $rs = change_status('customers','customer_id','customer_status',$info);
            if($rs) {
                echo json_encode(array('status'=>true));
            } else {
                echo json_encode(array('status'=>false));
            }
        }
    }
  
    public function bookingDetails($x, $searchStartDate = '', $searchEndDate=''){
        $data['title']      =   'Customer booking';
        $data['menu_title'] = "Customers"; 
        $data['page']       =   'bookingDetails';
        $data['datatables'] = true;
        $ride_now   =   $this->customer->getbookingDetails($x, $searchStartDate, $searchEndDate);
        $ride_later =   $this->customer->get_ridelater_bookingDetails($x, $searchStartDate, $searchEndDate);
        $result = array_merge($ride_now, $ride_later);
        //$result = array_map("unserialize", array_unique(array_map("serialize", $result)));
        $result = $this->customer->sort_merged_array($result);
        $data['ongoing_booking'] = $this->customer->getBookings($x,$status);
        $data['completed_booking'] = $this->customer->getBookings($x,$status="7");
        $data['assign_booking'] = $this->customer->getBookings($x,$status="2");
        $data['current_booking'] = $this->customer->getCurrentBookings($x);
                $data['cancelled_booking'] = $this->customer->getCancelledBookings($x);
           $data['customer'] = $this->customer->GetUserDetails($x);

        $this->load->view('template',$data);
    }


    public function updateCustomerStatus(){
        $request=$this->input->post(NULL, true);
        $result = $this->customers->updateCustomerStatus($request);
            if($result){
                $return_array = array(
                    'status' => 'success'
                );
            }else{
                $return_array = array(
                    'status' => 'error'
                );
            }
         echo json_encode($return_array);
    }

    public function save(){
        $this->form_validation->set_rules('name','Name','trim|required');
        $this->form_validation->set_rules('email','Email Id','trim|required');
        $this->form_validation->set_rules('phone','Phone Number','trim|required');
        $this->form_validation->set_rules('education','Education','trim|required');
        $this->form_validation->set_rules('city','City','trim|required');
        $this->form_validation->set_rules('dob','Date of Birth','trim|required');
        if (!$this->form_validation->run()) {
            throw new Exception(validation_errors(), 1);
        }
        $rs = $this->customers->insert_student($this->input->post(null, true));
        $this->session->set_flashdata($rs['status']?'success':"error", $rs['msg']);
        redirect(base_url('customer'));
    }


    public function add($id=''){
        $data['page']  = 'add';
        $data['title'] = $id!=""?"Edit Student":"Add Student";
        $data['menu_title'] = $id!=""?"Edit Student":"Add Student";
        $data['id'] = $id!=""?$id:0;
        $data['info'] = $id!=0? $this->customers->getStudentData($id):[];
        $data['courses'] = $this->customers->get_courses();
        $dt=[];
        $course = $this->customers->my_course($id);
        $dt=[];
        if($course){
           foreach ($course as $key => $value) {
              $dt[]=$value['batch_id']."_".$value['course_id'];
            } 
        }

        $data['course_data'] = $id!=0?$course:[];
        $data['sel_data'] = $id!=0?$dt:[];
        $this->load->view('template', $data);
    }

    public function logoff($id){
        $this->customers->logOffUser($id);
        redirect(base_url('customer'));
    }

   
}