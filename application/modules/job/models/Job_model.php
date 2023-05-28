<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Job_model extends CI_Model {
 
    var $table = 'jobs';
    var $column_order = array(null, 'jobs.title','jobs.description'); //set column field database for datatable orderable
    var $column_search = array('jobs.title', 'jobs.description', 'jobs.start_experience','jobs.end_experience','jobs.city', 'jobs.company_name'); //set column field database for datatable searchable 
    var $order = array('id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
    }
 
    private function _get_datatables_query()
    {
           
        $this->db->select('jobs.*, category.name')->from($this->table);
 
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

    function join_tble(){
        $this->db->join('category','category.id=jobs.type', 'left');
    }

    function where_conditions($params=[]){
        //$this->db->where('orders.order_status', $params['order_status']);
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        $this->join_tble();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->order_by('id', 'desc')->get();
        return $query->result();
        //echo $this->db->last_query();exit();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $this->join_tble();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function getCategory($id=''){
        return $this->db->select('*')->where('status', '0')->get('category')->result_array();
    }

    public function getCourseList($batch_id){
        return $this->db->select('course.id, course.title')->join('batch_course', 'batch_course.course_id=course.id')->where('batch_course.batch_id', $batch_id)->get('course')->result_array();
    }

    public function saveNewJob($params){
        try {
            $this->db->trans_begin();
            $insert_data = [
                        'title' => $params['title'],
                        'start_experience' => $params['start_exp'],
                        'end_experience' => $params['end_exp'],
                        'city' => $params['city'],
                        'description'=>$params['description'],
                        'type'=>$params['type'],
                        'company_name'=>$params['company_name'],
                        "created_on"=>date('Y-m-d H:i:s'),
                        "updated_on"=>date('Y-m-d H:i:s')
                    ];
            if($params['id']==0){                
                if (!$this->db->insert('jobs', $insert_data)) {
                    throw new Exception("Error Processing Request", 1);
                }
            }else{
                if (!$this->db->update('jobs', $insert_data, ['id'=>$params['id']])) {
                    throw new Exception("Error Processing Request", 1);
                }
            }
           
            $this->db->trans_commit();
                return true;
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return false;
        }
    }

    

    public function getJobs($id){
        return $this->db->select('jobs.*, category.name')->join('category', 'category.id=jobs.type')->where('jobs.id', $id)->get('jobs')->row_array();
    }
    
    public function delete($params){
        try {
            $this->db->trans_begin();
            $this->db->where('id',$params)->delete('jobs');
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