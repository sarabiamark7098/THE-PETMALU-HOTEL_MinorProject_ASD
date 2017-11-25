<?php
    include 'connection.php';

    session_start();

    $check_in; $check_out;

    if(isset($_GET['check_in'])) {
        $check_in = $_GET['check_in'];
        $_SESSION['check_in'] = $check_in;
    }
    if(isset($_GET['check_out'])) {
        $check_out = $_GET['check_out'];
        $_SESSION['check_out'] = $check_out;
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking | The PETMALU Hotel </title>
    <link rel="stylesheet" href="stylesheets/bootstrap.min.css">
    <link rel="stylesheet" href="stylesheets/style.css?ver=1.0.1"> 
</head>
<body>
    <nav class="booking-nav">
        <div class="container">
            <div class="navbar-header page-scroll">
                <a class="navbar-brand style-nav" href="index.html">The PETMALU Hotel</a>
            </div>
            <ul class="nav navbar-nav" style="float: right;">
                <li><a href="index.html" class="style-nav">Home</a></li>
                <li><a href="booking_Form.php" class="style-nav">Booking</a></li>
            </ul>
        </div>
    </nav>

    <div class="col-sm-12" id="check-room">
        <div id="check-details" class="container-fluid">
            <label for="check-in">Check in: <span><?php echo $check_in;?></span></label><br><br>
            <label for="check-out">Check out: <span><?php echo $check_out;?></span></label>
            <center><img src="images/jump.gif" alt="jump" style="width: 200px; height: 150px; margin-top: -90px;"></center>
        </div>
        <div class="container-fluid" style="width: 15%; float: right; margin-top: -100px; margin-right: 15px;">
            <?php
                $queryRoomType = "SELECT type_name FROM type";
                $resultRoomType = mysqli_query($connection, $queryRoomType);
            ?>
            <label for="select">Select Room Type:</label>
            <select name="room_type" class="form-control" onchange="showRooms(this.value)">
                <option value="all">All Rooms</option>
                <?php while($row = mysqli_fetch_assoc($resultRoomType)):;?>
                <option value="<?php echo $row['type_name'];?>"><?php echo $row['type_name'];?></option>
                <?php endwhile;?>
                <?php mysqli_free_result($result); ?>
            </select>
        </div>
        <div class="container-fluid" id="Select-Rooms">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="font-size: 13px;">Room no</th>
                                <th style="font-size: 13px;">Room Type</th>
                                <th style="font-size: 13px;">Picture</th>
                                <th style="font-size: 13px;">Price</th>
                                <th style="font-size: 13px;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="show-tables" style="width: 99%;">
                            <?php
                                $query = "SELECT room.`room_no`, type.`type_name`, type.`image_data`, type.`price` 
                                FROM 
                                room,
                                `type`,
                                room_type
                                WHERE
                                room.`room_no` = room_type.`room_no` AND
                                type.`type_no`= room_type.`type_no` AND
                                room.`room_no` NOT IN(SELECT DISTINCT booking.`room_no` FROM
                                booking,
                                booking_date
                                WHERE 
                                booking.`date_no` = booking_Date.`date_no` AND
                                (booking_Date.`check_in` >= '$check_in' AND booking_date.`check_in` < '$check_out')
                                OR
                                (booking_Date.`check_out` >= '$check_in' AND booking_Date.`check_out` < '$check_out')
                                )   
                                ORDER BY room.`room_no` ASC";

                                $result = mysqli_query($connection, $query);
                                if(!$result) {
                                    die("Database query failed.");
                                }
                                while($row = mysqli_fetch_assoc($result)) {
                                    $room_no = $row['room_no'];
                                    echo "<tr><td style='font-size: 12px;'>". $row['room_no'] ."</td>
                                    <td style='font-size: 12px;'>". $row['type_name'] ."</td>
                                    <td style='font-size: 12px;'><img width='100' height='100' src='data:image;base64,". $row['image_data'] ."'></td>
                                    <td style='font-size: 12px;'>". $row['price'] ."</td>
                                    <td>
                                    <a href='customer_Info.php?room_no=$room_no' class='btn btn-default'>
                                    <img src='images/Book_48px.png' style='width: 20px; height: 20px;'>Book</a>
                                    </td>";
                                }
                                mysqli_free_result($result);
                            ?>
                            <!--Ajax code auto refresh a certain section in html-->
                            <script>
                                function showRooms(str) {
                                var xhttp;    
                                if (str == "") {
                                    document.getElementById("show-tables").innerHTML = "";
                                    return;
                                }
                                xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("show-tables").innerHTML = this.responseText;
                                    }
                                };
                                xhttp.open("GET", "load_table_room.php?type_name="+str, true);
                                    xhttp.send();
                                }
                            </script>
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>
    </div>
</body>
</html>