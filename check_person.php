<?php
    $id = $_GET['id'];

    $pyscript = 'C:\\MAMP\\htdocs\\check_person.py';
    $python = 'C:\\Users\\admin\\AppData\\Local\\Programs\\Python\\Python37\\python.exe';
    $cmd = "$python $pyscript '".$id."'";
    exec("$cmd", $output);
    header("Location: /main.php?id=".$id);
?>