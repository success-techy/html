<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Authenticate extends CI_Controller {
    
	function __construct()
	{
		parent::__construct();
		$this->load->model('authenticate_model','authenticate');
	}

	public function index()
	{	

		if(isset($_SESSION['admin_login']['is_logged'])){
			redirect('dashboard');
			
		}else{
			
			$data['title'] = 'log In';
        	$this->load->view('login',$data);	
		}
	}


	public function login()
	{
		if(isset($_SESSION['admin_login']['is_logged'])){
			redirect('dashboard');
		}else{
			$data['title'] = 'log In';
	        $this->load->view('login',$data);			
		}
	}


	public function do_login(){
		$this->load->helper('security');
		$this->form_validation->set_rules('email', 'Email Id', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
			$input=$this->input->post(null,true);
			$input['password']=sha1($input['password']);
			
		if($this->form_validation->run()){
    		
    			if($res=$this->authenticate->login($input)){
    				
	    			
    				$key = "admin_login";
    				$path="dashboard";
	    		
    				$this->session->set_userdata($key, array('is_logged' => TRUE, 'id'=>$res['id'], "name"=>$res['name'],"email"=>$res['email']));

                redirect(site_url($path));
    		}
            else { 
    			$this->session->set_flashdata('error','Username or Password is incorrect!');
    			 redirect(base_url('authenticate/login'));
    		}
    	} else { 
    		$this->session->set_flashdata('error',validation_errors());
    		 redirect(site_url());
    	}

	}




	public function terms_conditions()
	{
        $lang = $this->input->get('lan') ?: 'en';
		$this->load->view('terms_conditions', compact('lang'));
	}

	public function privacy()
	{
		$this->load->view('privacy');	
	}

	public function privacy_policy()
	{
        $lang = $this->input->get('lan') ?: 'en';
		$this->load->view('privacy_policy', compact('lang'));
	}




	
	
	/*public function logout(){
		$sess_items = $this->session->all_userdata();
		$this->session->unset_userdata($sess_items);
        $this->db->cache_delete_all();
        $this->session->sess_destroy();
        $this->session->set_flashdata('success','Logged out successfully');
        redirect(base_url());
    }*/
    public function logout(){
    //	print_r($this->session->all_userdata());exit();
		$this->session->unset_userdata('admin_login');
		$this->session->unset_userdata('driver_login');
       /* $this->db->cache_delete_all();
        $this->session->sess_destroy();*/
        $this->session->set_flashdata('success','Logged out successfully');
        redirect(base_url('authenticate/login'));
    }

    public function send_dev(){
     
        $singleID=[];
        $rs = $this->db->select('device_id')->where('status', 1)->get('customers')->result_array();

        foreach ($rs as $key => $value) {
            //$singleID=[];
            $singleID[]=$value['device_id'];        
        }

        $rs = $this->db->select('device_id')->get('guest_users')->result_array();
        
        foreach ($rs as $key => $value) {
            $singleID[]=$value['device_id'];        
        }


        $deviceIds = array_chunk($singleID,100);
//        echo "Device Ids<pre>";print_r($deviceIds);

      // print_r($singleID);exit();
        $output=[];
        //foreach($deviceIds as $k => $v){
        foreach($deviceIds as $k => $v){

                   // echo "For loop Device Ids<pre>";print_r($v);exit();

           /* $fcmMsg = [
                'body' => "Fresh chicken, Mutton and seafood stores are live now!!",
                'title' =>  "Free Delivery at your door step Order now !!",
                //'sound' => "default",
                'color' => "#203E78",
                "image" => "https://villagefreshmart.com/village_api/assets/images/banners/chickenss.png",
            
             ];
    
        $fcmMsg["action_id"] = 17;
        $fcmMsg["action_type"] = "category";
        $fcmMsg["action_title"] = "Meat";*/
        
        $fcmMsg = [
            'body' => "Fresh fruits and vegetables, groceris stores are live now!!",
            'title' =>  "Free Delivery at your door step Order now !!",
            //'body' => "Special Offer!! சின்ன வெங்காயம் கிலோ ரூ. 25 மட்டுமே!!",
            //title' =>  "Special Offer!! சின்ன வெங்காயம் கிலோ ரூ. 25 மட்டும",
            //'sound' => "default",
            'color' => "#203E78",
            "image" => "https://villagefreshmart.com/village_api/assets/images/offer/banner1.jpeg",
            
        ];
        
        
        
        $fcmMsg["action_id"] = 1;
        $fcmMsg["action_type"] = "category";
        $fcmMsg["action_title"] = "Vegetables";
        
        
            $fcmFields = [
                'registration_ids' => $v,
                'priority' => 'high',
                'data' => $fcmMsg
            ];
            //echo "<pre>";print_r($fcmFields);exit();
    
            $headers = [
                'Authorization: key='. API_ACCESS_KEY,
                'Content-Type: application/json'
            ];
        
           //echo "Reponse of FCM<pre>";print_r($this->fcmProcess($fcmFields, $headers));

          $output[] = $this->fcmProcess($fcmFields, $headers);
        }
        print_r(count($output));
        return true;
       
    }
    public function fcmProcess($fcmFields, $headers){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
          echo "<pre>";print_r(curl_exec($ch));
        curl_close($ch);
        return $ch;
    }
    public function send(){
    	        $singleID=[];
        $rs = $this->db->select('device_id')->where('status', 1)->get('customers')->result_array();

        foreach ($rs as $key => $value) {
        	$singleID[]=$value['device_id'];		
        }

        $rs = $this->db->select('device_id')->get('guest_users')->result_array();
        
        foreach ($rs as $key => $value) {
        	$singleID[]=$value['device_id'];		
        }

        
        $fcmMsg = [
            'body' => "sdfd",
            'title' => "sfddsf",
            //'sound' => "default",
            'color' => "#203E78",
            "image" => ""
        ];

       
        
        $fcmFields = [
            'registration_ids' => $singleID,
            'priority' => 'high',
            'notification' => $fcmMsg
        ];

        $headers = [
            'Authorization: key='. API_ACCESS_KEY,
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
       	print_r(curl_exec($ch));exit();
        curl_close($ch);
    }

    public function join($id){
        $data['room_id'] = $id;
        $data['title'] = 'Host Join';
        $this->load->view('videoHost',$data);   
    }

    public function Studentjoin($id){
        $id = explode("_", $id);
        $data['room_id'] = $id[1];
        $data['student_name'] = $this->authenticate->studentInfo($id[0]);
        $data['title'] = 'Student Join';
        $this->load->view('videoStudent',$data);   
    }

    public function pdf_view($id){
        $data['url'] = $this->authenticate->pdf_view($id);
        $this->load->view('pdf_view', $data);
    }

    public function play($id){
        $data['video'] = $this->authenticate->videoPlay($id);
        $this->load->view('playvideo', $data);
    }

    public function token(){
        $secret_key = "2feefcd70e69fca7a1b1b204f8c9207a01555b4469ccf4248e861498f6088a62";
        $api_key = "18991a7c-b707-40f2-8861-4d354942a6a8";
        $token = array(
            "apikey" => $api_key,
            "version"=>2,
            "roles"=> ['CRAWLER']
        );
     
        echo json_encode(["meeting_token"=>JWT::encode($token, $secret_key)]);exit();
    }
}
