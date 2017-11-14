<?php include 'connection.php'?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Room | The PETMALU Hotel Admin</title>
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
                <h1 class="container-fluid">Add Room</h1>
                <p id="required" class="container-fluid"></p>
                <form action="add_room_type.php" class="container-fluid" method="post">
                    <div class="form-group">
                        <label for="firstname">Room No. :</label>
                        <input type="text" name="room_no" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="room_type">Room Type: </label>
                        <?php
                            $query = "SELECT type_name FROM type";
                            $result = mysqli_query($connection, $query);
                        ?>
                        <select name="room_type" class="form-control" style="width: 50%;">
                            <option value="null"><NULL></option>
                            <?php while($row = mysqli_fetch_assoc($result)):;?>
                            <option value="<?php echo $row['type_name']?>"><?php echo $row['type_name'];?></option>
                            <?php endwhile;?>
                        </select>
                    </div>
                    <br>
                    <button type="submit" name="id" class="btn btn-success">Add</button>
                </form>
            </div>
        </div>
    </body>
</html>