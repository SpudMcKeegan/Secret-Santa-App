<?php
	$toEmail = $_GET['toEmail'];
	$subject = "Your Person for Secret Santa";
	$to = $_GET['to'];
	$from = $_GET['from'];
	$message = "Hey " . $from . ", you got " . $to . " for secret santa \n
				--fauxgeek.com";

	$headers = "From: secretsanta@fauxgeek.com" . "\r\n";
	$headers .= "Bcc: secretsanta@fauxgeek.com";
	mail($toEmail,$subject,$message,$headers);	
?>