<style>
    #title{
        color:#343a40;
    }
    #camera_name{
        color:#343a40;
    }
    #name{
        width:300px;
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
        border-radius: 10px;

    }
    #card:hover {
        border-color:#343a40;
    }
    #choose{
        margin-right:20px;
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
            <a class="navbar-brand" href="#" id="navbar_title">GSCam</a>
            <div class="collapse navbar-collapse navbar-fixed-top" id="navbarText">
                <ul class="navbar-nav mr-auto">
                </ul>
            </div>
        </nav>
    </div>

    <div class="content" id="main">
        <div class='div_class' align='center'>
            <br/>
            <h3 id="title">Add a camera</h3>
            <div id="open_load" align="center" class="content">
                <form action="camera2.php" method="GET" enctype="multipart/form-data">
                    <div class="col-sm-10"><input type="text" name="camera_name" placeholder="Camera name" class="form-control" id="name" required></div>
                    <br/>
                    <div class="col-sm-10"><input type="text" name="camera_image" placeholder="Camera URL" class="form-control" id="name" required></div>
                    <br/>
                    <div><button type="submit" name="submit" class="btn btn-outline-dark">Add</button></div>
                </form>
                <br/>
            </div>
            <br/><br/>
            <hr>
            <?php
                $servername = "localhost:3306";
                $username = "root";
                $password = "root";
                $databaseName = "camera";

                $conn = new mysqli($servername,$username,$password,$databaseName);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM `camera`";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
	                    echo '<div class="card" id="card" style="width: 15rem;" name="card1">';
                        echo '<br/><h3 id="camera_name">'.$row["camera_name"].'</h3><br/>';
                        echo '<div class="card-body" name="card2">';
                        echo '<a href="main.php?id='.$row["id"].'"><button type="submit" name="submit2" class="btn btn-outline-info" name="choose" id="choose">Choose</button></a>';
                        echo '<a href="delete_camera.php?id='.$row["id"].'"><button type="submit" name="submit2" class="btn btn-outline-danger" name="delete" id="delete">Delete</button></a>';
                        echo '</div>';
                        echo '</div>';
	                }
                }
                $conn->close();
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