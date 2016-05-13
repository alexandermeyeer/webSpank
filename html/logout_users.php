<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
	session_start();

	if($_POST){
		echo "logged out";
		
		
	}
	else
		//echo "not logged out and request is".$_SERVER['REQUEST_METHOD'];
		echo "logged out";
		unset($_SESSION['username']);

?>