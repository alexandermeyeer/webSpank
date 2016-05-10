<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

if($_POST){

		//echo "<pre>".print_r($_POST)."</pre>";
	require_once ('MySQLi.php');

	$db = new MysqliDb ('localhost', 'root', 'azimamilancheesetopsvespa', 'mydb');

	$user=$_POST['username'];
	$pass=$_POST['password'];

	$queryString="SELECT * FROM Users WHERE username = '". $user ."' AND password= '" . $pass . "'";
	
	$queryUser=$db->query($queryString);

		if($queryUser)
		{
			echo "yass";
		}
		else
		{
			echo $queryString;
		}
	}

?>






