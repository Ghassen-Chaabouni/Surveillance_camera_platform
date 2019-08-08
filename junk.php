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
    #navbar{
        z-index:1;
    }
    .sticky {
        position: fixed;
        top: 0;
        width: 100%;
    }
    .sticky + .content {
        padding-top: 60px;
    }
    .content {
        padding: 16px;
    }
    #card{
        display: inline-block;
        margin:10px;
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
                echo '<a class="navbar-brand" href="choose_a_camera.php?id='.$id.'" id="navbar_title">GSCam</a>';
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
                    <li class="nav-item active" id="junk_navbar">
                        <?php
                            echo '<a class="nav-link" href="#">Junk</a>';
                        ?>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="content" id="main">
        <br/><br/>
        <div class='div_class' align='center'>
            <?php
                $dir_path = "not a person".$id;
                $extensions_array = array('jpg','png','jpeg','JPG');
                if(is_dir($dir_path)){
                    $files = scandir($dir_path);
                    $files = array_diff($files, array('.', '..',' ',''));

                    for($i = 2; $i < count($files)+2; $i++){
                        $file = pathinfo($files[$i]);
                        $extension = $file['extension'];

                        if(in_array($extension, $extensions_array)){
                            echo '<div class="card" id="card" style="width: 18rem;" name="card1">';

                            echo "<a href='$dir_path/$files[$i]' target='_blank'><img class ='card-img-top' src='$dir_path/$files[$i]' name='picture'></a><br>";
                            echo '<div class="card-body" name="card2">';
                            echo '<a href="delete_pic2.php?id='.$id.'&pic='.$dir_path.'/'.$files[$i].'"><button type="submit" name="submit2" class="btn btn-outline-danger" name="delete">Delete</button></a>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                }
            ?>
        </div>
    </div>

    <script>
        window.onscroll = function() {myFunction()};

        var navbar = document.getElementById("navbar");

        var sticky = navbar.offsetTop;

        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }
    </script>

</body>
</html>