<style>
    #check_persons{
        margin-right:20px;
    }
    #check_faces{
        margin-right:20px;
    }
    #pic_margin{
        margin-top:0px;
    }
    #pic_text{
        display:none;
    }
    #open_load{
        margin-left:0px;
        margin-right:0px;
    }

    #exit input:checked ~ .checkmark {
        background-color: #F32222;
    }
    .container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }


    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #ccc;
        border-radius: 50%;
    }


    .container input:checked ~ .checkmark {
        background-color: #2196F3;
    }

    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    .container input:checked ~ .checkmark:after {
        display: block;
    }

    .btn:hover{
        border-radius: 10px;
        border-color: blue;
    }
	p{
		font-size: 0px;
	}
	
	table{
		margin-left: 300px;
	}
	#main{
	    cursor: default;
	}
	.btn{
		color:black;
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
    #title{
        color:#343a40;
        margin-top:20px;
        margin-left:100px;
        margin-right:-900px;
        cursor: default;
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
        margin-right:700px;
    }
    #navbar{
        z-index:1;
    }
    textarea{
        background-color: #eee;
        border: none;

    }
    #time{
        outline: none;
        resize: none;
    }
    a.lightbox img {
        height: 150px;
        border: 3px solid white;
        box-shadow: 0px 0px 8px rgba(0,0,0,.3);
        margin-top:-15px;
    }

    .lightbox-target {
        z-index:999;
        position: fixed;
        right:0;
        top: 0%;
        width: 100%;
        background: rgba(0,0,0,.7);
        opacity: 0;
        -webkit-transition: opacity .5s ease-in-out;
        -moz-transition: opacity .5s ease-in-out;
        -o-transition: opacity .5s ease-in-out;
        transition: opacity .5s ease-in-out;
        overflow: hidden;
    }

    .lightbox-target img {
        position: absolute;
        top: 0;
        left:0;
        margin-top:250px;
        margin-left:0px;
        bottom: 0;
        max-height: 0%;
        max-width: 0%;
        border: 3px solid white;
        box-shadow: 0px 0px 8px rgba(0,0,0,.3);
        box-sizing: border-box;
        -webkit-transition: .5s ease-in-out;
        -moz-transition: .5s ease-in-out;
        -o-transition: .5s ease-in-out;
        transition: .5s ease-in-out;
    }

    a.lightbox-close {
        display: block;
        width:50px;
        height:50px;
        background: white;
        color: black;
        text-decoration: none;
        position: absolute;
        margin-top:8;
        right: 10;
    }

    a.lightbox-close:before {
        border-radius:10px;
        content: "";
        display: block;
        height: 30px;
        width: 3px;
        background: white;
        position: absolute;
        left: 24px;
        top:9.4px;
        -webkit-transform:rotate(45deg);
        -moz-transform:rotate(45deg);
        -o-transform:rotate(45deg);
        transform:rotate(45deg);
    }

    a.lightbox-close:after {
        border-radius:10px;
        content: "";
        display: block;
        height: 30px;
        width: 3px;
        background: white;
        position: absolute;
        left: 24px;
        top:9.4px;
        -webkit-transform:rotate(-45deg);
        -moz-transform:rotate(-45deg);
        -o-transform:rotate(-45deg);
        transform:rotate(-45deg);
    }

    .lightbox-target:target {
        opacity: 1;
        top: 0;
        bottom: 0;
    }

    .lightbox-target:target img {
        position: static;
        max-height: 1500px;
        max-width: 1500px;
    }

    .lightbox-target:target a.lightbox-close {
        top: 0px;
        border: none;
        background: rgba(0,0,0,0);
	    color: white;
	    box-shadow: inset 0 0 0 3px white;
	    padding: 10px;
	    font-size: 18px;
	    border-radius: 50%;
	    position: relative;
	    box-sizing: border-box;
	    transition: all 500ms ease;
    }

    #overlay {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    right: 0;
    background: #000;
    opacity: 0.8;
    filter: alpha(opacity=80);
    }

    #loading {
        width: 50px;
        height: 57px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -28px 0 0 -25px;
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
      <li class="nav-item active" id="camera_navbar">
        <a class="nav-link" href="#">Camera</a>
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

<div id="open_load" align="center" class="content">
    <br/><br/>
    <a id="check_persons" href='check_person.php'><button class="btn btn-outline-info" name = "check_persons">Check persons</button></a>
    <a id="check_faces" href='check_faces.php'><button class="btn btn-outline-info" name = "check_faces">Check faces</button></a>
    <a id="open_camera" href='open_camera.php'><button class="btn btn-outline-info" name = "open_camera">Open camera</button></a>
</div>


<div class="content" id="main_content">
	<div class="container">
      <div align="center" id="main">

        <br />
		<table class="table table-bordered" id="table">

        <?php
        $servername = "localhost:3306";
        $username = "root";
        $password = "root";
        $databaseName = "database";

        $conn = new mysqli($servername,$username,$password,$databaseName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM `database`";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
        $i=0;
        while($row = $result->fetch_assoc()) {
	        $i = $i+1;
		    if($i==1){
			    echo '<td class="table_title">Name</td>';
			    echo '<td class="table_title">Enter</td>';
			    echo '<td class="table_title">Exit</td>';
			    echo '<td class="table_title">Time</td>';
			    echo '<td class="table_title">Picture</td>';
		    }else{
		        echo '<form action="save.php" method="get" enctype="multipart/form-data">';

                $ch="";
                for($i=0;$i<strlen($row["Name"]);$i++){
                    if($row["Name"][$i]=="&"){
                        break;
                    }
                    $ch=$ch.$row["Name"][$i];
                }
                $row["Name"]=$ch;

		        echo '<tr><td><textarea data-limit-rows="true" rows="1" type="text" name="name" placeholder="Name" style="width:200px;height:150px;" id="name">' . $row["Name"]. '</textarea></td>';

                echo '<td>';

                echo '<label class="container" id="enter">';
                if($row["Enter_Exit"]=="enter"){
                    echo '<input type="radio" checked name="enter_exit" value="enter" >';
                }else{
                    echo '<input type="radio" name="enter_exit" value="enter" >';
                }
                echo '<span class="checkmark"></span>';
                echo '</label>';

                echo '</td>';

                echo '<td>';

                echo '<label class="container" id="exit">';
                if($row["Enter_Exit"]=="exit"){
                    echo '<input type="radio" checked name="enter_exit" value="exit">';
                }else{
                    echo '<input type="radio" name="enter_exit" value="exit">';
                }
                echo '<span class="checkmark"></span>';
                echo '</label>';

			    echo '<td><textarea readonly type="text" name="time" placeholder="Time" style="width:200px;height:150px;" id="time">' . $row["Time"] . '</textarea></td>';

                $k=$i-1;
			    echo '<td><textarea readonly id="pic_text" type="text" name="picture">'. $row["Picture"].'</textarea><a class="lightbox" href="#img'.$k.'"><img id="pic_margin" src="' . $row["Picture"]. '"height="150" class="picture" /></a></td>';

			    echo '<div class="lightbox-target" id="img'.$k.'">';
                echo '<img src="' . $row["Picture"]. '"/>';
                echo '<a class="lightbox-close" href="#" onclick="document.getElementById("img'.$k.'").id = "img"; return false"></a>';
                echo '</div>';

			    echo '<td><button type="submit" name="save" class="btn btn-outline-info" value="update">Save</button></td>';
			    echo '</form>';
			    echo "<td><a href='delete.php?Time=$row[Time]&Picture=$row[Picture]'><button class='btn btn-outline-danger'>Delete</button></a></td>";
			    echo '</tr>';
		    }
	    }

        echo "</table>";
        } else { echo "0 results"; }
        $conn->close();
        ?>
      </div>
    </div>
</div>


<script>
$(document).ready(function () {
  $('textarea[data-limit-rows=true]')
    .on('keypress', function (event) {
        var textarea = $(this),
            text = textarea.val(),
            numberOfLines = (text.match(/\n/g) || []).length + 1,
            maxRows = parseInt(textarea.attr('rows'));

        if (event.which === 13 && numberOfLines === maxRows ) {
          return false;
        }
    });
});
</script>


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


