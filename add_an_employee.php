<style>
    #delete{
	margin-left:35%;
    }
    #train{
        margin-top:-97px;
        margin-left:100px;
    }
    #upload{
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
      <li class="nav-item active" id="employee_navbar">
        <a class="nav-link" href="#">Add an employee</a>
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

<div class="content">
<div id="main" align="center">
    <h3 id="title">Upload a picture</h3>
    <br/>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div><input type="file" name="file[]" accept="image/*" multiple="multiple"></div>
            <br/>
            <div class="col-sm-10"><input type="text" name="text" list="names" placeholder="Name" class="form-control" id="name" required></div>
            <br/>
            <div><button id="upload" type="submit" name="submit" class="btn btn-outline-dark">Upload</button></div>

    </form>
    <a href='start_training.php'><button id="train" class="btn btn-outline-info" name = "train">Start training</button></a>


    <datalist id="names">
        <option>Chaabouni Ghassen</option>
        <option>Mohamed</option>
    </datalist>
     <br />
		<table class="table table-bordered" id="table">

        <?php
        $servername = "localhost:3306";
        $username = "root";
        $password = "root";
        $databaseName = "image";

        $conn = new mysqli($servername,$username,$password,$databaseName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM `images`";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        $i=0;
        while($row = $result->fetch_assoc()) {
	        $i = $i+1;
		    if($i==1){
			    echo '<td class="table_title">Name</td>';
			    echo '<td class="table_title">Picture</td>';
			    echo '<tr><td><type="text" name="name" placeholder="Name" style="width:200px;height:150px;" id="name">' . $row["name"]. '</td>';

                 echo '<td>';
                 echo "<br/>";
                 $ch="";
                 $l=1;
                 $s=0;
                while($s<strlen($row[imagename])){

                    if((strcmp($row[imagename][$s],"-")==0)){


                         echo '<div class="card" id="card" style="width: 18rem;" name="card1">';
                         echo "<a href='$ch' target='_blank'><img class ='card-img-top' src='$ch' name='picture'></a><br>";
                         echo '<div class="card-body" name="card2">';
                         echo "<a href='delete_pic.php?pic=$ch&id=$row[id]&image=$row[imagename]'><button class='btn btn-outline-danger' id='delete'>Delete</button></a>";
                         echo '</div>';
                         echo '</div>';

                        $ch="";
                        $s=$s+1;


                    }
                    $ch=$ch.$row[imagename][$s];
                    $s=$s+1;

                }

                echo '</td>';
                echo "<td><a href='delete_em.php?id=$row[id]&name=$row[name]'><button class='btn btn-outline-danger'>Delete</button></a></td>";
                echo '</tr>';

		    }else{
                    $ch="";
                    $l=1;
                    $s=0;

                echo '<tr><td><type="text" name="name" placeholder="Name" style="width:200px;height:150px;" id="name">' . $row["name"]. '</td>';
                echo '<td>';
                echo "<br/>";
                while($s<strlen($row[imagename])){

                    if((strcmp($row[imagename][$s],"-")==0)){

                         echo '<div class="card" id="card" style="width: 18rem;" name="card1">';
                         echo "<a href='$ch' target='_blank'><img class ='card-img-top' src='$ch' name='picture'></a><br>";
                         echo '<div class="card-body" name="card2">';
                         echo "<a href='delete_pic.php?pic=$ch&id=$row[id]&image=$row[imagename]'><button class='btn btn-outline-danger' id='delete'>Delete</button></a>";
                         echo '</div>';
                         echo '</div>';

                        $ch="";
                        $s=$s+1;

                    }
                    $ch=$ch.$row[imagename][$s];
                    $s=$s+1;
                }
                echo '</td>';
                echo "<td><a href='delete_em.php?id=$row[id]&name=$row[name]'><button class='btn btn-outline-danger'>Delete</button></a></td>";
                echo '</tr>';


		    }
	    }

        echo "</table>";
        } else { echo "0 results"; }
        $conn->close();
        ?>
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

