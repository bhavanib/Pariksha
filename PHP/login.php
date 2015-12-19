<?php
	//It's advisable that you have an array of possible users here, for quick prototyping.
	//Or use a $con = mysqli(); and query. Use mysqli over mysql. :) 
	$username = $_POST["username"];
	$password = $_POST["password"];
	$response = array("status" => "false");
	if($username == "a" && $password == "abcd"){
		$response["status"] = "true";
	}
	echo json_encode($response);
	//echo $username." : ".$password
?>