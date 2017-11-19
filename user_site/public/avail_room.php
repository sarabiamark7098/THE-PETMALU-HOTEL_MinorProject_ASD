<?php
    include 'connection.php';
    $check_in; $check_out;
    if(isset($_GET['check_in'])) {
        $check_in = $_GET['check_in'];
    }
    if(isset($_GET['check_out'])) {
        $check_out = $_GET['check_out'];
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking | Hotel Reservation</title>
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
        </div>
        <div class="container-fluid" style="width: 15%; float: right; margin-top: -100px; margin-right: 15px;">
            <?php
                $queryRoomType = "SELECT type_name FROM type";
                $resultRoomType = mysqli_query($connection, $queryRoomType);
            ?>
            <label for="select">Select Room Type:</label>
            <select name="room_type" class="form-control" onchange="showRooms(this.value)">
                <option value="null"><NULL></option>
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
                                <th style="font-size: 13px;">Availability</th>
                                <th style="font-size: 13px;">Book</th>
                            </tr>
                        </thead>
                        <tbody id="show-tables" style="width: 99%;">
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