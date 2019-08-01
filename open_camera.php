<?php
    $pyscript = 'C:\\MAMP\\htdocs\\open_camera.py';
    $python = 'C:\\Users\\admin\\AppData\\Local\\Programs\\Python\\Python37\\python.exe';
    $cmd = "$python $pyscript";
    exec("$cmd", $output1);

    header("Location: /index.php");
?>