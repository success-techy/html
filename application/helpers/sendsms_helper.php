<?php
	function sendsms($mobileno,$textmessage, $phone_code, $return = '0')
	{
		/*if($phone_code==966)
		{
			$source 		= 'Marzouqa';
			$sender 		= 'New SMS'; 
			$smsGatewayUrl 	= 'http://www.4jawaly.net';
			$username		= 'marzouqa';
			$password		= '123456';
			//$apikey = '602025n746bm1u79i0229uzoe4ddoj6s0';
			$textmessage = urlencode($textmessage);
			//$textmessage=urlencode("Hi this is a test message");
			$api_element = '/api/sendsms.php';
			$api_params = $api_element.'?username='.$username.'&password='.$password.'&message='.$textmessage.'&numbers='.$mobileno.'&sender='.$sender.'&unicode=e&Rmduplicated=1&return=xml';
			$smsgatewaydata = $smsGatewayUrl.$api_params;
			echo $smsgatewaydata;exit();
			$url = $smsgatewaydata;

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_POST, false);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); $output = curl_exec($ch);
			curl_close($ch);
			print_r($output);exit();
			if(!$output){ $output = file_get_contents($smsgatewaydata); }
			if($return == '1'){ return $output; }else{  }
		}*/
		if($phone_code==91)
		{
			$sender_id='Mazuqa';
			$curl = curl_init();
			$api_id='API405171932607';
			$api_password='T6g7AmvSi4';
			$textmessage = urlencode($textmessage);
			$api_url = 'http://api.smsala.com/api/SendSMS?api_id='.$api_id.'&api_password='.$api_password.'&sms_type=T&encoding=T&sender_id='.$sender_id.'&phonenumber='.$mobileno.'&textmessage='.$textmessage;
			curl_setopt_array($curl, array(
			  CURLOPT_URL => $api_url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			));

			$response = curl_exec($curl);

			
			$err = curl_error($curl);

			curl_close($curl);
		}else{
			$curl = curl_init();
			$source 		= 'Marzouqa';
			$sender 		= 'Marzouqa'; 
			$smsGatewayUrl 	= 'http://www.4jawaly.net';
			$username		= 'marzouqa';
			$password		= '123456';
			$textmessage = urlencode($textmessage);
			$api_url = 'http://www.4jawaly.net/api/sendsms.php?username='.$username.'&password='.$password.'&message='.$textmessage.'&numbers='.$mobileno.'&sender='.$sender.'&unicode=e&Rmduplicated=1&return=xml';

				  curl_setopt_array($curl, array(
				  CURLOPT_URL => $api_url,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "GET",
				  CURLOPT_HTTPHEADER => array(
				    
				  ),
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);
		}
		
		
				/*if ($err) {
					print_r($err);
				  //return "cURL Error #:" . $err;
				} else {
				 // return $response;
					print_r($response);

				}*/

				/*print_r($api_url);
				exit();*/

		//echo $response;
		
		/*if($phone_code==966)
		{

		




			$curl = curl_init();
			$source 		= 'Marzouqa';
			$sender 		= 'Marzouqa'; 
			$smsGatewayUrl 	= 'http://www.4jawaly.net';
			$username		= 'marzouqa';
			$password		= '123456';
			$textmessage = urlencode($textmessage);
			$api_url = 'http://www.4jawaly.net/api/sendsms.php?username='.$username.'&password='.$password.'&message='.$textmessage.'&numbers='.$mobileno.'&sender='.$sender.'&unicode=e&Rmduplicated=1&return=xml';

				  curl_setopt_array($curl, array(
				  CURLOPT_URL => $api_url,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "GET",
				  CURLOPT_HTTPHEADER => array(
				    
				  ),
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);
		
				if ($err) {
				  return "cURL Error #:" . $err;
				} else {
				  return $response;
				}
		}else if($phone_code==971)
		{
			$curl = curl_init();
			$username 		= 'Marzouqa';
			$password 		= 'Knq7dgw4iy'; 
			$senderid 	= 'Marzouqa';
			$textmessage = urlencode($textmessage);
			
			$api_url = 'https://smartsmsgateway.com/api/api_http.php?username='.$username.'&password='.$password.'&senderid='.$senderid.'&to='.$mobileno.'&text='.$textmessage.'&type=text&unicode=e&Rmduplicated=1&return=xml';

			curl_setopt_array($curl, array(
			  CURLOPT_URL =>$api_url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "Accept: *",
			    "Cache-Control: no-cache",
			    "Connection: keep-alive",
			    "Host: smartsmsgateway.com",
			    "Postman-Token: 833a6fa2-af7b-4dcf-bc4a-75893c6e62fe,3a411d56-bd37-461a-a475-b08a7b8700c1",
			    "User-Agent: PostmanRuntime/7.15.0",
			    "accept-encoding: gzip, deflate",
			    "cache-control: no-cache"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  return "cURL Error #:" . $err;
			} else {
			  return $response;
			}
		}elseif ($phone_code==20) {
			$curl = curl_init();

			$username 		= 'Kbas7kYe';
			$password 		= 'wfWRywuuxJ'; 
			$senderid 		= 'The Gate';
			$sender = curl_escape($curl, 'The Gate');
			$textmessage = curl_escape($curl, $textmessage);
			$mobileno = ltrim($mobileno,'+');
			$api_url =  'https://smsmisr.com/api/webapi/?username='.$username.'&password='.$password.'&language=1&sender='.$sender.'&mobile='.$mobileno.'&message='.$textmessage;
			
			 curl_setopt_array($curl, array(
			  CURLOPT_URL => $api_url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_HTTPHEADER => array(
			    "Accept: *",
			    "Accept-Encoding: gzip, deflate",
			    "Cache-Control: no-cache",
			    "Connection: keep-alive",
			    "Content-Length: 0",
			    "Host: smsmisr.com",
			    "Postman-Token: eb6f3ba4-1f41-47b2-a1e2-3f10e3510904,1b44f50e-9338-465a-8c3c-1164f9813212",
			    "User-Agent: PostmanRuntime/7.16.3",
			    "cache-control: no-cache"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);
			
			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
			  echo $response;
			}
			
			
			
		}else if($phone_code==91)
		{ 
			
			$id = "AC3b7ea60b9a5e4507f0132c0b03580873";
			$token = "2517558c67e3ae9421b6a71acf6ef450";
			$url = "https://api.twilio.com/2010-04-01/Accounts/$id/SMS/Messages";
			$from = "+12562903976";
			$to = "+".$mobileno; // twilio trial verified number
			//$to = "+919500478228";
			//$body = "using twilio rest api from marzouqa";
			$data = array (
			    'From' => $from,
			    'To' => $to,
			    'Body' => $textmessage,
			);
			$post = http_build_query($data);
			$x = curl_init($url);
			curl_setopt($x, CURLOPT_POST, true);
			curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($x, CURLOPT_USERPWD, "$id:$token");
			curl_setopt($x, CURLOPT_POSTFIELDS, $post);
			$y = curl_exec($x);
			curl_close($x);

		}else if($phone_code==249){
			$curl = curl_init();
			$username 		= 'marz';
			$password 		= '100321'; 
			$senderid 		= 'Marzouqa';
			$textmessage = curl_escape($curl, $textmessage);
			$mobileno = ltrim($mobileno,'+');
			$api_url =  'http://212.0.129.229/bulksms/webacc.aspx?user='.$username.'&pwd='.$password.'&smstext='.$textmessage.'&Sender='.$senderid.'&Nums='.$mobileno;
			curl_setopt_array($curl, array(
			  CURLOPT_URL => $api_url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "Accept: *",
			    "Accept-Encoding: gzip, deflate",
			    "Cache-Control: no-cache",
			    "Connection: keep-alive",
			    "Host: 212.0.129.229",
			    "Postman-Token: 066e43ee-d074-4cbe-bd74-4205592f023a,f1223663-7949-4990-9e1b-005197acb4b3",
			    "User-Agent: PostmanRuntime/7.17.1",
			    "cache-control: no-cache"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

		curl_close($curl);
			print_r($response);exit();
			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
			  echo $response;
			}
		}else if($phone_code==212){ // Morroco

			$curl = curl_init();
			$username 		= 'marzouqa';
			$password 		= 'fati2019'; 
			$textmessage = curl_escape($curl, $textmessage);
			$api_url =  "http://sms.sip.ma/sms_web/smsenvoi.php?log=".$username."&mp=".$password."&ndest=".$mobileno."&message=".$textmessage."&id=1111&dcs=0&shortcode=MARZOUQA";

			curl_setopt_array($curl, array(
			  CURLOPT_URL => $api_url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "Accept: *",
			    "Accept-Encoding: gzip, deflate",
			    "Cache-Control: no-cache",
			    "Connection: keep-alive",
			    "Host: sms.sip.ma",
			    "Postman-Token: 0aadb953-ced6-44f7-aadc-cc7e4d4cb020,e92276ae-7ce4-4753-b43e-8a357773e369",
			    "User-Agent: PostmanRuntime/7.17.1",
			    "cache-control: no-cache"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);
			
		}*/

	}
?>
