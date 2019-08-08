<?php
    $servername = "localhost:3306";
    $username = "root";
    $password = "root";
    $databaseName = "camera";

    $conn = new mysqli($servername,$username,$password,$databaseName);

    $id = (int)$_GET['id'];
    $sql = "SELECT * FROM `camera` WHERE `id`='".$id."'";
    $result = $conn->query($sql);
    $ch = "";
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $ch = $row['camera_image'];
        }
    }
    $conn->close();

    $pyscript = 'C:\\MAMP\\htdocs\\open_camera.py';
    $python = 'C:\\Users\\admin\\AppData\\Local\\Programs\\Python\\Python37\\python.exe';
    $cmd = "$python $pyscript '".$ch."' '".$id."'";
    exec("$cmd", $output1);

    header("Location: /main.php?id=".$id);
?>