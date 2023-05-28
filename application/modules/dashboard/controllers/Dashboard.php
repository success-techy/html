<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard_model', 'dashboard');
    }

    public function index()
    {
      
        if (!$this->session->userdata['admin_login']){
           redirect(base_url().'authenticate/login');
        }
        
        /*add_css(['assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css', 'assets/js/select.dataTables.min.css']);
        add_js(['assets/vendors/js/vendor.bundle.base.js', 'assets/vendors/chart.js/Chart.min.js', 'assets/vendors/datatables.net/jquery.dataTables.js', 'assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js', 'assets/js/dataTables.select.min.js', 'assets/js/off-canvas.js', 'assets/js/hoverable-collapse.js', 'assets/js/template.js', 'assets/js/settings.js', 'assets/js/todolist.js', 'assets/js/dashboard.js', 'assets/js/Chart.roundedBarCharts.js']);
*/
        $data['title'] = 'dashboard';
        $data['page'] = 'index';
        $data['jobs'] = $this->db->select('count(*) as cnt')->get('jobs')->row_array();
        $data['category'] = $this->db->select('count(*) as cnt')->get('category')->row_array();
     
        /*	if($this->session->userdata('is_verified')!=0){
                $data['page'] = 'index';
            }else{
                $data['page'] = 'doc_upload';
            }*/
        $this->load->view('template', $data);
        /*}
        else
        {
             redirect(base_url().'authenticate/login');
        }*/
    }

    public function order_chart_data()
    {
        echo json_encode(
            $this->dashboard->getOrdersChartData(
                $this->input->get('type'), $this->input->get('range')
            )
        );
    }

    public function region_statistics_data()
    {
        echo json_encode(
            $this->dashboard->getRegionStatisticsChartData(
                $this->input->get('range')
            )
        );
    }

    public function top_chefs()
    {
        echo json_encode(
            $this->dashboard->getTopChefs(
                $this->input->get('range')
            )
        );
    }

    /**
     * new_booking assist get the list of new bookings 
     * @return JSON data of current bookings
     */
    public function new_booking(){
       echo json_encode($this->dashboard->new_booking());exit();
    }


    /**
     * notification_list assist get the list of notificaitons
     * @return JSON data
     */
    public function notification_list(){
       echo json_encode($this->dashboard->notification_list());exit();
    }


    /**
     * read_notifications to update the notification status
     * @return JSON 
     */
    public function read_notifications(){
       echo json_encode($this->dashboard->read_notifications($_POST));exit();
    }

    /*public function doument_up()
    {
        $data['title'] = 'dashboard';
        $data['page'] = 'doc_upload';
        $this->load->view('template',$data);
    }

    public function do_add_document() {
        $info = $this->input->post(NULL,true);

        if(!$_FILES['pan_img']['tmp_name']|| !$_FILES['bus_img']['tmp_name']) {
                $validation_errors = validation_errors();
                $this->session->set_flashdata('error',"Business and PAN Documents are required.");
                redirect(site_url('dashboard/doument_up'));
            }
         else{
            if(isset($_FILES['pan_img']) && !empty($_FILES['pan_img']))
            $info['pancard_doc'] = do_upload_image('pan_img','vendor_document');
            if(isset($_FILES['bus_img']) && !empty($_FILES['bus_img']))
            $info['business_doc'] = do_upload_image('bus_img','vendor_document');
            $rs = $this->dashboard->do_add_vendor_doc($info);
            if($rs) {
                $this->session->set_flashdata('success', 'Your documents has been uploaded successfully!');
                redirect(site_url('dashboard/doument_up'));
            } else {
                $this->session->set_flashdata('error', 'Some error occurred. Please try again.');
            }
        }

        redirect(site_url('dashboard/doument_up'));
    }

    public function my_clients(){
        $vendor_id = $this->session->userdata('vendor_id');
        $data['title'] = 'My clients';
        $data['page'] = 'my_clients';
        //$data['order'] = $this->dashboard_model->my_order_count();
        $this->load->view('template',$data);

    }


    public function refunds(){
        $vendor_id = $this->session->userdata('vendor_id');
        $data['title'] = 'Refund List';
        $data['page'] = 'refund_list';
        // $data['users'] = $this->dashboard_model->my_clients_list($vendor_id);
        $this->load->view('template',$data);
    }

    public function replace(){
        $vendor_id = $this->session->userdata('vendor_id');
        $data['title'] = 'Replace List';
        $data['page'] = 'replace_list';
        // $data['users'] = $this->dashboard_model->my_clients_list($vendor_id);
        $this->load->view('template',$data);
    }

    public function permissions(){
        $vendor_id = $this->session->userdata('vendor_id');
        $data['title'] = 'Sub vendor permissions';
        $data['page'] = 'permissions';
        // $data['users'] = $this->dashboard_model->my_clients_list($vendor_id);
        $this->load->view('template',$data);
    }*/
}
