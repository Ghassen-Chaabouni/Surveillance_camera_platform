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
<div  id="navbar">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php" id="navbar_title">GSCam</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse navbar-fixed-top" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item" id="camera_navbar">
        <a class="nav-link" href="index.php">Camera</a>
      </li>
      <li class="nav-item" id="employee_navbar">
        <a class="nav-link" href="add_an_employee.php">Add an employee</a>
      </li>
      <li class="nav-item" id="live_navbar">
        <a class="nav-link" href="enter_exit.php">Enter/Exit</a>
      </li>
      <li class="nav-item" id="junk_navbar">
        <a class="nav-link" href="junk.php">Junk</a>
      </li>

    </ul>

  </div>
</nav>
</div>
<div class="content" id="main_content">
	<div class="container">
      <div align="center" id="main">
        <br />
        <img src='my_plot2.PNG'>
      </div>
    </div>
</div>
</body>
</html>


 <?php
     $pyscript = 'C:\\MAMP\\htdocs\\online_learning_enter_exit2.py';
     $python = 'C:\\Users\\admin\\AppData\\Local\\Programs\\Python\\Python37\\python.exe';
     $cmd = "$python $pyscript";
     exec("$cmd", $output);
 ?>
