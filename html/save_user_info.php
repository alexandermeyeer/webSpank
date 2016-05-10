<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

if($_POST){

		//echo "<pre>".print_r($_POST)."</pre>";
	require_once ('MySQLi.php');

	$db = new MysqliDb ('localhost', 'root', 'azimamilanchesetopsvespa', 'mydb');

	$data = array(
		"username" => $_POST['username'],
		"password" => $_POST['password'],
        );
	$db->insert('Users',$data);
}
?>