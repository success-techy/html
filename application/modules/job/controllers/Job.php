<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Job extends MX_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('job_model','schedule');
    }

    public function index() {

        $data['page']  = 'index';
        $data['title'] = "Job List";
        $data['menu_title'] = "Job List";
        $data['datatables'] = true;

        $this->load->view('template', $data);
    }

    public function get_job_list(){
        $list = $this->schedule->get_datatables();
        $data = array();

        $no = $_POST['start'];

        foreach ($list as $customers) {
            $status_chg = '<select name="order_st" id="order_st" data-id="'.$customers->id.'" onchange="change_status(this)">';
            $status_chg = $status_chg.'<option value="0" '.(($customers->status==0)?'selected':"").'>Active</option>';
            $status_chg = $status_chg.'<option value="1" '.(($customers->status==1)?'selected':"").'>Inactive</option></select>';

            $no++;
            $row = array();
            $row[] = $customers->title;
            $row[] = $customers->description;
            $row[] = $customers->name;
            $row[] = $customers->city;
            $row[] = $customers->start_experience.' - '.$customers->end_experience;
            $row[] = $customers->company_name;
            $row[] =  '<button class="btn btn-danger" data-classid="'.$customers->id.'" onclick="delete_class(this)">Delete</button>&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.base_url('job/add/'.$customers->id).'" class="btn btn-info">Edit</a>';

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->schedule->count_all(),
                        "recordsFiltered" => $this->schedule->count_filtered(),
                        "data" => $data,
                );

        echo json_encode($output);
    }



    public function updateJobStatus(){
        $request=$this->input->post(NULL, true);
        $result = $this->schedule->updateCourseStatus($request);
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

    public function add($id=''){
        $data['batch'] = $this->schedule->getCategory();
        $data['page']  = 'add';
        $data['title'] = $id!=""?"Edit Job":"Add Job";
        $data['menu_title'] = $id!=""?"Edit Job":"Add Job";
        $data['id'] = $id!=""?$id:0;
        $data['info'] = $id!=''?$this->schedule->getJobs($id):[];
        $this->load->view('template', $data);
    }


    public function save(){
        $this->form_validation->set_rules('title','Title','trim|required');
        $this->form_validation->set_rules('description','JD','trim|required');
        if (!$this->form_validation->run()) {
            throw new Exception(validation_errors(), 1);
        }
       
        $this->schedule->saveNewJob($this->input->post(NULL, true));

        $this->session->set_flashdata('success', "New Job is added or updated successfully");
        redirect('job');
    }

    public function delete(/*$id*/){
        $request=$this->input->post(NULL, true);
        $result = $this->schedule->delete($request['id']);
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
   
}