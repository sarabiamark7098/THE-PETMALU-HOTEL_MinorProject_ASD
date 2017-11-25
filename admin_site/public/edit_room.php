<?php include 'connection.php'?>

<?php
    $room_no; $type_name; $price; $avail;
    if(isset($_GET['room_no'])) {
        $room_no = $_GET['room_no'];
    }

    if(isset($_GET['type_name'])) {
        $type_name = $_GET['type_name'];
    }

    if(isset($_GET['price'])) {
        $price = $_GET['price'];
    }

    if(isset($_GET['avail'])) {
        $avail = $_GET['avail'];
    }
?>

<?php
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Room | The PETMALU Hotel Admin</title>
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
        <div class="container-fluid">
            <div class="col-sm-6">
            <h1>Edit Room</h1>
            <br>
                <form action="add_room_type.php" class="container-fluid" method="get">
                    <div class="form-group">
                        <label for="firstname">Room No. :</label>
                        <input type="text" name="room_no" value="<?php echo $room_no?>" class="form-control" style="width: 50%;">
                    </div>
                    <div class="form-group">
                        <label for="room_type">Room Type: </label>
                        <input type="text" name="type_name" value="<?php echo $type_name?>" class="form-control" style="width: 50%;">
                    </div>
                    <div class="form-group">
                        <label for="room_type">Cost: </label>
                        <input type="text" name="price" value="<?php echo $price?>" class="form-control" style="width: 50%;">
                    </div>
                    <div class="form-group">
                        <label for="room_type">Available: </label>
                        <input type="text" name="avail" value="<?php echo $avail?>" class="form-control" style="width: 50%;">
                    </div>
                    <br>
                    <button type="submit" name="update" value="update" class="btn btn-success">Add</button>
                    <button type="submit" name="cancel" value="cancel" class="btn btn-success">Cancel</button>
                    <?php
                        if(isset($_GET['cancel'])) {
                            header("Location: room.php");
                        }

                        if(isset($_GET['update'])) {
                            $queryUpdateRoom = "UPDATE room SET room_no = $room_no ";
                            $resultUpdateRoom = mysqli_query($connection, $queryUpdateRoom);

                            $queryUpdateType = "UPDATE type SET "
                        }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    // 5. Close database connection
    mysqli_close($connection);
?>