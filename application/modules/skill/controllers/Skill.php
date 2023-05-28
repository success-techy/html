<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Skill extends MX_Controller {
    
    public function __construct() {
    	parent::__construct();
        $this->load->model('skill_model','batch');
    }

    public function index() {

        $data['page']  = 'index';
        $data['title'] = "Job Category";
        $data['menu_title'] = "Job Category";
        $data['datatables'] = true;

    	$this->load->view('template', $data);
    }

    public function get_skill_list(){
        $list = $this->batch->get_datatables();
        $data = array();

        $no = $_POST['start'];
        $list = json_decode(json_encode($list), true);
        $ids = array_unique(array_column($list, 'id'));
        $ids = array_values($ids);
        $course=[];
        foreach ($list as $k => $v) {
                $no++;
                $row = array();
                $status_chg = '<select name="order_st" id="order_st" data-id="'.$v['id'].'" onchange="change_status(this)">';
                $status_chg = $status_chg.'<option value="0" '.(($v['status']==0)?'selected':"").'>Active</option>';
                $status_chg = $status_chg.'<option value="1" '.(($v['status']==1)?'selected':"").'>Inactive</option></select>';
                $row[] = $v['name'];              
                $row[] = '<a href="'.base_url('skill/add/'.$v['id']).'" class="btn btn-info">Edit</a>&nbsp;&nbsp;'.$status_chg;
                $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->batch->count_all(),
                        "recordsFiltered" => $this->batch->count_filtered(),
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


    public function updateSkillStatus(){
        $request=$this->input->post(NULL, true);
        $result = $this->batch->updateSkillStatus($request);
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
        if (!$this->form_validation->run()) {
            throw new Exception(validation_errors(), 1);
        }
      
        $rs = $this->batch->insert_batch($this->input->post(null, true));
        $this->session->set_flashdata($rs['status']?'success':"error", $rs['msg']);
        redirect(base_url('skill'));
    }


    public function add($id=''){
        $data['page']  = 'add';
        $data['title'] = $id!=""?"Edit Job Category":"Add Job Category";
        $data['menu_title'] = $id!=""?"Edit Job Category":"Add Job Category";
        $data['id'] = $id!=""?$id:0;
        $data['info'] = $id!=0? $this->batch->getBatchData($id):[];
        $this->load->view('template', $data);
    }
   
}