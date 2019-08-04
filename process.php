<?php
include "config.php";

	if(isset($_POST)){

	$firstname 		= $_POST['firstname'];
	$lastname 		= $_POST['lastname'];
	$email 			= $_POST['email'];
	$phonenumber	= $_POST['phonenumber'];
	$password 		= sha1($_POST['password']);

		$sql = "INSERT INTO `users`(`firstname`, `lastname`,`email`,`phonenumber`,`password`) VALUES ('".$firstname."', '".$lastname."', '".$email."', '".$phonenumber."', '".$password."')";
    	$Result=$db->query($sql);
    	if($Result){
			echo 'Successfully saved.';
		}else{
			echo 'There were erros while saving the data.';
		}
}else{
	echo 'No data';
}

?>
