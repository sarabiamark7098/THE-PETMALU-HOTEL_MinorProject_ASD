<?php include 'connection.php'?>

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
    <title>Room | The PETMALU Hotel Admin</title>
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
            <h2>Room</h2>
            <div class="container-fluid" id="table">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="font-size: 13px;">Room no</th>
                                    <th style="font-size: 13px;">Room Type</th>
                                    <th style="font-size: 13px;">Price</th>
                                    <th style="font-size: 13px;">Availability</th>
                                    <th style="font-size: 13px;">Action</th>
                                </tr>
                            </thead>
                            <tbody style="width: 99%;">

                                <?php 
                                
                                    //Table 
                                    // 2. Perform database query

                                    $query = "SELECT a.`room_no`, c.`type_name`, c.`price`, d.`avail`
                                    FROM 
                                    `room` a, 
                                    `room_type` b, 
                                    `type` c,
                                    `avail` d
                                    WHERE 
                                    a.`room_no` = b.`room_no` AND
                                    b.`type_no` = c.`type_no` AND
                                    a.`room_no` = d.`room_no` ORDER BY a.`room_no` ASC";

                                    $result = mysqli_query($connection, $query);

                                    if(!$result) {
                                        die("Database query failed.");
                                    }

                                    //3. Use return data (if any)
                                    while($row = mysqli_fetch_assoc($result)) {
                                        //output data from each row

                                        echo "<tr><td style='font-size: 12px;'>". $row['room_no'] ."</td>
                                        <td style='font-size: 12px;'>". $row['type_name'] ."</td>
                                        <td style='font-size: 12px;'>". $row['price'] ."</td>
                                        <td style='font-size: 12px;'>" . $row['avail'] . "</td>
                                        <td>
                                        <a href='edit.php'><img src='images/Edit_48px.png' style='width: 20px; height: 20px;'></a>
                                        <a href='delete.php'><img src='images/Delete_48px.png' style='width: 20px; height: 20px;'></a>
                                        </td>";
                                    }
                                    mysqli_free_result($result);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <a href="add_room.php" class="btn btn-default">Add Room</a>
            <a href="add_type.php" class="btn btn-default">Add Type</a>
        </div>
    </div>
</body>
</html>

<?php
    // 5. Close database connection
    mysqli_close($connection);
?>