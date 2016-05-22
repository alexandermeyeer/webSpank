<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
session_start();

if($_POST){

	require_once ('MySQLi.php');

	$db = new MysqliDb ('localhost', 'root', 'root', 'mydb');

	$result=$db->query("SELECT id, username , date, post, fileName FROM Posts");
	
	print_r(json_encode($result));
}
			
?>