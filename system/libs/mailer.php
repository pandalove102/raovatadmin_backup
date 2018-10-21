<?php

function sendMail($nguoi_nhan,$tieu_de,$noi_dung, $bat_html=0)
{

	/*include 'class.phpmailer.php';
	include 'class.smtp.php';	
	$mailcfg['mailfrom'] = 'support@ngoalongvn.com';
	$mailcfg['fromname'] = 'Support Ngọa Long';
	$mailcfg['smtpauth'] = 1;
	$mailcfg['smtphost'] = 'smtp.zoho.com';
	$mailcfg['smtpuser'] = 'support@ngoalongvn.com';
	$mailcfg['smtppass'] = 'supportngoalong2017';
	$mailcfg['smtpsecure'] = 'ssl';//:'tls';
	$mailcfg['smtpport'] =  465;*/
	
	include 'class.phpmailer.php';
	include 'class.smtp.php';	
	$mailcfg['mailfrom'] = 'huysusano@gmail.com';
	$mailcfg['fromname'] = 'Support Ngọa Long';
	$mailcfg['smtpauth'] = 1;
	$mailcfg['smtphost'] = 'smtp.zoho.com';
	$mailcfg['smtpuser'] = 'huysusano@gmail.com';
	$mailcfg['smtppass'] = 'NtjykBVGQnTd';//NgoaLong2017!@#';//
	$mailcfg['smtpsecure'] = 'ssl';//:'tls';
	$mailcfg['smtpport'] =  465;
	
	
	$mail = new PHPMailer();
	$mail->IsSMTP(); // set mailer to use SMTP
	
	$mail->Host = $mailcfg['smtphost']; // specify main and backup server
	$mail->Port = $mailcfg['smtpport']; // set the port to use
	$mail->SMTPAuth = $mailcfg['smtpauth']==0?false:true; // turn on SMTP authentication
	$mail->SMTPSecure = $mailcfg['smtpsecure'];
	$mail->Username = $mailcfg['smtpuser']; // your SMTP username or your gmail username
	$mail->Password = $mailcfg['smtppass']; // your SMTP password or your gmail password
	$from =  "".$mailcfg['mailfrom'].""; // Reply to this email
	$to   =  $nguoi_nhan; // Recipients email ID
	$name =  $nguoi_nhan; // Recipient's name
	$mail->From = $from;
	$mail->FromName = $mailcfg['fromname']; // Name to indicate where the email came from when the recepient received
	$mail->AddAddress($to,$name);
	$mail->AddReplyTo($from,"Administrator");
	$mail->WordWrap = 50; // set word wrap
	$mail->IsHTML($bat_html); // send as HTML
	$mail->CharSet= "utf-8";
	$mail->Subject = $tieu_de;
	$mail->Body = $noi_dung; //HTML Body
	$mail->AltBody = "Mail được gửi từ ".DOMAIN; //Text Body
	//$mail->SMTPDebug = 2;
	//echo '<pre>',print_r($mail),'</pre>';exit;
	return $mail->Send();
}
?>