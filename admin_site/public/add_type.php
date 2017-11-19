<?php
    include 'connection.php';
    ini_set('mysqli.connect_timeout', 300);
    ini_set('default_socket_timeout', 300);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Type | The PETMALU Hotel Admin</title>
    <link rel="stylesheet" href="stylesheets/style.css">
    <link rel="stylesheet" href="stylesheets/bootstrap.css">
    <link rel="stylesheet" href="stylesheets/bootstrap.min.css">
    <link rel="stylesheet" href="stylesheets/bootstrap-theme.css">
    <link rel="stylesheet" href="stylesheets/bootstrap-theme.min.css">
    </head>
    <body>
        <div id="header" class="col-sm-12">
            <div class="container-fluid">
                <h1>The <span id="highlight-header">PETMALU</span> Hotel Admin</h1>
            </div>
        </div>
        <div id="side-nav" class="col-sm-2">
            <div class="">
                <div class="navigation" id="navigation">
                    <center>
                        <ul>
                            <li><a href="home.php"><img src="images/Home_48px.png" alt="Home" style='float: left; width: 24px; height: 24px;'>Home</a></li>
                            <li><a href="booking.php"><img src="images/Booking_48px.png" alt="Home" style='float: left; width: 24px; height: 24px;'>Bookings</a></li>
                            <li><a href="confirmation.php"><img src="images/Checked_48px.png" alt="Home" style='float: left; width: 24px; height: 24px;'>Confirmation</a></li>
                            <li><a href="room.php"><img src="images/Room_48px.png" alt="Home" style='float: left; width: 24px; height: 24px;'>Room</a></li>
                            <li><a href=""><img src="images/Logout Rounded Up_48px.png" alt="Home" style='float: left; width: 24px; height: 24px;'>Logout</a></li>
                        </ul>
                </center>
                </div>
            </div>
        </div>
        <div id="content" class="col-sm-10">
            <div class="col-sm-6" style="background: #bdc3c7; height: 100%; padding-top: 10px;">
                <h1 class="container-fluid">Add Type</h1>
                <p id="required" class="container-fluid"></p>
                <form class="container-fluidmetho" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="room_type">Room type:</label>
                        <input type="text" name="type_name" class="form-control" style="width: 50%;">
                    </div>
                    <div class="form-group">
                        <label for="cost">Cost:</label>
                        <input type="text" name="price" class="form-control" style="width: 50%;">
                    </div>
                    <div>
                        <label for="photo">Select image to upload:</label>
                        <input type="file" name="image" id="image">
                    </div>
                    <br>
                    <input type="submit" value="Insert" id="insert" name="submit" class="btn btn-success">
                </form>
                <?php
                   

                    function test_input($data) {
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }   

                    if(isset($_POST['submit'])) {

                        $type_name; $price;
                        
                        if(isset($_POST['type_name'])) {
                            $type_name = $_POST['type_name'];
                        }

                        if(isset($_POST['price'])) {
                            $price = $_POST['price'];
                        }

                        if(getimagesize($_FILES['image']['tmp_name']) == FALSE) {
                               echo "Please select an image";
                        }else {
                            $image = addslashes($_FILES['image']['tmp_name']);
                            $name = addslashes($_FILES['image']['name']);
                            $image = file_get_contents($image);
                            $image = base64_encode($image);
                            
                            $query = "INSERT INTO `type` (type_name, price, image_name, image_data) VALUES ('$type_name', $price, '$name', '$image')";
                            $result = mysqli_query($connection, $query);

                            if($result) {
                                echo "success";
                            }else {
                                echo "failed" ;
                            }
                        }
                    }

                ?>
            </div>
        </div>
    </body>
</html>