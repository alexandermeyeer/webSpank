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
	$hash = password_hash($pass, PASSWORD_BCRYPT);
	$encoded = base64_encode($hash);



	$data = array(
		"username" => $user,
		"password" => $encoded,
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
