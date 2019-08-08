<?php
    $servername = "localhost:3306";
    $username = "root";
    $password = "root";
    $databaseName = "camera";

    $conn = new mysqli($servername,$username,$password,$databaseName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	$camera_image = $_GET['camera_image'];
    $camera_name = $_GET['camera_name'];


    $sql2 = "INSERT INTO `camera`(`camera_name`,`camera_image`) VALUES ('".$camera_name."','".$camera_image."')";
    mysqli_query($conn,$sql2);
    $conn->close();

    header("Location: /choose_a_camera.php");
?>