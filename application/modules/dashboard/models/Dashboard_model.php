<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function dashboard_count()
    {
      
        $customer = $this->db->select('count(*) as customer_count')->get('customers')->row_array();

        $orders = $this->db->select('count(*) as total_orders')->where('payment_status',1)->get('orders')->row_array();

        $todays_order_process = $this->db->select('count(*) as today_order_progress')->where('DATE_FORMAT(created_on, "%Y-%m-%d")=', date('Y-m-d'))->where('order_status>',6)->where('payment_status', 1)->get('orders')->row_array();

        $todays_completed = $this->db->select('count(*) as today_order_completed')->where('DATE_FORMAT(created_on, "%Y-%m-%d")=', date('Y-m-d'))->where('order_status',6)->where('payment_status', 1)->get('orders')->row_array();
        $today_cancelled = $this->db->select('count(*) as today_cancelled')->where('DATE_FORMAT(created_on, "%Y-%m-%d")=', date('Y-m-d'))->where_in('order_status',[7, 8])->where('payment_status', 1)->get('orders')->row_array();

        $total_completed = $this->db->select('count(*) as total_completed')->where('payment_status',1)->where('order_status',6)->get('orders')->row_array();

        $total_cancelled = $this->db->select('count(*) as total_cancelled')->where('payment_status',1)->where_in('order_status',[7, 8])->get('orders')->row_array();
        
        $today_pending= $this->db->select('count(*) as today_pending')->where('DATE_FORMAT(created_on, "%Y-%m-%d")=', date('Y-m-d'))->where('order_status',1)->where('payment_status', 1)->get('orders')->row_array();

        $today_confirmed = $this->db->select('count(*) as today_confirmed')->where('DATE_FORMAT(created_on, "%Y-%m-%d")=', date('Y-m-d'))->where('order_status',2)->where('payment_status', 1)->get('orders')->row_array();

        $today_packing = $this->db->select('count(*) as today_packing')->where('DATE_FORMAT(created_on, "%Y-%m-%d")=', date('Y-m-d'))->where_in('order_status',3)->where('payment_status', 1)->get('orders')->row_array();

        $today_delivery = $this->db->select('count(*) as today_delivery')->where('DATE_FORMAT(created_on, "%Y-%m-%d")=', date('Y-m-d'))->where_in('order_status',6)->where('payment_status', 1)->get('orders')->row_array();


        return [
            'customer_count' => $customer['customer_count'],
            'total_orders' => $orders['total_orders'],
            'total_completed' => $total_completed['total_completed'],
            'total_cancelled' => $total_cancelled['total_cancelled'],
            'today_total_order' => $todays_order_process['today_order_progress']+$todays_completed['today_order_completed'],
            'today_inprogress' => $todays_order_process['today_order_progress'],
            'today_completed' => $todays_completed['today_order_completed'],
            'today_cancelled' => $today_cancelled['today_cancelled'],
            'today_pending' => $today_pending['today_pending'],
            'today_confirmed' => $today_confirmed['today_confirmed'],
            'today_packing' => $today_packing['today_packing'],
            'today_delivery' => $today_delivery['today_delivery']
        ];
    }

    public function getOrdersChartData($type, $range)
    {
        $options = $labelSet = $result = [];
        if (($range === 'monthly')) {
            $dateSet = $this->monthlyDateDetails();
            $options['x_label'] = 'Month';
        } else {
            $dateSet = $this->lastSevenDaysDateDetails();
            $options['x_label'] = 'Day';
        }
        foreach ($dateSet['range'] as $date) {
            list($startDate, $endDate) = $date;
            $start = $startDate->setTime(00, 00, 00)->format('Y-m-d H:i:s');
            $end = $endDate->setTime(23, 59, 59)->format('Y-m-d H:i:s');
            $label = $startDate->format(($range === 'monthly') ? 'M' : 'D');
            $labelSet[] = $label;
            if ($type === 'order_summary') {
                $select = "sum(case when (created_on >= '{$start}' and created_on <= '{$end}') then 1 else 0 end) as {$label}_count";
            } else if ($type === 'order_revenue') {
                $select = "sum(case when (created_on >= '{$start}' and created_on <= '{$end}') then final_price else 0 end) as {$label}_amount";
            } else {
                return $result;
            }
            $this->db->select($select);
        }

        $from = $dateSet['start']->setTime(00, 00, 00)->format('Y-m-d H:i:s');
        $to = $dateSet['end']->setTime(23, 59, 59)->format('Y-m-d H:i:s');
         if ($this->session->userdata['admin_login']['country'] != ALL) {
            $this->db->where('orders.country', $this->session->userdata['admin_login']['country']);
        }
        $data = $this->db->where("created_on between '{$from}' and '{$to}'")->get('orders')->row_array();
        foreach ($data as $each) {
            $result[] = $each ?: 0;
        }

        if ($type === 'order_summary') {
            return $this->makeOrderSummaryResponse($result, $labelSet, $options);
        } else if ($type === 'order_revenue') {
            return $this->makeOrderRevenueResponse($result, $labelSet, $options);
        } else {
            return [];
        }
    }

    public function lastSevenDaysDateDetails()
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = new DateTime();
            $date->sub(new DateInterval("P{$i}D"));
            $data[] = [$date, $date];

            if ($i == 6) {
                $start = $date;
            } else if ($i == 0) {
                $end = $date;
            }
        }

        return [
            'range' => $data,
            'start' => $start,
            'end' => $end,
        ];
    }

    public function monthlyDateDetails()
    {
        $data = [];
        for ($i = 11; $i >= 0; $i--) {
            $monthStartDate = new DateTime('first day of this month');
            $monthStartDate->sub(new DateInterval("P{$i}M"));
            $monthEndDate = new DateTime($monthStartDate->format('Y-m-t'));
            $data[] = [$monthStartDate, $monthEndDate];

            if ($i == 11) {
                $start = $monthStartDate;
            } else if ($i == 0) {
                $end = $monthEndDate;
            }
        }

        return [
            'range' => $data,
            'start' => $start,
            'end' => $end,
        ];
    }

    public function makeOrderSummaryResponse(array $data, array $labelSet, array $options = [])
    {
        return [
            'data' => $data, 'label' => $labelSet, 'background_color' => 'rgba(75, 192, 192, 0.2)',
            'border_color' => 'rgba(75, 192, 192, 1)', 'x_label' => $options['x_label'], 'y_label' => 'Order Count',
            'label_name' => 'No. of Orders', 'y_step_size' => 1,
        ];
    }

    public function makeOrderRevenueResponse(array $data, array $labelSet, array $options = [])
    {
        return [
            'data' => $data, 'label' => $labelSet, 'background_color' => 'rgba(255, 159, 64, 0.2)',
            'border_color' => 'rgba(255, 159, 64, 1)', 'x_label' => $options['x_label'], 'y_label' => 'Order Amount',
            'label_name' => 'Total Amount', 'y_step_size' => false,
        ];
    }

    public function getRegionStatisticsChartData($range)
    {
        $options = [];
        $labelSet = [];
        $result = [];
        list($from, $to) = $this->resolveDateSets($range);
        $this->db->select('country.name as country_name, count(1) as order_count');
        $data = $this->db->where("created_on between '{$from}' and '{$to}'")
            ->join('customers', 'customers.id=orders.customer_id')
            ->join('country', 'country.phonecode=customers.country_code')
            ->group_by('country.name')
            ->order_by('country.name')
            ->get('orders')->result_array();
        foreach ($data as $each) {
            $labelSet[] = $each['country_name'];
            $result[] = $each['order_count'] ?: 0;
        }

        return $this->makeRegionStatisticsResponse($result, $labelSet, $options);
    }

    public function makeRegionStatisticsResponse(array $data, array $labelSet, array $options = [])
    {
        return [
            'data' => $data, 'label' => $labelSet,
        ];
    }

    public function getTopChefs($range)
    {
        list($from, $to) = $this->resolveDateSets($range);
        if ($this->session->userdata['admin_login']['country'] !== ALL) {
            $this->db->where('users.country_code', $this->session->userdata['admin_login']['country_code']);
        }
        return $this->db->select('users.first_name as name, country.name as country_name, count(orders.id) as order_count')
            ->where("created_on between '{$from}' and '{$to}'")
            ->join('users', 'users.id=orders.chef_id')
            ->join('country', 'country.phonecode=users.country_code')
            ->group_by('users.id')
            ->order_by('order_count', 'desc')
            ->limit(5)
            ->get('orders')->result_array();
    }

    public function resolveDateSets($range)
    {
        if (($range === 'this_year')) {
            $year = date('Y');
            $from = new DateTime('first day of January ' . $year);
            $from = $from->setTime(00, 00, 00)->format('Y-m-d H:i:s');
            $to = new DateTime('last day of December ' . $year);
            $to = $to->setTime(23, 59, 59)->format('Y-m-d H:i:s');
        } elseif (($range === 'this_month')) {
            $date = new DateTime('first day of this month');
            $from = $date->setTime(00, 00, 00)->format('Y-m-d H:i:s');
            $to = $date->setTime(23, 59, 59)->format('Y-m-t H:i:s');
        } else {
            $date = new DateTime();
            $from = $date->setTime(00, 00, 00)->format('Y-m-d H:i:s');
            $to = $date->setTime(23, 59, 59)->format('Y-m-d H:i:s');
        }

        return [$from, $to];
    }


    
    public function customer_online_count()
    {
        return $this->db->select('*')
            ->get('customers')->result_array();
    }

    public function chef_online_count()
    {
        return $this->db->select('country_code, online')->join('users','users.id=chef_info.user_id')
            ->get('chef_info')->result_array();
    }

        /**
     * new_booking assist get the list of new bookings 
     * @return array stored notification and current new bookings
     */
    public function new_booking(){
        $rs=[];
        
        $stored_noti=[];

        $rs = $this->db->select('*')->where('payment_date>=', date('Y-m-d H:i'.":00", strtotime('-1 minutes')))->where('payment_status','1')->get('orders')->result_array();

        if($rs){
            $stored_noti = $this->db->select('*')->where_in('order_id', array_column($rs, 'id'))->get('web_notifications')->result_array();
            $insert =[];

            if(!$stored_noti){
                foreach ($rs as $k => $v){
                    $insert[]=["message"=>"New Order is received and Order Id is ".$v['id'], "created_on"=>IST_TIME(), 'type'=>1, 'order_id'=>$v['id']];
                }
            }
            
            if(count($insert)>=1){
                $this->db->insert_batch('web_notifications', $insert);
            }

        }
        
        $notif=[];
        $notif = $this->db->select('count(*) as cnt')->where('is_read', '0')->get('web_notifications')->row_array();

        return ['new_noti'=>$rs, 'stored'=>$notif['cnt']];
    }



    /**
     * notification_list assist get the list of notifications
     * @return array stored notification list 
     */
    public function notification_list(){
        $notif=[];
 
        $notif = $this->db->select('web_notifications.*, orders.public_id')->join('orders', 'orders.id=web_notifications.order_id')->where('is_read', '0')->order_by('id','desc')->get('web_notifications')->result_array();

        return ['stored'=>$notif];
    }


      /**
     * read_notifications assist to store the notification accept info into web_notification table
     * @param int $id notification Id
     * @return true or false
     */
    public function read_notifications($id, $manual_assign=""){
        $where=[];
        if($manual_assign!=''){
            $where = ['order_id'=>$id['id']];
        }else{
            $where = ['id'=>$id['id']];
        }

        return $this->db->update('web_notifications',['is_read'=>1,  'accepted_by'=>$this->session->userdata('id')], $where);
    }

    /**
     * notification_count assist get the count of notifications
     * @return array stored notification count 
     */
    public function notification_count(){
        $notif=[];
 
        $notif = $this->db->select('count(*) as cnt')->where('is_read', '0')->get('web_notifications')->row_array();

        return $notif['cnt'];
    }



}
