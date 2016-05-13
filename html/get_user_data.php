<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
session_start();

if($_POST){

		//echo "<pre>".print_r($_POST)."</pre>";
	require_once ('MySQLi.php');

	$db = new MysqliDb ('localhost', 'root', 'azimamilancheesetopsvespa', 'mydb');

	$user=$_POST['username'];
	$pass=$_POST['password'];

	/*$hash = password_hash($pass, PASSWORD_BCRYPT);*/
	//$encoded = base64_encode($hash);

	$queryPass=$db->query("SELECT password FROM Users WHERE username = '". $user ."'");
	$decodedHash=base64_decode($queryPass[0]['password']);
	$dataYes="yes";
	$dataNo="no";



	// $queryString="SELECT * FROM Users WHERE username = '". $user ."' AND password= '" . $hash . "'";
	
	// $queryUser=$db->query($queryString);

		if(password_verify($pass,$decodedHash))
		{
			echo $dataYes;
			$_SESSION['username'] = $user;
		}
		else
		{
			echo $dataNo;

			
		}
	}

?>