 <?php
	require_once 'db.php';
	
	$servername = "localhost:3306";
	$username = "root";
	$password = "root";
	$databaseName = "database";

	$conn = new mysqli($servername,$username,$password,$databaseName);
	 
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	$time='';
	if(!empty($_GET['Time'])){
		$time = $_GET['Time'];
	}
	if(empty(time)){
		throw new Exception('ID is blank');
	}
	deleteRecord($conn,$time);

	$picture='';
	if(!empty($_GET['Picture'])){
		$picture = $_GET['Picture'];
	}
	if(empty($picture)){
		throw new Exception('Picture is blank');
	}

    unlink($picture);


	header("Location: /index.php");
	die;
  
?>
