<?php

// Google reCAPTCHA API keys settings  
$secretKey     = '6LfbdR8oAAAAAEfrkoyrFkz8k7mabjdmlO_pTR_N'; 

if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){  
  
	// Google reCAPTCHA verification API Request  
	$api_url = 'https://www.google.com/recaptcha/api/siteverify';  
	$resq_data = array(  
	    'secret' => $secretKey,  
	    'response' => $_POST['g-recaptcha-response'],  
	    'remoteip' => $_SERVER['REMOTE_ADDR']  
	);  
  
	$curlConfig = array(  
	    CURLOPT_URL => $api_url,  
	    CURLOPT_POST => true,  
	    CURLOPT_RETURNTRANSFER => true,  
	    CURLOPT_POSTFIELDS => $resq_data  
	);  
  
	$ch = curl_init();  
	curl_setopt_array($ch, $curlConfig);  
	$response = curl_exec($ch);  
	curl_close($ch);  
  
	// Decode JSON data of API response in array  
	$responseData = json_decode($response);  
  
	// If the reCAPTCHA API response is valid  
	if($responseData->success){
	
	require 'PHPMailer/PHPMailerAutoload.php';

		$MailSubject=$_POST["subject"];
		$UsrName=$_POST["name"];
		$UsrEmaile=$_POST["email"];
		$UsrMessage=nl2br($_POST["message"]);


		$mail = new PHPMailer;


		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.zoho.in';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = "admin@roadpartner.in";
		$mail->Password = "m%2vswdE";
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->setFrom('admin@roadpartner.in', 'Road Partner');
		$mail->addAddress('info@roadpartner.in', 'Web Submission');
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = $MailSubject;
		$mail->Body = "<b>Sender Email: </b>" .$UsrEmaile. "<br><b>Sender Name: </b>" .$UsrName. "<br><br><b>Message:</b><br>" .$UsrMessage ;
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			header("Location:../?sendmail=success#email-form");
		}


	} else {
		header("Location:../?sendmail=captcha#email-form");
		}
}

?>