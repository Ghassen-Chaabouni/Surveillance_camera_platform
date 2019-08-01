<?php

  $file = $_FILES['file'];
  $fileName = $_FILES['file']['name'];

  $total = count($fileName);
  for( $i=0 ; $i < $total ; $i++ ) {
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
                if (!file_exists('worker faces/'.$_POST["name"])) {
                    mkdir('worker faces/'.$_POST["name"], 0777, true);
                }
                $fileDestination = 'worker faces/'.$_POST["name"].'/'.$fileNameNew;

                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location: train.php?uploadsuccess");
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

header("Location: /train.php");
?>