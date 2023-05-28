<?php

if (!function_exists('push_notify')) {
    function push_notify($notification_id, $customer_id ='', $device_id='', $lang, $field=null)
    {
        $CI = get_instance();
        $CI->load->model('authenticate/Authenticate_model', 'notification_model');
        $rs = $CI->notification_model->notifications_info($notification_id, $customer_id, $device_id, $lang, $field);

        // my phone, using my FCM senderID, to generate the following registrationId
        //$singleID = 'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd' ;
        $singleID = $rs['device_id'];
        /*$registrationIDs = array(
             'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd',
             'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd'
             'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd'
        ) ;*/

        // prep the bundle
        // to see all the options for FCM to/notification payload:
        // https://firebase.google.com/docs/cloud-messaging/http-server-ref#notification-payload-support

        // 'vibrate' available in GCM, but not in FCM
        $fcmMsg = [
            'body' => $rs['message'],
            'title' => $rs['title'],
            //'sound' => "default",
            'color' => "#203E78",
            //"image" => $rs['image']
        ];

        if(isset($rs['image'])&&$rs['image']!=''){
            $fcmMsg["image"] = $rs['image'];
        }


        /*$data = array(
            'category' => "ACCEPT_DECLINE_CATEGORY"
        );*/
        // I haven't figured 'color' out yet.
        // On one phone 'color' was the background color behind the actual app icon.  (ie Samsung Galaxy S5)
        // On another phone, it was the color of the app icon. (ie: LG K20 Plush)

        // 'to' => $singleID ;  // expecting a single ID
        // 'registration_ids' => $registrationIDs ;  // expects an array of ids
        // 'priority' => 'high' ; // options are normal and high, if not set, defaults to high.
        
        
        $fcmFields = [
            'to' => $singleID,
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
       
        

        if($customer_id!=''){
            $CI->notification_model->doAddNotification(["customer_id"=>$customer_id, "title"=>$rs['title'], "message"=>$rs['message'], "notification_id"=>$notification_id, "image_path"=>$rs['origin_img']]);
        }

        return curl_exec($ch);
        
        curl_close($ch);
    }
}

if (!function_exists('IST_TIME')) {
     function IST_TIME()
    {
        $date = gmdate('Y-m-d h:i:s');
        $cenvertedTime = date('Y-m-d H:i:s',strtotime('+5 hour +30 minutes',strtotime($date)));
        return $cenvertedTime;
    }
}




/*if (!function_exists('test_automation')) {
     function test_automation($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://15.206.107.41:8080/engine-rest/process-definition/key/new_DIshes/submit-form",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_VERBOSE => true,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS =>$data,
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Cookie: ci_session=6q7msag4id5ke0dne1g4olmu46llic4s"
          ),
        ));

        $response = curl_exec($curl);
        
        curl_close($curl);
    }
}*/
