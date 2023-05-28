<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Customer_model extends CI_Model {
 
    var $table = 'customers';
    var $column_order = array(null, 'customers.id as customer_ids','name','email','phone','dob', 'education', 'city'); //set column field database for datatable orderable
    var $column_search = array('name','email','phone','dob', 'education', 'city'); //set column field database for datatable searchable 
    var $order = array('customers.id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
    }
 
    private function _get_datatables_query()
    {
         
        $this->db->select('*, customers.id as customer_ids')->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if(isset($_POST['search']['value'])) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables($params=[])
    {
        $this->_get_datatables_query();
        $this->where_conditions($params);
                    $this->db->group_by('customers.id');

        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($params=[])
    {
        $this->_get_datatables_query();
        $this->where_conditions($params);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
     function where_conditions($params=[]){
        $this->db->where('customers.type', 0);
        if(isset($params['course'])&&$params['course']!=''){
            $this->db->join('my_course','my_course.customer_id=customers.id');
            $tmp = explode('_', $params['course']);
            $this->db->where('my_course.batch_id', $tmp[0]);
            $this->db->where('my_course.course_id', $tmp[1]);
        }  
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function updateCustomerStatus($params){
        try {
            $this->db->trans_begin();

            $dt = array('status' => $params['status'], 'updated_on' => date('Y-m-d H:i:s'));

           
            $this->db->where('id',$params['id'])->update('customers', $dt);
            if(!$this->db->affected_rows()) {
                throw new Exception("Error Processing Request", 1);
            }

            $this->db->trans_commit();
            
            return true;
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return false;
        }
    }


    public function insert_student($params){
        try {
            
            $this->db->trans_begin();
             $update_data = [
                    'phone' => (int)$params['phone'],
                    'email'=>$params['email'],
                    'name'=>$params['name'],
                    'city'=>$params['city'],
                    'dob'=>$params['dob'],
                    'education'=>$params['education']
                ];
             
            if($params['id']>=1){
                $update_data['updated_on']= date('Y-m-d H:i:s');
                if (!$this->db->update('customers', $update_data, ['id'=>$params['id']])) {
                    throw new Exception("Error Processing Request", 1);
                }

                $rm_ids = [];

                foreach ($params['courses'] as $key => $value) {
                    if($value!=''){
                        $rm_ids[]= $params['coure_inf_id'][$key];
                    }
                }

                if($rm_ids){
                    $this->db->where('customer_id', $params['id'])->where_not_in('id', $rm_ids)->delete('my_course');
                }

                $my_course_info = $this->db->select('*')->where('customer_id', $params['id'])->get('my_course')->result_array();
                

                $insert_course = [];
                $update_course = [];
                foreach ($params['coure_inf_id'] as $key => $value) {
                    if($value==0 && $params['courses'][$key]!=''){
                        $ids = explode('_', $params['courses'][$key]);
                        $insert_course[]=[
                            'created_on' => date('Y-m-d H:i:s'),
                            'updated_on'=>date('Y-m-d H:i:s'),
                            'customer_id'=>$params['id'],
                            'purchased_date'=>date('Y-m-d'),
                            'start_date'=>$params['start_date'][$key],
                            'end_date'=>$params['end_date'][$key],
                            'status'=>1,
                            'batch_id'=>$ids[0],
                            'course_id'=>$ids[1],
                        ];
                    }else if($value>0 && $params['courses'][$key]!=''){
                        $ids = explode('_', $params['courses'][$key]);
                        $update_course[]=[
                            'created_on' => date('Y-m-d H:i:s'),
                            'updated_on'=>date('Y-m-d H:i:s'),
                            'customer_id'=>$params['id'],
                            'purchased_date'=>date('Y-m-d'),
                            'start_date'=>$params['start_date'][$key],
                            'end_date'=>$params['end_date'][$key],
                            'status'=>1,
                            'batch_id'=>$ids[0],
                            'course_id'=>$ids[1],
                            'id'=>$params['coure_inf_id'][$key]
                        ];
                    }
                }
                if($insert_course){
                     if (!$this->db->insert_batch('my_course', $insert_course)) {
                        throw new Exception("Error Processing Request", 1);
                    }
                }
                if($update_course){
                    if (!$this->db->update_batch('my_course', $update_course, 'id')) {
                        throw new Exception("Error Processing Request", 1);
                    }
                }

                
            }else{
                $update_data['created_on']= date('Y-m-d H:i:s');
                $update_data['status'] = 1;
                if (!$this->db->insert('customers', $update_data)) {
                    throw new Exception("Error Processing Request", 1);
                }

               $customerid = $this->db->insert_id();
               $insert_course=[];
               foreach ($params['courses'] as $key => $value) {
                $ids = explode('_', $value);
                   $insert_course[]=[
                    'created_on' => date('Y-m-d H:i:s'),
                    'updated_on'=>date('Y-m-d H:i:s'),
                    'customer_id'=>$customerid,
                    'purchased_date'=>date('Y-m-d'),
                    'start_date'=>$params['start_date'][$key],
                    'end_date'=>$params['end_date'][$key],
                    'status'=>1,
                    'batch_id'=>$ids[0],
                    'course_id'=>$ids[1]
                ];
               }

               if (!$this->db->insert_batch('my_course', $insert_course)) {
                    throw new Exception("Error Processing Request", 1);
                }
            }

            $this->db->trans_commit();
            return ['status'=>true, "msg"=>$params['id']==0?"New student record has been created sucessfully":"Student info has been updated sucessfully"];
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return ['status'=>true, "msg"=>$params['id']==0?"New student record creation has been failed":"Student info has been update has been failed"];
        }
    }

    public function getStudentData($id){
        return $this->db->select('*')->where('id', $id)->get('customers')->row_array();
    }

    public function my_course($id){
        return $this->db->select('*')->where('customer_id', $id)->get('my_course')->result_array();
    }

    /*public function get_courses(){
        return $this->db->select('batch.id, batch.course_id, title, batch_name')->join('course', 'course.id=batch.course_id')->where('status', 1)->get('batch')->result_array();
    }*/

    public function get_courses(){
        return $this->db->select('batch_course.batch_id as id, batch_course.course_id, title, batch_name')->join('course', 'course.id=batch_course.course_id')->join('batch', 'batch.id=batch_course.batch_id')/*->where('status', 1)*/->get('batch_course')->result_array();
    }

    public function logOffUser($id){
        try {
            $this->db->trans_begin();

            $dt = array('loggedin' => 0, 'updated_on' => date('Y-m-d H:i:s'));

           
            $this->db->where('id',$id)->update('customers', $dt);
            if(!$this->db->affected_rows()) {
                throw new Exception("Error Processing Request", 1);
            }

            $this->db->trans_commit();
            
            return true;
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return false;
        }
    }
 
}