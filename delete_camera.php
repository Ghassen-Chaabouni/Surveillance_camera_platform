<?php
    require_once 'rrmdir.php';
    $id = $_GET['id'];

    $servername = "localhost:3306";
    $username = "root";
    $password = "root";
    $databaseName = "database".$id;

    $conn = new mysqli($servername, $username, $password);

    $query = "DROP DATABASE ".$databaseName;
    if ($conn->query($query) === TRUE) {
        echo "Database dropped successfuly.";
    } else {
        echo "Unable to drop database " . $connection->error;
    }
    $conn->close();

    $dbname = "camera";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM `camera` WHERE id='".$id."'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();

    $dir = "worker faces".$id;
    $x = rrmdir($dir);

    $dir = "validation".$id;
    $x = rrmdir($dir);

    $dir = "unprocessed images".$id;
    $x = rrmdir($dir);

    $dir = "saved_models".$id;
    $x = rrmdir($dir);

    $dir = "not a person".$id;
    $x = rrmdir($dir);

    $dir = "finish check faces".$id;
    $x = rrmdir($dir);

    $dir = "enter_exit_validation".$id;
    $x = rrmdir($dir);

    $dir = "enter_exit_saved_model".$id;
    $x = rrmdir($dir);

    $dir = "enter_exit".$id;
    $x = rrmdir($dir);

    $dir = "check faces".$id;
    $x = rrmdir($dir);

    $file = "dataset_".$id.".csv";
    unlink($file);

    $file = "dataset2_".$id.".csv";
    unlink($file);

    $file = "dataset_".$id.".csv";
    unlink($file);

    $file = "my_plot_".$id.".png";
    unlink($file);

    $file = "my_plot2_".$id.".png";
    unlink($file);

    header("Location: /choose_a_camera.php?id=".$id);
?>

