<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Authenticate_model extends CI_Model {
  
    
    public function login($params){
        $res=$this->db->select('*')->where('email',$params['email'])->where('password', $params['password'])->where('status',1)->get('users')->row_array();
        
        if(!$res)
        {
            return false;    
        }
        return $res;
    }


    public function get_user_data($id){
        $this->db->select('usr.status,usr.id,usr.email,usr.user_type,usr.user_type,usr.full_name,usr.mobile,usr.vendor_id,usr.is_email_verified,usr.vendor_id,usr.address,usr.latitude,usr.longitude,vn.status AS vendor_status,vn.is_verified');
        $this->db->join('nsr_vendors vn','vn.id=usr.vendor_id');
        $this->db->where('usr.id',$id);
        return $this->db->get('nsr_users usr')->row_array();
    }

    // Password forgot
    public function new_passwd_updt($params)
    {
        $this->db->trans_begin();
            $this->db->select('id');
            $this->db->where('email', $params['email']);
            $rs = $this->db->get('nsr_users')->row_array();
            if($rs)
            {
                $this->db->set('password',password_hash($params['password'],PASSWORD_DEFAULT));
                $this->db->where('id', $rs['id']);
                $this->db->update('nsr_users');

                if($this->db->affected_rows()!=1){
                    $this->db->trans_rollback();
                    return false;
                }
            }
            else
            {
                return false;
            }
            $this->db->trans_commit();
            return true;
    }
      /** 
     * notifications_info to get notification details
     * @param  Int $id          notification_id
     * @param  Customer Id $customer_id 
     * @return Array       return customer device_id and notificaion msg
     */
    public function notifications_info($id, $customer_id='', $device_id='', $lan='', $field=null)
    {

      $rs=[];
    
      if($customer_id!=''){
        $rs = $this->db->select('device_id, device_type, lang_opt')->where('id', $customer_id)->get('customers')->row_array();
  
      }else{
        $rs['lang_opt'] = $lan;
        $get_user = $this->db->where('device_id', $device_id)->get('guest_users')->row_array();
       
        $rs['device_id'] = $get_user['device_id'];
        $rs['device_type'] = $get_user['device_type'];
       

      }

        $result = $this->db->select("{$rs['lang_opt']}_title as title, {$rs['lang_opt']}_message as message, {$rs['lang_opt']}_image_path as image")->where('status','1')->where('id', $id)->get('notification')->row_array();
        //echo $this->db->last_query();
        $rs['message'] = $result['message'];
        $rs['title']  = $result['title'];
        $rs['image'] = $result['image']!=''?base_url().$result['image']:'';
        $rs['origin_img'] = $result['image'];
        if ($field != null) {
            $rs['message'] = str_replace(['{field}'], [$field], $rs['message']);
        }
        return $rs;
    }

      /** 
     * doAddNotification Add notification
     * @param  Array $params
     * @return Boolean true or fale   
     */
    public function doAddNotification($params){
        try {
            
            $this->db->trans_begin();
                $params['created_on'] = date('Y-m-d H:i:s');

                if (!$this->db->insert('notification_list', $params)) {
                    throw new Exception("Error Processing Request", 1);
                }

            $this->db->trans_commit();
            return true;
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return false;
        }
    }

    public function pdf_view($id){
        $rs = $this->db->select('material_url')->where('id', $id)->get('materials')->row_array();
        return base_url().$rs['material_url'];
    }

    public function studentInfo($id){
        $rs =  $this->db->select('name')->where('id', $id)->get('customers')->row_array();
        return $rs['name'];
    }

    public function videoPlay($id){
        $rs = $this->db->select('video_url as video')->where('id', $id)->get('class_schedule')->row_array();
        return $rs['video'];
    }
}
