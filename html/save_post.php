<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
session_start();
if($_POST){
	require_once ('MySQLi.php');

	$db = new MysqliDb ('localhost', 'root', 'azimamilancheesetopsvespa', 'mydb');

	$post=$_POST['post'];
	// $username = $_POST['username'];
	// $ip = $_POST['ip'];
	$trimmed = "no";
	$image = $_FILES['image'];

	$username = $_SESSION['username'];
	$ip = $_SERVER['REMOTE_ADDR'];

	$corruptedCookie = "no";


	// echo "print files : ";
	// print_r($_FILES);

	// echo "print post : ";
	// print_r($_POST);

	//check if the cookie wasn't corrupted
	if(!isset($_SESSION['username'])){
		$corruptedCookie = "yes";
	}


	$fileFlag="no";
	$wrongMimeFlag = "no";
	//check if the FILES field are set
	if ($corruptedCookie == "no") {

		if (is_uploaded_file($_FILES['image']['tmp_name'])) {

			$acceptedExtensions = array('image/png','image/jpeg','image/gif');
			
			//then check the MIME type to see if it's an image
			if(in_array(mime_content_type($_FILES['image']['tmp_name']), $acceptedExtensions)){
				$fileFlag = "yes";
			}
			else{
				//bad mime type - store it 
				$wrongMimeFlag ="yes";
				$MimeTriedToUpload = mime_content_type($_FILES['image']['tmp_name']);
			}

			if($fileFlag == "yes"){
				$file = rand(1000,100000)."-".$_FILES['image']['name'];
			    $file_loc = $_FILES['image']['tmp_name'];
			 	$file_size = $_FILES['image']['size'];
			 	$file_type = $_FILES['image']['type'];

			 	//create (if doesnt exists yet)dir where image is going to be stored
			 	if (!file_exists('uploads')) {
			    mkdir('uploads', 0777, true);
				}

			 	$folder="uploads/";

				// new file size in KB
				$new_size = $file_size/1024;  
				// new file size in KB

				// make file name in lower case
				$new_file_name = strtolower($file);
				// make file name in lower case

				$final_file=str_replace(' ','-',$new_file_name);

				//move file to uploads folder
				if(move_uploaded_file($file_loc,$folder.$final_file))
				{
					// echo "file moved. to ".$folder.$final_file;
					$fileFlag = "yes";
				}
			}
		}	

	 	// echo "file ".$file." .loc ".$file_loc." .size ".$file_size." . type ".$file_type;

		//check that post is less than 255 chars
		if (strlen($post)>254) {
			//if so trim it
			$post = substr($post, 0, 254);
			$trimmed = "yes";
		}

		$now = date('Y-m-d H:i:s');

		$data = array(
			"username" => $username,
			"post" => $post,
			"ip" => $ip,
			"trimmed" => $trimmed,
			"date" => $now
		);


		//if the file was successfully uploaded, add it to the data array
		if ($fileFlag == "yes") {
			$data["fileName"] = $final_file;
			$data["fileSizeKB"] = $new_size;
			$data["fileType"] = $file_type;
		}

		//if user triued to upload wrong mime type, let's save what mime it was
		if($wrongMimeFlag == "yes"){
			$data["wrongMimeType"] = $MimeTriedToUpload;
		}

		//SQL 
		$db->insert('Posts',$data);
		
		echo "posted!";
	}

	// //if username was not set, i.e. cookie corrupted, save to log
	// else{
	// 	$db->insert('PostsAttempts',$data);	
	// }

}
?>