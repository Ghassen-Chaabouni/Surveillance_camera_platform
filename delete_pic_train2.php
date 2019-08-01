<?php

$pic='';
if(!empty($_GET['pic'])){
	$pic = $_GET['pic'];
}
if(empty(pic)){
	throw new Exception('Error');
}

unlink($pic);
$dirname = dirname($pic);
$files = scandir($dirname);
if (count($files)<=2){
    array_map('unlink', glob("$dirname/*.*"));
    rmdir($dirname);
}


header("Location: /enter_exit.php");
?>