<?php
include "dbConfig.php";


$pic='';
if(!empty($_GET['pic'])){
	$pic = $_GET['pic'];
}
if(empty(pic)){
	throw new Exception('Error');
}

$image='';
if(!empty($_GET['image'])){
	$image = $_GET['image'];
}

if(empty(image)){
    throw new Exception('Error');
    }

$i=0;
$pos=strpos($image,$pic);
for($i=$pos;$i<strlen($image);$i++){
     if(strcmp($image[$i],"-")==0){
        break;
    }
}
$ch1='';
$k=0;
while($k<$pos){
    $ch1=$ch1.$image[$k];
    $k=$k+1;
}
$k=$i;
while($k<strlen($image)){
    $k=$k+1;
    $ch1=$ch1.$image[$k];
}
$t=$_GET['id'];
$s = "UPDATE images SET `imagename`='".$ch1."' WHERE id='".$t."'";
mysqli_query($db,$s);

unlink($pic);
$dirname = dirname($pic);
$files = scandir($dirname);
if (count($files)<=2){
    array_map('unlink', glob("$dirname/*.*"));
    rmdir($dirname);
}

header("Location: /add_an_employee.php");
?>