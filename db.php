<?php
    function deleteRecord(mysqli $db, $time){
	$sql ="DELETE FROM `database` WHERE Time='".$time."'";
	$result = $db->query($sql);
	if(!$result){
		throw new Exception('Cannot delete');
	}
     }
?>
