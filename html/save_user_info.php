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

	$data = array(
		"username" => $user,
		"password" => $pass,
        );
	$queryToTest = $db->query("SELECT * FROM Users WHERE username = '" . $user . "'");

	if($queryToTest)
	{
		echo "notok";
	}
	else
	{
	$db->insert('Users',$data);
	echo "ok";
	}
}
?>