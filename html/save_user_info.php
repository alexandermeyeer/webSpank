<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

require 'vendor/autoload.php';
require 'PHPMailerAutoload.php';

if($_POST){

		//echo "<pre>".print_r($_POST)."</pre>";
	require_once ('MySQLi.php');

	$db = new MysqliDb ('localhost', 'root', '', 'mydb');

	$user=$_POST['username'];
	$pass=$_POST['password'];
	$hash = password_hash($pass, PASSWORD_BCRYPT);
	$encoded = base64_encode($hash);

	$ipproxy=getenv('HTTP_X_FORWARDED_FOR');

	$data = array(
		"username" => $user,
		"password" => $encoded,
		"ip" =>$_SERVER['REMOTE_ADDR'],
		"ipxproxy" =>$ipproxy,
		"date"=>$_SERVER['REQUEST_TIME'],
        );
	
	$queryToTest = $db->query("SELECT * FROM Users WHERE username = '" . $user . "'");
	


	$mail = new PHPMailer;
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.mailgun.org';                     // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'postmaster@sandbox4ee96bafb8bc42ac890d19f804ec904e.mailgun.org';   // SMTP username
	$mail->Password = 'e4d1ca6ba195a78aa8ed34fc53d50718';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable encryption, only 'tls' is 
	$mail->From = 'postmaster@sandbox4ee96bafb8bc42ac890d19f804ec904e.mailgun.org';
	$mail->FromName = 'Support';
	$mail->addAddress($user);                 // Add a recipient
	$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
	$mail->Subject = 'Confirm your account at Dream Team';

	if($queryToTest)
	{
		echo "notok";
	}
	else
	{
		$db->insert('Users',$data);
		
		$userid = $db->getInsertId();	             
			//create a random key
		$key = $user.date('mY');			
		$key = md5($key);
		$confirm = $db->query("INSERT INTO `confirm` VALUES(NULL,'$userid','$key','$user')");
	           
		$mail->Body=
			"Welcome!Thank-you for creating an account. Please confirm your account by copy and pasting the link below into your browsers address bar. http://localhost/confirm.php?email=".$user."&key=".$key." Thanks!";


		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		} else 
		{
		    echo 'Message has been sent';
		}
				//}

		}
	}

	

?>