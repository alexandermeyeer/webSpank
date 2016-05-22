<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
session_start();

if($_POST){


	require_once ('MySQLi.php');

	$db = new MysqliDb ('localhost', 'root', 'azimamilancheesetopsvespa', 'mydb');

	$user=$_POST['username'];
	$pass=$_POST['password'];
	$dataYes="yes";
	$dataNopass="nopass";
	$dataActive="notactive";

	/*$hash = password_hash($pass, PASSWORD_BCRYPT);*/
	//$encoded = base64_encode($hash);

	$queryPass=$db->query("SELECT password FROM Users WHERE username = '". $user ."'");
	
	if(!($queryPass))
	{
		echo $dataNopass;
	}
	else
	{
		
		$decodedHash=base64_decode($queryPass[0]['password']);
	
		$queryActive=$db->query("SELECT active, admin FROM Users WHERE username = '". $user ."'");

		if(password_verify($pass,$decodedHash))
		{	
			if($queryActive[0]['active'])
			{	
				echo $dataYes;
				$_SESSION['username'] = $user;

				if($queryActive[0]['admin']==1)
				{
					$_SESSION['admin'] = $user;
				}

			}
			else
			{
				echo $dataActive;
			}
		}
		else
		{
			echo $dataNopass;

			
		}
	}
}

?>