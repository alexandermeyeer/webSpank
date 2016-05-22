<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	if (isset($_SESSION['admin'])) {

		require_once ('MySQLi.php');

		$db = new MysqliDb ('localhost', 'root', 'azimamilancheesetopsvespa', 'mydb');

		$postID=$_POST['postID'];
		$result=$db->query("DELETE FROM Posts WHERE id = ".$postID);

		echo(json_encode($result));
		
	}
}
?>