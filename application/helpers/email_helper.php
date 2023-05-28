<?php
	function sendEmail($email,$textmessage, $subject)
	{

		$curl = curl_init();
		$from_email="otp@marzouqa.com";
		//$sendgrid_api="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";
		$sendgrid_api="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";

		$data = array(
 					"personalizations" => array( array(
 											"to" =>array( array("email" => $email))
 										)),
 					"from" => array("email" => $from_email, "name"=> "Marzouqa"),
 					"subject" => $subject,
 					"content" => array(array( "type" => "text/html", "value" => $textmessage))
 		);
 			
		//print_r(json_encode($data));
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  //CURLOPT_POSTFIELDS => '{"personalizations": [{"to": [{"email": "'.$email.'"}]}],"from": {"email": "'.$from_email.'"},"subject": "'.$subject.'","content": [{"type": "text/html", "value": "'.base64_encode($textmessage).'"}]}',
		  CURLOPT_POSTFIELDS => json_encode($data),

		  CURLOPT_HTTPHEADER => array(
		    "authorization: Bearer ".$sendgrid_api,
		    "cache-control: no-cache",
		    "content-type: application/json"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);

	/*if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		}
		print_r($err);
		echo "response";
		print_r($response);
exit();*/
	}
?>
