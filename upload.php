<?php
  include "dbConfig.php";

  $file = $_FILES['file'];
  $fileName = $_FILES['file']['name'];
  $name = $_POST['text'];

  $total = count($fileName);
  for( $i=0 ; $i < $total ; $i++ ) {
    $b=false;
    $n='';
    $file = $_FILES['file'][$i];
    $fileName = $_FILES['file']['name'][$i];
    $fileTmpName = $_FILES['file']['tmp_name'][$i];
    $fileSize = $_FILES['file']['size'][$i];
    $fileError = $_FILES['file']['error'][$i];
    $fileType = $_FILES['file']['type'][$i];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)){
        if ($fileError == 0){
            if ($fileSize < 5000000){
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                if (!file_exists('worker faces/'.$_POST["text"])) {
                    mkdir('worker faces/'.$_POST["text"], 0777, true);
                }
                $fileDestination = 'worker faces/'.$_POST["text"].'/'.$fileNameNew;

                move_uploaded_file($fileTmpName, $fileDestination);
                $sql = "SELECT * FROM `images`";
                $result = $db->query($sql);
                if ($result->num_rows> 0) {

                     while($row = $result->fetch_assoc()) {
                      if((strcmp($row[name],$name)==0)){
                          echo "<h3>".$total."<h3/>";
                          $n=$row[imagename].$fileDestination.'-';
                          $s = "UPDATE `images` SET `imagename`='".$n."' WHERE name='".$row[name]."'";
                          mysqli_query($db,$s);
                          $b=true;
                          $n="";
                          break;
                    }
                    }
                    if($b!=true){
                        $query = "insert into images (name,imagename) values('".$name."','".$fileDestination.'-'."')";
                        mysqli_query($db,$query);
                    }
                 }else{
                      $query = "insert into images (name,imagename) values('".$name."','".$fileDestination.'-'."')";
                      mysqli_query($db,$query);
                 }
            } else{
                echo "Your file is too big.";
            }
        }else{
            echo "There was an error uploading your file.";
        }
    } else{
        echo "You cannot upload files of this type.";
    }
  }

  header("Location: /add_an_employee.php");
?>
