<?php
	 function deleteRecord(mysqli $db, $id){
		$sql ="DELETE FROM `images` WHERE id='".$id."'";
		$result = $db->query($sql);
		if(!$result){
			throw new Exception('Cannot delete');
		}
	}
    header("Location: /add_an_employee.php");
?>