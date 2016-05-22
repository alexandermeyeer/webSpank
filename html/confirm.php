<?php

require_once ('MySQLi.php');

$db = new MysqliDb ('localhost', 'root', 'azimamilancheesetopsvespa', 'mydb');

//setup some variables
$action = array();
$action['result'] = null;

//check if the $_GET variables are present
	
//quick/simple validation
if(empty($_GET['email']) || empty($_GET['key'])){
	$action['result'] = 'error';
	$action['text'] = 'We are missing variables. Please double check your email.';			
}
		
if($action['result'] != 'error'){

	//cleanup the variables
	$email =$_GET['email'];
	$key =$_GET['key'];
	
	//check if the key is in the datab
	$check_key = $db->query("SELECT userid FROM confirm WHERE email = '$email' AND `key` = '$key' LIMIT 1");
	

				
		//get the confirm info
		$confirm_info = $check_key[0]['userid'];
		//confirm the email and update the users database
		$update_users = $db->query("UPDATE Users SET active = 1 WHERE id ='". $confirm_info ."'");
		//delete the confirm row
		$delete = $db->query("DELETE FROM confirm WHERE userid = '". $confirm_info ."'");
		
		if($update_users){
						
				
			$action['result'] = 'success';
			$action['text'] = 'User has been confirmed. Thank-You!';
			

		
		}else{

			$action['result'] = 'error';
			$action['text'] = 'The user could not be updated Reason: '.mysql_error();

		
		}

		header( "Location:http://46.101.98.185/index.php" );	

		
	
	
}


?>



