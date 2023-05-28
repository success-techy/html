<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Skill_model extends CI_Model {
 
    var $table = 'category';
    var $column_order = array(null, 'id'); //set column field database for datatable orderable
    var $column_search = array('name'); //set column field database for datatable searchable 
    var $order = array('id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
    }
 
    private function _get_datatables_query()
    {
           
        $this->db->select('category.*')->from($this->table);
 
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
        //$this->db->join('course','course.id=batch.course_id');
    }

    function where_conditions($params=[]){
        //$this->db->where('orders.order_status', $params['order_status']);
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        //$this->join_tble();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
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

    public function updateSkillStatus($params){
        try {
            $this->db->trans_begin();

            $dt = array('status' => $params['status'], 'updated_on' => date('Y-m-d H:i:s'));

           
            $this->db->where('id',$params['id'])->update('category', $dt);
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


    public function insert_batch($params){
        try {
            $this->db->trans_begin();
             $update_data = [
                    'name' => $params['name'],
                ];
             
            if($params['id']>=1){
                $update_data['updated_on']= date('Y-m-d H:i:s');
                if (!$this->db->update('category', $update_data, ['id'=>$params['id']])) {
                    throw new Exception("Error Processing Request", 1);
                }
            }else{
                $update_data['created_on']= date('Y-m-d H:i:s');
                if (!$this->db->insert('category', $update_data)) {
                    throw new Exception("Error Processing Request", 1);
                }
            }
            
            $this->db->trans_commit();
                return ['status'=>true, "msg"=>$params['id']==0?"New Skillset has been created sucessfully":"Skillset has been updated sucessfully"];
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return ['status'=>true, "msg"=>$params['id']==0?"New Skillset record creation has been failed":"Skillset update has been failed"];
        }
    }

    public function getBatchData($id){
        return $this->db->select('*')->where('id', $id)->get('category')->row_array();
    }


    public function getCourse(){
        return $this->db->select('title, id')->get('course')->result_array();
    }

    public function getBatchCourseData($batch_id){
        return $this->db->select('*')->where('batch_id', $batch_id)->get('batch_course')->result_array();
    }

    public function getBatchCourseInfo($batch_id){
         return $this->db->select('course.title')->join('course','course.id=batch_course.course_id')->where('batch_course.batch_id', $batch_id)->get('batch_course')->result_array();
    }
 
}