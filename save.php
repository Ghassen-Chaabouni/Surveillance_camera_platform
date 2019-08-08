<?php
    $id = $_GET['id'];

    $servername = "localhost:3306";
    $username = "root";
    $password = "root";
    $databaseName = "database".$id;

    $conn = new mysqli($servername,$username,$password,$databaseName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $conn2 = $conn;
    $name = $_POST['name'];
    $time = $_POST['time'];
    $radio = $_POST['enter_exit'];
    $picture = $_POST['picture'];

    $b2 = 0;
    $sql2 = "SELECT `Name` FROM `database` WHERE Time='".$time."' ORDER BY `Name`";
    if($queryResult = mysqli_query($conn, $sql2)){
        while ($row=mysqli_fetch_row($queryResult)){
            $result2 = $row[0];
            if($result2 != $name){
                $b2 = 1;
                $dir = "worker faces".$id."/".$name;
                $a = mt_rand(1,999999);
                if ( file_exists( $dir ) && is_dir( $dir ) ) {
                    $picture2 = $dir.'/'.$a.'.jpg';
                    copy($picture, $picture2);
                    break;
                }else{
                    mkdir($dir);
                    $picture2 = $dir.'/'.$a.'.jpg';
                    copy($picture, $picture2);
                    break;
                }
            }
        }
    }

    if($b2==1){
        $b = 0;
        $sql3 = "SELECT * FROM `images` ORDER BY `name`";
        if($result3 = mysqli_query($conn2, $sql3)){
            while($row3 = mysqli_fetch_array($result3)){
                if($row3['name']==$name){
                    $b = 1;
                    break;
                }
            }
        }

        $ch = $picture2." - ";
        if($b==1){
            $sql4 = "UPDATE `images` SET `imagename`=CONCAT(`imagename`,'".$ch."') WHERE `name`='".$name."'";
            mysqli_query($conn2,$sql4);
        }else{
            $sql4 = "INSERT INTO `images`(`name`, `imagename`) VALUES ('".$name."', '".$ch."')";
            mysqli_query($conn2,$sql4);
        }
    }

    $sql3 = "SELECT `Enter_Exit` FROM `database` WHERE Time='".$time."' ORDER BY `Name`";
    if($queryResult = mysqli_query($conn, $sql3)){
        while ($row=mysqli_fetch_row($queryResult)){
            $result2 = $row[0];
            if($result2 != $radio){
                $dir = "enter_exit".$id."/".$radio;
                $a = mt_rand(1,999999);
                if ( file_exists( $dir ) && is_dir( $dir ) ) {
                    copy($picture, $dir.'/'.$a.'.jpg');
                    break;
                }else{
                    mkdir($dir);
                    copy($picture, $dir.'/'.$a.'.jpg');
                    break;
                }
            }
        }
    }

    $sql = "UPDATE `database` SET `Name`='".$name."' WHERE Time='".$time."'";
    if(mysqli_query($conn, $sql)){
        echo "Names were updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    $sql = "UPDATE `database` SET `Enter_Exit`='".$radio."' WHERE Time='".$time."'";
    if(mysqli_query($conn, $sql)){
        echo "Enter/Exit were updated successfully.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    $conn->close();
    $conn2->close();
    header("Location: /main.php?id=".$id);
?>
