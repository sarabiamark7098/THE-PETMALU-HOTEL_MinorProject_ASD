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
<title>Booking | The PETMALU Hotel Admin</title>
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
        <h2>Bookings</h2>
        <div class="container-fluid" id="table">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="font-size: 13px;">#</th>
                                <th style="font-size: 13px;">Guest name</th>
                                <th style="font-size: 13px;">Address</th>
                                <th style="font-size: 13px;">Contact Number</th>
                                <th style="font-size: 13px;">Reservation</th>
                                <th style="font-size: 13px;">Check in</th>
                                <th style="font-size: 13px;">Check out</th>
                                <th style="font-size: 13px;">Room no.</th>
                                <th style="font-size: 13px;">Type</th>
                                <th style="font-size: 13px;">Payment</th>
                                <th style="font-size: 13px;">Action</th>
                            </tr>
                        </thead>
                        <tbody style="width: 99%;">
                            <?php //Table 
                                // 2. Perform database query
                                $query = "SELECT e.booking_id, d.`firstname`, d.`middle_Initial`, d.`lastname`, d.`address`, d.`contact_no`, a.`booking_date`, a.`check_in`, a.`check_out`, b.`room_no`, g.`type_name` 
                                FROM
                                `booking_date` a,
                                `room` b,
                                `hotel` c,
                                `guest` d,
                                `booking` e,
                                `room_type` f,
                                `type` g,
                                `avail` h
                                WHERE
                                a.`date_no` = e.`date_no` AND
                                b.`room_no` = e.`room_no` AND
                                c.`hotel_id` = e.`hotel_id` AND
                                d.`guest_id` = e.`guest_id` AND
                                b.`room_no` = f.`room_no` AND
                                f.`type_no` = g.`type_no` AND
                                b.`room_no` = h.`room_no` AND
                                e.`confirm` = 1
                                ";
                                $result = mysqli_query($connection, $query);
                                if(!$result) {
                                    die("Database query failed.");
                                }
                                //3. Use return data (if any)
                                while($row = mysqli_fetch_assoc($result)) {
                                    //output data from each row
                                    echo "<tr><td style='font-size: 12px;'>". $row['booking_id'] ."</td>
                                    <td style='font-size: 12px;'>". $row['firstname'] ."<br>". $row['middle_Initial']."<br>".$row['lastname']."</td>
                                    <td style='font-size: 12px;'>". $row['address']."</td>
                                    <td style='font-size: 12px;'>". $row['contact_no'] ."</td>
                                    <td style='font-size: 12px;'>". $row['booking_date'] ."</td>
                                    <td style='font-size: 12px;'>". $row['check_in'] ."</td>
                                    <td style='font-size: 12px;'>". $row['check_out'] ."</td>
                                    <td style='font-size: 12px;'>". $row['room_no'] ."</td>
                                    <td style='font-size: 12px;'>". $row['type_name'] ."</td>
                                    <td style='font-size: 12px;'>N/A</td>
                                    <td>
                                    <a href='edit.php?
                                    id={$row['booking_id']}&
                                    firstname={$row['firstname']}&
                                    lastname={$row['lastname']}&
                                    middle={$row['middle_Initial']}&
                                    address={$row['address']}&
                                    contact={$row['contact_no']}&'><img src='images/Edit_48px.png' style='width: 20px; height: 20px;'></a>
                                    <a href='delete.php?id={$row['booking_id']}'><img src='images/Delete_48px.png' style='width: 20px; height: 20px;'></a>
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
</body>
</html>

<?php
    // 5. Close database connection
    mysqli_close($connection);
?>