<style>
    #camera_navbar{
        margin-left:20px
    }
    #employee_navbar{
        margin-left:20px
    }
    #live_navbar{
        margin-left:20px
    }
    #junk_navbar{
        margin-left:20px
    }
</style>

<!DOCTYPE html>
<html>
<head>
 <title>GSCam</title>
</head>
<body style="background-color: #eee;">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <?php
        $id = $_GET['id'];
    ?>
    <div  id="navbar">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <?php
                echo'<a class="navbar-brand" href="choose_a_camera.php?id='.$id.'" id="navbar_title">GSCam</a>';
            ?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse navbar-fixed-top" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item" id="camera_navbar">
                        <?php
                            echo '<a class="nav-link" href="main.php?id='.$id.'">Camera</a>';
                        ?>
                    </li>
                    <li class="nav-item" id="employee_navbar">
                        <?php
                            echo '<a class="nav-link" href="add_an_employee.php?id='.$id.'">Add an employee</a>';
                        ?>
                    </li>
                    <li class="nav-item" id="live_navbar">
                        <?php
                            echo '<a class="nav-link" href="enter_exit.php?id='.$id.'">Enter/Exit</a>';
                        ?>
                    </li>
                    <li class="nav-item" id="junk_navbar">
                        <?php
                            echo '<a class="nav-link" href="junk.php?id='.$id.'">Junk</a>';
                        ?>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="content" id="main_content">
	    <div class="container">
            <div align="center" id="main">
                <br />
                <?php
                    echo "<img src='my_plot2_".$id.".PNG'>";
                ?>
            </div>
        </div>
    </div>

</body>
</html>

<?php
     $epoch = $_POST['epoch'];
     $pyscript = 'C:\\MAMP\\htdocs\\online_learning_enter_exit2.py';
     $python = 'C:\\Users\\admin\\AppData\\Local\\Programs\\Python\\Python37\\python.exe';
     $cmd = "$python $pyscript '".$id."' '".$epoch."'";
     exec("$cmd", $output);
?>
