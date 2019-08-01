<style>
    #train{
        margin-top:-52px;
        margin-left:100px;
    }
    #upload{
        margin-top:-18px;
        margin-right:130px;
    }
    .btn:hover{
        border-radius: 10px;
        border-color: blue;
    }
    #name{

        width:300px;
    }
    #card{
        display: inline-block;
        margin:10px;
    }

    hr{
        color:black;
    }
    #title{
        color:#343a40;
        margin-top:20px;
    }
    #name_title{
        color:#343a40;
    }
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
</style

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
<div  id="navbar">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php" id="navbar_title">GSCam</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item" id="camera_navbar">
        <a class="nav-link" href="index.php">Camera</a>
      </li>
      <li class="nav-item" id="employee_navbar">
        <a class="nav-link" href="add_an_employee.php">Add an employee</a>
      </li>
      <li class="nav-item active" id="live_navbar">
        <a class="nav-link" href="#">Enter/Exit</a>
      </li>
      <li class="nav-item" id="junk_navbar">
        <a class="nav-link" href="junk.php">Junk</a>
      </li>
    </ul>

  </div>
</nav>
</div>

<div class="content">
<div id="main" align="center">
    <h3 id="title">Upload a picture</h3>
    <br/>
    <form action="upload_to_train2.php" method="POST" enctype="multipart/form-data">
            <div><input type="file" name="file[]" accept="image/*" multiple="multiple"></div>
            <br/>
<div class="form-group">
    <select class="form-control" id="name" name="name">
      <option>enter</option>
      <option>exit</option>
    </select>
  </div>

            <br/>
            <div><button id="upload" type="submit" name="submit" class="btn btn-outline-dark">Upload</button></div>

    </form>



    <a href='start_training_enter_exit.php'><button id="train" class="btn btn-outline-info" name = "train">Start training</button></a>


    <datalist id="names">
        <option>Chaabouni Ghassen</option>
        <option>Mohamed</option>
    </datalist>
</div>
<br/><br/><br/><br/><br/>
<hr>
<?php
$dir_path = "enter_exit/";
$extensions_array = array('jpg','png','jpeg','JPG');
$k = 0;
if(is_dir($dir_path))
{
    $files = scandir($dir_path);
    $files = array_diff($files, array('.', '..',' ',''));

    for($j = 2; $j < count($files)+2; $j++)
    {

        $path = $dir_path.$files[$j];
        $files2 = scandir($path);
        $files2 = array_diff($files2, array('.', '..'));
        echo "<br/><br/>";
        echo "<div class='div_class' align='center'>";
        echo "<h3 id='name_title'>$files[$j]</h3>";

        for($i = 2; $i < count($files2)+2; $i++)
             {

                 $file2 = pathinfo($files2[$i]);
                 $extension = $file2['extension'];

                 if(in_array($extension, $extensions_array))
                     {
                         $k = $k+1;
                         echo '<div class="card" id="card" style="width: 18rem;" name="card1">';

                         echo "<img class ='card-img-top' src='$path/$files2[$i]' name='picture'><br>";
                         echo '<div class="card-body" name="card2">';
                         echo '<a href="delete_pic_train2.php?pic='.$path.'/'.$files2[$i].'"><button type="submit" name="submit2" class="btn btn-outline-danger" name="delete">Delete</button></a>';
                         echo '</div>';
                         echo '</div>';
                     }

             }
             echo "</div>";

    }
}
?>
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
